
function searchStore()
{
    var csrf  = $("input[name = '_token']").val();
    var ruta  = $("#rutaSearchStore").val();
    var store = $("#storeCode").val();

    $.ajax({
        url: ruta,
        type: 'GET',
        data: {
            '_token': csrf,
            'searchFor': store
        },
        dataType: 'json',
        beforeSend: function(before)
        {
            $("#loading_image_1").removeClass('ocultar');
        },
        success: function ( val ) {
            $("#loading_image_1").addClass('ocultar');
            if(val.hasOwnProperty('mensaje'))
            {
                $("#contenido_descripcion_tienda").empty();
                $("#contenido_form_tienda").empty();
                mensaje('mensaje_store_search', val['mensaje'], 1, 0);
                return;
            }
            createFormAddBills(val);
        }
    });

}

function createFormAddBills(val)
{
    descripcionTienda(val);
    addFormBills(val);
}

function descripcionTienda(val)
{

    $("#contenido_descripcion_tienda").empty();

    var p = "<hr/>";
    p += "<div class='d-flex flex-row bd-highlight mb-3'>";

    p += "<div class='p-2 bd-highlight'><h2>"+val[0]['name']+"</h2>";
    p += "<h3>"+val[0]['address']+"</h3></div>";

    p += "<form>";

    p += "<div class='p-2 bd-highlight float-left'>";

    p += "<div class='form-group'>";
    p += "<label for='inputVendor_1' class='col-sm-3 col-form-label'><h5>Vendor</h5></label>";
    p += "<select id='inputVendor_1' class='form-control'>";
    p += "<option selected value=''>Select Vendor</option>";
    p += "</select>";
    p += "</div>";

    p += "</div>";

    p += "<div class='p-2 bd-highlight float-left'>";

    p += "<div class='form-group'>";
    p += "<label for='fecha' class='col-sm-3 col-form-label'><h5>Fecha</h5></label>";
    p += "<input type='text' id='fecha' class='form-control'>";
    p += "</div>";

    p += "</div>";

    p += "</form>";

    p += "</div>";
    p += "<div class='clear'></div><hr/>";

    searchVendor();
    $("#contenido_descripcion_tienda").append(p);

    setTimeout(function() {
        $( "#fecha" ).datepicker({
            altField: "#fecha_pago_hidden",
            altFormat: "yy-mm-dd",
            format: 'DD/MM/YYYY',
            ignoreReadonly: true,
            allowInputToggle: true
        });
        $('.ui-datepicker').addClass('notranslate');
        searchProductsBillOpen();
    }, 1000);
}

function searchVendor()
{
    var p = "";
    var csrf  = $("input[name = '_token']").val();
    var ruta  = $("#rutaSearchVendor").val();

    $.ajax({
        url: ruta,
        type: 'GET',
        data: {
            '_token': csrf,
        },
        dataType: 'json',
        success: function ( val ) {
            if(val.hasOwnProperty('mensaje'))
            {
                p += "<option value=''>No Vendor</option>";
            }
            else
            {
                $.each(val, function (key, value) {
                    p += "<option value='"+ value['id'] +"'>"+ value['vendor'] +"</option>";
                })
            }
            $("#inputVendor_1").append(p);
        }
    });
}

function addFormBills(val) {

    $("#contenido_form_tienda").empty();

    var p ='';
    p += "<form id='form_bills_id'>";
    p += "<input type='hidden' id='id_tienda_id' value='"+ val[0]['id']+"'/>";

    p += "<div class='form-group row'>";

    p += "<label for='inputPLU_1' class='col-sm-3 col-form-label'>PLU</label>";
    p += "<div class='col-sm-3'>";
    p += "<input type='hidden' class='form-control' id='inputPLUId_1' >";
    p += "<input type='number' class='form-control plu_enter' id='inputPLU_1' placeholder='PLU' onfocusout='buscarPLU();'>";
    p += "</div>";

    p += "<label for='inputDescription_1' class='col-sm-3 col-form-label'>Description</label>";
    p += "<div class='col-sm-3'>";
    p += "<input type='text' class='form-control' id='inputDescription_1' placeholder='Description' disabled>";
    p += "</div>";


    p += "</div>";

    p += "</div>";

    p += "<div class='form-group row'>";

    p += "<label for='inputQTY_1' class='col-sm-3 col-form-label'>Box QTY</label>";
    p += "<div class='col-sm-3'>";
    p += "<input type='number' class='form-control box_enter' id='inputQTY_1' placeholder='QTY'>";
    p += "</div>";

    p += "<label for='inputInvoicePrice_1' class='col-sm-3 col-form-label'>Vendor Invoice Price</label>";
    p += "<div class='col-sm-3'>";
    p += "<input type='number' class='form-control price_enter' id='inputInvoicePrice_1' placeholder='Invoice Price'>";
    p += "</div>";

    p += "</div>";

    p += "<div class='form-group row'>";

    p += "<label for='inputItemAmount_1' class='col-sm-3 col-form-label'>Product Amount</label>";
    p += "<div class='col-sm-3'>";
    p += "<input type='number' class='form-control pro_amount_enter' id='inputItemAmount_1' placeholder='Product Amount'>";
    p += "</div>";

    p += "<label for='inputType_1' class='col-sm-3 col-form-label'>Type</label>";
    p += "<div class='col-sm-3'>";
    p += "<select id='inputUnit_1' class='form-control bill_control_class'>"
    p += "<option selected value='lbs'>LBS</option>";
    p += "<option value='unit'>Unit</option>";
    p += "</select>";
    p += "</div>";

    p += "</div>";

    p += "<button type='button' class='btn btn-primary' onclick='addProductToBill();'>Add</button>"

    p += "</form>";

    $("#contenido_form_tienda").append(p);
    pressEnterAddProductToBill();
    press_enter();
}

function pressEnterAddProductToBill()
{
    $(".bill_control_class").on("keypress", function (e) {
        if (e.keyCode == 13) {
            addProductToBill();
        }
    });
}

function buscarPLU()
{
    var csrf  = $("input[name = '_token']").val();
    var ruta  = $("#rutaSearchPLU").val();
    var item  = $("#inputPLU_1").val();

    $.ajax({
        url: ruta,
        type: 'GET',
        data: {
            '_token': csrf,
            'searchFor': item
        },
        dataType: 'json',
        success: function ( val ) {

            if(val.hasOwnProperty('mensaje'))
            {
                $("#inputDescription_1").val("");
                $("#inputPLUId_1").val("");

                mensaje('mensaje_store_search', val['mensaje'], 1, 0);
                return;
            }
            complentarFormBills(val);
        }
    });
}

function complentarFormBills(val)
{
    $("#inputPLUId_1").val(val[0]["id"]);
    $("#inputDescription_1").val(val[0]["description"]);
}

function addProductToBill() {
    var datos = {};

    datos['tienda_id']      = $("#id_tienda_id").val();
    datos['item_id']        = $("#inputPLUId_1").val();
    datos['vendor_id']      = $("#inputVendor_1").val();
    datos['description']    = $("#inputDescription_1").val();
    datos['qty']            = $("#inputQTY_1").val();
    datos['price']          = $("#inputInvoicePrice_1").val();
    datos['product_amount'] = $("#inputItemAmount_1").val();
    datos['unit']           = $("#inputUnit_1").val();
    datos['fecha_bill']     = formatoFecha($("#fecha").val());

    var csrf  = $("input[name = '_token']").val();
    var ruta  = $("#rutaAddProductToBill").val();

    $.ajax({
        url: ruta,
        type: 'GET',
        data: {
            '_token': csrf,
            'data': datos
        },
        dataType: 'json',
        success: function ( val ) {

            if(val.hasOwnProperty('mensaje'))
            {
                mensaje('mensaje_store_search', val['mensaje'], 1, 0);
                return;
            }

            var plu = $("#inputPLU_1").val();

            // $("#id_tienda_id").val("");
            $("#inputPLU_1").val("");
            $("#inputPLUId_1").val("");
            $("#inputDescription_1").val("");
            $("#inputQTY_1").val("");
            $("#inputInvoicePrice_1").val("");
            $("#inputItemAmount_1").val("");
            $("#inputUnit_1").val("");

            listProductAddBill(val, plu);

            $("#inputPLU_1").focus();
        }
    });
}

function searchProductsBillOpen()
{
    $("#fecha").change(function(){

        appenListProductsBillOpen();

    });

    $("#inputVendor_1").change(function () {
        if($("#fecha").val() != 0)
        {
            appenListProductsBillOpen();
        }
    });

}

function appenListProductsBillOpen()
{
    var dato = [];
    var csrf  = $("input[name = '_token']").val();
    var ruta  = $("#rutaSearchProductsBillOpen").val();

    dato.push($("#inputVendor_1").val());
    dato.push(formatoFecha($("#fecha").val()));
    dato.push($("#id_tienda_id").val());

    $.ajax({
        url: ruta,
        type: 'GET',
        data: {
            '_token': csrf,
            'dato': dato
        },
        dataType: 'json',
        success: function ( val ) {
            if(val.hasOwnProperty('mensaje'))
            {
                $("#contenido_list_product_bill").addClass('ocultar');
                $("#list_products tbody").empty();
                return;
            }
            listProductOldBill(val);
        }
    });
}

function listProductOldBill(val)
{
    $("#list_products tbody").empty();
    var p = '';
    var totalCompra = 0;
    $('#totalCompra').val(0);
    $.each(val, function(key, value){
        p += "<tr>";
        p += "<td>"+ value['plu'] +"</td>";
        p += "<td>"+ value['description'] +"</td>";
        p += "<td>"+ value['qty'] +"</td>";
        p += "<td>"+ parseFloat(value['price']).toFixed(2) +"</td>";
        p += "<td>"+ value['product_amount'] +"</td>";
        p += "<td>"+ value['unit'] +"</td>";
        p += "<td>"+( parseFloat(value['price'])/parseFloat(value['product_amount'])).toFixed(2) +"</td>";
        p += "<td>"+ (parseFloat(value['price']) * parseFloat(value['qty'])).toFixed(2) +"</td>";
        p += "<td><a onclick='deleteProductListBill("+value['bill_id']+");'><i class='fas fa-trash-alt'></i></a></td>";
        p += "</tr>";
        totalCompra = parseFloat($('#totalCompra').val());
        $('#totalCompra').val(((parseFloat(value['price']) * parseFloat(value['qty'])) + totalCompra).toFixed(2));
    });

    $("#contenido_list_product_bill").removeClass('ocultar');
    $("#list_products tbody").prepend(p);

}

function listProductAddBill(val, plu) {
    var p = '';

    p += "<tr>";
    p += "<td>"+ plu +"</td>";
    p += "<td>"+ val['description'] +"</td>";
    p += "<td>"+ val['qty'] +"</td>";
    p += "<td>"+ parseFloat(val['price']).toFixed(2) +"</td>";
    p += "<td>"+ val['product_amount'] +"</td>";
    p += "<td>"+ val['unit'] +"</td>";
    p += "<td>"+( parseFloat(val['price'])/parseFloat(val['product_amount'])).toFixed(2) +"</td>";
    p += "<td>"+ (parseFloat(val['price']) * parseFloat(val['qty'])).toFixed(2) +"</td>";
    p += "<td><a onclick='deleteProductListBill("+ val['id'] +");'><i class='fas fa-trash-alt'></i></a></td>";
    p += "</tr>";

    $("#contenido_list_product_bill").removeClass('ocultar');
    $("#list_products tbody").prepend(p);

    var totalCompra        = parseFloat($('#totalCompra').val());
    var totalCompraMostrar = ((parseFloat(val['price']) * parseFloat(val['qty'])) + totalCompra).toFixed(2);
    $('#totalCompra').val(totalCompraMostrar);
}

function deleteProductListBill(id_product)
{
    if(confirm("Are you sure that you want to delete the entrance?"))
    {
        var csrf  = $("input[name = '_token']").val();
        var ruta  = $("#rutaDeleteEntrance").val()+"/"+id_product;

        $.ajax({
            url: ruta,
            type: 'GET',
            data: {
                '_token': csrf,
                'id_item': id_product
            },
            dataType: 'json',
            success: function ( val ) {

                if(val.hasOwnProperty('mensaje'))
                {
                    return;
                }
                appenListProductsBillOpen();
            }
        });
    }
}

function saveProductListBill()
{
    var dato = [];
    var csrf  = $("input[name = '_token']").val();
    var ruta  = $("#rutaSaveProductsBillOpen").val();

    dato.push($("#inputVendor_1").val());
    dato.push(formatoFecha($("#fecha").val()));
    dato.push($("#id_tienda_id").val());

    $.ajax({
        url: ruta,
        type: 'GET',
        data: {
            '_token': csrf,
            'dato': dato
        },
        dataType: 'json',
        success: function ( val ) {
            $("#list_products tbody").empty();
            $("#contenido_list_product_bill").addClass('ocultar');
            if(val.hasOwnProperty('mensaje'))
            {
                return;
            }
        }
    });
}

function press_enter()
{
    $("#inputPLU_1").on("keypress", function (e) {
        if (e.keyCode == 13) {
            $(".box_enter").focus();
        }
    });

    $(".box_enter").on("keypress", function (e) {
        if (e.keyCode == 13) {
            $(".price_enter").focus();
        }
    });

    $(".price_enter").on("keypress", function (e) {
        if (e.keyCode == 13) {
            $(".pro_amount_enter").focus();
        }
    });

    $(".pro_amount_enter").on("keypress", function (e) {
        if (e.keyCode == 13) {
            $("#inputUnit_1").focus();
        }
    });
}