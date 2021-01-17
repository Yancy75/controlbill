function getReport()
{
    var datos = [];
    var csrf  = $("input[name = '_token']").val();
    var ruta  = $("#rutaGetReports").val();

    if(validateDate())
    {
        return;
    }

    datos.push( formatoFecha($("#fecha_i").val()));
    datos.push( formatoFecha($("#fecha_f").val()));
    $.ajax({
        url: ruta,
        type: 'GET',
        data: {
            '_token': csrf,
            'dato': datos
        },
        dataType: 'json',
        success: function ( val ) {

            $("#divReporte tbody").empty();
            if(val.hasOwnProperty('mensaje'))
            {
                mensaje('mensaje_id', val['mensaje'], 1, 0);
                return;
            }

            appendListReport(val);
        }
    });
}

function appendListReport(val)
{
    console.log(val);
    var p = '<div class="x_panel"><div class="x_title"><h2><i class="fa fa-align-left"></i> Report <small>Sessions</small></h2><ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>';
        p +='<li><a class="close-link"><i class="fa fa-close"></i></a></li></ul><div class="clearfix"></div></div><div class="x_content"><div class="accordion" id="accordion" role="tablist" aria-multiselectable="true"><div class="x_content">';
    var aux = 1;
    var indexa="";
    $.each(val, function(index, value){
           indexa=index.replace(/ /g, "");
           p += '<div class="panel"><a class="panel-heading collapsed" role="tab" id="'+indexa+aux+'" data-toggle="collapse" data-parent="#accordion" href="#'+indexa+'" aria-expanded="false" aria-controls="'+indexa+'">';
           p +='<h4 class="panel-title">'+indexa+'</h4></a>';aux++;
           p +='<div id="'+indexa+'" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne" style=""><div class="panel-body"><table class="table table-striped table-bordered" style="width:100%">';
           p +='<thead><tr><th>Supermarket</th><th>Product</th><th>Cost</th><th>Date</th></tr></thead><tbody>';
            $.each(value, function(i, v){
                p += '<tr><td>'+ v['store'] +'('+ v['store_code']+')</td><td>'+ v['vendor']  +'</td><td>$'+ v['unit_price']  +'</td><td>'+ formatoFechaMostrarSinHora(v['fecha_bill'])  +' </td></tr>';
            });
            p += '</tbody></table></div></div></div>';
        });
        p +='</div></div></div>';
        
    $("#divReporte").append(p);
    $('table.table').DataTable();
}
