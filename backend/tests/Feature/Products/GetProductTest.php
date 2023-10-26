<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class GetProductTest extends TestCase
{
    protected $method = Request::METHOD_GET;
    protected string $uri = '/api/products';

    public function testShouldResponseWithHttpOk()
    {
        Product::factory(4)->create();

        $this->defaultTest(
            $this->method,
            $this->uri
        )->assertJsonStructure(['data']);
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
