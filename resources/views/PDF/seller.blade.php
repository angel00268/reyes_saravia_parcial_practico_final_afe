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
    <h2 style="text-center">Reporte de Vendedores</h2>
    <table class="table" style="width: 100%" >
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">DUI</th>
            <th scope="col">NIT</th>
            <th scope="col">Dirección</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($sellers as $item)
          <tr>
            <td>{{$item->user_id}}</td>
            <td>{{$item->dui}}</td>
            <td>{{$item->nit}}</td>
            <td>{{$item->address}}</td>
          </tr>
        @endforeach  
        </tbody>
      </table>
</body>
