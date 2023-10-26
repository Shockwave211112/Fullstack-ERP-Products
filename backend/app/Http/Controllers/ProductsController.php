<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Services\ProductsService;
use App\Notifications\ProductCreatedNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

class ProductsController extends Controller
{
    /**
     * @param ProductsService $service
     * @return JsonResponse
     */
    public function index(ProductsService $service)
    {
        return $service->index();
    }

    /**
     * @param ProductStoreRequest $request
     * @param ProductsService $service
     * @return JsonResponse
     * @throws \App\Exceptions\PermissionsException
     */
    public function store(ProductStoreRequest $request, ProductsService $service)
    {
        $data = $request->validated();
        $service->permissions(auth()->user());

        Notification::route('mail', config('products.email'))->notify(new ProductCreatedNotification($data));
        return $service->store($data);
    }

    /**
     * @param int $id
     * @param ProductsService $service
     * @return JsonResponse
     * @throws \App\Exceptions\DataBaseException
     */
    public function show(int $id, ProductsService $service)
    {
        $service->exists($id);

        return $service->show($id);
    }

    /**
     * @param int $id
     * @param ProductUpdateRequest $request
     * @param ProductsService $service
     * @return mixed
     * @throws \App\Exceptions\DataBaseException
     * @throws \App\Exceptions\PermissionsException
     */
    public function update(int $id, ProductUpdateRequest $request, ProductsService $service)
    {
        $data = $request->validated();

        $service->exists($id);
        if (isset($data['article']))    $service->permissions(auth()->user());

        return $service->update($id, $data);
    }

    /**
     * @param int $id
     * @param ProductsService $service
     * @return JsonResponse
     * @throws \App\Exceptions\DataBaseException
     * @throws \App\Exceptions\PermissionsException
     */
    public function delete(int $id, ProductsService $service)
    {
        $service->exists($id);
        $service->permissions(auth()->user());

        return $service->delete($id);
    }
}
