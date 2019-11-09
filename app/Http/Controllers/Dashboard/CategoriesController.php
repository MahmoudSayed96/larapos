<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_categories')->only('create');
        $this->middleware('permission:read_categories')->only('index');
        $this->middleware('permission:update_categories')->only('edit');
        $this->middleware('permission:delete_categories')->only('destroy');
    }

    public function index(Request $request)
    {
        // Search operation
        $categories = Category::when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(10);

        return view('dashboard.categories.index', \compact('categories'));
    } // end of index

    public function create()
    {
        return view('dashboard.categories.create');
    } // end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|min:3|max:50',
        ]);

        Category::create($request->all());

        session()->flash('success', \Lang::get('site.added_successfully'));

        return redirect()->route('dashboard.categories.index');
    } // end of store


    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', \compact('category'));
    } // end of edit

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id . '|min:3|max:50',
        ]);

        $category->update($request->all());

        session()->flash('success', \Lang::get('site.updated_successfully'));

        return redirect()->route('dashboard.categories.index');
    } // end of update


    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash('success', \Lang::get('site.deleted_successfully'));

        return redirect()->route('dashboard.categories.index');
    } // end of destroy
} // end of controller
