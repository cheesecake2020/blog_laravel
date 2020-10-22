@extends('layouts.layout')
@section('title','ブログ詳細')
@include('layouts.header')

<!-- コンテンツ -->
@section('content')
<main>
    <h2>{{ $blog->title }}</h2>
    <span>作成日:{{ $blog->created_at }}</span>
    <span>更新日:{{ $blog->updated_at }}</span>
    <div>
        @if(empty($blog->imgpath))
        <img src="{{ asset('/images/no_image.JPG') }}" width="100">
        @else
        <img src="/uploads/{{ $blog->imgpath }}">
        @endif

    </div>
    <p>{{ $blog->content }}</p>
    <div class="flex">
        <a href="{{ route('blogs') }}"><button class="mybtn bg-gray">戻る</button></a>
        <a href="/edit/{{ $blog->id }}"><button class="mybtn bg-gray" >編集</button></a>
        <form method="POST" action="{{ route('delete',$blog->id) }}" onSubmit="return checkDelete()">
            @csrf
            <button class="mybtn bg-gray" id="delete" type="submit" onclick=>削除</button>
        </form>
    </div>
</main>
<script>
    'use strict';

    function checkDelete() {
        if (window.confirm('削除してよろしいですか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection