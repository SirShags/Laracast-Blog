{{-- This layout is using template inheretance --}}
{{-- @extends('components.layout')

@section('content')
    <article>
        <h1>{{ $post->title }}</h1>

        <div>
            {!! $post->body !!}
        </div>
    </article>

    <a href="/">Go Back</a>
@endsection --}}

{{-- This layout is using blade components --}}

<x-layout>
    <article>
        <h1>{!! $post->title !!}</h1>

        <p>
            By <a href="/authors/{{ $post->author->username }}">{{ $post->author->name }}</a> in <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
        </p>

        <div>
            {!! $post->body !!}
        </div>
    </article>

    <a href="/">Go Back</a>
</x-layout>
