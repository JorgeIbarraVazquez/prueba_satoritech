function getLocations(){
    let options = '<option value="">Selecciona una localidad</option>';
    $.ajax({
        type: "GET",
        url: "https://rickandmortyapi.com/api/location",
        success: function(response) {
            //el primer ajax lo utilizare para buscar la cantidad de paginas que son 
            let pages = response.info.pages;

            for (let i = 1; i <= pages; i++) {
                $.ajax({
                    type: "GET",
                    url: "https://rickandmortyapi.com/api/location?page=" + i + "",
                    success: function(info) {
                         
                        for (let data in info.results) {
                            options += '<option value="' + info.results[data]
                                .id +
                                ',' + info.results[data]
                                .name +
                                '">' + info.results[data].name + '</option>';
                                
                        }
                        $('#buscador_localidades').append(options);
                    }
                });
            }
        }
    });
    
}
var character=[];
function getCharacters(location){
    let character=[];
    $.ajax({
        type: "GET",
        async: false,
        url: "https://rickandmortyapi.com/api/character",
        success: function(response) {
            //el primer ajax lo utilizare para buscar la cantidad de paginas que son 
            let pages = response.info.pages;

            for (let i = 1; i <= pages; i++) {
                $.ajax({
                    type: "GET",
                    async: false,
                    url: "https://rickandmortyapi.com/api/character?page=" + i + "",
                    success: function(info) {
                        for (let data in info.results) {
                            
                                if (info.results[data].location.name ==
                                    location ) {
                                        character.push({
                                            "name":info.results[data].name,
                                            "status":info.results[data].status,
                                            "species":info.results[data].species,
                                            "origin_name":info.results[data].origin.name,
                                            "image":info.results[data].image,
                                            "episode":info.results[data].episode,
                                        });
 
                                }

                        }
                        
                    }
                });
            }
            
        }
    });
    return character;
}
