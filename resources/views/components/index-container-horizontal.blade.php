<div id="index-container-horizontal" class="relative grid overflow-x-scroll grid-rows-2 grid-flow-col auto-cols-max gap-2 w-full p-2 mx-auto scrollbar-hide">
    {{$slot}}
    <i id="container-horizontal-loading-indicator" class="fixed right-0 top-1/3 translate-y-1/4 htmx-indicator row-span-2 fas fa-spinner fa-spin text-5xl text-center text-black dark:text-white col-span-full"></i>
</div>

<script lang="text/javascript">
    let element = document.getElementById('index-container-horizontal');
        element.addEventListener('wheel', (event) => {
            event.preventDefault();
            element.scrollBy({
                left: event.deltaY < 0 ? -30 : 30,
            });
        });
</script>