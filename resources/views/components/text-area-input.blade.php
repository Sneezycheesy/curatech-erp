@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} 
{!! $attributes->merge(['class' => 'border-cbg-300 dark:border-cbg-700 dark:bg-cbg-900 dark:text-cbg-300 
    focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-md shadow-sm']) !!}>{{$slot}}</textarea>
