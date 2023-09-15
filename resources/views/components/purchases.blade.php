<x-app-layout>
    <div class="max-w-7xl mx-auto mt-10 bg-gray-300 text-black py-6 dark:bg-gray-700 dark:text-white">

    <!-- Display curatech device stock supplies -->
            <div class="text-center align-middle w-full">
                <form action='/purchases' method="post">
                    @csrf
                    @if (count($curatech_products) > 4)
                    <div class="grid gap-y-4 auto-cols-max grid-flow-col-dense grid-rows-2 overflow-scroll h-full">
                    @else
                    <div class="grid gap-y-4 auto-cols-max grid-flow-col-dense overflow-scroll h-full">
                    @endif
                        @foreach ( $curatech_products as $curatech_product )
                        <div class="grid gap-y-1 grid-cols-1 px-2">
                            <label class="" for="product-name">Product: {{$curatech_product->name}}</label>
                            <input class="dark:text-black rounded-xl text-center" type="number" name="{{$curatech_product->curatech_product_id}}" value="{{$curatech_product->stock_desired}}" />
                        </div>
                        @endforeach
                    </div>
                    <input class="col-span-8 dark:bg-gray-800 w-1/2 mt-4 hover:dark:bg-red-600 rounded-xl hover:cursor-pointer" type="submit" value="Update" />
                </form>
        </div>

    <!-- Display all needed components and their required stock based on curatech product stock supplies -->
        <div class="grid mt-5 gap-x-1 grid-flow-col grid-cols-6 h-max-h-400 mx-auto text-center">
            <!-- First row aka. header -->
    
                <!-- Display desired component fields to display
                    - ID
                    - Description
                    - Stock
                    - Supplier(s)
                    - Unit Price
                    - Feed
                    - Desired (based off product stock)
                    - Shortage (current stock - desired)
                    - Current stock
                    - Amount to order (possibly based off packaging style)
                    - Total order price
                    - Total current stock price (amount of components in stock * unit price)
                -->
                <div class="">
                    <p>ID</p>
                </div>
                <div class="">
                    <p>Description</p>
                </div>
                <div class="">
                    <p>Stock</p>
                </div>
                <div class="">
                    <p>Needed</p>
                </div>
                <div class="">
                    <p>Suppliers</p>
                </div>
                <div>
                    <p>Actions</p>
                </div>
            </div>

            <!-- FOREACH component
                FOREACH curatech_device add column
                    Display number of component required if device is linked to component
                Add column with component data for each column described above
            -->
            @foreach ($components as $component)
            <div class="grid mt-5 gap-x-1 grid-flow-col grid-cols-6 mx-auto text-center h-max-h-400">
                    <div class="items-end">
                        <p>{{$component->component_id}}</p>
                    </div>
                    <div class="inline overflow-hidden">
                        <p class="whitespace-nowrap overflow-hidden text-ellipsis" aria-label="{{$component->description}}">{{$component->description}}</p>
                    </div>
                    @if($component->stock < $component->required_stock())
                    <div class="dark:text-red-400">
                    @else
                    <div class="dark:text-white">
                    @endif
                        <p>{{$component->stock}}</p>
                    </div>
                    <div class="">
                        <p>{{$component->required_stock()}}</p>
                    </div>
                    <div class="">
                        <p>Suppliers</p>
                    </div>
                    <div>
                        <p><a href="/components/edit/{{$component->component_id}}">☺</a></p>
                    </div>
                </div>
                    <!-- Display desired component fields to display
                        - ID
                        - Description
                        - Stock
                        - Supplier(s)
                        - Unit Price
                        - Feed
                        - Desired (based off product stock)
                        - Shortage (current stock - desired)
                        - Current stock
                        - Amount to order (possibly based off packaging style)
                        - Total order price
                        - Total current stock price (amount of components in stock * unit price)
                    -->
            @endforeach

            <!-- Display total price of components to be ordered -->
    </div>
</x-app-layout>