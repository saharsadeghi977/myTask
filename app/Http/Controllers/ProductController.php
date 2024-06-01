<?php

namespace App\Http\Controllers;

use App\Http\Repositories\FileRepository;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Services\AttachmentService;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use App\Models\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('products.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $product = new product();
        return view('products.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
          $files = (new FileRepository())->upload('image', ['public','private']);
          $product = Product::create($request->validated());
          foreach($files as $file){
           $product->files()->attach($file);

          }
//

          return redirect()->route('products');
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
    public function edit(product $product)
    {
        $categories = Category::all()->pluck('name', 'id');
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(UpdateProductRequest $request, Product $product)
//    {   $attachmentService = AttachmentService::getInstance('default',['local','private']);
//        $product->update($request->validated());
//
//        if(!$request->hasFile('files')){
//            return false;
//        }
//        if ($product->images) {
//            foreach($product->images as image){
//                AttachmentService::remove(image);
//            }
//        }
//        AttachmentService::uploadFileRepository($request->file('files'), Product::class, $product->id);
//        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $product->delete();
        return redirect()->route('products.products');
    }
}
