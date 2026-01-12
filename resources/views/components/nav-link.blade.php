@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-4 py-2 border-b-2 border-indigo-400 dark:border-indigo-600 text-base font-semibold leading-5 text-gray-900 dark:text-white focus:outline-none transition duration-150 ease-in-out'
    : 'inline-flex items-center px-4 py-2 border-b-2 border-transparent text-base font-medium leading-5 text-gray-500 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:border-gray-400 dark:hover:border-gray-600 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
