<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function current(Request $request){
        return $this->json_response([
            'user' => $request->user(),
            'permissions' => Permission::all()->pluck('code')->flip()
        ]);
    }

    public function list(Request $request): \Illuminate\Http\JsonResponse
    {
//        $request->validate([
//            'cascade' => 'boolean'
//        ]);
        $query = User::query();
//        $cascade_mode = false;
//        if($request->has('cascade'))
//            $cascade_mode = $request->user()->can("sys.view_user-cascade")? $request['cascade']: false;

//        $query = !$cascade_mode? User::where('fn_organization_id',$request->user()->fn_organization_id) :
//            User::whereIn('fn_organization_id',Organization::select("organization_id")->descendantsAndSelf($request->user()->organization->organization_id)->pluck("organization_id"));

        return $this->json_response(
            $query->paginate()
        );
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'username'=> 'required|string|unique:t_user,username',
            'password'=> 'required|confirmed',
            'email' => 'email'
        ]);
        $target = new User($request->input());
        $target->username = $request['username'];
        $target->password = bcrypt($request['password']);
        $target->save();

//        $cascade_mode = false;
//        if($request->has('cascade'))
//            $cascade_mode = $request->user()->can("sys.view_user-cascade")? $request['cascade']: false;

//        $query = !$cascade_mode? User::where('fn_organization_id',$request->user()->fn_organization_id) :
//            User::whereIn('fn_organization_id',Organization::select("organization_id")->descendantsAndSelf($request->user()->organization->organization_id)->pluck("organization_id"));

        return $this->json_response($target);
    }

    public function update(Request $request, User $target): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'password'=> 'confirmed',
            'email' => 'email'
        ]);

        $target->update($request->only(['email', 'nickname']));
        if($request->has('password'))
            $target->password = bcrypt($request['password']);
        $target->save();

//        $cascade_mode = false;
//        if($request->has('cascade'))
//            $cascade_mode = $request->user()->can("sys.view_user-cascade")? $request['cascade']: false;

//        $query = !$cascade_mode? User::where('fn_organization_id',$request->user()->fn_organization_id) :
//            User::whereIn('fn_organization_id',Organization::select("organization_id")->descendantsAndSelf($request->user()->organization->organization_id)->pluck("organization_id"));

        return $this->json_response($target);
    }

    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'user_ids' => 'array|required'
        ]);
        User::whereIn('user_id', $request['user_ids'])->where('user_id', '<>', 1)->delete();
        return $this->json_response();
    }
}
