<style>
    table {
        border-spacing: 0;
    }

    td,
    tr {
        text-align: center;
        border: 1px solid black;
    }

</style>

<body>
    <h2 style="text-center">Mis Productos</h2>
    <table class="table" style="width: 100%" >
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Producto</th>
            <th scope="col">Precio Unitario</th>
            <th scope="col">Stock</th>
            <th scope="col">Garantia</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($products as $item)
          <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->product_name}}</td>
            <td>{{$item->unit_price}}</td>
            <td>{{$item->stock}}</td>
            <td>{{$item->warranty}}</td>
          </tr>
        @endforeach  
        </tbody>
      </table>
</body>
