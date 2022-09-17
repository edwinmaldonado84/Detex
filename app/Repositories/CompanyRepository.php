<?php

namespace App\Repositories;

use App\Models\Company;
use App\Core\BaseRepository;
use App\Core\Utilities\Helpers;

class CompanyRepository extends BaseRepository
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    public function list($params)
    {


        $q = Company::leftJoin('groups', 'groups.id', '=', 'group_id')
            ->where('companies.name', 'LIKE', isset($params['search']) ? "%" . $params['search'] . "%" : "%")
            ->orWhere('companies.business_name', 'LIKE', isset($params['search']) ? "%" . $params['search'] . "%" : "%")
            ->orWhere('companies.rfc', 'LIKE', isset($params['search']) ? "%" . $params['search'] . "%" : "%")
            ->orWhere('companies.webpage', 'LIKE', isset($params['search']) ? "%" . $params['search'] . "%" : "%")
            ->orWhere('groups.name', 'LIKE', isset($params['search']) ? "%" . $params['search'] . "%" : "%")
            ->orderBy($params['sortBy'] ?? 'companies.id',  $params['sortType'] ?? 'asc')
            ->select("companies.*", "groups.name as group_name");

        if (Helpers::hasValue($params['per_page']) && ($params['per_page'] == -1)) $params['per_page'] = 999999999999;
        if (Helpers::hasValue($params['paginate']) && ($params['paginate'] == 'no')) return $q->get();
        return $q->paginate($params['per_page'] ?? 10);

        /*  return $this->get($params, ['group'], function ($q) use ($params) {
            $q->ofId($params['id'] ?? '');
            $q->ofSearch($params['search'] ?? '');

            $q->orderBy($params['sortBy'] ?? 'id', $params['sortType'] ?? 'asc');

            return $q;
        });
        */
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
