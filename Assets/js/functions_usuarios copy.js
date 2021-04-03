var tableUsuarios;
let rowTable = "";
var divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function () {

    tableUsuarios = $('#tableUsuarios').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": " " + base_url + "/Usuarios/getUsuarios",
            "dataSrc": ""
        },
        "columns": [{
                "data": "idpersona"
            },
            {
                "data": "nombres"
            },
            {
                "data": "apellidos"
            },
            {
                "data": "email_user"
            },
            {
                "data": "telefono"
            },
            {
                "data": "nombrerol"
            },
            {
                "data": "status"
            },
            {
                "data": "options"
            }
        ],
        'dom': 'lBfrtip',
        'buttons': [{
            "extend": "copyHtml5",
            "text": "<i class='far fa-copy'></i> Copiar",
            "titleAttr": "Copiar",
            "className": "btn btn-secondary btn-md"
        }, {
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr": "Esportar a Excel",
            "className": "btn btn-success btn-md"
        }, {
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr": "Esportar a PDF",
            "className": "btn btn-danger btn-md"
        }, {
            "extend": "csvHtml5",
            "text": "<i class='fas fa-file-csv'></i> CSV",
            "titleAttr": "Esportar a CSV",
            "className": "btn btn-info btn-md"
        }],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    });

    if (document.querySelector("#formUsuario")) {
        var formUsuario = document.querySelector("#formUsuario");
        formUsuario.onsubmit = function (e) {
            e.preventDefault();
            var strIdentificacion = document.querySelector('#txtIdentificacion').value;
            var strNombre = document.querySelector('#txtNombre').value;
            var strApellido = document.querySelector('#txtApellido').value;
            var strEmail = document.querySelector('#txtEmail').value;
            var intTelefono = document.querySelector('#txtTelefono').value;
            var intTipousuario = document.querySelector('#listRolid').value;
            var strPassword = document.querySelector('#txtPassword').value;
            var tipo = document.querySelector('#tipo').value;

            if(tipo == "0"){
                if (strPassword == '' || strIdentificacion == '' || strApellido == '' || strNombre == '' || intTipousuario == '') {
                    swal("Atención", "Todos los campos son obligatorios.", "error");
                    return false;
                }
            }else{
                if (strIdentificacion == '' || strApellido == '' || strNombre == '' || intTipousuario == '') {
                    swal("Atención", "Todos los campos son obligatorios.", "error");
                    return false;
                }
            }

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) {
                if (elementsValid[i].classList.contains('is-invalid')) {
                    swal("Atención", "Por favor verifique los campos en rojo.", "error");
                    return false;
                }
            }

            divLoading.style.display = "flex";

            var ajaxUrl = base_url+'/Usuarios/setUsuario';
            var formData = new FormData($("#formUsuario").get(0));
            $.ajax({
                type: 'POST',
                url: ajaxUrl,
                data: formData,                
                contentType: false,
                processData: false,
                success: function (objData) {
                    if (objData.status) {
                        /* alert(respuesta); */
                        
                        $('#modalFormUsuario').modal("hide");
                        formUsuario.reset();
                        swal("Usuarios", objData.msg ,"success");
                        tableUsuarios.api().ajax.reload();                        
                    } else {
                        /* alert('ERROR'); */
                        swal("Error", objData.msg , "error");
                    }
                    divLoading.style.display = "none";
                    return false;
                }
            });


        }
    }
    //Actualizar Perfil
    if (document.querySelector("#formPerfil")) {
        var formPerfil = document.querySelector("#formPerfil");
        formPerfil.onsubmit = function (e) {
            e.preventDefault();
            var strIdentificacion = document.querySelector('#txtIdentificacion').value;
            var strNombre = document.querySelector('#txtNombre').value;
            var strApellido = document.querySelector('#txtApellido').value;
            var intTelefono = document.querySelector('#txtTelefono').value;
            var strPassword = document.querySelector('#txtPassword').value;
            var strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;

            if (strIdentificacion == '' || strApellido == '' || strNombre == '' || intTelefono == '') {
                swal("Atención", "Todos los campos son obligatorios..", "error");
                return false;
            }

            if (strPassword != "" || strPasswordConfirm != "") {
                if (strPassword != strPasswordConfirm) {
                    swal("Atención", "Las contraseñas no son iguales.", "info");
                    return false;
                }
                if (strPassword.length < 5) {
                    swal("Atención", "La contraseña debe tener un mínimo de 5 caracteres.", "info");
                    return false;
                }
            }

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) {
                if (elementsValid[i].classList.contains('is-invalid')) {
                    swal("Atención", "Por favor verifique los campos en rojo.", "error");
                    return false;
                }
            }
            divLoading.style.display = "flex";
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Usuarios/putPerfil';
            var formData = new FormData(formPerfil);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) return;
                if (request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal("hide");
                        swal({
                            title: "",
                            text: objData.msg,
                            type: "success",
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false,
                        }, function (isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
    //Actualizar Datos Fiscales
    if (document.querySelector("#formDataFiscal")) {
        var formDataFiscal = document.querySelector("#formDataFiscal");
        formDataFiscal.onsubmit = function (e) {
            e.preventDefault();
            var strNit = document.querySelector('#txtNit').value;
            var strNombreFiscal = document.querySelector('#txtNombreFiscal').value;
            var strDirFiscal = document.querySelector('#txtDirFiscal').value;

            if (strNit == '' || strNombreFiscal == '' || strDirFiscal == '') {
                swal("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            divLoading.style.display = "flex";
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Usuarios/putDFical';
            var formData = new FormData(formDataFiscal);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) return;
                if (request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal("hide");
                        swal({
                            title: "",
                            text: objData.msg,
                            type: "success",
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false,
                        }, function (isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    } else {
                        swal("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}, false);


window.addEventListener('load', function () {
    fntRolesUsuario();
    fntDepartamentoUsuario();
    /*fntViewUsuario();
    fntEditUsuario();
    fntDelUsuario();*/
}, false);

function fntRolesUsuario() {
    if (document.querySelector('#listRolid')) {
        var ajaxUrl = base_url + '/Roles/getSelectRoles';
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listRolid').innerHTML = request.responseText;
                $('#listRolid').selectpicker('render');
            }
        }
    }
}

function fntDepartamentoUsuario() {
    if (document.querySelector('#listDepartamento')) {
        var ajaxUrl = base_url + '/Ubicacion/getSelectDepartamento';
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#listDepartamento').innerHTML = request.responseText;
                /* $('#listDepartamento').selectpicker('render'); */
            }
        }
    }
}

const selectDepartamento = document.querySelector('#listDepartamento');
const selectProvincia = document.querySelector('#listProvincia');
const selectDistrito = document.querySelector('#listDistrito');
const selectBase = document.querySelector('#listBaseRondera');

selectDepartamento.addEventListener('change', (event) => {
    fntProvinciaUsuario(event.target.value);
    selectProvincia.disabled = false;
    selectDistrito.disabled = true;
    selectBase.disabled = true;
});

function fntProvinciaUsuario(idDepartamento) {  
    var ajaxUrl = base_url + '/Ubicacion/getSelectProvincia';
    $.ajax({
        type: 'POST',
        url: ajaxUrl,
        data: {idDepartamento : idDepartamento},
        success: function (objData) {
            document.querySelector('#listProvincia').innerHTML = objData;
        }
    });
}

selectProvincia.addEventListener('change', (event) => {
    fntDistritoUsuario(event.target.value);
    selectDistrito.disabled = false;
    selectBase.disabled = true;
});

function fntDistritoUsuario(idProvincia) {
    var ajaxUrl = base_url + '/Ubicacion/getSelectDistrito';
    $.ajax({
        type: 'POST',
        url: ajaxUrl,
        data: {idProvincia : idProvincia},
        success: function (objData) {
            document.querySelector('#listDistrito').innerHTML = objData;
        }
    });
}

selectDistrito.addEventListener('change', (event) => {
    fntBaseRonderaUsuario(event.target.value);
    selectBase.disabled = false;
});

function fntBaseRonderaUsuario(idDistrito) {
    var ajaxUrl = base_url + '/Ubicacion/getSelectBaseRondera';    
    $.ajax({
        type: 'POST',
        url: ajaxUrl,
        data: {idDistrito : idDistrito},
        success: function (objData) {
            document.querySelector('#listBaseRondera').innerHTML = objData;
        }
    });
}

function fntViewUsuario(idpersona) {
    var idpersona = idpersona;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/getUsuario/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);

            if (objData.status) {
                var estadoUsuario = objData.data.status == 1 ?
                    '<span class="badge badge-success">Activo</span>' :
                    '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celIdentificacion").innerHTML = objData.data.identificacion;
                document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML = objData.data.email_user;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombrerol;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;
                $('#modalViewUser').modal('show');
            } else {
                swal("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditUsuario(idpersona) {
    document.querySelector('#titleModal').innerHTML = "Actualizar Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    document.getElementById("idUsuario").value = "";
    document.getElementById("txtIdentificacion").value = "";
    document.getElementById("txtNombre").value = "";
    document.getElementById("txtApellido").value = "";
    document.getElementById("txtTelefono").value = "";
    document.getElementById("txtEmail").value = "";
    document.getElementById("listRolid").value = "";

    document.getElementById("listDepartamento").value = "";
    document.getElementById("listProvincia").value = "";
    document.getElementById("listDistrito").value = "";
    document.getElementById("listBaseRondera").value = "";
    document.getElementById("txtDireccion").value = "";
    document.getElementById("listStatus").value = "";
    document.getElementById("txtPassword").value = "";
    document.getElementById("txtRepeatPassword").value = "";

    var idpersona = idpersona;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/getUsuario/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);

            selectProvincia.disabled = false;
            selectDistrito.disabled = false;
            selectBase.disabled = false;

            if (objData.status) {
                document.querySelector("#idUsuario").value = objData.data.idpersona;
                document.querySelector("#txtIdentificacion").value = objData.data.identificacion;
                document.querySelector("#txtNombre").value = objData.data.nombres;
                document.querySelector("#txtApellido").value = objData.data.apellidos;
                document.querySelector("#txtTelefono").value = objData.data.telefono;
                document.querySelector("#txtEmail").value = objData.data.email_user;
                document.querySelector("#listRolid").value = objData.data.idrol;
                document.querySelector("#tipo").value = "1";
                
                document.querySelector("#listDepartamento").value = objData.data.id_depart;
                
                document.querySelector("#listProvincia").value = objData.data.id_provincia;
                
                document.querySelector("#listDistrito").value = objData.data.id_distrito;
                
                document.querySelector("#listBaseRondera").value = objData.data.id_base;
                

                if(isset(objData.data.direccionfiscal)){
                    document.querySelector("#txtDireccion").value = objData.data.direccionfiscal;
                }else{
                    document.querySelector("#txtDireccion").value = "adasd";
                }

                
                $('#listRolid').selectpicker('render');

                if (objData.data.status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');
            }
        }
        $('#modalFormUsuario').modal('show');
    }
}

function fntDelUsuario(idpersona) {

    var idUsuario = idpersona;
    swal({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function (isConfirm) {

        if (isConfirm) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Usuarios/delUsuario';
            var strData = "idUsuario=" + idUsuario;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        swal("Eliminar!", objData.msg, "success");
                        tableUsuarios.api().ajax.reload();
                    } else {
                        swal("Atención!", objData.msg, "error");
                    }
                }
            }
        }

    });

}


function openModal() {
    document.querySelector('#idUsuario').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Usuario";
    document.querySelector("#formUsuario").reset();
    $('#modalFormUsuario').modal('show');
}

function openModalPerfil() {
    $('#modalFormPerfil').modal('show');
}