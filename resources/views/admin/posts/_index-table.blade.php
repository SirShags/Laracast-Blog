<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="text-sm font-medium text-gray-900 hover:text-gray-500 hover:underline">
                <a href="/posts/{{ $post->slug }}">
                    {{ $post->title }}
                </a>
            </div>
        </div>
    </td>

    <td class='px-4 py-4 whitespace-nowrap'>
            <span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800'>
                Published
            </span>
    </td>

    <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
        <a href="/admin/posts/{{ $post->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
    </td>

    <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
        <form method="POST" action="/admin/posts/{{ $post->id }}">
            @csrf
            @method('DELETE')

            <button class="text-xs text-gray-400">Delete</button>
        </form>
    </td>
</tr>
