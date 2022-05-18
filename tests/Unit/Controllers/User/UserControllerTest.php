<?php

namespace Tests\Unit\Controllers\User;

use App\Http\Controllers\User\UserController;
use App\Repositories\User\UserRepository;
use Exception;
use Mockery as m;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    protected $controller;

    protected $userRepoMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepoMock = m::mock(app()->make(UserRepository::class))->makePartial();
    }

    public function tearDown(): void
    {
        unset($this->userRepoMock);
        unset($this->controller);
        m::close();

        parent::tearDown();
    }

    public function testMarkReadNotificationFunction()
    {
        $id = 'sdfgsvdqe2353bdsn';
        $this->userRepoMock->shouldReceive('markReadNotification')->with($id)->andReturn(true);

        $this->controller = new UserController($this->userRepoMock);

        $response = $this->controller->markReadNotification($id);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testMarkReadNotificationFunctionFail()
    {
        $id = 'sdfgsvdqe2353bdsn';
        $this->userRepoMock->shouldReceive('markReadNotification')->with($id)->andThrow(new Exception());

        $this->controller = new UserController($this->userRepoMock);
        $response = $this->controller->markReadNotification($id);

        $this->assertEquals(500, $response->getStatusCode());
    }

    public function testMarkReadAllNotificationFunction()
    {
        $this->userRepoMock->shouldReceive('markReadAllNotifications')->andReturn(true);

        $this->controller = new UserController($this->userRepoMock);
        $response = $this->controller->markReadAllNotification();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testMarkReadAllNotificationFunctionFail()
    {
        $this->userRepoMock->shouldReceive('markReadAllNotifications')->andThrow(new Exception());

        $this->controller = new UserController($this->userRepoMock);
        $response = $this->controller->markReadAllNotification();

        $this->assertEquals(500, $response->getStatusCode());
    }
}
