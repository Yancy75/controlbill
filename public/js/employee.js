function mostrarInputInfoPayrollEmployee()
{
    $(".salary_class_ocultar").removeClass("ocultar");
    $("#overtime_id").addClass("ocultar");
}

function ocultarInputInfoPayrollEmployee()
{
    $(".salary_class_ocultar").addClass("ocultar");
    $("#overtime_id").removeClass("ocultar");
}

function decisionCargarPagina()
{
    //Chequeo que valor tiene el campo con el tipo de salario. Si es 'hourly' oculto los dos inputs si es salary muestro los dos input
    var salary_type = $("#inputTypeSalary").val();

    if(salary_type == 'hourly')
    {
        ocultarInputInfoPayrollEmployee();
    }
    else if(salary_type == 'salary')
    {
        mostrarInputInfoPayrollEmployee();
        //calculo a cuanto me van a salir las hora dependiendo el salario
        calcularValorHorasPorSalario();
    }
}

function calcularValorHorasPorSalario()
{
    //Calculo las el valor de las hora al coger el salario y dividirlo en 40 horas. Esto es semanal
    var salario = $("#inputContractHours").val();
    var hour    = $('#inputHoursToCalculatedSalary').val();

    if(salario == 0 || hour == 0)
    {
        return;
    }

    $("#inputPayHours").val(salario/hour);
    calcularOvertimeEnSettingEmployee();
}

function validarSalaryTypeOnChange()
{
    //cada vez que se cambia el tipo de salario valido cual es para ocultar o mostrar los inputs
    $("#inputTypeSalary").change(function () {
        decisionCargarPagina();
    });
}

function mostrarEndDate()
{
    $("#endDateId").removeClass('ocultar');
    $("#titulo_terminated_employee").removeClass('ocultar');
    $("#reasonEndDateId").removeClass('ocultar');
    $("#detailId").removeClass('ocultar');
    $("#authorizedById").removeClass('ocultar');
    $("#mostrarEndDateId").addClass('ocultar');

    $("#inputFiredDate").prop( "disabled", false );
    $("#inputauthorizedBy").prop( "disabled", false );
    $("#inputReasonFiredDate").prop( "disabled", false );
    $("#inputDetail").prop( "disabled", false );
}

function calcularOvertimeEnSettingEmployee()
{
    var payHour            = $("#inputPayHours").val();
    var porcentajeOvertime = $("#porcentaje_overtime").val();

    $("#inputOvertime").val(payHour*(1 + (porcentajeOvertime/100)));
}

function mostrarRehideBy()
{
    $('#authorizedRehideById').removeClass('ocultar');
    $("#inputauthorizedRehideBy").prop( "disabled", false );
    $("#inputReHiredDate").prop( "disabled", false );
}
