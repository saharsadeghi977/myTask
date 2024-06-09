<?php

namespace App\Http\Controllers;
use App\Http\Repositories\FileRepository;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Services\AttachmentService;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use App\Models\Fileable;
use App\Models\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()
            ->with(['files'])
            ->latest()
            ->paginate(5);

        return view('products.index', compact('products'));
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
        $files = (new FileRepository())->upload('image', ['public', 'private']);
        $product = Product::create($request->validated());
        foreach ($files as $file) {
            $product->files()->sync($file);
        }
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
    public function update(UpdateProductRequest $request, Product $product)
    {
         $files = (new FileRepository())->upload('image', ['public', 'private']);
         $product->update($request->validated());
         foreach ($product->files as $existingFile) {
             $product->files()->detach($existingFile);
             $relatedModelsCount=Fileable::query()->where('file_id',$existingFile)->count();
             if($relatedModelsCount<1) {
                 AttachmentService::instance()->delete($existingFile->path);
                 $existingFile->delete();
             }

         }
         foreach($files as $file) {
             $product->files()->sync($file);
         }

        return redirect()->route('products');
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
