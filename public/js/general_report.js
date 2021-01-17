function addDepartment()
{
    var department = $('#department_list').val();
    var idSuper    = $('#idSuper_department_add').val();
    var ruta       = $("#ruta_department_add").val();
    var dato       = [];

    dato.push(idSuper);
    dato.push(department);

    if(department.length == 0)
    {
        mensaje('mensaje_id', 'Fill the field', 1, 0);
        return true;
    }

    $("#imageIdGif").removeClass('ocultar');
    $("#buttonIdAddDepartment").attr('disabled', true);

    $.ajax({
        url: ruta,
        type: 'GET',
        data: {
            'dato': dato
        },
        dataType: 'json',
        success: function ( val ) {
            location.reload()
            $("#imageIdGif").addClass('ocultar');
            $("#buttonIdAddDepartment").attr('disabled', false);
        }
    });
}

function activeModifyDepartment(number) {
    $("#inputName"+number).removeAttr('disabled');
    $("#inputStatus"+number).removeAttr('disabled');
    $("#idModifyButton"+number).removeClass('ocultar');
    $("#idCloseModifyButton"+number).removeClass('ocultar');
    $("#idAddPayrollDepartmentButton"+number).removeClass('ocultar');
    $("#idActiveModifyButton"+number).addClass('ocultar');
}

function closeModifyDepartment(number)
{
    $("#inputName"+number).attr('disabled', true);
    $("#inputStatus"+number).attr('disabled', true);
    $("#idModifyButton"+number).addClass('ocultar');
    $("#idCloseModifyButton"+number).addClass('ocultar');
    $("#idAddPayrollDepartmentButton"+number).addClass('ocultar');
    $("#idActiveModifyButton"+number).removeClass('ocultar');
}

function modifyDepartment(number)
{
    var department = $("#inputName"+number).val();
    var status     = $("#inputStatus"+number).val();
    var id         = $("#inputId"+number).val();
    var ruta       = $("#id_modify_department_add").val();
    var dato       = [];

    if(department.length == 0)
    {
        mensaje('inputName'+number, 'Fill the field', 1, 0);
        return true;
    }

    $("#imageIdGif").removeClass('ocultar');
    $("#idModifyButton"+number).attr('disabled', true);
    $("#idCloseModifyButton"+number).attr('disabled', true);

    dato.push(id);
    dato.push(department);
    dato.push(status);

    $.ajax({
        url: ruta,
        type: 'GET',
        data: {
            'dato': dato
        },
        dataType: 'json',
        success: function ( val ) {
            location.reload()
            $("#imageIdGif").addClass('ocultar');
            $("#idModifyButton"+number).attr('disabled', false);
            $("#idCloseModifyButton"+number).attr('disabled', false);
        }
    });
}
