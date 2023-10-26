<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    protected $method = Request::METHOD_PATCH;
    protected string $uri = '/api/products/';

    public function testShouldResponseWithHttpOk()
    {
        $product = Product::factory()->create();

        $this->defaultTest(
            $this->method,
            $this->uri . $product->id,
            data: [
                'article' => 'testproduct',
                'name' => 'Test Product',
                'status' => 'available',
                'data' => json_encode(['color' => 'test']),
            ]
        );

        $this->assertDatabaseHas('products', ['article' => 'testproduct']);
    }

    public function testShouldResponseWithHttpUnprocessableIfNotAdmin()
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

    public function testShouldResponseWithHttpUnprocessableIfInvalidParams()
    {
        $product = Product::factory()->create();

        $this->defaultTest(
            $this->method,
            $this->uri . $product->id,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            data: [
                'article' => ['1'],
                'name' => 123,
                'status' => 'test',
                'data' => 123,
            ]
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

    public function testShouldResponseWithHttpForbiddenIfDontHavePermissions()
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
