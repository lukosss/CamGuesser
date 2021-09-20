<?php


namespace App\Application\Country\Serializer\Denormalizer;

use App\Domain\Country\Dto\Country;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class CountryDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, string $type, string $format = null, array $context = []): Country
    {
        return new Country(
            $data['name']
        );
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === Country::class;
    }
}
