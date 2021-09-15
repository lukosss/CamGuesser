<?php

namespace App\Application\Camera;

use App\Domain\Camera\Dto\Camera;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class CameraDenormalizer implements DenormalizerInterface
{

    public function denormalize($data, string $type, string $format = null, array $context = []): Camera
    {
        return new Camera(
            $data['result']['webcams'][0]['player']['day']['embed'],
            $data['result']['webcams'][0]['id'],
            $data['result']['webcams'][0]['location']['country']
        );
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === Camera::class;
    }
}
