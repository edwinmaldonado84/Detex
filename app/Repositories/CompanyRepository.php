<?php

namespace App\Repositories;

use App\Models\Company;
use App\Core\BaseRepository;
use App\Core\Utilities\Helpers;
use App\Http\Resources\CompanyResource;

class CompanyRepository extends BaseRepository
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    public function list($params)
    {

        $q = Company::join('groups', 'groups.id', '=', 'group_id');

        $q->ofId($params['id'] ?? '');
        $q->ofSearch($params['search'] ?? '');
        $q->ofGroupId($params['groupId'] ?? '');

        $q->orderBy($params['sortBy'] ?? 'companies.id',  $params['sortType'] ?? 'asc');
        $q->select("companies.*", "groups.name as group_name");


        // if per page is -1, we don't need to paginate at all, but we still return the paginated
        // data structure to our response. Let's just put the biggest number we can imagine.
        if (Helpers::hasValue($params['per_page']) && ($params['per_page'] == -1)) $params['per_page'] = 999999999999;

        // if don't want any pagination
        if (Helpers::hasValue($params['paginate']) && ($params['paginate'] == 'no')) return $q->get();

        return new CompanyResource($q->paginate($params['per_page'] ?? 10));
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
