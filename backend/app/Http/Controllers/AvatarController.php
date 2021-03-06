<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Avatar;

class AvatarController extends Controller
{
    public function index()
    {
        return Avatar::all();
    }

    public function create()
    {
        //
    }

    public function show($id)
    {
        return Avatar::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
