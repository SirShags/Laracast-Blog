@props(['name'])


<x-form.field>
    <x-form.label name='{{ $name }}' />

    <textarea
<<<<<<< HEAD
            class='border border-gray-400 p-2 w-full'
            name='{{ $name }}'
            id='{{ $name }}'
            required
    >{{ old($name) }}</textarea>
=======
            class='border border-gray-200 p-2 w-full rounded'
            name='{{ $name }}'
            id='{{ $name }}'
            required
    >{{ $slot ?? old($name) }}</textarea>
>>>>>>> a2b7a0d8d168f86b202c4665cc79422f425be354

    <x-form.error name='{{ $name }}' />
</x-form.field>
