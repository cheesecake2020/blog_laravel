@section('header')
<!-- ナビゲーションバー -->

<body class="antialiased">
    <header>
        <div class="logo">
            <img class="icon" src="{{ asset('/images/icon.JPG') }}" width="30" height="30" alt="">
        </div>
        <h1>CheeseCake</h1>
        <div class="pc-menu">
            <nav>
                <ul>
                    <li><a href="{{ route('blogs') }}">HOME</a></li>
                    <li><a href="{{ route('create') }}">新規作成</a></li>
                </ul>
            </nav>
        </div>
        <!-- スマホ用メニューアイコン -->
        <button class="nav_toggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>
    <nav class="nav">
        <ul class="nav_menu_ul ">
            <li class="nav_menu_li"><a class="nav-link" href="{{ route('blogs') }}">HOME</a></li>
            <li class="nav_menu_li"><a class="nav-link" href="{{ route('create') }}">新規作成</a></li>
        </ul>
    </nav>
    @endsection