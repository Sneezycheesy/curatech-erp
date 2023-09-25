@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-primary-600 dark:border-primary-600 text-sm font-medium leading-5 text-paragraph-light dark:text-paragraph-dark focus:outline-none focus:border-primary-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-paragraph-light dark:text-paragraph-dark hover:text-paragraph-700 dark:hover:text-paragraph-100 hover:border-primary-300 dark:hover:border-primary-700 focus:outline-none focus:text-paragraph-700 dark:focus:text-paragraph-300 focus:border-paragraph-300 dark:focus:border-paragraph-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
