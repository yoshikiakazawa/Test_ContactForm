<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
        <title>thanks</title>
    </head>
    <body>
        <div class="thanks__content">
            <div class="thanks__backing">
                <p>Thank you</p>
            </div>
            <div class="thanks__heading">
                <p>お問い合わせありがとうございました</p>
                <a class="home__button" href="{{ route('contacts.main') }}">HOME</a>
            </div>
        </div>
    </body>
</html>
