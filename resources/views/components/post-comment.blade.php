@props(['comment'])


<x-panel class='bg-gray-50'>
    <article class='flex space-x-4'>
        <div class='flex-shrink-0'>
            <img src="https://i.pravatar.cc/60?u={{ $comment->user_id }}" alt="" width='60' class='rounded-xl'>
        </div>

        <div>
            <header class='mh-4'>
                <h3 class='font-bold'>
                    {{ $comment->author->username }}
                </h3>

                <p class='text-xs'>
                    <time>
                        {{ $comment->created_at->diffForHumans() }}
                    </time>
                </p>

                <p>
                    {{ $comment->body }}
                </p>
            </header>
        </div>
    </article>
</x-panel>
