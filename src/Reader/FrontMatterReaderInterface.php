<?php
namespace ZeroConfig\Preacher\Plugin\FrontMatter\Reader;

use ZeroConfig\Preacher\Source\SourceInterface;

interface FrontMatterReaderInterface
{
    /**
     * Get front matter for the given source.
     *
     * @param SourceInterface $source
     *
     * @return array
     */
    public function getFrontMatter(SourceInterface $source): array;
}
