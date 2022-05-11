<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Article\ArticleRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }
    
    public function index()
    {

        $year = Carbon::now()->year;
        $chartData = $this->articleRepository->getStatistic();

        return view('admin.index', compact('chartData', 'year'));
    }
}
