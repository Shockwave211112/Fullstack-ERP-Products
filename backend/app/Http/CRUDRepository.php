<?php

namespace App\Http;

use App\Exceptions\DataBaseException;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class CRUDRepository
{
    protected $model;
    protected $modelName;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->modelName = class_basename($model);
    }

    public function index()
    {
        return Cache::tags([$this->modelName, 'pagination'])
            ->remember($this->modelName . '-page-' . request('page', default: 1), now()->addMinutes(180),
                fn () => $this->model::paginate(10));
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function store(array $data)
    {
        $record = $this->model::create($data);

        return response()->json([
            'message' => $this->modelName . ' added.',
            'entity' => $record
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function show(int $id)
    {
        $record = Cache::tags($this->modelName)
            ->remember($this->modelName . ':' . $id, now()->addMinutes(180),
                fn () => $this->model::find($id));

        if ($record) {
            return response()->json([
                'entity' => $record
            ]);
        }
        throw new DataBaseException(message: $this->modelName . ' not found.', status: 404);
    }


    /**
     * @param int $id
     * @param array $data
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function update(int $id, array $data)
    {
        $record = $this->model::find($id);

        if ($record) {
            $oldRecord = clone $record;

            $record->update($data);

            return response()->json([
                'message' => $this->modelName . ' updated.',
                'entity' => $record,
                'old_entity' => $oldRecord,
            ]);
        }

        throw new DataBaseException(message: $this->modelName . ' not found.', status: 404);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws DataBaseException
     */
    public function delete(int $id)
    {
        $record = $this->model::find($id);

        if ($record) {
            $record->delete();

            return response()->json([
                'message' => $this->modelName . ' deleted.'
            ]);
        }

        throw new DataBaseException(message: $this->modelName . ' not found.', status: 404);
    }
}
