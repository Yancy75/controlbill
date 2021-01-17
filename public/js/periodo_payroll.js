function buscarPeriodoByClick(date)
{
    var fecha = date.split('-');
    var new_fecha = fecha[1]+'/'+fecha[2]+'/'+fecha[0];
    $("#inputDate").val(new_fecha);
    setTimeout(function() {
        $('button').click();
    }, 150);
}
