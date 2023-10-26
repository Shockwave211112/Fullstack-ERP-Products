<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    protected $method = Request::METHOD_POST;
    protected string $uri = '/api/auth/registration';

    public function testShouldResponseWithHttpOk()
    {
            $this->defaultTest(
            $this->method,
            $this->uri,
            data: [
                'email' => 'test@test.com',
                'name' => 'Test',
                'password' => '11111111',
                'password_confirmation' => '11111111'
            ],
            needAuth: false,
        )->assertJsonStructure(['token']);
    }

    public function testShouldResponseWithHttpUnprocessableIfEmailExists()
    {
        User::factory()->create(['email' => 'test@test.com']);

        $this->defaultTest(
            $this->method,
            $this->uri,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            data: [
                'email' => 'test@test.com',
                'name' => 'Test',
                'password' => '11111111',
                'password_confirmation' => '11111111'
            ],
            needAuth: false,
        );
    }

    public function testShouldResponseWithHttpUnprocessableIfNoParams()
    {
        $this->defaultTest(
            $this->method,
            $this->uri,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            needAuth: false,
        );
    }

    public function testShouldResponseWithHttpUnprocessableIfInvalidParams()
    {
        $this->defaultTest(
            $this->method,
            $this->uri,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            data: [
                'email' => 'fsafas.com',
                'name' => 1,
                'password' => '222',
            ],
            needAuth: false,
        );
    }
}
