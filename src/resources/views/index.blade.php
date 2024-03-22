<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
        </div>
    </header>

    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>Confirm</h2>
            </div>
            <form class="form" action="/contacts/confirm" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <label class="form__label--item">お名前</label>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--nametext">
                            <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}" />
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
                            <label><input type="radio" name="gender" value="1" checked />男性</label>
                            <label><input type="radio" name="gender" value="2" />女性</label>
                            <label><input type="radio" name="gender" value="3" />その他</label>
                        </div>
                        <div class="form__error">
                            <!--バリデーション機能を実装したら記述します。-->
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
                            <input type="email" name="email" placeholder="test@example.com"
                                value="{{ old('email') }}" />
                        </div>
                        @error('email')
                            <div class="form__error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <label class="form__label--item">電話番号</label>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--tel">
                            <input type="tel" name="tel" placeholder="09012345678"
                                value="{{ old('tel') }}" />
                            {{-- <input type="tel" name="tel1" placeholder="090" />
                            <span>-</span>
                            <input type="tel" name="tel2" placeholder="1234" />
                            <span>-</span>
                            <input type="tel" name="tel3" placeholder="5678" /> --}}
                        </div>
                        @error('tel')
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
                            <input type="text" name="address" placeholder="東京都○○1-2-3"
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
                            <input type="text" name="building" placeholder="マンション○○"
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
                            <select class="form__input--select-btn" name="category_id">
                                <option value="選択してください">選択してください</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->content }}</option>
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
                            <textarea name="detail" placeholder="資料をいただきたいです"value="{{ old('detail') }}"></textarea>
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
    </main>

</body>


</html>
