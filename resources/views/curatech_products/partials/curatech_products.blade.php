<div id="curatech_products_container">
@foreach ( $curatech_products as $curatech_product )
    <a href="/curatech_product/{{$curatech_product->curatech_product_id}}">
        <div class="mt-6 bg-cbg-200 dark:bg-cbg-700 dark:text-paragraph-dark text-paragraph-light sm:rounded-lg px-6 max-w-6xl mx-auto py-4 hover:bg-cbg-800 hover:dark:bg-cbg-800 hover:text-white">
            <p class="text-lg"> {{ $curatech_product->name }}</p>
            <p>{{$curatech_product->description}}</p>
        </div>
    </a>
@endforeach
</div>