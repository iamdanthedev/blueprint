<?php

namespace App\Entities;

use JsonSerializable;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;


class BaseEntity implements JsonSerializable {
    public function jsonSerialize()
    {
        $serializer = new Serializer([new GetSetMethodNormalizer()]);
        return $serializer->normalize($this);
    }

}
