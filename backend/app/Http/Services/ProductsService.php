<?php

namespace App\Http\Services;


use App\Exceptions\DataBaseException;
use App\Exceptions\PermissionsException;
use App\Http\CRUDRepository;
use App\Http\Traits\CRUDTrait;
use App\Models\Product;
use App\Models\User;

class ProductsService
{
    use CRUDTrait;

    public function __construct()
    {
        $this->repository = new CRUDRepository(new Product());
    }

    /**
     * @param int $id
     * @return void
     * @throws DataBaseException
     */
    public function exists(int $id)
    {
        $record = Product::find($id);

        if (!$record) {
            throw new DataBaseException('Product not found.', 404);
        }
    }

    /**
     * @param User $user
     * @return void
     * @throws PermissionsException
     */
    public function permissions(User $user)
    {
        $roles = $user->roles->pluck('name')->toArray();
        $acceptedRoles = config('products.roles');

        foreach ($roles as $role)
        {
            if (!in_array($role, $acceptedRoles)) throw new PermissionsException('You dont have enough permissions.', 403);
        }
    }
}
