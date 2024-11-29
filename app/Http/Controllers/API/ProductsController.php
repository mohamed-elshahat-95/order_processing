<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductsController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        // Retrieve all active products
        $products = $this->productRepository->all();
        return response()->json($products);
    }

    public function show($id)
    {
        // Retrieve product by ID
        $product = $this->productRepository->find($id);
        return response()->json($product);
    }
  
    public function store(StoreProductRequest $request)
    {
        // Create a new product
        $product = $this->productRepository->create($request->all());
        return response()->json($product, 201);
    }
    
    public function update(UpdateProductRequest $request, $id)
    {
        // Update product
        $product = $this->productRepository->update($id, $request->all());
        return response()->json($product);
    }
   
    public function destroy($id)
    {
        // Delete product
        $this->productRepository->delete($id);
        return response()->json(['message' => 'Product deleted successfully'], 200); 
    }
}
