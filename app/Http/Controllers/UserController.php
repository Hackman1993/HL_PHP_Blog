<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $request->validate([
            'cascade' => 'boolean'
        ]);
        $cascade_mode = false;
        if($request->has('cascade'))
            $cascade_mode = $request->user()->can("sys.view_user-cascade")? $request['cascade']: false;

        $query = !$cascade_mode? User::where('fn_organization_id',$request->user()->fn_organization_id) :
            User::whereIn('fn_organization_id',Organization::select("organization_id")->descendantsAndSelf($request->user()->organization->organization_id)->pluck("organization_id"));

        $query->with(["organization","roles"]);
        if ($request->has('search'))
            $this->addFuzzyQueryParameter($query, $request['search'], ['username', 'real_name', 'passport_no', 'phone_number']);

        if($request["page"] > $query->paginate($request['limit'])->lastPage())
            $request->offsetSet('page',$query->paginate($request['limit'])->lastPage());
        return $this->jsonResponse(
            $query->with('organization')->paginate($request['limit'])
        );
    }
}
