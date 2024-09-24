@props([
    'id' => null,
    'name',
    'label',
])

<div>
    <label for="{{ $id ?? $name }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    <input id="{{ $id ?? $name }}" type="password" name="{{ $name }}" {{ $attributes->merge(['class' => 'w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500']) }}>
</div>
