function validateDate()
{
    var date1 = $("#fecha_i").val();
    var date2 = $("#fecha_f").val();

    if(date1.length == 0)
    {
        mensaje('mensaje_id', 'Select the date', 1, 0);
        return true;
    }
    else if(date2.length == 0)
    {
        mensaje('mensaje_id', 'Select the date', 1, 0);
        return true;
    }
    else if(date1 > date2)
    {
        mensaje('mensaje_id', 'Start day can be bigger than end date', 1, 0);
        return true;
    }

    return false;
}

function getVendor()
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
            $("#inputVendor").append(p);
        }
    });
}

function searchBill() {
    var csrf  = $("input[name = '_token']").val();
    var ruta  = $("#rutaSearchBills").val();
    var datos = [];

    if(validateDate())
    {
        return;
    }

    datos.push( formatoFecha($("#fecha_i").val()));
    datos.push( formatoFecha($("#fecha_f").val()));
    datos.push( $("#inputVendor").val());
    datos.push( $("#tiendaCode").val());

    $.ajax({
        url: ruta,
        type: 'GET',
        data: {
            '_token': csrf,
            'dato': datos
        },
        dataType: 'json',
        success: function ( val ) {
            if(val.hasOwnProperty('mensaje'))
            {
                $("#id_table_list_bills tbody").empty();
                mensaje('mensaje_id', val['mensaje'], 1, 0);
                return;
            }
            appendTableList(val);
        }
    });
}

function appendTableList(val)
{
    $("#id_table_list_bills tbody").empty();
    var p = '';

    $.each(val, function (key, value) {
        var fecha = formatoFechaMostrarSinHora(value['fecha_bill']);
        p += "<tr>";
        p += "<td>" + value['tienda_name'] + "</td>";
        p += "<td>" + value['vendor_name'] + "</td>";
        p += "<td class='ocultar'>" + value['item_id'] + "</td>";
        p += "<td>" + value['description'] + "</td>";
        p += "<td>" + value['qty'] + "</td>";
        p += "<td>" + parseFloat(value['price']).toFixed(2) + "</td>";
        p += "<td>" + value['product_amount'] + "</td>";
        p += "<td>" + value['unit'] + "</td>";
        p += "<td>" + fecha + "</td>";
        p += "<td>" + (value['price']/value['product_amount']).toFixed(2) + "</td>";
        p += "<td>" + (value['price'] * value['qty']).toFixed(2) + "</td>";
        p += "</tr>";
    });

    $("#id_table_list_bills tbody").append(p)
}

function searchReportPlu()
{
    var csrf  = $("input[name = '_token']").val();
    var ruta  = $("#rutaSearchBills").val();
    var datos = [];

    if(validateDate())
    {
        return;
    }

    datos.push( formatoFecha($("#fecha_i").val()));
    datos.push( formatoFecha($("#fecha_f").val()));
    datos.push( $("#input_plu").val());

    $.ajax({
        url: ruta,
        type: 'GET',
        data: {
            '_token': csrf,
            'dato': datos
        },
        dataType: 'json',
        success: function ( val ) {
            if(val.hasOwnProperty('mensaje'))
            {
                $("#id_table_list_bills tbody").empty();
                mensaje('mensaje_id', val['mensaje'], 1, 0);
                return;
            }
            appendTableReport2(val);
        }
    });
}

function appendTableReport2(val)
{
    $("#id_table_list_bills tbody").empty();
    var p = '';

    $.each(val, function (key, value) {
        var fecha = formatoFechaMostrarSinHora(value['fecha_bill']);
        p += "<tr>";
        p += "<td>" + value['name'] + "</td>";
        p += "<td>" + value['vendor'] + "</td>";
        p += "<td class='ocultar'>" + value['item_id'] + "</td>";
        p += "<td>" + value['description'] + "</td>";
        p += "<td>" + value['qty'] + "</td>";
        p += "<td>" + parseFloat(value['price']).toFixed(2) + "</td>";
        p += "<td>" + value['product_amount'] + "</td>";
        p += "<td>" + value['unit'] + "</td>";
        p += "<td>" + fecha + "</td>";
        p += "<td>" + (value['price']/value['product_amount']).toFixed(2) + "</td>";
        p += "<td>" + (value['price'] * value['qty']).toFixed(2) + "</td>";
        p += "</tr>";
    });

    $('#id_table_list_bills').DataTable().destroy();
    $("#id_table_list_bills tbody").append(p)
    $('#id_table_list_bills').DataTable();
}