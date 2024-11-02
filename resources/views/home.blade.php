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
                    <div class="row" role="group">
                        <div class="col-4 text-center">
                            <button id="ShowUsersBtn" type="button" data-target="#usersDiv" class="btn btn-outline-info" data-toggle="collapse" aria-pressed="false" autocomplete="off">Show All Users</button>
                        </div>
                        <div class="col-4 text-center">
                            <button id="ShowcategoriesBtn" type="button" data-target="#categoriesDiv" class="btn btn-outline-info" data-toggle="collapse" aria-pressed="false" autocomplete="off">Show All Categories</button>
                        </div>
                        <div class="col-4 text-center">
                            <button id="ShowProductsBtn" type="button" data-target="#productsDiv" class="btn btn-outline-info" data-toggle="collapse" aria-pressed="false" autocomplete="off">Show All Products</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="usersDiv" class="justify-content-center"> <!-- style="display:none"> -->
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
                <tfoot>
                    <button type="button" class="btn btn-success">Add user</button>
                </tfoot>
            </table>
        </div>
        <div id="categoriesDiv" class="container text-center " style="margin-left:33%;">
            <table class="table table-striped table-responsive m-5" style="width:33%">
                <thead class="table-info text-center">
                    <th>ID#</th>
                    <th>category name</th>
                </thead>
                <tbody class="text-center">
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <button type="button" class="btn btn-success">Add category</button>
                </tfoot>
            </table>
        </div>

        <div id="productsDiv" class="container text-center "><!-- style="display:none">-->
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
                <tfoot>
                    <button type="button" class="btn btn-success">Add product</button>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@elseif(Auth::guest() || Auth::user()->identity) <!--guest or customer-->
<!-- view all items to the customer to choose from them and add to the cart -->
@else <!-- seller-->
<!-- view all items added by this seller and add/delete/modify them -->

@endif
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
