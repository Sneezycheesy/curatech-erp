<div {{$attributes->merge(['class' => "grid static grid-cols-1 auto-rows-max p-3 dark:bg-cbg-700 dark:text-white bg-cbg-300 w-full duration-200 rounded hover:cursor-pointer hover:ring hover:ring-primary hover:dark:bg-cbg-800 hover:bg-cbg-100"]) }}>
    {{ $slot }}
</div>