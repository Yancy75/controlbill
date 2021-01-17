function calcularWorkingHours(c)
{
    var horasTrabajadas        = parseFloat($('#horaTrabajadas_'+c).val());
    var cantidadHoraRegular    = parseFloat($('#regularHourAmount_'+c).text());
    var potPorcentaje          = parseFloat($('#generalSetPtoPorcentage').val())/100;
    var montoPagadoHoraRegular = parseFloat($('#regularHourRate_'+c).text());

    if(Number.isNaN(montoPagadoHoraRegular))
    {
        $('#regularHourRate_'+c).html('<p style="color:red">The amount per hours is empty.</p>');
        return;
    }

    if(horasTrabajadas > cantidadHoraRegular)
    {

        $('#overTimeHour_'+c).text(horasTrabajadas - cantidadHoraRegular);
        $('#overTimeRate_'+c).text(montoPagadoHoraRegular * (1 + potPorcentaje));
    }
    else
    {
        $('#overTimeHour_'+c).text('0');
        $('#overTimeRate_'+c).text('0');
    }

    return;
}

function grossWage(c) {
    var horasTrabajadas        = parseFloat($('#horaTrabajadas_'+c).val());
    var cantidadHoraRegular    = parseFloat($('#regularHourAmount_'+c).text());
    var montoPagadoHoraRegular = parseFloat($('#regularHourRate_'+c).text());

    if(horasTrabajadas > cantidadHoraRegular)
    {
        $('#grossWage_'+c).text(cantidadHoraRegular * montoPagadoHoraRegular);
        return cantidadHoraRegular * montoPagadoHoraRegular;
    }
    else
    {
        $('#grossWage_'+c).text(horasTrabajadas * montoPagadoHoraRegular);
        return horasTrabajadas * montoPagadoHoraRegular;
    }
    return;
}

function overTimeWage(c)
{
    var horasTrabajadas        = parseFloat($('#horaTrabajadas_'+c).val());
    var cantidadHoraRegular    = parseFloat($('#regularHourAmount_'+c).text());
    var potPorcentaje          = parseFloat($('#generalSetPtoPorcentage').val())/100;
    var montoPagadoHoraRegular = parseFloat($('#regularHourRate_'+c).text());

    if(horasTrabajadas > cantidadHoraRegular)
    {
        var overTimeHours = horasTrabajadas - cantidadHoraRegular;
        var overTimeRate  = montoPagadoHoraRegular * (1 + potPorcentaje);

        $('#overTimeWage_'+c).text(overTimeHours * overTimeRate);
        return overTimeHours * overTimeRate;
    }
    else
    {
        $('#overTimeWage_'+c).text('0');
        return 0;
    }
    return;
}

function totalWage(c)
{
    var totalWageV;

    setTimeout(function() {
        var grossWageV     = parseFloat($('#grossWage_'+c).text());
        var overTimeWageV  = parseFloat($('#overTimeWage_'+c).text());
        var ptoAmountPaidV = parseFloat($('#ptoAmountPaid_'+c).text());

        totalWageV = grossWageV + overTimeWageV + ptoAmountPaidV;

        $('#totalWage_'+c).text(totalWageV.toFixed(2));
        return totalWageV;
    }, 800);


    return;
}

function calcularptoAmountPaid(c) {
    var ptoHours               = $('#ptoHours_'+c).val();
    var montoPagadoHoraRegular = parseFloat($('#regularHourRate_'+c).text());

    montoPagadoHoraRegular = parseFloat(montoPagadoHoraRegular);
    if(Number.isNaN(montoPagadoHoraRegular))
    {
        $('#ptoAmountPaid_'+c).html('<p style="color:red">The amount per hours is empty.</p>');
        return;
    }

    var ptoAmountPaidV = ptoHours * montoPagadoHoraRegular;

    $("#ptoAmountPaid_"+c).text(ptoAmountPaidV);

    return ptoAmountPaidV;
}

function calcularNetWage(c)
{
    setTimeout(function() {
        var totalWage      = parseFloat($("#totalWage_"+c).text());
        var bonus          = parseFloat($("#bonus_"+c).val());
        var taxes          = parseFloat($("#taxes_"+c).text());

        var netWage       = totalWage + bonus - taxes;

        calcularCash(c, netWage);
        $("#netWage_"+c).text(netWage);
    }, 1200);

    return;
}

function calcularTaxes(c)
{
    var checkGrossPay = parseFloat($("#checkGrossPay_"+c).val());
    var checkNetPay   = parseFloat($("#checkNetPay_"+c).val());
    var taxes         = checkGrossPay - checkNetPay;
    $("#taxes_"+c).text(taxes);
}

function calcularCash(c, netWage) {
    var cash = netWage - parseFloat($("#DDP_"+c).val());
    $("#Cash_"+c).text(cash);
}

function savePayroll()
{
  /* modificar para evaluacion y eficiencia 100% numero y nada espacios en balnco y no NaN*/
    disabledButtonSubmit();
    var control = $("#controlFilasId").val();
    var ruta    = $("#rutaAddPayroll").val();
    var datas   = new Array();

    for(var i = 1; i <= control; i++)
    {
        var data = new Array();
        data.push($('#beginDateVal').val());
        data.push(parseInt($('#idEmployee_'+i).text()));
        data.push(parseFloat($('#regularHourRate_'+i).text()));
        data.push(parseFloat($('#horaTrabajadas_'+i).val()));
        data.push(parseFloat($('#ptoHours_'+i).val()));
        data.push(parseFloat($('#bonus_'+i).val()));
        data.push(parseFloat($('#checkGrossPay_'+i).val()));
        data.push(parseFloat($('#checkNetPay_'+i).val()));
        data.push(parseFloat($('#taxes_'+i).text()));
        data.push(parseFloat($('#DDP_'+i).val()));
        data.push($('#typeSalary_'+i).text());
        data.push(parseFloat($('#regularHourAmount_'+i).text()));

        datas.push(data);

    }

    $.ajax({
        url: ruta,
        type: 'POST',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            'dato': datas
        },
        dataType: 'json',
        success: function ( val ) {
            window.location = $('#rutaViewPayroll').val();
        }
    });

}

function modifyCalcularWorkingHours()
{
    var horasTrabajadas        = parseFloat($('#inputTotalOfHours').val());
    var cantidadHoraRegular    = parseFloat($('#inputRegHours').val());
    var potPorcentaje          = parseFloat($('#inputPorcentage').val())/100;
    var montoPagadoHoraRegular = parseFloat($('#inputRegRate').val());
    if(Number.isNaN(montoPagadoHoraRegular))
    {
        $('#inputRegRate').html('<p style="color:red">The amount per hours is empty.</p>');
        return;
    }
    if(horasTrabajadas > cantidadHoraRegular)
    {

        $('#inputOTHour').val(horasTrabajadas - cantidadHoraRegular);
        $('#inputOTRate').val(montoPagadoHoraRegular * (1 + potPorcentaje));
    }
    else
    {
        $('#inputOTHour').val('0');
        $('#inputOTRate').val('0');
    }

    return;
}

function modifyGrossWage() {
    var horasTrabajadas        = parseFloat($('#inputTotalOfHours').val());
    var cantidadHoraRegular    = parseFloat($('#inputRegHours').val());
    var montoPagadoHoraRegular = parseFloat($('#inputRegRate').val());

    if(horasTrabajadas > cantidadHoraRegular)
    {
        $('#inputGrossWage').val(cantidadHoraRegular * montoPagadoHoraRegular);
        return cantidadHoraRegular * montoPagadoHoraRegular;
    }
    else
    {
        $('#inputGrossWage').val(horasTrabajadas * montoPagadoHoraRegular);
        return horasTrabajadas * montoPagadoHoraRegular;
    }
    return;
}

function modifyOverTimeWage()
{
    var horasTrabajadas        = parseFloat($('#inputTotalOfHours').val());
    var cantidadHoraRegular    = parseFloat($('#inputRegHours').val());
    var potPorcentaje          = parseFloat($('#inputPorcentage').val())/100;
    var montoPagadoHoraRegular = parseFloat($('#inputRegRate').val());

    if(horasTrabajadas > cantidadHoraRegular)
    {
        var overTimeHours = horasTrabajadas - cantidadHoraRegular;
        var overTimeRate  = montoPagadoHoraRegular * (1 + potPorcentaje);

        $('#inputOvertimeWage').val(overTimeHours * overTimeRate);
        return overTimeHours * overTimeRate;
    }
    else
    {
        $('#inputOvertimeWage').val('0');
        return 0;
    }
    return;
}

function modifyTotalWage()
{
    var totalWageV;

    setTimeout(function() {
        var grossWageV     = parseFloat($('#inputGrossWage').val());
        var overTimeWageV  = parseFloat($('#inputOvertimeWage').val());
        var ptoAmountPaidV = parseFloat($('#inputPTOAmountPaid').val());

        totalWageV = grossWageV + overTimeWageV + ptoAmountPaidV;

        $('#inputTotalWage').val(totalWageV);
        return totalWageV;
    }, 800);


    return;
}

function ModifyCalcularptoAmountPaid() {
    var ptoHours               = $('#inputTPOHour').val();
    var montoPagadoHoraRegular = parseFloat($('#inputRegRate'). val());

    montoPagadoHoraRegular = parseFloat(montoPagadoHoraRegular);
    if(Number.isNaN(montoPagadoHoraRegular))
    {
        // $('#inputPTOAmountPaid').html('<p style="color:red">The amount per hours is empty.</p>');
        return;
    }

    var ptoAmountPaidV = ptoHours * montoPagadoHoraRegular;

    $("#inputPTOAmountPaid").val(ptoAmountPaidV);

    return ptoAmountPaidV;
}

function modifyCalcularNetWage()
{
    setTimeout(function() {
        var totalWage      = parseFloat($("#inputTotalWage").val());
        var bonus          = parseFloat($("#inputBonus").val());
        var taxes          = parseFloat($("#inputTaxes").val());

        var netWage       = totalWage + bonus - taxes;

        $("#inputNetWage").val(netWage);
    }, 1200);
    setTimeout(function() {
        modifyCalcularCash();
    }, 1400);

    return;
}

function modifyCalcularTaxes()
{
    var checkGrossPay = parseFloat($("#inputCheckGrossPay").val());
    var checkNetPay   = parseFloat($("#inputCheckNetPay").val());
    var taxes         = checkGrossPay - checkNetPay;
    $("#inputTaxes").val(taxes);
    setTimeout(function() {
        modifyCalcularCash();
    }, 1400);
}

function modifyCalcularCash() {
    var cash = parseFloat($("#inputNetWage").val()) - parseFloat($("#inputTaxes").val());
    $("#inputCash").val(cash);
}
