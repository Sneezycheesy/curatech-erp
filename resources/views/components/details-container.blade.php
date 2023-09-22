<div {{$attributes->merge(['class' => "grid grid-cols-1 auto-rows-max p-3 dark:bg-gray-700 dark:text-white bg-gray-300 w-full rounded hover:cursor-pointer hover:dark:bg-gray-800 hover:bg-gray-400"]) }}>
    {{ $slot }}
</div>