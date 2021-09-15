<?php

namespace Tests\Unit;

use App\Domain\Camera\Dto\Camera;
use App\Domain\Camera\Service\CameraClient;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class CameraTest extends TestCase
{

    private const FAKE_RANDOM_CAMERA_ID = 1234567890;

    /**
     * @var CameraClient|MockObject
     */
    private $cameraMock;
    private Camera $camera;
    private Camera $newCamera;


    public function setUp(): void
    {
        parent::setUp();


        $this->cameraMock = $this->createMock(CameraClient::class);
        $this->cameraMock->expects($this->once())->method('getCamera')
            ->willReturn(new Camera('url', self::FAKE_RANDOM_CAMERA_ID, 'country'));

        $this->newCamera = new Camera('url', self::FAKE_RANDOM_CAMERA_ID, 'country');
        $this->camera = $this->cameraMock->getCamera(self::FAKE_RANDOM_CAMERA_ID);
    }

    public function test_should_return_camera_object(): void
    {

        self::assertEquals($this->newCamera, $this->camera);
    }

    public function test_should_return_selected_cameras_id(): void
    {
        self::assertEquals($this->newCamera->getId(), $this->camera->getId());
    }

    public function test_should_return_webcam_player_embed_link(): void
    {
        self::assertEquals($this->newCamera->getUrl(), $this->camera->getUrl());
    }

    public function test_should_return_displayed_cameras_country(): void
    {
        self::assertEquals($this->newCamera->getCountry(), $this->camera->getCountry());
    }
}
