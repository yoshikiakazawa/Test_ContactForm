@extends('layouts.app')
@if (Auth::check())
@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection
@section('button')
<form class="sign__button" action="/logout" method="post">
    @csrf
    <button class="sign__button-submit">logout</button>
</form>
@endsection
@section('content')

<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>
    <form class="search-form" action="{{ route('admin.search') }}" method="get">
        @csrf
        <input class="search-form__item-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="名前やメールアドレスを入力して下さい" >
        <select class="search-form__item-select-gender" name="gender">
            <option value="">性別</option>
            <option value="1">男性</option>
            <option value="2">女性</option>
            <option value="3">その他</option>
        </select>
        <select class="search-form__item-select-id" name="category_id">
            <option value="" selected>お問い合わせの種類</option>
            <option value="">選択してください</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
            @endforeach
        </select>
        <input class="search-form__item-date" type="date" name="created_at" value="{{ old('created_at') }}" >
        <button class="search__button-submit">検索</button>
        <a class="reset__button" href="{{ route('admin.main') }}">
            <button class="reset__button-submit">リセット</button>
        </a>
    </form>
    <div class="admin__option">
        <a class="csv__button-submit" href="{{ route('admin.csv') }}">エクスポート</a>
        {{ $contacts->appends(request()->query())->links('pagination::semantic-ui') }}
    </div>
    <div class="inquiry-table">
        <table class="inquiry-table__inner">
            <tr class="inquiry-table__row">
                <th class="inquiry-table__header" style="width: 20%;" >お名前</th>
                <th class="inquiry-table__header" style="width: 10%;" >性別</th>
                <th class="inquiry-table__header" style="width: 28%;" >メールアドレス</th>
                <th class="inquiry-table__header" style="width: 28%;" >お問い合わせの種類</th>
                <th class="inquiry-table__header" style="min-width: 140px;" ></th>
            </tr>
            @foreach ($contacts as $contact)
            <tr class="inquiry-table__row">
                <td class="inquiry-table__item">
                    <p>{{ $contact['last_name'] . '　' . $contact['first_name'] }}</p>
                </td>
                <td class="inquiry-table__item">
                    {{-- @if($contact['gender'] == 1)
                    <p>男性</p>
                    @elseif($contact['gender'] == 2)
                    <p>女性</p>
                    @elseif($contact['gender'] == 3)
                    <p>その他</p>
                    @endif --}}
                    {{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}
                </td>
                <td class="inquiry-table__item">{{ $contact['email'] }}</td>
                <td class="inquiry-table__item">
                    @foreach ($categories as $category)
                    {{-- @if ($contact['category_id'] == $category->id)
                    {{ $category->content }}
                    @endif --}}
                    {{ $contact['category_id'] == $category->id ? $category->content : '' }}
                    @endforeach
                </td>
                <td class="inquiry-table__item">
                    <div class="inquiry-form__button">
                        <label for="modal-toggle-{{ $contact['id'] }}" class="inquiry-form__button-submit">詳細</label>
                    </div>

                    <input type="checkbox" id="modal-toggle-{{ $contact['id'] }}" class="modal-toggle">
                    <div class="modal">
                        <label class="close__button-submit" for="modal-toggle-{{ $contact['id'] }}"></label>
                        <div class="detail-table">
                            <table class="detail-table__inner">
                                <tr class="detail-table__row">
                                    <th class="detail-table__header">お名前</th>
                                    <td class="detail-table__text">
                                        {{ $contact['last_name'] . '　' . $contact['first_name'] }}
                                    </td>
                                </tr>
                                <tr class="detail-table__row">
                                    <th class="detail-table__header">性別</th>
                                    <td class="detail-table__text">
                                        {{ $contact['gender'] == 1 ? '男性' : ($contact['gender'] == 2 ? '女性' : 'その他') }}
                                    </td>
                                </tr>
                                <tr class="detail-table__row">
                                    <th class="detail-table__header">メールアドレス</th>
                                    <td class="detail-table__text">
                                        {{ $contact['email'] }}
                                    </td>
                                </tr>
                                <tr class="detail-table__row">
                                    <th class="detail-table__header">電話番号</th>
                                    <td class="detail-table__text">
                                        {{ $contact['tel'] }}
                                    </td>
                                </tr>
                                <tr class="detail-table__row">
                                    <th class="detail-table__header">住所</th>
                                    <td class="detail-table__text">
                                        {{ $contact['address'] }}
                                    </td>
                                </tr>
                                <tr class="detail-table__row">
                                    <th class="detail-table__header">建物名</th>
                                    <td class="detail-table__text">
                                        {{ $contact['building'] }}
                                    </td>
                                </tr>
                                <tr class="detail-table__row">
                                    <th class="detail-table__header">お問い合わせの種類</th>
                                    <td class="detail-table__text">
                                        @foreach ($categories as $category)
                                        {{ $contact['category_id'] == $category->id ? $category->content : '' }}
                                        @endforeach
                                    </td>
                                </tr>
                                <tr class="detail-table__row">
                                    <th class="detail-table__header">お問い合わせ内容</th>
                                    <td class="detail-table__text">
                                        {{$contact['detail']}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <form class="form" action="/admin/delete" method="post">
                            @method('DELETE')
                            @csrf
                            <div class="delete__button">
                                <input type="hidden" name="id" value="{{ $contact['id'] }}">
                                <button class="delete__button-submit" type="submit">削除</button>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endif
@endsection
