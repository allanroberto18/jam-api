<?php
declare(strict_types=1);

namespace App\Helpers;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializerObjectHelper
{
    /**
     * @param $values
     * @return string
     */
    public static function serializeObject(object $values): string
    {
        $serializer = self::getSerializer();

        return $serializer->serialize($values, 'json');
    }

    /**
     * @param array $data
     * @return string
     */
    public static function serializeArray(array $data): string
    {
        $serializer = self::getSerializer();

        return $serializer->serialize($data, 'json');
    }

    /**
     * @return Serializer
     */
    private static function getSerializer(): Serializer
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalilzer = new ObjectNormalizer();
        $normalilzer->setIgnoredAttributes(["__initializer__", "__cloner__","__isInitialized__"]);
        $normalizers = [$normalilzer];
        return new Serializer($normalizers, $encoders);
    }
}
