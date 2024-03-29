@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="{{ route('contacts.confirm') }}" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item" for="last_name" >お名前</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--nametext">
                    <input type="text" name="last_name" id="last_name" placeholder="例：山田" value="{{ old('last_name') }}" />
                    <input type="text" name="first_name" placeholder="例：太郎"
                        value="{{ old('first_name') }}" />
                </div>
                @error('last_name')
                    <div class="form__error">{{ $message }}</div>
                @enderror
                        @error('first_name')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item" for="gender">性別</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <label><input type="radio" name="gender" id="gender" value="1" checked />男性</label>
                    <label><input type="radio" name="gender" value="2" />女性</label>
                    <label><input type="radio" name="gender" value="3" />その他</label>
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item" for="email">メールアドレス</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" id="email" placeholder="例：test@example.com"
                        value="{{ old('email') }}" />
                </div>
                @error('email')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item" for="tel1">電話番号</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--tel">
                    <input type="tel" name="tel1" id="tel1" placeholder="080" value="{{ old('tel1') }}" />
                    <span>-</span>
                    <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}" />
                    <span>-</span>
                    <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}" />
                </div>
                @error('tel1')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item" for="address">住所</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" id="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3"
                        value="{{ old('address') }}" />
                </div>
                @error('address')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item" for="building">建物名</label>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" id="building" placeholder="例：千駄ヶ谷マンション101"
                        value="{{ old('building') }}" />
                </div>
                @error('building')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item" for="category_id">お問い合わせの種類</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--select">
                    <select class="form__input--select-btn" name="category_id" id='category_id'>
                        {{-- <option value="選択してください">選択してください</option> --}}
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                            {{-- <option value="{{ $category->id }}">{{ $category->content }}</option> --}}
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <label class="form__label--item" for="detail">お問い合わせ内容</label>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" id="detail" placeholder="お問い合わせ内容をご記入ください" >{{ old('detail') }}</textarea>
                </div>
                @error('detail')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection
