<?php

namespace App\Repositories;

use App\Models\Company;
use App\Core\BaseRepository;

class CompanyRepository extends BaseRepository
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    public function list($params)
    {

        return $this->get($params, [], function ($q) use ($params) {
            $q->ofId($params['id'] ?? '');
            $q->ofName($params['name'] ?? '');
            $q->ofSearch($params['search'] ?? '');

            $q->orderBy($params['sortBy'] ?? 'id', $params['sortDesc'] == 'true' ? 'desc' : 'asc');

            return $q;
        });
    }

    public function delete(int $id)
    {
        $ids = explode(',', $id);

        foreach ($ids as $id) {
            $lesson = $this->model->find($id);
            if (!$lesson) {
                return false;
            };
            $lesson->delete();
        }

        return true;
    }
}
