<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Core\BaseRepository;
use App\Core\Utilities\Helpers;
use App\Http\Resources\ContactResource;

class ContactRepository extends BaseRepository
{
    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }

    public function list($params)
    {
        $q = Contact::leftJoin('phones', 'contacts.id', '=', 'phones.contact_id')
            ->leftJoin('emails', 'contacts.id', '=', 'emails.contact_id')
            ->leftJoin('group_company_charge_contact', 'contacts.id', '=', 'group_company_charge_contact.contact_id');

        $q->ofId($params['id'] ?? '');
        $q->ofSearch($params['search'] ?? '');
        $q->ofCompanyId($params['companyId'] ?? '');

        $q->distinct("contacts.id");
        $q->select("contacts.id");


        $q = Contact::whereIn('contacts.id', $q->pluck('id')->toArray())
            ->orderBy($params['sortBy'] ?? 'contacts.id',  $params['sortType'] ?? 'asc');

        // if per page is -1, we don't need to paginate at all, but we still return the paginated
        // data structure to our response. Let's just put the biggest number we can imagine.
        if (Helpers::hasValue($params['per_page']) && ($params['per_page'] == -1)) $params['per_page'] = 999999999999;

        // if don't want any pagination
        if (Helpers::hasValue($params['paginate']) && ($params['paginate'] == 'no')) return $q->get();

        return new ContactResource($q->paginate($params['per_page'] ?? 10));
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
