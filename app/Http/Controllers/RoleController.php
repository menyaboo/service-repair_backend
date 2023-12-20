<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return Role::all();
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->all());

        return $role;
    }

}
