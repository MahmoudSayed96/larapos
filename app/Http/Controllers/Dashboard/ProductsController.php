<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_products')->only('create');
        $this->middleware('permission:read_products')->only('index');
        $this->middleware('permission:update_products')->only('edit');
        $this->middleware('permission:delete_products')->only('destroy');
    }

    public function index(Request $request)
    {
        $categories = Category::all();

        // Search operation
        $products = Product::when($request->search, function ($query) use ($request) {
            return $query->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->category_id, function ($query) use ($request) {
            return $query->where('category_id', $request->category_id);
        })->latest()->paginate(10);

        return view('dashboard.products.index', \compact('categories', 'products'));
    } // end of index

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', \compact('categories'));
    } //end  of create

    public function store(Request $request)
    {
        $roles = [
            'category_id' => 'required',
        ];

        foreach (config('translatable.locales') as $locale) {
            $roles += [$locale . '.name' => ['required', Rule::unique('product_translations', 'name')]];
            $roles += [$locale . '.description' => 'required'];
        }

        $roles = [
            'image' => 'image',
            'purchase_price' => 'required|number',
            'sale_price' => 'required|number',
            'stock' => 'required|number',
        ];

        $request_data = $request->all();
        if ($request->image) {
            $img = Image::make($request->image);
            // resize the image to a width of 300 and constrain aspect ratio (auto height)
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // save image
            $img->save(public_path('uploads/images/products/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } // end if image

        Product::create($request_data);

        session()->flash('success', \Lang::get('site.added_successfully'));
        return \redirect()->route('dashboard.products.index');
    } //end of store


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', \compact('product', 'categories'));
    } //end of edit

    public function update(Request $request, Product $product)
    {
        $roles = [
            'category_id' => 'required',
        ];

        foreach (config('translatable.locales') as $locale) {
            $roles += [$locale . '.name' => ['required', Rule::unique('product_translations', 'name')->ignore($product->id, 'product_id')]];
            $roles += [$locale . '.description' => 'required'];
        }

        $roles = [
            'image' => 'image',
            'purchase_price' => 'required|number',
            'sale_price' => 'required|number',
            'stock' => 'required|number',
        ];

        $request_data = $request->all();
        if ($request->image) {
            if ($product->image != 'default.png') {
                // delete old image
                \Storage::disk('public_uploads')->delete('/images/products/' . $product->image);
            } // end if check default
            $img = Image::make($request->image);
            // resize the image to a width of 300 and constrain aspect ratio (auto height)
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            // save image
            $img->save(public_path('uploads/images/products/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } //end of image

        $product->update($request_data);
        session()->flash('success', \Lang::get('site.updated_successfully'));
        return \redirect()->route('dashboard.products.index');
    } //end of update

    public function destroy(Product $product)
    {
        if ($product->image != 'default.png') {
            \Storage::disk('public_uploads')->delete('/images/products/' . $product->image);
        }
        $product->delete();

        session()->flash('success', \Lang::get('site.deleted_successfully'));

        return \redirect()->route('dashboard.products.index');
    } // end of destroy


    public function searchBy()
    {
        return 'test';
    }

    public function productsList(Request $request){
        $categories = Category::all();
        // Search operation
        $products = Product::when($request->search, function ($query) use ($request) {
            return $query->whereTranslationLike('name', '%' . $request->search . '%');
        })->when($request->category_id, function ($query) use ($request) {
            return $query->where('category_id', $request->category_id);
        })->latest()->paginate(10);
        return view('dashboard.products.show_products',compact('categories','products'));
    }
}
