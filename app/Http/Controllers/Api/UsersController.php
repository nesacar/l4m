<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\User;
use File;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index(){
        $users = User::with('client')->orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'users' => $users
        ]);
    }

    public function store(CreateUserRequest $request){
        $user = User::create($request->except('password', 'image'));
        if(request('password')){
            $user->password = bcrypt(request('password'));
            $user->update();
        }

        return response()->json([
            'user' => $user
        ]);
    }

    public function show($id){
        $user = User::with('client')->find($id);
        return response()->json([
            'user' => $user,
            'client_ids' =>  $user->client()->get(['id', 'title']),
            'clients' => Client::select('id', 'title')->where('publish', 1)->get(),
        ]);
    }

    public function update(EditUserRequest $request, $id){
        $user = User::find($id);
        $user->update($request->except('password', 'image'));
        if(request('password')){
            $user->password = bcrypt(request('password'));
            $user->update();
        }

        $user->client()->sync(request('client_ids'));

        $client_ids = $user->client()->pluck('id');

        return response()->json([
            'user' => $user,
            'client_ids' => $client_ids,
        ]);
    }

    public function destroy($id){
        $user = User::find($id);
        if(!empty($user->image)) File::delete($user->image);
        User::destroy($user->id);
        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function uploadImage($id){
        $user = User::find($id);
        $user->update(['image' => $user->storeImage()]);
        return response()->json([
            'image' => $user->image
        ]);
    }

    public function changePassword(ChangePasswordRequest $request){
        $user = $request->user();
        if (Hash::check(request('oldpassword'), $user->password)) {
            $user->password = bcrypt(request('password'));
            $user->update();

            $user->update(['image' => $user->storeImage()]);

            return response()->json([
                'message' => 'done'
            ]);
        }else{
            return response()->json([
                'errors' => [
                    'oldpassword' => [
                        0 => 'the old password mismatch'
                    ]
                ]
            ], 422);
        }
    }

    public function logout(Request $request){
        $user = $request->user();
        return response()->json([
            'message' => 'logout user'
        ]);
    }

    public function getUsers(Request $request){
        $user = $request->user();
        $users = User::select('id', 'email', 'role_id', 'name', 'image')->where('block', 0)->where('id', '<>', $user->id)->get();

        return response()->json([
            'users' => $users,
        ]);
    }

    /**
     * @param User $user
     */
    public function clientByUser(User $user){
        $client = $user->client()->first();

        return response()->json([
            'client' => $client,
        ]);
    }
}
