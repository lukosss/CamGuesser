<?php

namespace Tests\Unit;

use App\Domain\WindyApi\Dto\Camera;
use App\Domain\WindyApi\Dto\Id;
use App\Domain\WindyApi\Service\WindyClient;
use App\Domain\WindyApi\UseCase\GetAllCountriesUseCase;
use App\Domain\WindyApi\UseCase\GetOneRandomCameraIdUseCase;
use App\Domain\WindyApi\UseCase\GetRandomCameraPlayerUseCase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\MockObject\MockObject;
use Prophecy\PhpUnit\ProphecyTrait;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use ProphecyTrait;

    private const FAKE_RANDOM_CAMERA_ID = 1234567890;

    private GetAllCountriesUseCase $allCountries;
    private GetOneRandomCameraIdUseCase $randomCameraId;
    private GetRandomCameraPlayerUseCase $randomCameraPlayer;
    /**
     * @var GetRandomCameraPlayerUseCase|MockObject
     */
    private $mockUseCase;
    private Camera $player;
    private Camera $mockPlayer;


    public function setUp(): void
    {
        parent::setUp();


        $this->mockUseCase = $this->createMock(GetRandomCameraPlayerUseCase::class);
        $this->mockUseCase->expects($this->once())->method('getCamera')
            ->willReturn(new Camera('url', self::FAKE_RANDOM_CAMERA_ID, 'country'));

        $this->mockPlayer = new Camera('url', self::FAKE_RANDOM_CAMERA_ID, 'country');
        $this->player = $this->mockUseCase->getCamera(self::FAKE_RANDOM_CAMERA_ID);


        $windyClient = new WindyClient();
        $this->allCountries = new GetAllCountriesUseCase($windyClient);
    }

    public function test_should_return_array_of_all_available_countries(): void
    {
    }

    public function test_should_return_one_random_webcam_id(): void
    {
        $this->mockUseCase = $this->createMock(GetOneRandomCameraIdUseCase::class);
        $this->mockUseCase->expects($this->once())->method('getId')
            ->willReturn(new Id(self::FAKE_RANDOM_CAMERA_ID));

        $mockId = new Id(self::FAKE_RANDOM_CAMERA_ID);
        $id = $this->mockUseCase->getId();

        self::assertEquals($mockId, $id);
    }

    public function test_should_return_camera_object(): void
    {
        self::assertEquals($this->mockPlayer, $this->player);
    }

    public function test_should_return_selected_cameras_id(): void
    {
        self::assertEquals($this->mockPlayer->getId(), $this->player->getId());
    }

    public function test_should_return_webcam_player_embed_link(): void
    {
        self::assertEquals($this->mockPlayer->getUrl(), $this->player->getUrl());
    }

    public function test_should_return_displayed_cameras_country(): void
    {
        self::assertEquals($this->mockPlayer->getCountry(), $this->player->getCountry());
    }
}
