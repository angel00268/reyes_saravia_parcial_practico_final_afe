@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        {{-- <a href="{{ url('/productsReportsVendedor') }}" class="col-lg-4" style="text-decoration: none">
            <div>
                <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3 bg-primary p-5 rounded text-white">
                    <div class="features-icons-icon d-flex"><i class="bi-window m-auto text-primary"></i></div>
                    <h3>Reporte de Productos</h3>
                </div>
            </div>
        </a> --}}
        <a href="{{ url('/sellerReports') }}" class="col-lg-4" style="text-decoration: none">
            <div>
                <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3 bg-info p-5 rounded text-white">
                    <div class="features-icons-icon d-flex"><i class="bi-window m-auto text-primary"></i></div>
                    <h3>Reporte de Vendedores</h3>
                </div>
            </div>
        </a>
        <a href="{{ url('/productsReportsAuditor') }}" class="col-lg-4" style="text-decoration: none">
            <div >
                <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3 bg-success p-5 rounded text-white">
                    <div class="features-icons-icon d-flex"><i class="bi-window m-auto text-primary"></i></div>
                    <h3>Reporte de Productos</h3>
                </div>
            </div>
        </a>
        <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3 bg-secondary p-5 rounded text-white">
                <div class="features-icons-icon d-flex"><i class="bi-window m-auto text-primary"></i></div>
                <h3>Reporte Parametrizado</h3>
                <form action="">
                    <select name="seller_id" class="form-select" aria-label="Default select example">
                        <option selected>Seleccionar Vendedor</option>
                        @foreach ($products as $item)
                            <option value="{{$item->seller_id}}">{{$item->seller->user->name}}</option>
                        @endforeach
                      </select>
                      <a type="button" class="btn btn-dark mt-2">Generar Reporte</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
