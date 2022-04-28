<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryList = $this->categoryRepository->getAllCategories();

        return view('admin.category.index', compact('categoryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $options = $request->all('name', 'parent_id');
        $options['slug'] =  Str::slug($options['name']);

        $result = $this->categoryRepository->creatCategory($options);

        if ($result) {
            return back()->with('success', __('Created successfully'));
        }

        return back()->with('error', __('Create failed'));
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
        $category = $this->categoryRepository->getCategory($id);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryRepository->getCategory($id);
        $options = $request->all('name', 'parent_id');
        $options['slug'] =  Str::slug($options['name']);

        if ($category->update($options)) {
            return back()->with('success', __('Updated successfully'));
        }

        return back()->with('Update failed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->getCategory($id);
        $category->articles()->detach();
        
        $parent = $category->parent_id;
        $category->subCategories()->update(['parent_id' => $parent]);

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', __('Deleted successfully'));
    }
}
