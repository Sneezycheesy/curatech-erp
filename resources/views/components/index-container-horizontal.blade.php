<div class="relative">
    <div id="index-container-horizontal" class="grid overflow-x-scroll grid-rows-2 grid-flow-col auto-cols-max gap-2 w-full p-2 mx-auto scrollbar-hide">
        {{$slot}}
    </div>
    <i id="container-horizontal-loading-indicator" class="htmx-indicator absolute top-1/2 right-0 -translate-y-1/2 h-max text-5xl text-center text-black dark:text-white">
        <i class="fas fa-spinner fa-spin"></i>
    </i>
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