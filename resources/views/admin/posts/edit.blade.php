<x-layout>
    <x-setting :heading="'Edit Post: ' . $post->title">
        <form action="/admin/posts/{{ $post->id }}" method='POST' enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name='title' :value="old('title', $post->title)" />

            <div class='flex mt-6'>
                <div class='flex-1'>
                    <x-form.input name='thumbnail' type='file' :value="old('thumbnail', $post->thumbnail)"/>
                </div>

                <img src="{{ asset('storage/thumbnails/' . $post->thumbnail) }}" alt="" class="rounded-xl ml-6" width='100'>
            </div>


            <x-form.textarea name='excerpt'>
                {{ old('excerpt', $post->excerpt) }}
            </x-form.textarea>

            <x-form.textarea name='body'>
                {{ old('body', $post->body) }}
            </x-form.textarea>

            <div class='flex space-x-12'>
                <x-form.field>
                    <x-form.label name='category_id' />

                    <select name="category_id" id='category_id'>
                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}"
                                        {{ old('category_id', $post->category_id) == $category->id ? 'selected' : "" }}
                            >
                                {{ ucwords($category->name) }}
                            </option>
                        @endforeach
                    </select>

                    <x-form.error name='category' />
                </x-form.field>

                <x-form.field>
                    <x-form.label name='user_id' />

                    <select name="user_id" id='user_id'>
                        @foreach (\App\Models\User::all() as $user)
                            <option value="{{ $user->id }}"
                                        {{ old('user_id', $post->author->id) == $user->id ? 'selected' : "" }}
                            >
                                {{ ucwords($user->name) }}
                            </option>
                        @endforeach
                    </select>

                    <x-form.error name='user' />
                </x-form.field>
            </div>

            <div class='flex space-x-3'>
                <x-form.button value='draft'>
                    Save as Draft
                </x-form.button>

                <x-form.button value='create'>
                    Publish
                </x-form.button>
            </div>
        </form>
    </x-setting>
</x-layout>
