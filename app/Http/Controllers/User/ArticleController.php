<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Repositories\Article\ArticleRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{

    protected $articleRepository;
    protected $categoryRepository;

    public function __construct(
        ArticleRepositoryInterface $articleRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author = Auth::user();
        $articles = $author->articles()
            ->with('categories')
            ->orderBy('created_at', 'desc')
            ->paginate(config('custom.per-page'));

        return view('user.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //lấy danh sách categories đưa vào view để chọn
        $categories = $this->categoryRepository->getCategoryList();

        return view('user.article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $options = $request->only('title', 'content');
        //xử lý slug
        $options['slug'] = Str::slug($options['title']);
        //upload ảnh
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('/images/articles/', 'public');
            if ($path) {
                $options['cover_image'] = $path;
            }
        }

        $article =  $this->articleRepository->createArticle($options);
        if ($article) {
            //thêm category
            $article->categories()->attach($request->input('categories'));

            return redirect()->route('user.article.index')->with('success', __('Create article successfully'));
        } else {
            return back()->with('error', __('Something went wrong'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
