<?php
namespace ZeroConfig\Preacher\Plugin\FrontMatter\Locator;

class JsonFrontMatterLocator extends AbstractFrontMatterLocator
{
    /**
     * Get the possible extensions used for front matter files.
     *
     * @return string[]
     */
    protected function getFrontMatterExtensions(): array
    {
        return ['json'];
    }
}
