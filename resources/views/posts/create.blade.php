<x-layout>
    <section class='py-8 max-w-md mx-auto'>
        <h1 class='text-lg font-bold mb-4'>
            Publish New Post
        </h1>

        <x-panel>
            <form action="/admin/posts" method="post" enctype="multipart/form-data">
                @csrf

                <x-form.input name='title' />
                <x-form.input name='thumbnail' type='file'/>

                <x-form.textarea name='excerpt'/>
                <x-form.textarea name='body'/>

                <div class='mb-6'>
                     <label  for='category_id'
                            class='block mb-2 uppercase font-bold text-xs text-gray-700'
                    >
                        Category
                    </label>

                    <select name="category_id" id='category_id'>
                        @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}"
                                           {{ old('category_id') == $category->id ? 'selected' : "" }}
                            >
                                {{ ucwords($category->name) }}
                            </option>
                        @endforeach
                    </select>

                    @error('category')
                         <p class='text-red-500 text-xs mt-1'>
                             {{ $message }}
                         </p>
                    @enderror
                </div>

                <x-submit-button>
                    Publish
                </x-submit-button>
            </form>
        </x-panel>
    </section>
</x-layout>
