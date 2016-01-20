<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Models\Client;
use Illuminate\Http\Request;

use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
        return \CodeProject\Models\Client::all();
    }

    public function store(Request $request)
    {
        return Client::create($request->all());
    }

    public function show($id)
    {
        return Client::find($id);
    }

    public function destroy($id)
    {
        Client::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
        return Client::find($id)->save($request);
    }
}
