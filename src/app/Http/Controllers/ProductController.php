<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    public function __construct(
        private ProductService $productService,
        private ProductRepository $productRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->getAll();
        
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $validated = $request->validated();

        $product = $this->productService->createProduct($validated);

        return redirect()->route('products.index')
            ->with('success', '商品を登録しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product = $this->productService->updateProduct($product, $validated);

        return redirect()->route('products.show', $product)
            ->with('success', '商品を更新しました');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return redirect()->route('products.index')
            ->with('success', '商品を削除しました');
    }
}
