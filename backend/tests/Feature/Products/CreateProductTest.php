<?php

namespace Tests\Feature\Products;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    protected $method = Request::METHOD_POST;
    protected string $uri = '/api/products';

    public function testShouldResponseWithHttpOk()
    {
        $this->defaultTest(
            $this->method,
            $this->uri,
            data: [
                'article' => 'testproduct',
                'name' => 'Test Product',
                'status' => 'available',
                'data' => json_encode(['color' => 'test']),
            ]
        );

        $this->assertDatabaseHas('products', ['article' => 'testproduct']);
    }

    public function testShouldResponseWithHttpUnprocessableIfNoParams()
    {
        $this->defaultTest(
            $this->method,
            $this->uri,
            Response::HTTP_UNPROCESSABLE_ENTITY,
        );
    }

    public function testShouldResponseWithHttpUnprocessableIfInvalidParams()
    {
        $this->defaultTest(
            $this->method,
            $this->uri,
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
        $this->defaultTest(
            $this->method,
            $this->uri,
            Response::HTTP_UNAUTHORIZED,
            needAuth: false
        );
    }

    public function testShouldResponseWithHttpForbiddenIfDontHavePermissions()
    {
        $this->defaultTest(
            $this->method,
            $this->uri,
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
