<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    use DatabaseMigrations;

    protected function setUpTraits(): void
    {
        parent::setUpTraits();
        Redis::command('flushdb');
        $this->artisan('db:seed');
    }

    /**
     * @param $method
     * @param string $uri
     * @param int $status
     * @param array $data
     * @param bool $needAuth
     * @param string $role
     * @param User|null $user
     * @return \Illuminate\Testing\TestResponse
     */
    public function defaultTest(
        $method,
        string $uri,
        int    $status = Response::HTTP_OK,
        array  $data = [],
        bool   $needAuth = true,
        string $role = 'admin',
        User   $user = null,
    )
    {
        if ($needAuth) {
            if (!$user) {
                $user = User::factory()->create(['password' => '11111111']);
                $user->assignRole($role);
            }

            $userData = [
                'email' => $user->email,
                'password' => '11111111',
            ];

            $authToken = $this->post('/api/auth/login', $userData)->assertOk()->json('token');

            $authHeader = array_merge(['authorization' => 'Bearer '. $authToken]);
        } else $authHeader = [];

        return $this->json($method, $uri, $data, headers: $authHeader)->assertStatus($status);
    }
}
