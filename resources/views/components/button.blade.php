@props([
    'type' => 'submit'
])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600']) }}>
    {{ $slot }}
</button>
