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
                    @php try{
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
                    @php }catch(\Exception $e){}
                </tbody>

            </table>
        </div>
        <div id="categoriesDiv" class=" panel-collapse collapse in text-center">
            <div class="row mt-5">
                <div class="col  w-50">
                    <table class="table table-striped table-responsive ms-5">
                        <thead class="table-info text-center">
                            <th>ID#</th>
                            <th>category name</th>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    <form action="{{route('home.editCategory')}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-warning">modify</button>
                                    </form>
                                    <form action="{{route('home.deleteCategory')}}" method="post">
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
                </thead>
                <tbody class="text-center">
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->ProductName}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->CategoryName}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->sellerName}}</td>
                        <td>{{$product->quantityAvailable}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@elseif(Auth::guest() || Auth::user()->identity) <!--guest or customer-->
<!-- view all items to the customer to choose from them and add to the cart -->
@else <!-- seller-->
<!-- view all items added by this seller and add/delete/modify them -->

@endif
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>



@endsection