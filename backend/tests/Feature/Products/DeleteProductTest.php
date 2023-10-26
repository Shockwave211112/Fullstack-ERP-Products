<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    protected $method = Request::METHOD_DELETE;
    protected string $uri = '/api/products/';

    public function testShouldResponseWithHttpOk()
    {
        $product = Product::factory()->create();

        $this->defaultTest(
            $this->method,
            $this->uri . $product->id,
        );

        $this->assertSoftDeleted('products', ['article' => $product->article]);
    }

    public function testShouldResponseWithHttpNotFound()
    {
        $this->defaultTest(
            $this->method,
            $this->uri . 99999,
            Response::HTTP_NOT_FOUND,
        );
    }

    public function testShouldResponseWithHttpUnauthIfWithoutToken()
    {
        $product = Product::factory()->create();

        $this->defaultTest(
            $this->method,
            $this->uri . $product->id,
            Response::HTTP_UNAUTHORIZED,
            needAuth: false
        );
    }

    public function testShouldResponseWithHttpF1orbiddenIfDontHavePermissions()
    {
        $product = Product::factory()->create();

        $this->defaultTest(
            $this->method,
            $this->uri . $product->id,
            Response::HTTP_FORBIDDEN,
            data: [
                'article' => 'testproduct',
                'name' => 'Test Product',
                'status' => 'available',
                'data' => json_encode(['color' => 'test']),
            ],
            role: User::USER
        );
    }
}
