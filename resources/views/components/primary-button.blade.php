<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-cbg-100 dark:bg-cbg-200 border border-cbg-200 
            rounded-md font-semibold text-xs text-paragraph-800 dark:text-cbg-800 uppercase tracking-widest hover:bg-cbg-300 dark:hover:bg-white focus:bg-cbg-100 
            dark:focus:bg-white active:bg-cbg-900 dark:active:bg-white focus:outline-none focus:ring-2 focus:ring-cbg-400 focus:ring-offset-2 
            dark:focus:ring-offset-cbg-800 transition ease-in-out duration-150 justify-center']) }}>
    {{ $slot }}
</button>
