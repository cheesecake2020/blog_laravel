@extends('layouts.layout')
@section('title','Blog登録')
@include('layouts.header')

<!-- コンテンツ -->
@section('content')
<main>
    <h2>Blog登録</h2>
    <form method="POST" action="{{ route('store') }}" id="demo" onSubmit="return checkSubmit()" enctype="multipart/form-data">
        @csrf
        <form id="demo" action="#" onsubmit="return false;">
            <ul>
                <li>
                    <label for="title">タイトル</label>
                    <input id="title" name="title" class="form" value="{{ old('title') }}" type="text"><br>
                    @if ($errors->has('title'))
                    <div class="danger">
                        {{ $errors->first('title') }}
                    </div>
                    @endif
                </li>
                <li>
                    <label for="content">内容　　</label>
                    <textarea name='content' rows="10" cols="5" tabindex="4"></textarea>
                    @if ($errors->has('content'))
                    <div class="danger">
                        {{ $errors->first('content') }}
                    </div>
                    @endif
                </li>
                <li>
                    <input type="file" name="imgpath">
                    @if ($errors->has('imgpath'))
                    <div class="danger">
                        {{ $errors->first('imgpath') }}
                    </div>
                    @endif
                </li>
            </ul>
            <br>
            <div class="flex">
                <button class="mybtn bg-gray">
                    <a href="{{ route('blogs') }}">
                        キャンセル
                    </a></button>
                <button type="submit" class="mybtn bg-blue">
                    投稿する
                </button>
            </div>
        </form>

</main>
<script>
    function checkSubmit() {
        if (window.confirm('送信してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection