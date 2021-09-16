<?php

namespace Tests\Unit;

use App\Domain\Camera\Dto\Camera;
use App\Domain\Camera\Service\CameraClient;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class CameraTest extends TestCase
{

    private const FAKE_ID = 1234567890;

    /**
     * @var CameraClient|MockObject
     */
    private $cameraClientMock;
    private Camera $cameraFromMockClient;
    private Camera $camera;


    public function setUp(): void
    {
        parent::setUp();

        $this->cameraClientMock = $this->createMock(CameraClient::class);
        $this->camera = new Camera('url', self::FAKE_ID, 'country');
    }

    public function test_should_return_camera_object(): void
    {
        $this->cameraClientMock->expects($this->once())->method('getCamera')
            ->willReturn(new Camera('url', self::FAKE_ID, 'country'));

        $this->cameraFromMockClient = $this->cameraClientMock->getCamera(self::FAKE_ID);

        self::assertEquals($this->camera, $this->cameraFromMockClient);
    }

    public function test_should_return_selected_cameras_id(): void
    {
        $this->cameraClientMock->expects($this->once())->method('getCamera')
            ->willReturn(new Camera('url', self::FAKE_ID, 'country'));

        $this->cameraFromMockClient = $this->cameraClientMock->getCamera(self::FAKE_ID);

        self::assertEquals($this->camera->getId(), $this->cameraFromMockClient->getId());
    }

    public function test_should_return_webcam_player_embed_link(): void
    {
        $this->cameraClientMock->expects($this->once())->method('getCamera')
            ->willReturn(new Camera('url', self::FAKE_ID, 'country'));

        $this->cameraFromMockClient = $this->cameraClientMock->getCamera(self::FAKE_ID);

        self::assertEquals($this->camera->getUrl(), $this->cameraFromMockClient->getUrl());
    }

    public function test_should_return_displayed_cameras_country(): void
    {
        $this->cameraClientMock->expects($this->once())->method('getCamera')
            ->willReturn(new Camera('url', self::FAKE_ID, 'country'));

        $this->cameraFromMockClient = $this->cameraClientMock->getCamera(self::FAKE_ID);

        self::assertEquals($this->camera->getCountry(), $this->cameraFromMockClient->getCountry());
    }
}
