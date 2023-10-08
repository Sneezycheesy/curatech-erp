<div id="index-container-horizontal" class="grid overflow-x-scroll grid-rows-2 grid-flow-col auto-cols-max gap-2 w-full p-2 mx-auto scrollbar-hide">
    {{$slot}}
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