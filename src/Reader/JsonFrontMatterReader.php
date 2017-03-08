<?php
namespace ZeroConfig\Preacher\Plugin\FrontMatter\Reader;

use Symfony\Component\Serializer\Encoder\JsonEncoder;

class JsonFrontMatterReader extends AbstractFrontMatterReader
{
    /**
     * Decode the given front matter.
     *
     * @param string $matter
     *
     * @return array
     */
    protected function decodeMatter(string $matter): array
    {
        return $this->getDecoder()->decode($matter, JsonEncoder::FORMAT);
    }
}
