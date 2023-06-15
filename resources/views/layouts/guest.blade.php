<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
@section('js')
<script>
    window.addEventListener('DOMContentLoaded', function() {
        setInterval(verificarStock, 5000); // Verificar cada 30 segundos (ajusta el intervalo según tus necesidades)
    });

    function verificarStock() {
        fetch('{{ route('verificar.stock') }}')
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    mostrarAlerta(data);
                }
            })
            .catch(error => console.error(error));
    }

    function mostrarAlerta(insumos) {
        const alertaDiv = document.createElement('div');
        alertaDiv.classList.add('alert', 'alert-danger', 'fixed-top', 'text-center');
        alertaDiv.textContent = 'Advertencia, los siguientes insumos se están agotando:';
        
        const listaInsumos = document.createElement('ul');
        insumos.forEach(insumo => {
            const listItem = document.createElement('li');
            listItem.textContent = insumo.Nombre_Insumo;
            listaInsumos.appendChild(listItem);
        });
        
        alertaDiv.appendChild(listaInsumos);
        
        document.body.appendChild(alertaDiv);
    }

</script>
@endsection

