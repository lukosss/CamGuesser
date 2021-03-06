<?php


namespace App\Application\Id\Serializer\Denormalizer;

use App\Domain\Id\Dto\Id;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class IdDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, string $type, string $format = null, array $context = []): Id
    {
        return new Id(
            $data['result']['webcams'][0]['id']
        );
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === Id::class;
    }
}
