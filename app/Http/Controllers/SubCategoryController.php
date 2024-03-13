<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $categoryRepository;
    protected $subcategoryRepository;
    protected $limit = 10;
    public function __construct(CategoryRepository $categoryRepository ,SubCategoryRepository $subcategoryRepository){
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $subcategoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->subcategoryRepository->paginate($this->limit,[],['category']);
        return view('subcategories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepository->all();
        return view('subcategories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {

        $sub_cat = $this->subcategoryRepository->addSubcategory($request->validated());
        if($sub_cat){
            return redirect()->back()->with(['status'=>'success','message'=>'SubCategory added successfully!']);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->subcategoryRepository->find($id);
        $categories = $this->categoryRepository->paginate($this->limit);
        return view('subcategories.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequest $request, string $id)
    {

        $update = $this->subcategoryRepository->updateSubCategory($id, $request->validated());
        if($update){
          return redirect()->back()->with(['status'=>'success','message'=>'Category Update Successfull!']);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $subcategory = $this->subcategoryRepository->destroySubCategory($id);
       if($subcategory){
        return redirect()->back()->with(['status'=>'success','message'=>'Category Deletion Successfull!']);
       }
    }
}
