@props(['counter'])
<div class="grid grid-rows-1 py-3 auto-cols-fr text-center mx-auto grid-flow-col hover:bg-cbg-500 dark:hover:bg-cbg-500 {{$counter ? 'bg-cbg-300 dark:bg-cbg-800' : 'bg-cbg-400 dark:bg-cbg-700'}}">
    {{$slot}}
</div>