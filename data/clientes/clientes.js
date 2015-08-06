$(document).on("ready", inicio);
function evento(e) {
    e.preventDefault();
}
function scrollToBottom() {
    $('html, body').animate({
        scrollTop: $(document).height()
    }, 'slow');
}

function openPDF(){
window.open('../../ayudas/ayuda.pdf');
}

function scrollToTop() {
    $('html, body').animate({
        scrollTop: 0
    }, 'slow');
}

var dialogo =
{
    autoOpen: false,
    resizable: false,
    width: 860,
    height: 350,
    modal: true
};

var dialogo3 =
{
    autoOpen: false,
    resizable: false,
    width: 400,
    height: 210,
    modal: true,
    position: "top",
    show: "explode",
    hide: "blind"    
}

var dialogo4 ={
    autoOpen: false,
    resizable: false,
    width: 240,
    height: 150,
    modal: true,
    position: "top",
    show: "explode",
    hide: "blind"
}

var dialogo_cuenta ={
    autoOpen: false,
    resizable: false,
    width: 530,
    height: 350,
    modal: true,
    position: "top",
    show: "explode",
    hide: "blind"
}

function abrirDialogo() {
    $("#clientes").dialog("open");
}

function abrirCuenta() {
    $("#cuentas").dialog("open");
}

function guardar_cliente() {
    var iden = $("#ruc_ci").val();
    
    if ($("#tipo_docu").val() === "") {
        $("#tipo_docu").focus();
        alertify.error("Seleccione un tipo de documento ");
    } else {
        if ($("#tipo_docu").val() === "Cedula" && iden.length < 10) {
            $("#ruc_ci").focus();
            alertify.error("Error.. Minimo 10 digitos ");
        } else {
            if ($("#tipo_docu").val() === "Ruc" && iden.length < 13) {
                $("#ruc_ci").focus();
                alertify.error("Error.. Minimo 13 digitos ");
            } else {
                if ($("#nombres_cli").val() === "") {
                    $("#nombres_cli").focus();
                    alertify.error("Ingrese Nombres completos");
                } else {
                    if ($("#tipo_cli").val() === "") {
                        $("#tipo_cli").focus();
                        alertify.error("Seleccione Tipo cliente");
                    } else {
                        if ($("#direccion_cli").val() === "") {
                            $("#direccion_cli").focus();
                            alertify.error("Ingrese una dirección");
                        } else {
                            if ($("#pais_cli").val() === "") {
                                $("#pais_cli").focus();
                                alertify.error("Ingrese un pais");
                            } else {
                                if ($("#ciudad_cli").val() === "") {
                                    $("#ciudad_cli").focus();
                                    alertify.error("Ingrese una ciudad");
                                } else {
                                    // if ($("#cupo_credito").val() === "") {
                                    //     $("#cupo_credito").focus();
                                    //     alertify.error("Ingrese cantidad del crédito");
                                    // }else{
                                        $.ajax({
                                            type: "POST",
                                            url: "guardar_clientes.php",
                                            data: "tipo_docu=" + $("#tipo_docu").val() + "&ruc_ci=" + $("#ruc_ci").val() +
                                            "&nombres_cli=" + $("#nombres_cli").val() + "&tipo_cli=" + $("#tipo_cli").val() + "&direccion_cli=" + $("#direccion_cli").val() + "&nro_telefono=" + $("#nro_telefono").val() + "&nro_celular=" + $("#nro_celular").val() + "&pais_cli=" + $("#pais_cli").val() + "&ciudad_cli=" + $("#ciudad_cli").val() + "&email=" + $("#email").val() + "&cupo_credito=" + $("#cupo_credito").val() + "&notas_cli=" + $("#notas_cli").val()+ "&id_plan_cuentas=" + $("#id_plan_cuentas").val(),
                                            success: function(data) {
                                                var val = data;
                                                if (val == 1) {
                                                    alertify.success('Datos Agregados Correctamente');						    		
                                                    setTimeout(function() {
                                                    location.reload();
                                                    }, 1000);
                                                }
                                            }
                                        });
                                    // }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function modificar_cliente() {
    var iden = $("#ruc_ci").val();
    
    if ($("#id_cliente").val() === "") {
        alertify.error("Seleccione un cliente");
    } else {
        if ($("#tipo_docu").val() === "") {
            $("#tipo_docu").focus();
            alertify.error("Seleccione un tipo de documento ");
        } else {
            if ($("#tipo_docu").val() === "Cedula" && iden.length < 10) {
                $("#ruc_ci").focus();
                alertify.error("Error.. Minimo 10 digitos ");
            } else {
                if ($("#tipo_docu").val() === "Ruc" && iden.length < 13) {
                    $("#ruc_ci").focus();
                    alertify.error("Error.. Minimo 13 digitos ");
                } else {
                    if ($("#nombres_cli").val() === "") {
                        $("#nombres_cli").focus();
                        alertify.error("Ingrese Nombres completos");
                    } else {
                        if ($("#tipo_cli").val() === "") {
                            $("#tipo_cli").focus();
                            alertify.error("Seleccione Tipo cliente");
                        } else {
                            if ($("#direccion_cli").val() === "") {
                                $("#direccion_cli").focus();
                                alertify.error("Ingrese una dirección");
                            } else {
                                if ($("#pais_cli").val() === "") {
                                    $("#pais_cli").focus();
                                    alertify.error("Ingrese un pais");
                                } else {
                                    if ($("#ciudad_cli").val() === "") {
                                        $("#ciudad_cli").focus();
                                        alertify.error("Ingrese una ciudad");
                                    } else {
                                        // if ($("#cupo_credito").val() === "") {
                                        //     $("#cupo_credito").focus();
                                        //     alertify.error("Ingrese cantidad del crédito");
                                        // }else{
                                            $.ajax({
                                                type: "POST",
                                                url: "modificar_clientes.php",
                                                data: "tipo_docu=" + $("#tipo_docu").val() + "&ruc_ci=" + $("#ruc_ci").val() + "&id_cliente=" + $("#id_cliente").val() +
                                                "&nombres_cli=" + $("#nombres_cli").val() + "&tipo_cli=" + $("#tipo_cli").val() + "&direccion_cli=" + $("#direccion_cli").val() + "&nro_telefono=" + $("#nro_telefono").val() + "&nro_celular=" + $("#nro_celular").val() + "&pais_cli=" + $("#pais_cli").val() + "&ciudad_cli=" + $("#ciudad_cli").val() + "&email=" + $("#email").val() + "&cupo_credito=" + $("#cupo_credito").val() + "&notas_cli=" + $("#notas_cli").val(),
                                                success: function(data) {
                                                    var val = data;
                                                    if (val == 1) {
                                                        alertify.success('Datos Modificados Correctamente');						    		
                                                        setTimeout(function() {
                                                            location.reload();
                                                        }, 1000);
                                                    }
                                                }
                                            });  
                                        // }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
function eliminar_cliente() {
    if ($("#id_cliente").val() === "") {
        alertify.error("Seleccione un cliente");
    } else {
        $("#clave_permiso").dialog("open");     
    }
}
function validar_acceso(){
    if($("#clave").val() == "") {
        $("#clave").focus();
        alertify.error("Ingrese la clave");
    }else{
        $.ajax({
            url: '../procesos/validar_acceso.php',
            type: 'POST',
            data: "clave=" + $("#clave").val(),
            success: function(data) {
                var val = data;
                if (val == 0) {
                    $("#clave").val("");
                    $("#clave").focus();
                    alertify.error("Error... La clave es incorrecta ingrese nuevamente");
                } else {
                    if (val == 1) {
                        $("#seguro").dialog("open");   
                    }
                }
            }
        });
    }   
}

function aceptar(){
    $.ajax({
        type: "POST",
        url: "eliminar_clientes.php",
        data: "id_cliente=" + $("#id_cliente").val(),
        success: function(data) {
            var val = data;
            if (val == 1) {
                alertify.error('Error.. El Cliente tiene movimientos en el sistema');						    		
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }else{
                alertify.success('Cliente Eliminado Correctamente');						    		
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        }
    });  
}

function cancelar(){
    $("#seguro").dialog("close");   
    $("#clave_permiso").dialog("close");    
    $("#clave").val("");    
}

function cancelar_acceso(){
    $("#clave_permiso").dialog("close");     
    $("#clave").val("");
}

function nuevo_cliente() {
    location.reload();
}

function ValidNum() {
    if (event.keyCode < 48 || event.keyCode > 57) {
        event.returnValue = false;
    }
    return true;
}

function Num_Let() {
    if ((event.keyCode !== 32) && (event.keyCode < 65) || (event.keyCode > 90) && (event.keyCode < 97) || (event.keyCode > 122)) {
        event.returnValue = false;
    }
    return true;
}

function punto(e){
    var key;
    if (window.event) {
        key = e.keyCode;
    }
    else if (e.which) {
        key = e.which;
    }

    if (key < 48 || key > 57) {
        if (key === 46 || key === 8)     {
            return true;
        } else {
            return false;
        }
    }
    return true;   
}

function inicio() {
    $("[data-mask]").inputmask();
    alertify.set({ delay: 1000 });    
    $("#ruc_ci").focus();
    $("#ruc_ci").attr("maxlength", "10");
    $("#ruc_ci").keypress(ValidNum);
    $("#nro_telefono").validCampoFranz("0123456789");
    $("#nro_celular").validCampoFranz("0123456789");
    
    $("#cupo_credito").on("keypress",punto);
    
    $("#tipo_docu").change(function() {
        if ($("#tipo_docu").val() === "Cedula") {
            $("#ruc_ci").val("");
            $("#ruc_ci").keypress(ValidNum);
            $("#ruc_ci").removeAttr("disabled");
            $("#ruc_ci").attr("maxlength", "10");

        } else {
            if ($("#tipo_docu").val() === "Ruc") {
                $("#ruc_ci").val("");
                $("#ruc_ci").keypress(ValidNum);
                $("#ruc_ci").removeAttr("disabled");
                $("#ruc_ci").removeAttr("maxlength");
                $("#ruc_ci").attr("maxlength", "13");
            } else {
                if ($("#tipo_docu").val() === "Pasaporte") {
                    $("#ruc_ci").val("");
                    $("#ruc_ci").unbind("keypress");
                    $("#ruc_ci").removeAttr("disabled");
                    $("#ruc_ci").attr("maxlength", "30");
                }
            }
        }
    });
    
    $("#ruc_ci").keyup(function() {
        $.ajax({
            type: "POST",
            url: "comparar_cedulas.php",
            data: "cedula=" + $("#ruc_ci").val() + "&tipo_docu=" + $("#tipo_docu").val(),
            success: function(data) {
                var val = data;
                if (val == 1) {
                    $("#ruc_ci").val("");
                    $("#ruc_ci").focus();
                    alertify.error("Error... El cliente esta registrado");
                }else{
                    var numero = $("#ruc_ci").val();
                    var suma = 0;      
                    var residuo = 0;      
                    var pri = false;      
                    var pub = false;            
                    var nat = false;                     
                    var modulo = 11;
                    var p1;
                    var p2;
                    var p3;
                    var p4;
                    var p5;
                    var p6;
                    var p7;
                    var p8;            
                    var p9; 
                    var d1  = numero.substr(0,1);         
                    var d2  = numero.substr(1,1);         
                    var d3  = numero.substr(2,1);         
                    var d4  = numero.substr(3,1);         
                    var d5  = numero.substr(4,1);         
                    var d6  = numero.substr(5,1);         
                    var d7  = numero.substr(6,1);         
                    var d8  = numero.substr(7,1);         
                    var d9  = numero.substr(8,1);         
                    var d10 = numero.substr(9,1);  

                    if (d3 < 6){           
                        nat = true;            
                        p1 = d1 * 2;
                        if (p1 >= 10) p1 -= 9;
                        p2 = d2 * 1;
                        if (p2 >= 10) p2 -= 9;
                        p3 = d3 * 2;
                        if (p3 >= 10) p3 -= 9;
                        p4 = d4 * 1;
                        if (p4 >= 10) p4 -= 9;
                        p5 = d5 * 2;
                        if (p5 >= 10) p5 -= 9;
                        p6 = d6 * 1;
                        if (p6 >= 10) p6 -= 9; 
                        p7 = d7 * 2;
                        if (p7 >= 10) p7 -= 9;
                        p8 = d8 * 1;
                        if (p8 >= 10) p8 -= 9;
                        p9 = d9 * 2;
                        if (p9 >= 10) p9 -= 9;             
                        modulo = 10;
                    } else if(d3 == 6){           
                        pub = true;             
                        p1 = d1 * 3;
                        p2 = d2 * 2;
                        p3 = d3 * 7;
                        p4 = d4 * 6;
                        p5 = d5 * 5;
                        p6 = d6 * 4;
                        p7 = d7 * 3;
                        p8 = d8 * 2;            
                        p9 = 0;            
                    } else if(d3 == 9) {          
                        pri = true;                                   
                        p1 = d1 * 4;
                        p2 = d2 * 3;
                        p3 = d3 * 2;
                        p4 = d4 * 7;
                        p5 = d5 * 6;
                        p6 = d6 * 5;
                        p7 = d7 * 4;
                        p8 = d8 * 3;
                        p9 = d9 * 2;            
                    }

                    suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;                
                    residuo = suma % modulo;                                         

                    var digitoVerificador = residuo==0 ? 0: modulo - residuo; 
                    
                    if ($("#tipo_docu option:selected").text() === "Cedula") {
                        if (numero.length === 10) {
                            if(nat == true){
                                if (digitoVerificador != d10){  
                                    alertify.error('El número de cédula es incorrecto.');
                                    $("#ruc_ci").val("");
                                }else{
                                    if($("#ruc_ci").val() === "0000000000"){
                                        alertify.error('El número de cédula es incorrecto.');
                                        $("#ruc_ci").val("");
                                        }else{
                                            alertify.success('El número de cédula es correcto.');
                                    }
                                }
                            }
                        }
                    }else{
                        if ($("#tipo_docu option:selected").text() === "Ruc") {
                            var ruc = numero.substr(10,13);
                            var digito3 = numero.substring(2,3);

                            if(ruc == "001" ){
                                if(digito3 < 6){ 
                                    if(nat == true){
                                     if (digitoVerificador != d10){                          
                                      alertify.error('El ruc persona natural es incorrecto.');
                                      $("#ruc_ci").val("");
                                      }else{
                                       alertify.success('El ruc persona natural es correcto.');    
                                      } 
                                    }
                                }else{
                                    if(digito3 == 6){ 
                                        if (pub==true){  
                                            if (digitoVerificador != d9){                          
                                                alertify.error('El ruc público es incorrecto.');
                                                $("#ruc_ci").val("");
                                            }else{
                                                alertify.success('El ruc público es correcto.'); 
                                            } 
                                        }
                                    }else{
                                        if(digito3 == 9){
                                            if(pri == true){
                                                if (digitoVerificador != d10){                          
                                                    alertify.error('El ruc privado es incorrecto.');
                                                    $("#ruc_ci").val("");
                                                }else{
                                                    alertify.success('El ruc privado es correcto.');      
                                                } 
                                            }
                                        } 
                                    }
                                }
                            }else{
                                if(numero.length === 13){
                                    alertify.error('El ruc es incorrecto.'); 
                                    $("#ruc_ci").val("");
                                }
                            }
                        }
                    }
                }
            }
        });
    });
    
    $("#btnGuardar").click(function(e) {
        e.preventDefault();
    });
    $("#btnModificar").click(function(e) {
        e.preventDefault();
    });
    $("#btnBuscar").click(function(e) {
        e.preventDefault();
    });
    $("#btnEliminar").click(function(e) {
        e.preventDefault();
    });
    $("#btnNuevo").click(function(e) {
        e.preventDefault();
    });
    $("#btnCuenta").click(function(e) {
        e.preventDefault();
    });

    $("#btnGuardar").on("click", guardar_cliente);
    $("#btnModificar").on("click", modificar_cliente);
    $("#btnBuscar").on("click", abrirDialogo);
    $("#btnEliminar").on("click", eliminar_cliente);
    $("#btnAceptar").on("click", aceptar);
    $("#btnSalir").on("click", cancelar);
    $("#btnAcceder").on("click", validar_acceso);
    $("#btnCancelar").on("click", cancelar_acceso);
    $("#btnNuevo").on("click", nuevo_cliente);
    $("#btnCuenta").on("click", abrirCuenta);

    $("#clientes").dialog(dialogo);
    $("#cuentas").dialog(dialogo_cuenta);
    $("#clave_permiso").dialog(dialogo3);
    $("#seguro").dialog(dialogo4);

    jQuery("#list").jqGrid({
        url: 'datos_clientes.php',
        datatype: 'xml',
        colNames: ['Codigo', 'Tipo Documento', 'Identificacion', 'Nombres', 'Tipo Cliente', 'Fijo', 'Movil', 'Pais', 'Ciudad', 'Direccion', 'Correo', 'Credito', 'Nota'],
        colModel: [
            {name: 'id_cliente', index: 'id_cliente', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'tipo_docu', index: 'tipo_docu', editable: true, align: 'center', width: '120', search: false, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'ruc_ci', index: 'ruc_ci', editable: true, align: 'center', width: '120', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'nombres_cli', index: 'nombres_cli', editable: true, align: 'center', width: '120', search: true, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'tipo_cli', index: 'tipo_cli', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'nro_telefono', index: 'nro_telefono', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'nro_celular', index: 'nro_celular', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'pais_cli', index: 'pais_cli', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'ciudad_cli', index: 'ciudad_cli', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'direccion_cli', index: 'direccion_cli', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'email', index: 'email', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'cupo_credito', index: 'cupo_credito', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'notas_cli', index: 'notas_cli', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}}
        ],
        rowNum: 10,
        width: 830,
        height: 200,
        rowList: [10, 20, 30],
        pager: jQuery('#pager'),
        sortname: 'id_cliente',
        shrinkToFit: false,
        sortorder: 'asc',
        caption: 'Lista de Clientes',        
        viewrecords: true,
        ondblClickRow: function(){
         var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
         jQuery('#list').jqGrid('restoreRow', id);   
         jQuery("#list").jqGrid('GridToForm', id, "#clientes_form");
         $("#btnGuardar").attr("disabled", true);
         $("#clientes").dialog("close");    
        }
    }).jqGrid('navGrid', '#pager',
            {
                add: false,
                edit: false,
                del: false,
                refresh: true,
                search: true,
                view: true
            },
    {
        recreateForm: true, closeAfterEdit: true, checkOnUpdate: true, reloadAfterSubmit: true, closeOnEscape: true
    },
    {
        reloadAfterSubmit: true, closeAfterAdd: true, checkOnUpdate: true, closeOnEscape: true,
        bottominfo: "Todos los campos son obligatorios son obligatorios"
    },
    {
        width: 300, closeOnEscape: true
    },
    {
        closeOnEscape: true,        
        multipleSearch: false, overlay: false
    },
    {
    },
        {
            closeOnEscape: true
        }
    );    
    jQuery("#list").jqGrid('navButtonAdd', '#pager', {caption: "Añadir",
        onClickButton: function() {
            var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
            jQuery('#list').jqGrid('restoreRow', id);
            if (id) {
                jQuery("#list").jqGrid('GridToForm', id, "#clientes_form");
                $("#btnGuardar").attr("disabled", true);
                $("#clientes").dialog("close");
            } else {
                alertify.alert("Seleccione un fila");
            }
        }
    });
}

