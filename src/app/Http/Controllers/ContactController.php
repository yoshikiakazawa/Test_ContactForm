<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();

        return view('index', compact('contacts', 'categories'));
    }

    public function confirm(ContactRequest $request)
    {
        // $request->validate([
        //     'first_name' => 'required|max:255',
        //     'last_name' => 'required|max:255',
        //     'gender' => 'required|numeric',
        //     'email' => 'required|email|max:255',
        //     'tel' => 'required|numeric|max:5',
        //     'address' => 'required|max:255',
        //     'building' => 'max:255',
        //     'category_id' => 'required|numeric',
        //     'detail' => 'required|max:120',
        // ]);

        $contact = $request->only('last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail');
        // $contact = $request->all();
        // Contact::create($contact);
        // return $contact;
        // return view('thanks');
        return view('confirm', compact('contact'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $contact = $request->only('last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail');
        Contact::create($contact);
        return view('thanks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
