<?php

namespace App\Repositories\Classes;

use App\Exceptions\ProductNotFoundException;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        return Product::where('is_active', true)->get();
    }

    public function find(int $id): ?Product
    {
        $product = Product::find($id);

        // If product is not found, throw the custom exception
        if (!$product) {
            throw new ProductNotFoundException("Product with ID {$id} not found.");
        }

        return $product;
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): Product
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id): bool
    {
        $product = $this->find($id);
        return $product ? $product->delete() : false;
    }
}