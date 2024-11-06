<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-info ">
                    <h2><strong><u><em>{{ __('Seller Page') }}</em></u></strong></h2>
                </div>
                <div class="card-body">
                    <div class="row panel-group" role="group" id="SellerBtns">
                        <div class="col-6 text-center">
                            <button id="AddNewProductBtn" data-parent="#SellerBtns" type="button" data-target="#NewProductDiv" class="btn btn-outline-info" data-toggle="collapse" aria-expanded="false" aria-controls="NewProductDiv">Add New Product</button>
                        </div>
                        <div class="col-6 text-center">
                            <button id="ShowProductsBtn" type="button" data-parent="#SellerBtns" data-target="#SellerProductsDiv" class="btn btn-outline-info" data-toggle="collapse" aria-expanded="false" aria-controls="SellerProductsDiv">Show My Products</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="SellerProductsDiv" class=" panel-collapse collapse in text-center">
        <div class="row m-4 d-flex justify-content-between" id="productCards">
            @isset($sellerProducts)
            @foreach ($sellerProducts as $product)
            <div class="col-sm-4">
                <div class="card border-secondary mb-3 text-center">
                    <div class="text-info card-header bg-transparent border-secondary">
                        {{$product->CategoryName}}
                    </div>
                    <img src="../{{$product->productImg}}" class="card-img-top mx-auto my-1 d-block" alt="{{$product->productName}}" style="width: 100px;height:100px;">
                    <div class="card-body text-info">
                        <p class="card-title" style="font-size: 13px;"><input type="text" class="text-info border-0" id="crdp{{$product->id}}" value="{{$product->productName}}" readonly="true" ondblclick="this.readOnly='';"></p>

                        <p class="card-text"><textarea class="text-info border-0" id="crdDesc{{$product->id}}" readonly="true" style="width:100%" ondblclick="this.readOnly='';">{{$product->description}}</textarea></p>
                        <p>price :<span text-bg-info border-secondary><input type="number" class="border-0 text-center" value="{{$product->price}}" id="crdPrc{{$product->id}}" readonly="true" ondblclick="this.readOnly='';"></span></p>
                        <p>Quantity Available :<span text-bg-info border-info><input type="number" class="border-0 text-center" id="crdqA{{ $product->id }}" value="{{$product->quantityAvailable}}" ondblclick="this.readOnly='';"></span></p>
                    </div>
                    <div class="card-footer bg-transparent border-info d-flex mx-auto">

                        <form action="{{route('seller.editProduct',[$product->id])}}" method="post">
                            @csrf

                            <input type="hidden" name="crdUpdateProduct{{$product->id}}" id="crdUpdateProduct{{$product->id}}" value="">
                            <button type="submit" class="btn btn-warning" onclick="document.getElementById('crdUpdateProduct{{$product->id}}').value=getallCrdValues('{{$product->id}}');">modify</button>
                        </form>
                        <form action=" {{route('seller.deleteProduct',[$product->id])}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">delete</button>
                        </form>

                    </div>
                </div>
            </div>
            @endforeach
            @endisset
        </div>
        <script>
            function getallCrdValues(id) {
                var DataToSend = "";
                var name = document.getElementById('crdp' + id).value;

                var desc = document.getElementById('crdDesc' + id).value;

                var price = document.getElementById('crdPrc' + id).value;

                var QA = document.getElementById('crdqA' + id).value;


                DataToSend = name + ";" + desc + ";" + price + ";" + QA;
                //  alert(DataToSend);
                console.log(DataToSend);
                return DataToSend;
            }
        </script>
    </div>

    <div id="NewProductDiv" class=" panel-collapse collapse in text-center">
        <form action="{{route('seller.addProduct')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h4 class="text-info mt-4"><u>Add new Product</u></h4>
            <div class="row">
                <div class="col-2">
                    <label>Product Name:</label>
                </div>
                <div class="col-8"> <input class="form-control my-2" name="pName" type="text"></div>
            </div>
            <div class="row">
                <div class="col-2">
                    <label>Product Description:</label>
                </div>
                <div class="col-8"> <textarea name="pDesc" class="form-control my-2" rows="2" placeholder="please write product description"> </textarea>
                </div>
                <div class="row justify-content-around mt-2">
                    <div class="col-2">
                        <label>Category :</label>
                    </div>
                    <div class="col-4">
                        <script>
                            // select dropdown-item from menu
                            $(document).ready(function() {
                                $('.dropdown-menu li').on('click', '.dropdown-item', function() {
                                    var selected = $(this).html();
                                    $("#CategoriesBtn").html(selected);
                                    $("#selectedCategory").html(selected);
                                    $("#selectedCategory").val(selected);
                                    //   alert($("#selectedCategory").val());
                                });
                            })
                        </script>
                        <div class="dropdown text-info">
                            <button class="btn btn-outline-info dropdown-toggle" type="button" id="CategoriesBtn" data-bs-toggle="dropdown" aria-expanded="false">
                                -- Categories --
                            </button>
                            <ul class="dropdown-menu" role="menu" border-info-subtle" id="categoryItems" aria-labelledby="CategoriesBtn">
                                @foreach ($categories as $category)
                                <li id="category{{$category->id}}" value="category{{$category->id}}" class="dropdown-item" role="menuitem"><button class="dropdown-item" type="button">{{$category->name}}</button></li>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-2">
                        <label>product Image :</label>
                    </div>
                    <div class="col-4">
                        <input type="file" id="pImage" name="pImage" accept='image/jpeg , image/jpg, image/gif, image/png'>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-4 mx-auto">
                        <label>Price:</label> <input class="form-control my-2" name="pPrice" type="number">
                    </div>
                    <div class="col-2"><input type="hidden" name="selectedCategory" id="selectedCategory" value=""></div>
                    <div class="col-4 mx-auto">
                        <label>Quantity Available:</label> <input class="form-control my-2" name="pQuantity" type="number">
                    </div>
                    <div class="justify-content-center mx-auto mt-2">
                        <button class="btn btn-success col-2" type="submit" onclick="replaceHiddenData();">Add Product</button>
                    </div>
                    <script>
                        function replaceHiddenData() {
                            var hidden = document.getElementById('selectedCategory');
                            var selectedCategory = document.getElementById('CategoriesBtn');
                            hidden.value = selectedCategory.innerText;
                            //  alert(hidden.value);
                        }
                    </script>
        </form>


    </div>

</div>
