<x-layout>
    <x-setting heading='Publish New Post'>
        <form action="/admin/posts" method="POST" enctype="multipart/form-data">
            @csrf

            <x-form.input name='title'  required/>
            <x-form.input name='thumbnail' type='file' required/>

            <x-form.textarea name='excerpt' required/>
            <x-form.textarea name='body' required/>

            <x-form.field>
                <x-form.label name='category' />

                <select name="category_id" id='category_id'>
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : "" }}
                        >
                            {{ ucwords($category->name) }}
                        </option>
                    @endforeach
                </select>

                <x-form.error name='category' />
            </x-form.field>

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
