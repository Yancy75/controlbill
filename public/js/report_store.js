function validarFechaBuscarReporte()
{
    $(".inputDate").change(function(){
        if($("#inputDate").val() != '' && $("#inputDatef").val() != ''){
            if($("#inputDate").val() > $("#inputDatef").val())
            {
                console.log('hola');
                $("#mensaje_id").removeClass('ocultar')
                $("#mensaje_spam").text("Start date can't be oldest than end date");
                $("button").prop('disabled', true );
                setTimeout(function() {
                    $("#mensaje_id").addClass('ocultar')
                    $("#mensaje_spam").text("");
                }, 6400);
            }
            else
            {
                $("button").prop('disabled', false );
            }
            return;
        }
    });
}
