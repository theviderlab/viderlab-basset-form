// Here we can configure the same parameters of "Panel de Basset"
var widgetSettings = (function() {

    var portalConfig = {
        "UrlDomain": "https://vuelosyhoteles.agileturismo.tur.ar/accommodations", // Url del dominio del buscador
        "anticipation": 7, // Días de anticipación
        "enabledDays": 300, 
        "maximumDays": 0,
        "maxPersona": 8 // Máximo de persona por habitación
    };

    var widgetProductsSettings = {
        "bassetApiKey": "osmivqNERq3pZqcB8iCvQ3qUHnh5SvVh1TzyeBPv", // Basset api key
        "bassetClientId": "86e24913-659f-47e9-9313-dd5884aed53d", // Basset client ID
    }


    return {
        portalConfig: portalConfig,
        widgetProductsSettings: widgetProductsSettings
    }
})()

const urlBasset = widgetSettings.portalConfig.UrlDomain;
var maxPersona = widgetSettings.portalConfig.maxPersona;

(function($) {
	'use strict';

    $(document).ready(function() {

        // Input autocomplete de Destino
        $("#hoteles_destino").on("input", function(event) {
            event.preventDefault();
            if ($(this).val() != '') {
                entities($(this).val(), $(this));
            }
        });

        // Habitaciones
        var hoteles_habitaciones = $("#hoteles_habitaciones");
        hoteles_habitaciones.on("change", function(event) {
            console.log('hoteles_habitaciones.change'); // DEBUG
            for (var i = 2; i <= 4; i++) {
                if (i <= hoteles_habitaciones.val()) {
                    $("#habitacion-"+i).show();
                    $("#habitacion-"+i+" .search-close").show();
                    $("#habitacion-"+(i-1)+" .search-close").hide();
                } else{
                    $("#habitacion-"+i).hide();
                }
            }       
        });

        // Habitaciones close
        var habitacion_close = $(".search-close");
        habitacion_close.on('click', function(event) {
            let room_id = $(this).parent().parent().attr('id');
            $('#' + room_id).hide();
            hoteles_habitaciones.val(hoteles_habitaciones.val()-1);
            $("#habitacion-"+hoteles_habitaciones.val()+" .search-close").show();

        });

        // Validar adultos y menores = 8

        // habitacion 1
        getCantidadMenores("hoteles_adultos-1" , "hoteles_menores-1")

        $("#hoteles_adultos-1").on("change", function(event) {
            getCantidadMenores("hoteles_adultos-1" , "hoteles_menores-1")
            $("#menores_contenedor-1").hide();
        });

        // habitacion 2
        getCantidadMenores("hoteles_adultos-2" , "hoteles_menores-2")
        $("#hoteles_adultos-2").on("change", function(event) {
            getCantidadMenores("hoteles_adultos-2" , "hoteles_menores-2")
            $("#menores_contenedor-2").hide();
        });

        // habitacion 3
        getCantidadMenores("hoteles_adultos-3" , "hoteles_menores-3")
        $("#hoteles_adultos-3").on("change", function(event) {
            getCantidadMenores("hoteles_adultos-3" , "hoteles_menores-3")
            $("#menores_contenedor-3").hide();
        });

        // habitacion 4
        getCantidadMenores("hoteles_adultos-4" , "hoteles_menores-4")
        $("#hoteles_adultos-4").on("change", function(event) {
            getCantidadMenores("hoteles_adultos-4" , "hoteles_menores-4")
            $("#menores_contenedor-4").hide();
        });


        // Fechas desde y hasta
        var hoteles_desde = $("#hoteles_desde");
        var hoteles_hasta = $("#hoteles_hasta");

        hoteles_desde.attr("min", getFecha(sumarDias(new Date(), widgetSettings.portalConfig.anticipation)));
        hoteles_desde.attr("max", getFecha(sumarDias(new Date(), widgetSettings.portalConfig.enabledDays)));

        hoteles_hasta.attr("min", getFecha(sumarDias(new Date(), widgetSettings.portalConfig.anticipation)));
        hoteles_hasta.attr("max", getFecha(sumarDias(new Date(), widgetSettings.portalConfig.enabledDays)));

        hoteles_desde.on("change", function(event) {
            if (hoteles_desde.val()) {
                hoteles_desde.css('color', 'black');
            }
            hoteles_hasta.val(hoteles_desde.val());
            hoteles_hasta.attr("min", hoteles_desde.val())
            hoteles_hasta.attr("max", getFecha(sumarDias(new Date( hoteles_desde.val()), widgetSettings.portalConfig.enabledDays)));
        });

        hoteles_hasta.on("change", function(event) {
            if (hoteles_hasta.val()) {
                hoteles_hasta.css('color', 'black');
            }
        });


        // Seleccion de menores y edades
        for(var j=1; j <=4; j++) {
            $("#hoteles_menores-"+j).data('id_num',j);
            $("#hoteles_menores-"+j).on("change", function(event) {
                event.preventDefault();
                
                var id_num = $(this).data('id_num');
                if ($(this).val() != '' && $(this).val() > 0) {
                    $("#menores_contenedor-"+id_num).show();
    
                    var cantidad_menores = $(this).val();
                    var select = '';
                    for (var i = 1; i <= cantidad_menores; i++) {
                        select += '<div class="search-input-group search-w" id="menor-'+i+'">'
                        select += '<label>Menor '+i+'</label>'
                        select += '<select name="" class="search-input img-child" id="menor-edad-'+id_num+'-'+i+'" autocomplete="off">'
                        select += '<option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option></select></div>'
                    }
                    $("#menores_datos-"+id_num).html(select);
                } else {
                    $("#menores_contenedor-"+id_num).hide();
                }
            });            
        }


        // Envio de datos
        
        $("#FormHoteles").on("submit", function(event){
            event.preventDefault();
            let hasError = false;
            let buscadorUrl = urlBasset + "/accommodations/results?";
            var hoteles_destino = $("#hoteles_destino");
            var hoteles_habitaciones = $("#hoteles_habitaciones");
            var hoteles_desde = $("#hoteles_desde");
            var hoteles_hasta = $("#hoteles_hasta");
            // var hoteles_adultos = $("#hoteles_adultos-1");
            // var hoteles_menores = $("#hoteles_menores-1");
            console.log('hoteles_destino',hoteles_destino.val()) // DEBUG
            console.log('hoteles_habitaciones',hoteles_habitaciones.val()) // DEBUG
            console.log('hoteles_desde',hoteles_desde.val()) // DEBUG
            console.log('hoteles_hasta',hoteles_hasta.val()) // DEBUG

            if (!hoteles_destino.attr('data-id')) {
                hoteles_destino.classClass('validar');
                hasError = true;
            }
            if (!hoteles_desde.val()) {
                hoteles_desde.classClass('validar');
                hasError = true;
            }
            if (!hoteles_hasta.val()) {
                hoteles_hasta.classClass('validar');
                hasError = true;
            }
            var hoteles_distribucion = '';
            if (hoteles_habitaciones.val() >= 1) {
                for (var i = 1; i <= hoteles_habitaciones.val(); i++) {
                    hoteles_adultos
                    var hoteles_adultos = $("#hoteles_adultos-"+i)
                    console.log('hoteles_adultos-'+i,hoteles_adultos.val()) // DEBUG
                    hoteles_distribucion += hoteles_adultos.val()
                    var hoteles_menores = $("#hoteles_menores-"+i)
                    console.log('hoteles_menores-'+i,hoteles_menores.val()) // DEBUG


                    if (hoteles_menores.val() > 0) {
                        for (var j = 1; j <= hoteles_menores.val(); j++) {
                            hoteles_distribucion += '-'+$("#menor-edad-"+i+"-"+j).val();   
                        }
                    }
                    if (hoteles_habitaciones.val() > 1 &&  i < hoteles_habitaciones.val()) {
                        hoteles_distribucion += ','
                    }
                }
            }
    
            var url = buscadorUrl + "region_id="+hoteles_destino.attr('data-id')+"&region_type="+hoteles_destino.attr('data-type')+"&checkin="+setDateForBasset(hoteles_desde.val())+"&checkout="+setDateForBasset(hoteles_hasta.val())+"&distribution="+hoteles_distribucion;
            console.log(url); // DEBUG

            // si hay algún error no efectuamos la acción submit del form
            if(hasError) {
                return false;
            }
            // console.log('url',url)
            window.location.href = url;
        });
	});    

    function setDateForBasset(date){
        return date.split("/").reverse().join("-").replace(/ /g, "")
    }
    
    function entities(city, inputElement) {
        var myHeaders = new Headers();
        myHeaders.append("x-api-key", widgetSettings.widgetProductsSettings.bassetApiKey);
        myHeaders.append("x-client-id", widgetSettings.widgetProductsSettings.bassetClientId);
    
        var requestOptions = {
            method: 'GET',
            headers: myHeaders,
            timeout: 0
        };
    
        fetch("https://api.basset.ws/autocomplete/?channel=WEB&entities=ACC_MULTI_CITY_VICINITY,ACC_CITY&language=es&site=AR&q="+city, requestOptions)
        .then(response => response.text())
        .then(result => {
            autocomplete(inputElement, JSON.parse(result));
        })
        .catch(error => console.log('error', error));
    
    }

    function autocomplete(inp, arr) {

        var currentFocus;
        var a, b, i, val = inp.val();
    
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
    
        a = $("<div></div>")
            .attr("id", inp.attr('id') + "autocomplete-list")
            .addClass("autocomplete-items");
    
        inp.parent().append(a);
    
        for (i = 0; i < arr.length; i++) {
            if (eliminarDiacriticos(arr[i].name.substr(0, val.length).toUpperCase()) == val.toUpperCase()) {
    
                b = $("<div></div>");

                b.html("<strong>" + arr[i].name.substr(0, val.length) + "</strong>" + arr[i].name.substr(val.length))
                   .append($("<input type='hidden'>").val(arr[i].name).attr("data-id", arr[i].id).attr("data-type", arr[i].type))
                   .on("click", function() {
                       var input = $(this).find("input:first");
                       inp.val(input.val())
                             .attr('data-id', input.data('id'))
                             .attr('data-type', input.data('type'));
                       closeAllLists();
                   });
                
                a.append(b);
                
            }
        }
    
        /*execute a function presses a key on the keyboard:*/
        inp.on("keydown", function(e) {
            var $x = $('#' + this.id + "autocomplete-list").children("div");
            if (e.keyCode == 40) {
                currentFocus++;
                addActive($x);
            } else if (e.keyCode == 38) {
                currentFocus--;
                addActive($x);
            } else if (e.keyCode == 13) {
                e.preventDefault();
                if (currentFocus > -1) {
                    if ($x.length) $x.eq(currentFocus).click();
                }
            }
        });
        
        function addActive($x) {
            if (!$x.length) return false;
            removeActive($x);
            if (currentFocus >= $x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = $x.length - 1;
            $x.eq(currentFocus).addClass("autocomplete-active");
        }
        
        function removeActive($x) {
            $x.removeClass("autocomplete-active");
        }
        
        function closeAllLists($elmnt) {
            var $items = $(".autocomplete-items");

            if (!$elmnt) {  // If no argument is provided
                $items.remove();
                return;
            }

            $items.each(function() {
                if ($elmnt[0] !== $(this)[0] && $elmnt[0] !== inp) {
                    $(this).remove();
                }
            });
        }
        
        $(document).on("click", function(e) {
            closeAllLists($(e.target));
        });
        
    }

    function eliminarDiacriticos(texto) {
        return texto.normalize('NFD').replace(/[\u0300-\u036f]/g,"");
    }
    
    /* Función que suma o resta días a una fecha, si el parámetro
    días es negativo restará los días*/
    function sumarDias(fecha, dias){
        fecha.setDate(fecha.getDate() + dias);
        return fecha;
    }
    
    function getFecha(fecha) {
        let date = new Date(fecha)
    
        let day = date.getDate()
        let month = date.getMonth() + 1
        let year = date.getFullYear()
    
        if(month < 10){
            return `${year}-0${month}-${day}`
        }else{
            return `${year}-${month}-${day}`
        }
    }
    
    function getCantidadMenores(idAdultos , idMenores) {
        // Validar adultos y menores = 8
        var hoteles_adultos = $('#' + idAdultos);
        let div_hoteles_menores = $('#' + idMenores);
    
        var select;
        for (var i = 0; i <= maxPersona - hoteles_adultos.val(); i++) {
            select += '<option value="'+i+'">'+i+'</option>'
        }
        div_hoteles_menores.html(select);
    }
})( jQuery );





