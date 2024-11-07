

    <!-- Sliding cart-->
    <div id="slider" class="cart">
        <i class="fa-regular fa-circle-left"> show cart</i>
        <i class="fa-solid fa-cart-shopping"></i>
        <div class="slider"style="height: 500px; overflow-y: auto;">Your cart !
            <hr>
            <div class="container d-grid">

                @isset($cart)

                @foreach ($cart as $cartItem)

                <div class="card rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-3">
                                <img
                                    src="../{{$cartItem->prdtImg}}" class="img-fluid rounded-3" alt="Cotton T-shirt">
                            </div>
                            <div class="col-3">
                                <p class="lead fw-normal mb-2" style="font-size: smaller">{{ $cartItem->prdtName }}</p>

                            </div>
                            <div class="d-flex col-3" >
                                <form action="{{ route('previewCart',[$cartItem->productID]) }}">
                                    @csrf
                                <input min="1" name="quantity{{$cartItem->productID}}" value="{{$cartItem->CountOfProductID}}" type="number"
                                    class="form-control" />
                                    <button class="btn btn-info p-0" type="submit" style="width:40px;height: 20px;font-size:20%">update</button>
                                </form>
                            </div>
                            <div class="col-2">
                                <h5 class="mb-0" style="font-size: small">{{$cartItem->price}}</h5>
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                <form action="{{route('deleteCartItem',[$cartItem->productID])}}" method="post">
                                    @csrf
                                    <button type="submit" class="text-danger border-0 bg-transparent"><i class="fas fa-trash fa-lg"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                @endforeach
                @endisset


            </div>
        </div>

    </div>






