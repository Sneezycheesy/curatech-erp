<div {{$attributes->merge(['class' => "grid grid-cols-1 auto-rows-max p-3 dark:bg-cbg-700 dark:text-white bg-cbg-300 w-full duration-200 rounded hover:cursor-pointer outline outline-0 outline-primary hover:outline-2 hover:outline-offset-2 hover:outline-primary hover:dark:bg-cbg-800 hover:bg-cbg-100"]) }}>
    {{ $slot }}
</div>