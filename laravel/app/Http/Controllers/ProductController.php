<?php
namespace App\Http\Controllers;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
class ProductController extends Controller
{
    private const PRODUCTS = [];
    public function getProducts(): mixed
    {
        return response()->json(self::PRODUCTS, Response::HTTP_OK);
    }
    public function getProductItem(string $id): mixed
    {
        $product = $this->getProductItemById(self::PRODUCTS, $id);

        if (!$product) {
            return response()->json(['data' => ['error' => 'Not found product by id']], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['data' => $product], Response::HTTP_OK);
    }
    public function createProduct(Request $request): mixed
    {
        $requestData = json_decode($request->getContent(), associative: true);

        $productId = random_int(0, 100);

        $newProductData = [
            'id' => $productId,
            'name' => $requestData['name'],
            'description' => $requestData['description'],
            'price' => $requestData['price'],
        ];

        return response()->json(['data' => $newProductData], Response::HTTP_CREATED);


    }
    public function updateProduct(string $id, Request $request): mixed
    {
        $requestData = json_decode($request->getContent(), true);

        $product = $this->getProductItemById(self::PRODUCTS, $id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        // Оновлення значень
        $product['name'] = $requestData['name'] ?? $product['name'];
        $product['description'] = $requestData['description'] ?? $product['description'];
        $product['price'] = $requestData['price'] ?? $product['price'];



        return response()->json(['data' => $product], Response::HTTP_OK);
    }
    public function deleteProduct(string $id): mixed
    {
        $product = $this->getProductItemById(self::PRODUCTS, $id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(['message' => 'Product deleted'], Response::HTTP_OK);
    }

};
