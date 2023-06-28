@extends('adminlte::page')

@section('title', 'Detalles del producto')

@section('content_header')
@stop

@section('content')

     <center><h3 class="page-title"> {{$productos->NombreProducto}}</h3></center>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                   <center> <img  src="/imagen/{{$productos->imagen}}" alt="producto" class="avatar" ></center>
                    <br><br>
                    <h4 class="card-title">Detalles del producto</h4>
                    <div class="table-responsive col-md-12">
                        <div class="table-responsive scrollable-table">
                        <table class="table" id="detalleProducto">
                            <thead>
                                <tr>
                                    <th>Numero de producto</th>
                                    <th>Insumos</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalleProducto as $detalle)
                                    <tr>
                                        <td>{{$detalle->id_insumos}}</td>
                                        {{-- llamar el nombre del producto  --}}
                                        <td>
                                            @foreach ($insumos as $insu)
                                                @if($insu->id == $detalle->id_insumos)
                                                    {{$insu->Nombre_Insumo}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$detalle->Cantidad}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@section('js')
<script>
    // Obtén una referencia al botón o enlace que activa el modal
const btnModal = document.getElementById('btnModal');

// Obtén una referencia al modal
const modal = document.getElementById('miModal');

// Agrega un evento de click al botón o enlace para mostrar el modal
btnModal.addEventListener('click', () => {
    modal.style.display = 'block';
});

// Agrega un evento de click al modal para ocultarlo cuando se hace clic fuera del contenido
modal.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

</script>
@endsection
@section('css')
<style>
    .scrollable-table{
        max-height: 200px;
        overflow-y: auto;
    }
.modal {
    display: none; /* Ocultar inicialmente el modal */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro semi-transparente */
}
.avatar {
    border-radius: 3%;
    width: 450px;
    height: 250px;
    
}
</style>
@endsection
@endsection