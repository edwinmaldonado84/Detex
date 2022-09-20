<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Core\BaseRepository;
use App\Core\Utilities\Helpers;
use Illuminate\Support\Facades\DB;

class ContactRepository extends BaseRepository
{
    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }

    public function list($params)
    {




        $find = Contact::leftJoin('phones', 'contacts.id', '=', 'phones.contact_id')
            ->leftJoin('emails', 'contacts.id', '=', 'emails.contact_id')
            ->where('contacts.name', 'LIKE', isset($params['search']) ? "%" . $params['search'] . "%" : "%")
            ->where('contacts.last_name', 'LIKE', isset($params['search']) ? "%" . $params['search'] . "%" : "%")
            ->orWhere('phones.phone', 'LIKE', isset($params['search']) ? "%" . $params['search'] . "%" : "%")
            ->orWhere('emails.email', 'LIKE', isset($params['search']) ? "%" . $params['search'] . "%" : "%")
            ->orderBy($params['sortBy'] ?? 'contacts.id',  $params['sortType'] ?? 'asc')
            ->distinct()
            ->select("contacts.id");

        $q = Contact::whereIn('contacts.id', $find->pluck('id')->toArray())
            ->orderBy($params['sortBy'] ?? 'contacts.id',  $params['sortType'] ?? 'asc');


        if (Helpers::hasValue($params['per_page']) && ($params['per_page'] == -1)) $params['per_page'] = 999999999999;
        if (Helpers::hasValue($params['paginate']) && ($params['paginate'] == 'no')) return $q->get();
        return $q->paginate($params['per_page'] ?? 10);

        return $q;
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
