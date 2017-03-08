<?php
namespace ZeroConfig\Preacher\Plugin\FrontMatter;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @codeCoverageIgnore
 */
class PreacherFrontMatterBundle extends Bundle
{
    /**
     * Get the name of the parent bundle.
     *
     * @return string
     */
    public function getParent(): string
    {
        return 'PreacherBundle';
    }
}
