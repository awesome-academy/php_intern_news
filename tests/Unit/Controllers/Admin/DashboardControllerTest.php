<?php

namespace Tests\Unit\Controllers\Admin;

use App\Http\Controllers\Admin\DashboardController;
use App\Repositories\Article\ArticleRepository;
use Mockery as m;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    protected $articleRepoMock;
    protected $controller;
    public function setUp(): void
    {
        parent::setUp();

        $this->articleRepoMock = m::mock(app()->make(ArticleRepository::class))->makePartial();
    }

    public function tearDown(): void
    {
        unset($this->articleRepoMock);
        m::close();

        parent::tearDown();
    }

    public function testIndexFunction()
    {
        $chartData = [
            'Jan' => 2,
            'Feb' => 5,
            'Mar' => 10,
            'Apr' => 5,
            'May' => 7,
            'Jun' => 0,
            'Jul' => 0,
            'Aug' => 0,
            'Sep' => 0,
            'Oct' => 0,
            'Nov' => 0,
            'Dec' => 0,
        ];

        $this->articleRepoMock->shouldReceive('getStatistic')->andReturn($chartData);
        $this->controller = new DashboardController($this->articleRepoMock);

        $view = $this->controller->index();
        $data = $view->getData();

        $this->assertEquals('admin.index', $view->getName());
        $this->assertArrayHasKey('chartData', $data);
        $this->assertArrayHasKey('year', $data);
        $this->assertEquals($chartData, $data['chartData']);
    }
}
