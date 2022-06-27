<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return User::all()->where('isAdmin', '=', 0);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function admin()
    {
        return User::all()->where('isAdmin', '=', 1);
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if(User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->name = is_null($request->name) ? $user->name : $request->name;
            $user->username = is_null($request->username) ? $user->username : $request->username;
            $user->isDarkTheme = is_null($request->isDarkTheme) ? $user->isDarkTheme : $request->isDarkTheme;
            $user->avatar = is_null($request->avatar) ? $user->avatar : $request->avatar;
            $user->save();

            return response([
                "user" => $user,
                "message" => "Usuário atualizado com sucesso..."
            ], 200);
        } else {
            return response()->json([
                "message" => "Usuário não encontrado"
            ], 404);
        }
    }

    public function destroy($id)
    {
        //
    }

    public function hitsAsc() {
        return DB::table('users')->where('isAdmin', '=', 0)->where('hits', '!=', null)->orderBy('hits', 'ASC')->get();
    }

    public function hitsDesc() {
        return DB::table('users')->where('isAdmin', '=', 0)->where('hits', '!=', null)->orderBy('hits', 'DESC')->get();
    }

}
