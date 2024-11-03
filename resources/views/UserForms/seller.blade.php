<div>
    <div id="productsDiv" class="text-center">
        <table class="table table-striped table-responsive m-5" id="allProducts">
            <thead class="table-info text-center">
                <th>ID#</th>
                <th>product name</th>
                <th>description</th>
                <th>category</th>
                <th>price</th>
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
                    <td>{{$product->quantityAvailable}}</td>
                    <td class="d-flex">
                        <form action="{{route('seller.editProduct',[$product->id])}}" method="post">
                            @csrf

                            <input type="hidden" name="update{{$product->id}}" id="update{{$product->id}}" value="">
                            <button type="submit" class="btn btn-warning" onclick="document.getElementById('update{{$product->id}}').value=document.getElementById('txt{{$product->id}}').value">modify</button>
                        </form>
                        <form action="{{route('seller.deleteProduct',[$product->id])}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>