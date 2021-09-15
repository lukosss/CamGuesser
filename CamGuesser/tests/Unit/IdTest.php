<?php

namespace Tests\Unit;

use App\Domain\WindyApi\Dto\Id;
use App\Domain\WindyApi\Service\IdClient;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class IdTest extends TestCase
{

    private const FAKE_RANDOM_CAMERA_ID = 1234567890;

    /**
     * @var IdClient|MockObject
     */
    private $idClient;
    private Id $id;
    private Id $mockId;


    public function setUp(): void
    {
        parent::setUp();

        $this->idClient = $this->createMock(IdClient::class);
        $this->idClient->expects($this->once())->method('getId')
            ->willReturn(new Id(self::FAKE_RANDOM_CAMERA_ID));

        $this->mockId = new Id(self::FAKE_RANDOM_CAMERA_ID);
        $this->id = $this->idClient->getId();

    }

    public function test_should_return_array_of_all_available_countries(): void
    {
    }

    public function test_should_return_one_random_webcam_id(): void
    {
        self::assertEquals($this->mockId, $this->id);
    }
}
