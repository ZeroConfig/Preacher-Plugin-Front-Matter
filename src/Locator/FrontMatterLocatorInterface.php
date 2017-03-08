<?php
namespace ZeroConfig\Preacher\Plugin\FrontMatter\Locator;

use SplFileInfo;
use ZeroConfig\Preacher\Source\SourceInterface;

interface FrontMatterLocatorInterface
{
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
    public function locate(SourceInterface $source): SplFileInfo;
}
