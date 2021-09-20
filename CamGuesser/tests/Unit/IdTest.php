<?php

namespace Tests\Unit;

use App\Domain\Id\Dto\Id;
use App\Domain\Id\Service\IdClient;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class IdTest extends TestCase
{

    private const FAKE_ID = 1234567890;

    /**
     * @var IdClient|MockObject
     */
    private $idMockClient;
    private Id $idFromMockClient;
    private Id $id;


    public function setUp(): void
    {
        parent::setUp();

        $this->idMockClient = $this->createMock(IdClient::class);
        $this->id = new Id(self::FAKE_ID);
    }

    public function test_should_return_one_random_webcam_id(): void
    {
        $this->idMockClient->expects($this->once())->method('getId')
            ->willReturn(new Id(self::FAKE_ID));

        $this->idFromMockClient = $this->idMockClient->getId();

        self::assertEquals($this->id, $this->idFromMockClient);
    }
}
