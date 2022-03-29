<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return response()->json([
            'data' => $users,
            'message' => 'success',
        ]);
    }

    public function store(StoreUserRequest $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json([
            'data' => $user,
            'message' => 'success',
        ]);
    }

    public function edit($id){
        $user = User::find($id);
        if($user){
            return response()->json([
                'data' => $user,
                'message' => 'success',
            ]);
        } else {
            return response()->json(['message' => 'Data not found']);
        }
    }

    public function update(UpdateUserRequest $request,$id){
        $user = User::find($id);
        if($user) {
            $updated_role = $user->update($request->all());
            return response()->json([
                'data' => $user,
                'message' => 'success'
            ]);
        } else {
            return response()->json(['message' => 'Data not found']);
        }
    }

    public function show($id){
        $user = User::with('user_get_role')->where('id',$id)->get();
        if($user) {
            return response()->json([
                'data' => $user,
                'message' => 'success',
            ]);
        } else {
            return response()->json(['message' => 'Data not found']);
        }
    }

    public function delete($id){
        $user = User::find($id);
        if($user) {
            $user->delete();
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'Data not found']);
        }
    }
}
