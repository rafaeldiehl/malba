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

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
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