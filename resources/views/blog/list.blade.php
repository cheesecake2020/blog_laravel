@extends('layouts.layout')
@section('title','Blog一覧')
@include('layouts.header')

<!-- コンテンツ -->
@section('content')
<main>


    <h2>Blog一覧</h2>
    @if(Session::has('err_msg'))
    <p class="danger">
        {{ session('err_msg')}}
    </p>
    @endif
    @foreach ($blogs as $blog)
    <div class="container">

        <article class="box1">
            @if(empty($blog->imgpath))
            <img src="{{ asset('/images/no_image.JPG') }}">
            @else
            <img src="/uploads/{{ $blog->imgpath }}">
            @endif
        </article>
        <article class="box2">
            <a href="/{{ $blog->id }}">
                <h4>{{ $blog->title }}</h4>
            </a>
        </article>
        <article class="box3">
            <h5>{{ $blog->content }}</h5>
        </article>
    </div>

    @endforeach

</main>

@endsection