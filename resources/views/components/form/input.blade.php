<<<<<<< HEAD
@props(['name', 'type' => 'text'])
=======
@props(['name'])
>>>>>>> a2b7a0d8d168f86b202c4665cc79422f425be354

<x-form.field>
    <x-form.label name='{{ $name }}' />

<<<<<<< HEAD
    <input  type='{{ $type }}'
            class='border border-gray-400 p-2 w-full'
            value='{{ old("name") }}'
            name='{{ $name }}'
            id='{{ $name }}'
            required
=======
    <input  class='border border-gray-200 p-2 w-full rounded'
            name='{{ $name }}'
            id='{{ $name }}'
            {{ $attributes(['value' => old($name)]) }}
>>>>>>> a2b7a0d8d168f86b202c4665cc79422f425be354
    >

    <x-form.error name='{{ $name }}' />
</x-form.field>
