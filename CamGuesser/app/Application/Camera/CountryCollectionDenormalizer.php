<?php


namespace App\Application\Camera;

use App\Domain\WindyApi\Dto\Country;
use App\Domain\WindyApi\Dto\CountryCollection;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class CountryCollectionDenormalizer implements DenormalizerInterface
{

    private CountryDenormalizer $countryDenormalizer;

    public function __construct(CountryDenormalizer $countryDenormalizer)
    {
        $this->countryDenormalizer = $countryDenormalizer;
    }


    public function denormalize($data, string $type, string $format = null, array $context = []): CountryCollection
    {
        $countries = [];
        foreach($data['result']['countries'] as $countryArray) {
            $countries[] = $this->countryDenormalizer->denormalize($countryArray, Country::class);
        }
        return new CountryCollection(
            ...$countries
        );
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === CountryCollection::class;
    }
}
