<div {{$attributes->merge(['class' => "grid grid-cols-1 auto-rows-max p-3 dark:bg-cbg-700 dark:text-white bg-cbg-300 w-full rounded hover:cursor-pointer hover:dark:bg-cbg-800 hover:bg-cbg-400"]) }}>
    {{ $slot }}
</div>