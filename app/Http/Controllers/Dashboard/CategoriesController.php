<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

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
            return $query->whereTranslationLike('name', '%' . $request->search . '%');
        })->latest()->paginate(10);

        return view('dashboard.categories.index', \compact('categories'));
    } // end of index

    public function create()
    {
        return view('dashboard.categories.create');
    } // end of create

    public function store(Request $request)
    {
        $roles = [];
        foreach (config('translatable.locales') as $locale) {
            $roles += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];
        }
        $request->validate($roles);
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
        $roles = [];
        foreach (config('translatable.locales') as $locale) {
            $roles += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];
        }
        $request->validate($roles);
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
