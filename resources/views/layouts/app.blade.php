<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        img:hover {
            opacity: .6;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="app">


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="{{ asset('js/api.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $(".buscador").select2();
        getLocations(); // funcion que permite obtner las localidades de la api


    });

    $('#getCharactersForm').on('submit', function() {
        let data_location = $('#buscador_localidades').val().split(',');
        let characters = getCharacters(data_location[1]);

        if (data_location[0] < 50) {
            $('#app').css('background-color', '#20c997');
        } else if (data_location[0] >= 50 && data_location[0] < 80) {
            $('#app').css('background-color', '#0dcaf0');
        } else {
            $('#app').css('background-color', '#dc3545');
        }
        let div_characters = '';
        let for_end = characters.length;

        if (characters.length > 5) {
            for_end = 5;
        }

        let episodes = '';
        let arr_episodes = [];
        for (let i = 0; i < for_end; i++) {

            $.ajax({
                url: 'characters',
                method: 'POST',
                data: "name=" + characters[i].name + "&status=" + characters[i].status + "&species=" +
                    characters[i].species,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',

                success: function(response) {},
                error: function(response) {}
            });
            episodes = '';

            arr_episodes[i] = Array.from(characters[i].episode);
            if (arr_episodes[i].length >= 3) {
                arr_episodes[i].length = 3;
            }
            for (let a = 0; a < arr_episodes[i].length; a++) {

                episodes += `<p > ${a+1}.- <a href="${arr_episodes[i][a]}">${arr_episodes[i][a]}</a></p>`;

            }


            div_characters += `
            <div class="card col-md-3 mt-3 mr-3" >
                <img src="${characters[i].image}" class="card-img-top imageClick" alt="${characters[i].name}" id="${characters[i].name},${characters[i].status},${characters[i].species}">
                <div class="card-body">
                    <h5 class="card-title">${characters[i].name}</h5>
                    <span class="badge bg-info">Status: ${characters[i].status}</span>
                    <span class="badge bg-success">Especie: ${characters[i].species}</span>
                    <p>Origin name: ${characters[i].origin_name}</p>
                    <h5>Episodios</h5>
                    ${episodes} 
                </div>
            </div>`;
        }


        $("#content").html(div_characters);
        return false;

    });

    $(document).on("click", ".imageClick", function() {
        $('#modalInfo').modal('show');
        let data = $(this).attr('id').split(',');
        $('#titleCharacter').html(data[0]);
        
        let info = `
                    <span class="badge bg-info">Status: ${data[1]}</span>
                    <span class="badge bg-success">Especie: ${data[2]}</span>
                   
                    
                `;
        $('.modal-body').html(info);
    });
</script>

</html>
