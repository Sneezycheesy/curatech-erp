@props(['message' => $message ?? null])
<p {{$attributes->merge(['class' => 'text-red-200 dark:text-red-500 text-sm'])}}>
    {{$slot}}
</p>