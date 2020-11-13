const URL_BASE = window.location.href;
var bienes;
var bienes_usr;

$( document ).ajaxStart(function () {
    $('.container_pre').show();
});

$( document ).ajaxComplete(function() {
    $('.container_pre').hide();
});

function loadHtml(type="all") {
    var html = "";
    if(type=="all"){
        array = bienes;
    }else{
        array = bienes_usr;
    }
    array.forEach(function (bien) {
        if(type!='all'){
            bien = JSON.parse(bien.content);
        }
        html += `<div class="col s6 m6">
                <div class="row">
                  <div class="col s6">
                    <img class="responsive-img" src="img/home.jpg">
                  </div>                  
                    <div class="card-content">                           
                        <ul class="collection">
                          <li class="collection-item"><strong>Dirección: </strong> ${bien.Direccion}</li>
                          <li class="collection-item"><strong>Ciudad:</strong>  ${bien.Ciudad}</li>
                          <li class="collection-item"><strong>Telefono:</strong>  ${bien.Telefono}</li>
                          <li class="collection-item"><strong>Codigo Postal:</strong>  ${bien.Codigo_Postal}</li>
                          <li class="collection-item"><strong>Tipo:</strong>  ${bien.Tipo}</li>
                          <li class="collection-item"><strong>Precio:</strong>  ${bien.Precio}</li>`;
        if(type=='all') {
            html += `<li class="collection-item"><button data-id="${bien.Id}" class="btn green">Guardar</button></li>`;
        }
        html +=`</ul>                 
                    </div>
                </div>
              </div>
                <hr>`;
    });
    if(type=="all") {
        document.getElementById('div_bienes').innerHTML = html;
        document.getElementById('total_bienes').innerText = array.length;
    }else{
        document.getElementById('div_mis_bienes').innerHTML = html;
        document.getElementById('total_mis_bienes').innerText = array.length;
    }
}

function loadFilterCities() {
    // Carga el filtro de ciudades
    ciudades = filters['ciudad'];
    html = "";
    ciudades.forEach(function (ciudad) {
        html += `<option value="${ciudad}">${ciudad}</option>`;
    });
    document.getElementById('selectCiudad').innerHTML += html;
}

function loadFilterTypes() {
    // Carga filtro de tipo de vivienda
    tipos = filters['tipo'];
    html = "";
    tipos.forEach(function (tipo) {
        html += `<option value="${tipo}">${tipo}</option>`;
    });
    document.getElementById('selectTipo').innerHTML += html;
}

function loadScrollPrice() {
    precios = filters['precio'].map(function (precio) {
        precio = precio.replace('$', '');
        precio = precio.replace(',', '');
        return parseInt(precio);
    });

    precios.sort(function (a, b) {
        return a - b;
    });

    $("#rangoPrecio").ionRangeSlider({
        type: "double",
        grid: false,
        values: precios,
        min: precios[0],
        max: precios[precios.length - 1],
        from: precios[0],
        to: precios[precios.length - 1],
        prefix: "$"
    });
}

function getOwnRealty() {
    $.get(`${URL_BASE}back/bienes/getBienesByUser/?user_id=1`, function (data) {
        bienes_usr = JSON.parse(data);
        loadHtml('owns');
    });
}

function loadEventButtons() {
    var buttons = $('#tabs-1 li.collection-item button');
    buttons.each(function (index, button) {
        $(button).on('click', function (e) {
            var bien_id = $(button).data('id');
            $.get(`${URL_BASE}back/bienes/saveOwnRealty/?user_id=1&bien_id=${bien_id}`, function (data) {
                var result = JSON.parse(data);
                if (result.save) {
                    getOwnRealty();
                }
            });
        });
    });
}

function pincipalLoad() {
    $.get(`${URL_BASE}back/bienes/`, function (data) {
        bienes = JSON.parse(data);
        loadHtml();
        loadEventButtons();
    });
}

function loadInit() {
    pincipalLoad();

    $.get(`${URL_BASE}back/bienes/filters`, function (data){
        filters = JSON.parse(data);

        loadFilterCities();

        loadFilterTypes();

        loadScrollPrice();
    });

    $('#submitButton').on('click', function (e){
        e.preventDefault();
        city = $('#selectCiudad').val();
        tipo = $('#selectTipo').val();
        precio = $('#rangoPrecio').val();

        $.get(`${URL_BASE}back/bienes/byFilter/?Precio=${precio}&Ciudad=${city}&Tipo=${tipo}`, function (data){
            bienes = JSON.parse(data);
            bienes = Object.values(bienes);
            loadHtml();
            loadEventButtons();
        });
    });

    $('#resetButton').on('click', function (e) {
        e.preventDefault();
        let my_range = $("#rangoPrecio").data("ionRangeSlider");
        $('#selectCiudad').val(null);
        $('#selectTipo').val(null);
        my_range.reset();
        pincipalLoad();

    });

    getOwnRealty();

    $('.container_pre').hide();
}

loadInit();
