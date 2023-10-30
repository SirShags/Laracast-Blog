<x-form.field>
    <button type='submit'
            name='action'
            class='px-10 py-2 text-xs font-semibold text-white uppercase bg-blue-500 rounded-2xl hover:bg-blue-600'
            {{ $attributes }}
            >
        {{ $slot }}
    </button>
</x-form.field>
