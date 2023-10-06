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

        <div>
            {!! $post->body !!}
        </div>
    </article>

    <a href="/">Go Back</a>
</x-layout>
