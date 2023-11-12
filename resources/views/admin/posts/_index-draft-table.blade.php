<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="text-sm font-medium text-gray-900">
                <span>
                    {{ $draft->title }}
                </span>
            </div>
        </div>
    </td>

    <td class='px-4 py-4 whitespace-nowrap'>
        <span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-gray-800 animate-pulse'>
            Draft
        </span>
    </td>

    <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
        @if($draft->post_id)
            <a href="/admin/posts/{{ $draft->post_id }}/edit" class="text-blue-500 hover:text-blue-600">
                Edit
            </a>
        @else
            <a href="/admin/posts/{{ $draft->id }}/edit" class="text-blue-500 hover:text-blue-600">
                Edit
            </a>
        @endif
    </td>

    <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
        <form method="POST" action="/admin/posts/{{ $draft->id }}">
            @csrf
            @method('DELETE')

            <button class="text-xs text-gray-400">Delete</button>
        </form>
    </td>
</tr>
