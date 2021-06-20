<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('twitter.login') }}">Twitter Login</a>
                        <a href="{{ route('register') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    youtube大学のやつ
                </div>

                <div class="links">
                    <a href="{{ route('sample')}}/1">練習問題１</a>
                    <a href="{{ route('sample')}}/2">練習問題２・・・ヨーロッパ史（古代〜中世）</a>
                </div>
                <div class="links">
                    <a href="{{ route('mypage')}}">自分の成績</a>
                    <a href="https://twitter.com/share?url=http://local.lara02.com&text=【練習問題】youtube大学で80点でした。一緒に過去の授業を復習しよう！&hashtags=#aaaa">ツイートする</a>
                    <br>
                    何かアレば、土生（@PROGRESSHabu）までDMくださいませ。
                </div>
                <div id="app">
                    <div id="nav">
                    <router-link to="/">Home</router-link>
                    <router-link to="/about">About</router-link>
                    <router-link to="/tutorial">Tutorial</router-link>
                    <router-link to="/practice/1">Practice1</router-link>
                    <router-link to="/practice/2">Practice2</router-link>
                    </div>
                    <router-view/>
                    <example-component></example-component>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script> 
    </body>
</html>
