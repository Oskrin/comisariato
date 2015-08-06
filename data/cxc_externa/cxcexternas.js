$(document).on("ready", inicio);
function evento(e) {
    e.preventDefault();
}

function openPDF(){
window.open('../../ayudas/ayuda.pdf');
}

var dialogos =
{
    autoOpen: false,
    resizable: false,
    width: 860,
    height: 560,
    modal: true
};

var dialogo2 =
{
    autoOpen: false,
    resizable: false,
    width: 800,
    height: 350,
    modal: true,
    // position: "top",
    show: "explode",
    hide: "blind"    
}

function abrirDialogo(e) {
    e.preventDefault();
    $("#prod").dialog("open");

}

function scrollToBottom() {
    $('html, body').animate({
        scrollTop: $(document).height()
    }, 'slow');
}
function scrollToTop() {
    $('html, body').animate({
        scrollTop: 0
    }, 'slow');
}

function show() {
    var Digital = new Date();
    var hours = Digital.getHours();
    var minutes = Digital.getMinutes();
    var seconds = Digital.getSeconds();
    var dn = "AM";
    if (hours > 12) {
        dn = "PM";
        hours = hours - 12;
    }
    if (hours === 0)
        hours = 12;
    if (minutes <= 9)
        minutes = "0" + minutes;
    if (seconds <= 9)
        seconds = "0" + seconds;
    $("#hora_actual").val(hours + ":" + minutes + ":" + seconds + " " + dn);

    setTimeout("show()", 1000);
}

function enter(e) {
    if (e.which === 13 || e.keyCode === 13) {
        comprobar();
        return false;
    }
    return true;
}

function comprobar() {
    if ($("#id_cliente").val() === "") {
        $("#ruc_ci").focus();
        alertify.error("Ingrese un cliente");
    } else {
        if ($("#num_factura").val() === "") {
            $("#num_factura").focus();
            alertify.error("Ingrese Factura Preimpresa");
        }else{
            if ($("#tipo_documento").val() === "") {
                $("#tipo_documento").focus();
                alertify.error("Seleccione tipo Documento");
            }else{
                if ($("#total").val() === "") {
                    $("#total").focus();
                    alertify.error("Ingrese el total de la factura");
                }
            }
        }
    }
}


function guardar_cuenta() {
    if ($("#id_cliente").val() === "") {
        $("#ruc_ci").focus();
        alertify.error("Ingrese un cliente");
    } else {
        if ($("#num_factura").val() === "") {
            $("#num_factura").focus();
            alertify.error("Ingrese Factura Preimpresa");
        }else{
            $.ajax({
                type: "POST",
                url: "comparar_num_venta.php",
                data: "num_fac=" + $("#num_factura").val(),
                success: function(data) {
                    var val = data;
                    if (val == 1) {
                        $("#num_factura").val("");
                        $("#num_factura").focus();
                        alertify.error("Error... El número de factura ya existe");
                    }else{
                        if ($("#tipo_documento").val() === "") {
                            $("#tipo_documento").focus();
                            alertify.error("Seleccione tipo Documento");
                        }else{
                            if ($("#total").val() === "") {
                                $("#total").focus();
                                alertify.error("Ingrese el total de la factura");
                            }else{
                                $.ajax({
                                    type: "POST",
                                    url: "guardar_cxcexternas.php",
                                    data: "id_cliente=" + $("#id_cliente").val() + "&comprobante=" + $("#comprobante").val() + "&fecha_actual=" + $("#fecha_actual").val() + "&hora_actual=" + $("#hora_actual").val() + "&num_factura=" + $("#num_factura").val() + "&tipo_documento=" + $("#tipo_documento").val() + "&total=" + $("#total").val(),
                                    success: function(data) {
                                        val = data;
                                        if (val == 1) {
                                            alertify.alert("Registro Guardado correctamente", function(){ location.reload();});
                                        }
                                    }
                                });
                            }
                        }
                    }
                }
            });
        }
    }
}

function flecha_atras(){
  $.ajax({
        type: "POST",
        url: "../../procesos/flechas.php",
        data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "c_cobrarexternas" + "&id_tabla=" + "id_c_cobrarexternas" + "&tipo=" + 1,
        success: function(data) {
            var val = data;
            if(val != ""){
                $("#comprobante").val(val);
                var valor = $("#comprobante").val();
                
                 /////////////////////////////////////////////////
                $("#btnGuardar").attr("disabled", true);
                $("#btnModificar").attr("disabled", true);
                $("#ruc_ci").attr("disabled", "disabled");
                $("#nombres_completos").attr("disabled", "disabled");
                $("#num_factura").attr("disabled", "disabled");
                $("#total").attr("disabled", "disabled");
                $("#id_cliente").val("");
                $("#ruc_ci").val("");
                $("#nombres_completos").val("");
                $("#num_factura").val("");
                $("#total").val("");
                
                 ///////////////////llamar cuentas flechas primera parte/////
                $.getJSON('retornar_cuentas_externas.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 10) {
                            $("#fecha_actual").val(data[i]);
                            $("#hora_actual").val(data[i + 1 ]);
                            $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ] );
                            $("#id_cliente").val(data[i + 4]);
                            $("#ruc_ci").val(data[i + 5]);
                            $("#nombres_completos").val(data[i + 6]);
                            $("#num_factura").val(data[i + 7]);
                            $("#tipo_documento").val(data[i + 8]);
                            $("#total").val(data[i + 9]);
                        }
                    }
                });
            }else{
                alertify.alert("No hay mas registros posteriores!!");
            }
        }
    });
}

function flecha_siguiente(){
   $.ajax({
        type: "POST",
        url: "../../procesos/flechas.php",
        data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "c_cobrarexternas" + "&id_tabla=" + "id_c_cobrarexternas" + "&tipo=" + 2,
        success: function(data) {
            var val = data;
            if(val != ""){
                $("#comprobante").val(val);
                var valor = $("#comprobante").val();
                
                //////////////////////////////////////////////////
                $("#btnGuardar").attr("disabled", true);
                $("#btnModificar").attr("disabled", true);
                $("#ruc_ci").attr("disabled", "disabled");
                $("#nombres_completos").attr("disabled", "disabled");
                $("#num_factura").attr("disabled", "disabled");
                $("#total").attr("disabled", "disabled");
                $("#id_cliente").val("");
                $("#ruc_ci").val("");
                $("#nombres_completos").val("");
                $("#num_factura").val("");
                $("#total").val("");                
                
                $.getJSON('retornar_cuentas_externas.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 10) {
                            $("#fecha_actual").val(data[i]);
                            $("#hora_actual").val(data[i + 1 ]);
                            $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ] );
                            $("#id_cliente").val(data[i + 4]);
                            $("#ruc_ci").val(data[i + 5]);
                            $("#nombres_completos").val(data[i + 6]);
                            $("#num_factura").val(data[i + 7]);
                            $("#tipo_documento").val(data[i + 8]);
                            $("#total").val(data[i + 9]);
                        }
                    }
                });
                }else{
                alertify.alert("No hay mas registros superiores!!");
            }
        }
    });
}

function limpiar_campo(){
    if($("#ruc_ci").val() === ""){
        $("#id_cliente").val("");
        $("#nombres_completos").val("");
        $("#saldo").val("");
    }
}

function limpiar_campo2(){
    if($("#nombres_completos").val() === ""){
        $("#id_cliente").val("");
        $("#ruc_ci").val("");
        $("#saldo").val("");
    }
}

function limpiar_cuenta(){
    location.reload(); 
}

function punto(e){
 var key;
if (window.event) {
    key = e.keyCode;
} else if (e.which) {
    key = e.which;
}

if (key < 48 || key > 57) {
    if (key === 46 || key === 8) {
        return true;
    } else {
        return false;
    }
}
return true;   
}

function inicio() {
    alertify.set({ delay: 1000 });
    $("[data-mask]").inputmask();
    show();
    
    $("#btnGuardar").click(function(e) {
        e.preventDefault();
    });
    $("#btnModificar").click(function(e) {
        e.preventDefault();
    });
    $("#btnNuevo").click(function(e) {
        e.preventDefault();
    });
    $("#btnAtras").click(function(e) {
        e.preventDefault();
    });
    $("#btnAdelante").click(function(e) {
        e.preventDefault();
    });

    $("#btnGuardar").on("click", guardar_cuenta);
    $("#btnNuevo").on("click", limpiar_cuenta);
    $("#btnAtras").on("click", flecha_atras);
    $("#btnAdelante").on("click", flecha_siguiente);

    /////////////////////////// 
    $("#buscar_cartera_cobrar").dialog(dialogo2);
    $("#btnBuscar").click(function(e) {
        e.preventDefault();
        $("#buscar_cartera_cobrar").dialog("open");   
    });
    
    $("#ruc_ci").on("keyup", limpiar_campo);
    $("#nombres_completos").on("keyup", limpiar_campo2);
    $("#ruc_ci").on("keypress", enter);
    $("#num_factura").on("keypress", enter);
    $("#total").on("keypress", enter);
    
    
    $("#num_factura").attr("maxlength", "20");
     
    $("#total").on("keypress",punto);
    
    $("#ruc_ci").autocomplete({
        source: "buscar_cliente2.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#ruc_ci").val(ui.item.value);
        $("#nombres_completos").val(ui.item.nombres_completos);
        $("#id_cliente").val(ui.item.id_cliente);
        $("#saldo").val(ui.item.saldo);
        return false;
        },
        select: function(event, ui) {
        $("#ruc_ci").val(ui.item.value);
        $("#nombres_completos").val(ui.item.nombres_completos);
        $("#id_cliente").val(ui.item.id_cliente);
        $("#saldo").val(ui.item.saldo);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    
    $("#nombres_completos").autocomplete({
        source: "buscar_cliente_pagos.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#nombres_completos").val(ui.item.value);
        $("#ruc_ci").val(ui.item.ruc_ci);
        $("#id_cliente").val(ui.item.id_cliente);
        $("#saldo").val(ui.item.saldo);
        return false;
        },
        select: function(event, ui) {
        $("#nombres_completos").val(ui.item.value);
        $("#ruc_ci").val(ui.item.ruc_ci);
        $("#id_cliente").val(ui.item.id_cliente);
        $("#saldo").val(ui.item.saldo);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };

    $('#fecha_actual').datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');

    jQuery("#list2").jqGrid({
        url: 'xmlBuscarCuentasExternasCobrar.php',
        datatype: 'xml',
        colNames: ['ID','IDENTIFICACIÓN','CLIENTE', 'FACTURA NRO.','MONTO TOTAL','FECHA'],
        colModel: [
           {name: 'id_c_cobrarexternas', index: 'id_c_cobrarexternas', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 50},
           {name: 'identificacion', index: 'identificacion', editable: false, search: true, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 150},
           {name: 'nombres_cli', index: 'nombres_cli', editable: true, search: true, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 200},
           {name: 'num_factura', index: 'num_factura', editable: true, search: true, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 200},
           {name: 'total', index: 'total', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 100},
           {name: 'fecha_nota', index: 'fecha_nota', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 100},
        ],
        rowNum: 30,
        width: 750,
        height:220,
        sortable: true,
        rowList: [10, 20, 30],
        pager: jQuery('#pager2'),
        sortname: 'id_c_cobrarexternas',
        sortorder: 'asc',
        viewrecords: true,              
        ondblClickRow: function(){
            var id = jQuery("#list2").jqGrid('getGridParam', 'selrow');
            jQuery('#list2').jqGrid('restoreRow', id);
        
            if (id) {
                var ret = jQuery("#list2").jqGrid('getRowData', id);
                var valor = ret.id_c_cobrarexternas;
                /////////////agregregar cuentas cobrar////////
                $("#comprobante").val(valor);
                $("#btnGuardar").attr("disabled", true);
                $("#btnModificar").attr("disabled", true);
                $("#ruc_ci").attr("disabled", "disabled");
                $("#nombres_completos").attr("disabled", "disabled");
                $("#num_factura").attr("disabled", "disabled");
                $("#total").attr("disabled", "disabled");
                $("#id_cliente").val("");
                $("#ruc_ci").val("");
                $("#nombres_completos").val("");
                $("#num_factura").val("");
                $("#total").val("");
                $.getJSON('retornar_cuentas_externas.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 10)
                        {
                            $("#fecha_actual").val(data[i]);
                            $("#hora_actual").val(data[i + 1 ]);
                            $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ] );
                            $("#id_cliente").val(data[i + 4]);
                            $("#ruc_ci").val(data[i + 5]);
                            $("#nombres_completos").val(data[i + 6]);
                            $("#num_factura").val(data[i + 7]);
                            $("#tipo_documento").val(data[i + 8]);
                            $("#total").val(data[i + 9]);
                        }
                    }
                });
                $("#buscar_cartera_cobrar").dialog("close");
            } else {
              alertify.alert("Seleccione una Cuenta");
            }
        }
        
    }).jqGrid('navGrid', '#pager2',
    {
        add: false,
        edit: false,
        del: false,
        refresh: true,
        search: true,
        view: true
    },{
        recreateForm: true, 
        closeAfterEdit: true, 
        checkOnUpdate: true, 
        reloadAfterSubmit: true, 
        closeOnEscape: true
    },
    {
        reloadAfterSubmit: true, 
        closeAfterAdd: true, 
        checkOnUpdate: true, 
        closeOnEscape: true,
        bottominfo: "Todos los campos son obligatorios son obligatorios"
    },
    {
        width: 300, 
        closeOnEscape: true
    },
    {
        closeOnEscape: true,        
        multipleSearch: false, 
        overlay: false
    },
    {
    },
    {
        closeOnEscape: true
    });
        
    jQuery("#list2").jqGrid('navButtonAdd', '#pager2', {
        caption: "Añadir",
        onClickButton: function() {
            var id = jQuery("#list2").jqGrid('getGridParam', 'selrow');
            jQuery('#list2').jqGrid('restoreRow', id);
            if (id) {
                var ret = jQuery("#list2").jqGrid('getRowData', id);
                var valor = ret.id_c_cobrarexternas;
                /////////////agregregar cuentas cobrar////////
                $("#comprobante").val(valor);
                $("#btnGuardar").attr("disabled", true);
                $("#btnModificar").attr("disabled", true);
                $("#ruc_ci").attr("disabled", "disabled");
                $("#nombres_completos").attr("disabled", "disabled");
                $("#num_factura").attr("disabled", "disabled");
                $("#total").attr("disabled", "disabled");
                $("#id_cliente").val("");
                $("#ruc_ci").val("");
                $("#nombres_completos").val("");
                $("#num_factura").val("");
                $("#total").val("");
                $.getJSON('retornar_cuentas_externas.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 10)
                        {
                            $("#fecha_actual").val(data[i]);
                            $("#hora_actual").val(data[i + 1 ]);
                            $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ] );
                            $("#id_cliente").val(data[i + 4]);
                            $("#ruc_ci").val(data[i + 5]);
                            $("#nombres_completos").val(data[i + 6]);
                            $("#num_factura").val(data[i + 7]);
                            $("#tipo_documento").val(data[i + 8]);
                            $("#total").val(data[i + 9]);
                        }
                    }
                });
                $("#buscar_cartera_cobrar").dialog("close");
            } else {
              alertify.alert("Seleccione una Cuenta");
            }
        }
    });
}



