$(document).on("ready", inicio);
function evento(e) {
    e.preventDefault();
}

function openPDF(){
window.open('../../ayudas/ayuda.pdf');
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

function autocompletar() {
    var temp = "";
    var serie = $("#serie3").val();
    for (var i = serie.length; i < 9; i++) {
        temp = temp + "0";
    }
    return temp;
}

function comprobar() {
    if ($("#tipo_docu").val() === "") {
        $("#tipo_docu").focus();
        alertify.alert("Seleccione tipo documento");
    } else {
        if ($("#empresa").val() === "") {
            $("#ruc_ci").focus();
            alertify.alert("Indique una empresa");
        } else {
            if ($("#tipo_comprobante").val() === "") {
                $("#tipo_comprobante").focus();
                alertify.alert("Seleccione tipo comprobante");
            } else {
                if ($("#serie1").val() === "") {
                    $("#serie1").focus();
                } else {
                    if ($("#serie2").val() === "") {
                        $("#serie2").focus();
                    } else {
                        if ($("#serie3").val() === "") {
                            $("#serie3").focus();
                        } else {
                            if($("#serie1").val() != "" && $("#serie2").val() != "" && $("#serie3").val() != ""){
                                var a = autocompletar($("#serie3").val());
                                $("#serie3").val(a + "" + $("#serie3").val());
                                $("#tipo_documento").focus();
                            }else{
                                if ($("#total").val() === "") {
                                    $("#total").focus();
                                    alertify.alert("Ingrese el total de la factura");
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function guardar_gasto() {
    if ($("#tipo_docu").val() === "") {
        $("#tipo_docu").focus();
        alertify.error("Seleccione tipo documento");
    } else {
        if ($("#empresa").val() === "") {
            $("#ruc_ci").focus();
            alertify.error("Indique una empresa");
        } else {
            if ($("#num_factura").val() === "") {
                $("#num_factura").focus();
                alertify.error("Ingrese el numero de la factura");
            } else {
                if ($("#descripcion").val() === "") {
                    $("#descripcion").focus();
                    alertify.error("Ingrese la descripción");
                }else{
                    if ($("#total").val() === "") {
                        $("#total").focus();
                        alertify.error("Ingrese el total del gasto");
                    }else{
                        $.ajax({
                            type: "POST",
                            url: "guardar_gastos_internos.php",
                            data: "id_proveedor=" + $("#id_proveedor").val() + "&comprobante=" + $("#comprobante").val() + "&fecha_actual=" + $("#fecha_actual").val() + "&hora_actual=" + $("#hora_actual").val() + "&num_factura=" + $("#num_factura").val() + "&descripcion=" + $("#descripcion").val() + "&total=" + $("#total").val(),
                            success: function(data) {
                                var val = data;
                                if (val == 1) {
                                    alertify.alert("Registro Guardado correctamente", function(){
                                    window.open("../../reportes/reporte_gasto.php?id="+$("#comprobante").val(),'_blank');    
                                    location.reload();
                                    });
                                }
                            }
                        });
                    }
                }
            }
        }
    }
}

function flecha_atras(){
 $.ajax({
        type: "POST",
        url: "../../procesos/flechas.php",
        data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "gastos_internos" + "&id_tabla=" + "id_gastos" + "&tipo=" + 1,
        success: function(data) {
            var val = data;
            if(val != ""){
                $("#comprobante").val(val);
                var valor = $("#comprobante").val();
                
                 ///////////////////llamar gastos internos/////
                $("#btnGuardar").attr("disabled", true);
                $("#btnModificar").attr("disabled", true);
                $("#tipo_docu").attr("disabled", "disabled");
                $("#ruc_ci").attr("disabled", "disabled");
                $("#nombres_completos").attr("disabled", "disabled");
                $("#num_factura").attr("disabled", "disabled");
                $("#descripcion").attr("disabled", "disabled");
                $("#total").attr("disabled", "disabled");
                $("#id_proveedor").val("");
                $("#ruc_ci").val("");
                $("#empresa").val("");
                $("#num_factura").val("");
                $("#descripcion").val("");
                $("#total").val("");
                
                $.getJSON('retornar_gastos_internos.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 11)
                        {
                            $("#fecha_actual").val(data[i]);
                            $("#hora_actual").val(data[i + 1 ]);
                            $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ] );
                            $("#tipo_docu").val(data[i + 4]);
                            $("#id_proveedor").val(data[i + 5]);
                            $("#ruc_ci").val(data[i + 6]);
                            $("#empresa").val(data[i + 7]);
                            $("#num_factura").val(data[i + 8]);
                            $("#descripcion").val(data[i + 9]);
                            $("#total").val(data[i + 10]);
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
        data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "gastos_internos" + "&id_tabla=" + "id_gastos" + "&tipo=" + 2,
        success: function(data) {
            var val = data;
            if(val != ""){
                $("#comprobante").val(val);
                var valor = $("#comprobante").val();
                
                //////////////////////////////////////////
                $("#btnGuardar").attr("disabled", true);
                $("#btnModificar").attr("disabled", true);
                $("#tipo_docu").attr("disabled", "disabled");
                $("#ruc_ci").attr("disabled", "disabled");
                $("#nombres_completos").attr("disabled", "disabled");
                $("#num_factura").attr("disabled", "disabled");
                $("#descripcion").attr("disabled", "disabled");
                $("#total").attr("disabled", "disabled");
                $("#id_proveedor").val("");
                $("#ruc_ci").val("");
                $("#empresa").val("");
                $("#num_factura").val("");
                $("#descripcion").val("");
                $("#total").val("");
                
                ///////////////////llamar gastos internos/////
                $.getJSON('retornar_gastos_internos.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 11)
                        {
                        $("#fecha_actual").val(data[i]);
                        $("#hora_actual").val(data[i + 1 ]);
                        $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ] );
                        $("#tipo_docu").val(data[i + 4]);
                        $("#id_proveedor").val(data[i + 5]);
                        $("#ruc_ci").val(data[i + 6]);
                        $("#empresa").val(data[i + 7]);
                        $("#num_factura").val(data[i + 8]);
                        $("#descripcion").val(data[i + 9]);
                        $("#total").val(data[i + 10]);
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
        $("#id_proveedor").val("");
        $("#empresa").val("");
    }
}

function limpiar_cuenta(){
    location.reload(); 
}

function inicio() {
    alertify.set({ delay: 1000 });
    //////////////para hora///////////
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

    $("#btnGuardar").on("click", guardar_gasto);
    $("#btnNuevo").on("click", limpiar_cuenta);
    $("#btnAtras").on("click", flecha_atras);
    $("#btnAdelante").on("click", flecha_siguiente);
    $("#ruc_ci").on("keyup", limpiar_campo);
    /////////////////////////////////
    $("#num_factura").attr("maxlength", "20");
       
    $("#buscar_gastos_internos").dialog(dialogo2);
    $("#btnBuscar").click(function(e) {
        e.preventDefault();
        $("#buscar_gastos_internos").dialog("open");   
    });
    /////////////////////////// 

    $("#ruc_ci").attr("disabled", "disabled");
    $("#empresa").attr("disabled", "disabled");
    /////////////////////////////////

    ///////////calendarios/////
    $('#fecha_actual').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    $("#total").keypress(function(e) {
        var key;
        if (window.event)
        {
            key = e.keyCode;
        }
        else if (e.which)
        {
            key = e.which;
        }

        if (key < 48 || key > 57)
        {
            if (key === 46 || key === 8)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        return true;
    });

    $("#tipo_docu").change(function() {
        var tipo = $("#tipo_docu").val();
        if (tipo === "Cedula") {
            $("#ruc_ci").validCampoFranz("0123456789");
            $("#ruc_ci").removeAttr("disabled");
            $("#ruc_ci").attr("maxlength", "10");
            $("#ruc_ci").autocomplete({
                source: "buscar_empresa.php?tipo_docu=" + tipo,
                minLength: 1,
                focus: function(event, ui) {
                $("#ruc_ci").val(ui.item.value);
                $("#empresa").val(ui.item.empresa);
                $("#id_proveedor").val(ui.item.id_proveedor);
                return false;
                },
                select: function(event, ui) {
                $("#ruc_ci").val(ui.item.value);
                $("#empresa").val(ui.item.empresa);
                $("#id_proveedor").val(ui.item.id_proveedor);
                return false;
                }

                }).data("ui-autocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                .append("<a>" + item.value + "</a>")
                .appendTo(ul);
            };
            //////////////////////////////
            $("#ruc_ci").val("");
            $("#empresa").val("");
            $("#id_proveedor").val("");
        } else {
            if (tipo === "Ruc") {
                $("#ruc_ci").validCampoFranz("0123456789");
                $("#ruc_ci").removeAttr("disabled");
                $("#ruc_ci").removeAttr("maxlength");
                $("#ruc_ci").attr("maxlength", "13");
                $("#ruc_ci").autocomplete({
                    source: "buscar_empresa.php?tipo_docu=" + tipo,
                    minLength: 1,
                    focus: function(event, ui) {
                    $("#ruc_ci").val(ui.item.value);
                    $("#empresa").val(ui.item.empresa);
                    $("#id_proveedor").val(ui.item.id_proveedor);
                    return false;
                    },
                    select: function(event, ui) {
                    $("#ruc_ci").val(ui.item.value);
                    $("#empresa").val(ui.item.empresa);
                    $("#id_proveedor").val(ui.item.id_proveedor);
                    return false;
                    }

                    }).data("ui-autocomplete")._renderItem = function(ul, item) {
                    return $("<li>")
                    .append("<a>" + item.value + "</a>")
                    .appendTo(ul);
                };
                //////////////////////////////
                $("#ruc_ci").val("");
                $("#empresa").val("");
                $("#id_proveedor").val("");
            } else {
                if (tipo === "Pasaporte") {
                    $("#ruc_ci").unbind("keypress");
                    $("#ruc_ci").removeAttr("disabled");
                    $("#ruc_ci").attr("maxlength", "30");
                    $("#ruc_ci").autocomplete({
                        source: "buscar_empresa.php?tipo_docu=" + tipo,
                        minLength: 1,
                        focus: function(event, ui) {
                        $("#ruc_ci").val(ui.item.value);
                        $("#empresa").val(ui.item.empresa);
                        $("#id_proveedor").val(ui.item.id_proveedor);
                        return false;
                        },
                        select: function(event, ui) {
                        $("#ruc_ci").val(ui.item.value);
                        $("#empresa").val(ui.item.empresa);
                        $("#id_proveedor").val(ui.item.id_proveedor);
                        return false;
                        }

                        }).data("ui-autocomplete")._renderItem = function(ul, item) {
                        return $("<li>")
                        .append("<a>" + item.value + "</a>")
                        .appendTo(ul);
                    };
                    //////////////////////////////
                    $("#ruc_ci").val("");
                    $("#empresa").val("");
                    $("#id_proveedor").val("");
                }
            }
        }
    });
    
    ///////////calendarios/////
    $('#fecha_actual').datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');
    
       ////////////////////tabla facturas compra/////////////////////////
        jQuery("#list2").jqGrid({
        url: 'xmlBuscarPagosInternos.php',
        datatype: 'xml',
        colNames: ['ID','IDENTIFICACIÓN','EMPRESA', 'FACTURA NRO.','MONTO TOTAL','FECHA'],
        colModel: [
            {name: 'id_gastos', index: 'id_gastos', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 50},
            {name: 'identificacion_pro', index: 'identificacion_pro', editable: false, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 150},
            {name: 'empresa_pro', index: 'empresa_pro', editable: true, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 200},
            {name: 'num_factura', index: 'num_factura', editable: true, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 200},
            {name: 'total', index: 'total', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 100},
            {name: 'fecha_actual', index: 'fecha_actual', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 100},
        ],
        rowNum: 30,
        width: 750,
        height:220,
        sortable: true,
        rowList: [10, 20, 30],
        pager: jQuery('#pager2'),
        sortname: 'id_gastos',
        sortorder: 'asc',
        viewrecords: true,              
        ondblClickRow: function(){
        var id = jQuery("#list2").jqGrid('getGridParam', 'selrow');
        jQuery('#list2').jqGrid('restoreRow', id);
        
        if (id) {
            var ret = jQuery("#list2").jqGrid('getRowData', id);
            var valor = ret.id_gastos;
            /////////////agregregar gastos internos////////
            $("#comprobante").val(ret.id_gastos);
            $("#btnGuardar").attr("disabled", true);
            $("#btnModificar").attr("disabled", true);
            $("#tipo_docu").attr("disabled", "disabled");
            $("#ruc_ci").attr("disabled", "disabled");
            $("#nombres_completos").attr("disabled", "disabled");
            $("#num_factura").attr("disabled", "disabled");
            $("#descripcion").attr("disabled", "disabled");
            $("#total").attr("disabled", "disabled");
            $("#id_proveedor").val("");
            $("#ruc_ci").val("");
            $("#empresa").val("");
            $("#num_factura").val("");
            $("#descripcion").val("");
            $("#total").val("");
            $.getJSON('retornar_gastos_internos.php?com=' + valor, function(data) {
                var tama = data.length;
                if (tama !== 0) {
                    for (var i = 0; i < tama; i = i + 11)
                    {
                    $("#fecha_actual").val(data[i]);
                    $("#hora_actual").val(data[i + 1 ]);
                    $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ] );
                    $("#tipo_docu").val(data[i + 4]);
                    $("#id_proveedor").val(data[i + 5]);
                    $("#ruc_ci").val(data[i + 6]);
                    $("#empresa").val(data[i + 7]);
                    $("#num_factura").val(data[i + 8]);
                    $("#descripcion").val(data[i + 9]);
                    $("#total").val(data[i + 10]);
                    }
                }
            });
         $("#buscar_gastos_internos").dialog("close");
        } else {
          alertify.alert("Seleccione un Gasto Interno");
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
        });
        
       jQuery("#list2").jqGrid('navButtonAdd', '#pager2', {caption: "Añadir",
       onClickButton: function() {
        var id = jQuery("#list2").jqGrid('getGridParam', 'selrow');
        jQuery('#list2').jqGrid('restoreRow', id);
        if (id) {
           var ret = jQuery("#list2").jqGrid('getRowData', id);

            var valor = ret.id_gastos;
            /////////////agregregar datos factura////////
            $("#comprobante").val(ret.id_gastos);
            $("#btnGuardar").attr("disabled", true);
            $("#btnModificar").attr("disabled", true);
            $("#tipo_docu").attr("disabled", "disabled");
            $("#ruc_ci").attr("disabled", "disabled");
            $("#nombres_completos").attr("disabled", "disabled");
            $("#num_factura").attr("disabled", "disabled");
            $("#descripcion").attr("disabled", "disabled");
            $("#total").attr("disabled", "disabled");
            $("#id_proveedor").val("");
            $("#ruc_ci").val("");
            $("#empresa").val("");
            $("#num_factura").val("");
            $("#descripcion").val("");
            $("#total").val("");
            $.getJSON('retornar_gastos_internos.php?com=' + valor, function(data) {
                var tama = data.length;
                if (tama !== 0) {
                    for (var i = 0; i < tama; i = i + 11)
                    {
                    $("#fecha_actual").val(data[i]);
                    $("#hora_actual").val(data[i + 1 ]);
                    $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ] );
                    $("#tipo_docu").val(data[i + 4]);
                    $("#id_proveedor").val(data[i + 5]);
                    $("#ruc_ci").val(data[i + 6]);
                    $("#empresa").val(data[i + 7]);
                    $("#num_factura").val(data[i + 8]);
                    $("#descripcion").val(data[i + 9]);
                    $("#total").val(data[i + 10]);
                    }
                }
            });
            $("#buscar_gastos_internos").dialog("close");
        } else {
          alertify.alert("Seleccione un Gasto Interno");
        }
    }
  });   
}




