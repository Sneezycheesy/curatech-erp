@props(['disabled' => isset($disabled) ? true : false, 'options' => empty('options') ? $options : ''])

<select
    {{$attributes->merge(['class' => 'border-cbg-300 dark:border-cbg-700 dark:bg-cbg-900 dark:text-cbg-300 focus:border-red-500 dark:focus:border-red-600 focus:ring-red-500 dark:focus:ring-red-600 rounded-md shadow-sm'])}} 
    {{ $disabled ? 'disabled' : '' }}>
    {{$options}}
</select>