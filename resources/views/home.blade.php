@extends("layouts.layout")

@section("pageTitle","Shopping")

@section("content")
@if(!Auth::guest() && Auth::user()->identity===2) <!-- Administrator -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-info "><strong><u><em>{{ __('Administration Page') }}</em></u></strong></div>
                <div class="card-body">
                    <div class="row panel-group" role="group" id="accordion">
                        <div class="col-4 text-center">
                            <button id="ShowUsersBtn" data-parent="#accordion" type="button" data-target="#usersDiv" class="btn btn-outline-info" data-toggle="collapse" aria-expanded="false" aria-controls="usersDiv">Show All Users</button>
                        </div>
                        <div class="col-4 text-center">
                            <button id="ShowcategoriesBtn" data-parent="#accordion" type="button" data-target="#categoriesDiv" class="btn btn-outline-info" data-toggle="collapse" aria-expanded="false" aria-controls="categoriesDiv">Show All Categories</button>
                        </div>
                        <div class="col-4 text-center">
                            <button id="ShowProductsBtn" data-parent="#accordion" type="button" data-target="#productsDiv" class="btn btn-outline-info" data-toggle="collapse" aria-expanded="false" aria-controls="productsDiv">Show All Products</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="usersDiv" class="panel-collapse collapse in justify-content-center">
            <table class="table table-striped table-responsive m-5">
                <thead class="table-info text-center">
                    <th>ID#</th>
                    <th>full name</th>
                    <th>username</th>
                    <th>email</th>
                    <th>identity</th>
                </thead>
                <tbody class="text-center">

                    @foreach ($users as $user)
                    <tr>
                        @if ($user->identity === 2)
                        @continue;
                        @endif
                        <td>{{$user->id}}</td>
                        <td>{{$user->Fname}}</td>
                        <td>{{$user->userName}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if($user->identity=== 0)
                            seller
                            @elseif ($user->identity ===1)
                            customer
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
        <div id="categoriesDiv" class=" panel-collapse collapse in text-center">
            <div class="row mt-5">
                <div class="col  w-50">
                    <table class="table table-striped table-responsive ms-5" id="categoriesTables">
                        <thead class="table-info text-center">
                            <th>ID#</th>
                            <th colspan="2">category name</th>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td><input type="text" class="catTxtName" id="txt{{$category->id}}" value="{{$category->name}}" readonly="true" ondblclick="this.readOnly='';"></td>
                                <td class="d-flex">
                                    <form action="{{route('home.editCategory',[$category->id])}}" method="post">
                                        @csrf

                                        <input type="hidden" name="update{{$category->id}}" id="update{{$category->id}}" value="">
                                        <button type="submit" class="btn btn-warning" onclick="document.getElementById('update{{$category->id}}').value=document.getElementById('txt{{$category->id}}').value">modify</button>
                                    </form>
                                    <form action="{{route('home.deleteCategory',[$category->id])}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="col w-25">
                    <form action="{{route('home.addCategory')}}" method="post">
                        @csrf
                        <label for="categoryName" class="form-label">add new category</label>
                        <input type="text" name="categoryName" id="categoryName" class="form-control w-50 mx-auto">
                        <button class="btn btn-success" type="submit">Add</button>
                    </form>
                </div>
            </div>
        </div>
        <div id="productsDiv" class=" panel-collapse collapse in text-center">
            <table class="table table-striped table-responsive m-5">
                <thead class="table-info text-center">
                    <th>ID#</th>
                    <th>product name</th>
                    <th>description</th>
                    <th>category</th>
                    <th>price</th>
                    <th>seller Added it</th>
                    <th>quantity Available from it</th>
                    <th>product image</th>
                    <th> controllers</th>
                </thead>
                <tbody class="text-center">
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td><input type="text" class="border-0" id="txtp{{$product->id}}" value="{{$product->productName}}" readonly="true" ondblclick="this.readOnly='';"></td>
                        <td style="font-size: smaller;"><textarea class="border-0" id="pDesc{{$product->id}}" value="{{$product->description}}" readonly="true" ondblclick="this.readOnly='';">{{$product->description}}</textarea></td>
                        <td><input type="text" class="border-0" id="p{{$product->id}}" value="{{$product->CategoryName}}" readonly="true" ondblclick="this.readOnly='';getCategories('p{{$product->id}}','{{$product->CategoryName}}');"></td>
                        <td><input type="number" class="border-0" value="{{$product->price}}" id="price{{$product->id}}" readonly="true" ondblclick="this.readOnly='';"></td>
                        <td>{{$product->sellerName}}</td>
                        <td><input type="number" class="border-0" id="qA{{ $product->id }}" value="{{$product->quantityAvailable}}" ondblclick="this.readOnly='';"></td>
                        <td><img src="{{ asset($product->productImage) }}" alt="{{ $product->productName }}" class="img-thumbnail rounded-1" style="width: 60px;height:60px"></td>
                        <td class="d-flex">
                            <form action="{{route('seller.editProduct',[$product->id])}}" method="post">
                                @csrf

                                <input type="hidden" name="updatep{{$product->id}}" id="updatep{{$product->id}}" value="">
                                <button type="submit" class="btn btn-warning" onclick="document.getElementById('updatep{{$product->id}}').value=getallValues('{{$product->id}}');">modify</button>
                            </form>
                            <form action="{{route('seller.deleteProduct',[$product->id])}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <script>
                        function getCategories(id, name) {
                            var CatNameCollection = document.getElementsByClassName('catTxtName');
                            var select = document.createElement('select');
                            for (var i = 0; i < CatNameCollection.length; i++) {
                                var opt = CatNameCollection[i].value;
                                var el = document.createElement("option");
                                el.textContent = opt;
                                //  var abc = (opt.id).substr(opt.id, 3);

                                if (opt == name) {
                                    el.setAttribute('selected', true);
                                    // console.log(el);
                                }

                                el.value = opt;
                                select.appendChild(el);
                            }
                            select.setAttribute('id', 'pCat' + id);
                            document.getElementById(id).outerHTML = select.outerHTML;

                        }

                        function getallValues(id) {
                            var DataToSend = "";
                            var name = document.getElementById('txtp' + id).value;

                            var desc = document.getElementById('pDesc' + id).value;
                            var categories = "";
                            var catName = "";
                            try {
                                catogories = document.getElementById('pCatp' + id);
                                catName = catogories.options[catogories.options.selectedIndex].value;
                            } catch {
                                catogories = document.getElementById('p' + id);
                                catName = catogories.value;

                            }
                            console.log(catName);
                            var price = document.getElementById('price' + id).value;
                            var QA = document.getElementById('qA' + id).value;

                            DataToSend = name + ";" + desc + ";" + catName + ";" + price + ";" + QA;

                            console.log(DataToSend);
                            return DataToSend;
                        }
                    </script>
                </tbody>

            </table>
        </div>
    </div>
</div>
@elseif(Auth::guest() || Auth::user()->identity) <!--guest or customer-->
<!-- view all items to the customer to choose from them and add to the cart -->

@else
<!-- seller-->
<!-- view all items added by this seller and add/delete/modify them -->
@include ('UserForms.seller')
@endif
@endsection
