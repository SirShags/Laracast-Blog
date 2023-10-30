<x-layout>
    <x-setting heading='Manage Posts'>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($drafts as $draft)
                                    @include('admin.posts._index-draft-table')
                                @endforeach

                                @foreach ($posts as $post)
                                    {{-- Only posts that don't have an active draft won't show, user would only want to see their draft that exists --}}
                                    @if (!$post->draft_post_id)
                                        @include('admin.posts._index-table')
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-setting>
</x-layout>
