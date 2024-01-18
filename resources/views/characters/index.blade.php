@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="/"><button class="btn btn-info" type="button">Regresar</button></a>
       <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Estatus</th>
                        <th>Especie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($characters as $character)
                        <tr>
                            <td>{{$character->name}}</td>
                            <td>{{$character->name}}</td>
                            <td>{{$character->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
       </div>

    </div>
@endsection
