<?php

namespace Tests\Unit;

use App\Domain\WindyApi\Dto\Camera;
use App\Domain\WindyApi\UseCase\GetRandomCameraPlayerUseCase;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class CameraTest extends TestCase
{

    private const FAKE_RANDOM_CAMERA_ID = 1234567890;

    /**
     * @var GetRandomCameraPlayerUseCase|MockObject
     */
    private $cameraClient;
    private Camera $camera;
    private Camera $mockCamera;


    public function setUp(): void
    {
        parent::setUp();

        $this->cameraClient = $this->createMock(GetRandomCameraPlayerUseCase::class);
        $this->cameraClient->expects($this->once())->method('getCamera')
            ->willReturn(new Camera('url', self::FAKE_RANDOM_CAMERA_ID, 'country'));

        $this->mockCamera = new Camera('url', self::FAKE_RANDOM_CAMERA_ID, 'country');
        $this->camera = $this->cameraClient->getCamera(self::FAKE_RANDOM_CAMERA_ID);
    }

    public function test_should_return_camera_object(): void
    {
        self::assertEquals($this->mockCamera, $this->camera);
    }

    public function test_should_return_selected_cameras_id(): void
    {
        self::assertEquals($this->mockCamera->getId(), $this->camera->getId());
    }

    public function test_should_return_webcam_player_embed_link(): void
    {
        self::assertEquals($this->mockCamera->getUrl(), $this->camera->getUrl());
    }

    public function test_should_return_displayed_cameras_country(): void
    {
        self::assertEquals($this->mockCamera->getCountry(), $this->camera->getCountry());
    }
}
