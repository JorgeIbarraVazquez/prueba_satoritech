@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form class="d-flex" id="getCharactersForm">
                    <select class="buscador" id="buscador_localidades" style="width: 100%; ">
                    </select>
                    <button class="btn btn-dark" type="submit">Buscar</button>
                </form>

                
            </div>
            <div class="col-md-12 mt-4">
                <a href="characters"><button class="btn btn-info" type="button">Mostrar personajes guardados</button></a>
                    <div id="content" class="row"></div>
            </div>
        </div>

    </div>
    <!--Modal-->
    <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="titleCharacter"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                  
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                
                </div>
            </div>
        </div>
    </div>
    <!--Cierra Modal-->
@endsection
