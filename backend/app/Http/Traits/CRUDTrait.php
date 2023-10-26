<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait CRUDTrait
{
    protected $repository;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        return $this->repository->index();
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        return $this->repository->show($id);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}
