@extends('layouts.layout')
@section('title','Blog編集')
@include('layouts.header')

<!-- コンテンツ -->
@section('content')
<main>
    <h2>Blog編集フォーム</h2>
    <form method="POST" action="{{ route('update') }}" id="demo" onSubmit="return checkSubmit()" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $blog->id }}">
        <input type="hidden" name="old_img" value="{{ $blog->imgpath }}">
        <ul>
            <li>
                <label for="title">タイトル</label>
                <input id="title" name="title" class="form" value="{{ $blog->title }}" type="text"><br>
                @if ($errors->has('title'))
                <div class="danger">
                    {{ $errors->first('title') }}
                </div>
                @endif
            </li>
            <li>
                <label for="content">内容　　</label>
                <textarea name="content" rows="10" cols="5" tabindex="4">{{ $blog->content }}</textarea>
                @if ($errors->has('content'))
                <div class="danger">
                    {{ $errors->first('content') }}
                </div>
                @endif
            </li>
            <li>
                @if(empty($blog->imgpath))
                <img src="{{ asset('/images/no_image.JPG') }}" width="50">
                @else
                <img src="/uploads/{{ $blog->imgpath }}">
                @endif</li>
            <li>
                <input type="file" name="new_img">
                @if ($errors->has('imgpath'))
                <div class="danger">
                    {{ $errors->first('imgpath') }}
                </div>
                @endif
            </li>
        </ul>
        <br>
        <div class="flex">
            <a href="{{ route('blogs') }}">
                <button class="mybtn bg-gray" type="button">キャンセル</button>
            </a>
            <button type="submit" class="mybtn bg-blue">
                更新する
            </button>
        </div>
    </form>

</main>
<script>
    function checkSubmit() {
        if (window.confirm('更新してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection