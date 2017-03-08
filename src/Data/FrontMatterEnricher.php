<?php
namespace ZeroConfig\Preacher\Plugin\FrontMatter\Data;

use ArrayAccess;
use ZeroConfig\Preacher\Data\DataEnricherInterface;
use ZeroConfig\Preacher\Output\OutputInterface;
use ZeroConfig\Preacher\Plugin\FrontMatter\Reader\FrontMatterReaderInterface;
use ZeroConfig\Preacher\Source\SourceInterface;

class FrontMatterEnricher implements DataEnricherInterface
{
    /** @var FrontMatterReaderInterface */
    private $reader;

    /**
     * Constructor.
     *
     * @param FrontMatterReaderInterface $reader
     */
    public function __construct(FrontMatterReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Enrich the template data using the given source and output.
     *
     * @param ArrayAccess     $templateData
     * @param SourceInterface $source
     * @param OutputInterface $output
     *
     * @return void
     *
     * @throws FrontMatterCollisionException When a key already exists on the
     *   given template data.
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function enrich(
        ArrayAccess $templateData,
        SourceInterface $source,
        OutputInterface $output
    ) {
        $matter = $this->reader->getFrontMatter($source);

        foreach ($matter as $key => $value) {
            if ($templateData->offsetExists($key)) {
                throw new FrontMatterCollisionException(
                    sprintf(
                        'Trying to set key "%s" with value %s, yet template data'
                        . ' already holds value %s',
                        $key,
                        var_export($value, true),
                        var_export($templateData->offsetGet($key), true)
                    )
                );
            }

            $templateData->offsetSet($key, $value);
        }
    }
}
