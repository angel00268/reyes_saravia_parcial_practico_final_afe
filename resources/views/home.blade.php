@extends('layouts.app')

@section('content')
    <div class="mt-3 px-5">
        <div class="p-5 shadow bg-white">
            <h3 class="text-center ">Bienvenido {{auth()->user()->name}}</h3>
            <div class="col-md-10 mx-auto p-3">

            </div>
        </div>
    </div>
@endsection
