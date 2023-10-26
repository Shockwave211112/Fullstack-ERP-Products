<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetByIdProductTest extends TestCase
{
    protected $method = Request::METHOD_GET;
    protected string $uri = '/api/products/';

    public function testShouldResponseWithHttpOk()
    {
        $product = Product::factory()->create();

        $this->defaultTest(
            $this->method,
            $this->uri . $product->id,
        );
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
        $this->defaultTest(
            $this->method,
            $this->uri,
            Response::HTTP_UNAUTHORIZED,
            needAuth: false
        );
    }
}
