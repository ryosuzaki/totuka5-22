<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>戸塚ハッカソン</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <!-- MDB -->
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css"
    rel="stylesheet"
    />
    <!---->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">

    <!-- tablesorter -->
    <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
    <style type="text/css">
        .tablesorter-headerUnSorted {
            height:80%;
            background-image: url("{{asset('img/sort-icon.png')}}");
            background-repeat: no-repeat;
            background-size:auto 60%;
            background-position: center right;
        }
        .tablesorter-headerAsc {
            background-image: url("{{asset('img/sort-asc-icon.png')}}");
            background-repeat: no-repeat;
            background-size:auto 60%;
            background-position: center right;
        }
        .tablesorter-headerDesc {
            background-image: url("{{asset('img/sort-desc-icon.png')}}");
            background-repeat: no-repeat;
            background-size:auto 60%;
            background-position: center right;
        }
        label{
            font-size:1rem;
        }
        td{
            font-size:1rem;
        }
    </style>

</head>
<body class="drawer drawer--left">
    <div id="app">
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    戸塚ハッカソン
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                避難所
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('shelter.search.get') }}">
                                    検索
                                </a>
                                @auth
                                <a class="dropdown-item" href="{{ route('shelter.register.get') }}">
                                    登録
                                </a>
                                @endauth
                            </div>
                            
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                サポートチーム
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('support_team.search.get') }}">
                                    検索
                                </a>
                                @auth
                                <a class="dropdown-item" href="{{ route('support_team.register.get') }}">
                                    登録
                                </a>
                                @endauth
                            </div>
                        </li>
                        @auth
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                アンケート
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('questionnaire.form.get',['type'=>'health']) }}">
                                    健康管理
                                </a>
                                <a class="dropdown-item" href="{{ route('questionnaire.form.get',['type'=>'safety']) }}">
                                    安否確認
                                </a>
                                <a class="dropdown-item" href="{{ route('questionnaire.answers',['id'=>Auth::user()->id])}}">
                                    これまでの回答
                                </a>
                            </div>
                        </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown"> 
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.info') }}">
                                        個人情報 確認・編集
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.belong') }}">
                                        所属一覧
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <header role="banner">
            <button type="button" class="drawer-toggle drawer-hamburger">
            <span class="sr-only">toggle navigation</span>
            <span class="drawer-hamburger-icon"></span>
            </button>
            <nav class="drawer-nav" role="navigation">
            <ul class="drawer-menu">
                <li><a class="drawer-brand" href="{{ url('/') }}">戸塚ハッカソン</a></li>
                <li class="drawer-dropdown">
                    <a class="drawer-menu-item" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                    避難所<span class="drawer-caret"></span>
                    </a>
                    <ul class="drawer-dropdown-menu">
                    <li><a class="drawer-dropdown-menu-item" href="{{ route('shelter.search.get') }}">検索</a></li>
                    @auth
                    <li><a class="drawer-dropdown-menu-item" href="{{ route('shelter.register.get') }}">登録</a></li>
                    @endauth
                    </ul>
                </li>
                <li><a class="drawer-menu-item" href="#">Nav1</a></li>
                <li><a class="drawer-menu-item" href="#">Nav2</a></li>
            </ul>
            </nav>
        </header>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

<!--<footer class="mx-auto">
<a href="{{route('license')}}" class="text-center">ライセンス</a>
</footer>-->

<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"
></script>
<!---->
<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
<script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
<script type="module">
$(document).ready(function() {
  $('.drawer').drawer();
});
</script>

</body>
</html>
