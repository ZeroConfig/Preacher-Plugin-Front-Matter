<?php
namespace ZeroConfig\Preacher\Plugin\FrontMatter\Locator;

use SplFileInfo;
use ZeroConfig\Preacher\Source\SourceInterface;

abstract class AbstractFrontMatterLocator implements FrontMatterLocatorInterface
{
    /**
     * Get the possible extensions used for front matter files.
     *
     * @return string[]
     */
    abstract protected function getFrontMatterExtensions(): array;

    /**
     * Locate a front matter file for the given source.
     *
     * @param SourceInterface $source
     *
     * @return SplFileInfo
     *
     * @throws FrontMatterNotFoundException When no front matter file could be
     *   found for the given source.
     */
    public function locate(SourceInterface $source): SplFileInfo
    {
        $path = array_reduce(
            $this->getFrontMatterExtensions(),
            function ($memo, string $extension) use ($source) {
                return $memo || realpath(
                    sprintf(
                        '%s/%s.%s',
                        getcwd(),
                        $source->getBaseName(),
                        $extension
                    )
                );
            },
            false
        );

        if ($path === false) {
            throw new FrontMatterNotFoundException(
                sprintf(
                    'Could not find front matter for %s',
                    $source->getBaseName()
                )
            );
        }

        return new SplFileInfo($path);
    }
}
