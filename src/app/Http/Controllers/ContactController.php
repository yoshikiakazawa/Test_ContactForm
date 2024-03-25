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
        // $categories = Category::all();

        return view('index', compact('contacts'));
    }

    public function confirm(ContactRequest $request)
    {


        // $contact = $request->only('last_name', 'first_name', 'gender', 'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'detail');
        $contact = $request->all();

        $request->session()->put([
            '_old_input' => [
                'last_name' => $contact['last_name'],
                'first_name' => $contact['first_name'],
                'gender' => $contact['gender'],
                'email' => $contact['email'],
                'tel1' => $contact['tel1'],
                'tel2' => $contact['tel2'],
                'tel3' => $contact['tel3'],
                'address' => $contact['address'],
                'building' => $contact['building'],
                'category_id' => $contact['category_id'],
                'detail' => $contact['detail'],
            ]
        ]);

        $fullName = $contact['last_name'] . ' ' . $contact['first_name'];

        $tel = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];

        $gender_content = $contact['gender'];
        switch ($gender_content)
        {
            case 1:
                $gender_content = '男性';
                break;
            case 2:
                $gender_content = '女性';
                break;
            case 3:
                $gender_content = 'その他';
                break;
            default:
                $gender_content = '未指定';
                break;
        }

        $category = Category::find($contact['category_id']);
        $category_content = $category ? $category->content : '';

        return view('confirm', compact('fullName', 'contact', 'tel', 'gender_content', 'category_content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        $request->session()->forget('_old_input');
        $request->session()->save();

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
