<div>
    <!-- It is never too late to be what you might have been. - George Eliot -->
    @isset($AllCategories)
    <div class="container mx-auto d-flex justify-content-around">
        <form action="" method="post">
            @foreach ($AllCategories as $category)
            <button class="btn btn-outline-info " type="submit" style="border-radius: 10px;">{{$category->name}}</button>
            @endforeach
        </form>
    </div>
    @endisset
    <div class="row m-4 d-flex justify-content-between border-info-subtle" id="pCards">
        @php
        // $productsSent = isset($filteredProducts)? $filteredProducts: (isset($AllProducts)?$AllProducts : null) ;
        $productsSent ="";
        // echo (count($filteredProducts));
        if(count($filteredProducts)>0)
        $productsSent = $filteredProducts;
        else
        $productsSent=$AllProducts;



        @endphp

        @forelse ($productsSent as $product)
        <div class="col-sm-4">
            <div class="card border-secondary mb-3 text-center">
                <div class="text-info card-header bg-transparent border-secondary" style="font-size:larger">
                    <strong>{{$product->CategoryName}}</strong>
                </div>
                <img src="../{{$product->productImg}}" class="card-img-top mx-auto my-1 d-block" alt="{{$product->productName}}" style="width: 100px;height:100px;">
                <div class="card-body text-info">
                    <p class="card-title" style="font-size: 13px;font-weight: bold;">{{$product->productName}}</p>

                    <p class="card-text" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow:scroll;">{{$product->description}}</p>
                    <p>price :<span text-bg-info border-secondary>{{$product->price}}</span></p>
                    <p>Quantity Available :<span text-bg-info border-info>{{$product->quantityAvailable}}</span></p>
                </div>
                <div class="card-footer bg-transparent border-info d-flex mx-auto">

                    <form action="{{route('seller.editProduct',[$product->id])}}" method="post">
                        @csrf

                        <input type="hidden" name="N{{$product->id}}" id="ID{{$product->id}}" value="">
                        <button type="submit" class="btn btn-info text-light " style="border-radius: 10px;">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div>
            No products found!
        </div>
        @endforelse

    </div>
</div>
