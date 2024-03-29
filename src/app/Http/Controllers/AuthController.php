<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use App\Models\User;


class AuthController extends Controller
{
    public function admin()
    {
        // $contacts = Contact::with('category')->paginate(7);
        $contacts = Contact::with('category')->orderBy('created_at', 'desc')->paginate(7);

        return view('admin',  compact('contacts'));
    }

    // public function register(AuthRequest $request)
    // {
    //     User::create($request->validated());

    //     return view('auth/register');
    // }
}
