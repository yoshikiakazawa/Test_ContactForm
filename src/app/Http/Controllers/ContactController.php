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
        // $contacts = Contact::with('category')->get();
        // $categories = Category::all();
        // return view('index', compact('contacts'));
        return view('index');
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

        $fullName = $contact['last_name'] . '　' . $contact['first_name'];

        $tel = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];

        $gender_content = $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他');

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
    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('admin');
    }

    public function admin()
    {
        // $contacts = Contact::with('category')->get();
        // $contacts = Contact::with('category')->paginate(7);
        // $contacts = Contact::all();
        $contacts = Contact::with('category')->orderBy('created_at', 'desc')->paginate(7);
        // $contacts = Contact::Paginate(7);
        // $contacts = Contact::query()->paginate(7);
        // $contacts = Contact::with('category')->paginate(7);

        return view('admin',  compact('contacts'));
    }

    public function search(Request $request)
    {
        // リクエストから検索キーワードを取得
        $keyword = $request->input('keyword');
        $gender = $request->input('gender');
        $category_id = $request->input('category_id');
        $created_at = $request->input('created_at');

        // 検索クエリの構築
        $query = Contact::query();

        // 名前やメールアドレスの検索
        if ($keyword)
        {
            $query->where(function ($q) use ($keyword)
            {
                $q->where('first_name', 'like', "%$keyword%")
                    ->orWhere('last_name', 'like', "%$keyword%")
                    ->orWhere('email', 'like', "%$keyword%");
            });
        }

        // 性別の検索
        if ($gender)
        {
            $query->where('gender', $gender);
        }

        // お問い合わせの種類の検索
        if ($category_id)
        {
            $query->where('category_id', $category_id);
        }

        // 作成日時の検索
        if ($created_at)
        {
            $query->whereDate('created_at', $created_at);
        }

        // 検索結果の取得
        $contacts = $query->get();
        $contacts = $query->paginate(7)->appends($request->all());

        // 検索結果をビューに渡して表示する
        return view('admin', compact('contacts'));
    }
}
