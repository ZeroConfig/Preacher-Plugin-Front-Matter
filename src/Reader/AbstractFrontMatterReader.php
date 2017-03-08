<?php
namespace ZeroConfig\Preacher\Plugin\FrontMatter\Reader;

use Symfony\Component\Serializer\Encoder\DecoderInterface;
use ZeroConfig\Preacher\Plugin\FrontMatter\Locator\FrontMatterLocatorInterface;
use ZeroConfig\Preacher\Plugin\FrontMatter\Locator\FrontMatterNotFoundException;
use ZeroConfig\Preacher\Source\SourceInterface;

abstract class AbstractFrontMatterReader implements FrontMatterReaderInterface
{
    /** @var FrontMatterLocatorInterface */
    private $locator;

    /** @var DecoderInterface */
    private $decoder;

    /**
     * Constructor.
     *
     * @param FrontMatterLocatorInterface $locator
     * @param DecoderInterface            $decoder
     */
    public function __construct(
        FrontMatterLocatorInterface $locator,
        DecoderInterface $decoder
    ) {
        $this->locator = $locator;
        $this->decoder = $decoder;
    }

    /**
     * Get front matter for the given source.
     *
     * @param SourceInterface $source
     *
     * @return array
     */
    public function getFrontMatter(SourceInterface $source): array
    {
        try {
            $matter = $this->decodeMatter(
                implode(
                    '',
                    iterator_to_array(
                        $this->locator->locate($source)->openFile('r')
                    )
                )
            );
        } catch (FrontMatterNotFoundException $e) {
            $matter = [];
        }

        return $matter;
    }

    /**
     * Get the configured decoder.
     *
     * @return DecoderInterface
     */
    protected function getDecoder(): DecoderInterface
    {
        return $this->decoder;
    }

    /**
     * Decode the given front matter.
     *
     * @param string $matter
     *
     * @return array
     */
    abstract protected function decodeMatter(string $matter): array;
}
