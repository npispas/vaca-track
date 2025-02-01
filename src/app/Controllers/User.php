<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\Role;
use App\Models\User as UserModel;

class User extends Controller
{
    public function index(): void
    {
        $users = UserModel::with('role')->get();

        View::render('users/index', compact('users'));
    }

    public function create(): void
    {
        $roles = Role::all();

        View::render('users/create', compact('roles'));
    }

    public function store(): void
    {
        $errors = Request::validate([
            'name' => ['required', 'max' => 255],
            'email' => ['required', 'email', 'unique' => 'users,email', 'max' => 255],
            'username' => ['required', 'unique' => 'users,username', 'max' => 255],
            'employee_id' => ['required', 'unique' => 'users,employee_id', 'exact' => 7],
            'role_id' => ['required'],
            'password' => ['required', 'min' => 8, 'max' => 255],
            'password_confirmation' => ['required']
        ]);

        if ($errors) {
            Response::redirect('/users/create')->with('errors', $errors)->send();
        }

        $data = Request::all();

        $user = new UserModel();
        $user->fill($data);
        $user->save();

        Response::redirect('/users')->with('success', 'User created successfully!')->send();
    }

    public function edit(int $id): void
    {
        $user = UserModel::find($id);

        View::render('users/edit', compact('user'));
    }

    public function update(int $id): void
    {
        $errors = Request::validate([
            'name' => ['required', 'max' => 255],
            'email' => ['required', 'email', 'unique' => "users,email,$id", 'max' => 255],
            'password' => ['nullable', 'min' => 8, 'max' => 255],
            'password_confirmation' => ['nullable'],
        ]);

        if ($errors) {
            Response::redirect("/users/$id/edit")->with('errors', $errors)->send();
        }

        $data = array_filter(Request::all(), fn ($value) => !empty($value));

        $user = UserModel::find($id);
        $user->fill($data);
        $user->update();

        Response::redirect('/users')->with('success', 'User updated successfully!')->send();
    }

    public function delete(int $id): void
    {
        UserModel::find($id)->delete();

        Response::redirect('/users')->with('success', 'User deleted successfully!')->send();
    }
}
