@props(['counter'])
<div class="grid grid-rows-1 py-3 auto-cols-fr text-center mx-auto grid-flow-col hover:bg-cbg-400 dark:hover:bg-cbg-500 {{$counter ? 'bg-cbg-200 dark:bg-cbg-800' : 'bg-cbg-300 dark:bg-cbg-900'}}">
    {{$slot}}
</div>