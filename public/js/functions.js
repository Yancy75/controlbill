/**
 * Created by Magalys on 9/12/2018.
 */

function mensaje(id, mensaje, tipo, fijo)
{
    console.log(mensaje);

    tipo = typeof tipo !== 'undefined' ?  tipo : 1;
    fijo = typeof fijo !== 'undefined' ?  fijo : 0;
    if(tipo == 1)
    {
        $("div#"+id).replaceWith("<div class='alert alert-danger ' role='alert' id='"+id+"'><strong>"+mensaje+"</strong></div>");
    }
    if(tipo == 2)
    {
        $("div#"+id).replaceWith("<div class='alert alert-info ' role='alert' id='"+id+"'><strong>"+mensaje+"</strong></div>");
    }
    if(fijo == 1)
    {
        $("#"+id).show();
    }
    if(fijo == 0)
    {
        $("#"+id).show().delay(5000).fadeOut(50);
    }
}

function getUrlPublic(url)
{
    var splitUrl = url.split('/');
    splitUrl.pop();
    return splitUrl.join("/");
}

function formatoFechaHora(fecha) {
    var fecha2 = fecha.split(" ");
    var fecha3 = fecha2[0].split("-");

    return fecha3[2]+"-"+fecha3[1]+"-"+fecha3[0]+" "+fecha2[1];
}

function formatoFecha(fecha) {
    var fecha2 = fecha.split("/");

    return fecha2[2]+"-"+fecha2[0]+"-"+fecha2[1];
}

function formatoFechaMostrarSinHora(fecha)
{
    var fecha2 = fecha.split(" ");
    var fecha3 = fecha2[0].split("-");

    return fecha3[1]+"-"+fecha3[2]+"-"+fecha3[0];
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}//fin function

function disabledButtonSubmit()
{
    let timerInterval
    Swal.fire({
        title: 'Auto close alert!',
        html: 'I will close in <b></b> milliseconds.',
        timer: 1000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            timerInterval = setInterval(() => {
                const content = Swal.getContent()
                if (content) {
                    const b = content.querySelector('b')
                    if (b) {
                        b.textContent = Swal.getTimerLeft()
                    }
                }
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
    });
}
