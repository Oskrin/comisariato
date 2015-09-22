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

var dialogo = {
    autoOpen: false,
    resizable: false,
    width: 600,
    height: 420,
    modal: true
};
        
var dialogo2 = {
    autoOpen: false,
    resizable: false,
    width: 800,
    height: 350,
    modal: true,
    position: "top",
    show: "explode",
    hide: "blind"    
}

function abrirDialogo() {
    if ($("#carga_series").val() === "") {
        alertify.error("Error... Seleccione un producto");
    } else {
        if ($("#carga_series").val() === "No") {
            $("#descuento").focus();
            alertify.error("Error... El producto no contiene series");
        } else {
            if ($("#cantidad").val() !== "") {
                $("#series").dialog("open");
            } else {
                $("#cantidad").focus();
                alertify.error("Error... Indique una cantidad");
            }
        }
    }
}

function ValidNum(e) {
    if (e.keyCode < 48 || e.keyCode > 57) {
        e.returnValue = false;
    }
    return true;
}

function enter(e) {
    if (e.which === 13 || e.keyCode === 13) {
        entrar();
        return false;
    }
    return true;
}

function enter2(e) {
    if (e.which === 13 || e.keyCode === 13) {
        comprobar();
        return false;
    }
    return true;
}

function enter3(e) {
    if (e.which === 13 || e.keyCode === 13) {
        comprobar2();
        return false;
    }
    return true;
}

function enter4(e) {
    if (e.which === 13 || e.keyCode === 13) {
        comprobar3();
        return false;
    }
    return true;
}

function enter5(e) {
    if (e.which === 13 || e.keyCode === 13) {
        comprobar4();
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

function entrar() {
    if ($("#cod_producto").val() === "") {
        $("#codigo").focus();
        alertify.error("Ingrese un producto");
    } else {
        if ($("#codigo").val() === "") {
            $("#codigo").focus();
            alertify.error("Ingrese un producto");
        } else {
            if ($("#producto").val() === "") {
                $("#producto").focus();
                alertify.error("Ingrese un producto");
            } else {
                if ($("#cantidad").val() === "") {
                    $("#cantidad").focus();
                } else {
                    if ($("#cantidad").val() === "0") {
                        $("#cantidad").focus();
                        alertify.error("Ingrese una cantidad válida");
                    } else {
                        $("#precio").focus();
                    }
                }
            }
        }
    }
}

function comprobar() {
    if ($("#cod_producto").val() === "") {
        $("#codigo").focus();
        alertify.error("Ingrese un producto");
    } else {
        if ($("#codigo").val() === "") {
            $("#codigo").focus();
            alertify.error("Ingrese un producto");
        } else {
            if ($("#producto").val() === "") {
                $("#producto").focus();
                alertify.error("Ingrese un producto");
            } else {
                if ($("#cantidad").val() === "") {
                    $("#cantidad").focus();
                } else {
                    if ($("#cantidad").val() === "0") {
                        $("#cantidad").focus();
                        alertify.error("Ingrese una cantidad válida");
                    } else {
                        if ($("#precio").val() === "") {
                            $("#precio").focus();
                            alertify.error("Ingrese un precio");
                        } else {
                            $("#descuento").focus();
                        }
                    }
                }
            }
        }
    }
}

function limpiar_campos () {
    $("#cod_producto").val("");
    $("#codigo_barras").val("");
    $("#codigo").val("");
    $("#producto").val("");
    $("#cantidad").val("");
    $("#precio").val("");
    $("#descuento").val("");
    $("#iva_producto").val("");
    $("#carga_series").val("");
    $("#incluye").val("");   
}

function comprobar2() {
    var subtotal0 = 0;
    var subtotal12 = 0;
    var iva12 = 0;
    var total_total = 0;
    var descu_total = 0;

    if ($("#cod_producto").val() === "") {
        $("#codigo").focus();
        alertify.error("Ingrese un producto");
    } else {
        if ($("#codigo").val() === "") {
            $("#codigo").focus();
            alertify.error("Ingrese un producto");
        } else {
            if ($("#producto").val() === "") {
                $("#producto").focus();
                alertify.error("Ingrese un producto");
            } else {
                if ($("#cantidad").val() === "") {
                    $("#cantidad").focus();
                    alertify.error("Ingrese una cantidad");
                } else {
                    if ($("#cantidad").val() === "0") {
                        $("#cantidad").focus();
                    } else {
                        if ($("#precio").val() === "") {
                            $("#precio").focus();
                            alertify.error("Ingrese un precio");
                        } else {

                            var filas = jQuery("#list").jqGrid("getRowData");
                            var descuento = 0;
                            var total = 0;
                            var su = 0;
                            var precio = 0;
                            var multi = 0;
                            var flotante = 0;
                            var resultado = 0;  
                            var repe = 0;

                            if (filas.length === 0) {
                                if ($("#descuento").val() !== "") {
                                    desc = $("#descuento").val();
                                    precio = (parseFloat($("#precio").val())).toFixed(3);
                                    multi = (parseFloat($("#cantidad").val()) * parseFloat($("#precio").val())).toFixed(3);
                                    descuento = ((multi * parseFloat(desc)) / 100);
                                    flotante = parseFloat(descuento);
                                    resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(3);
                                    total = (multi - resultado).toFixed(3);
                                } else {
                                    desc = 0;
                                    precio = (parseFloat($("#precio").val())).toFixed(3);
                                    multi = (parseFloat($("#cantidad").val()) * parseFloat($("#precio").val())).toFixed(3);
                                    descuento = ((multi * parseFloat(desc)) / 100);
                                    flotante = parseFloat(descuento);
                                    resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(3);
                                    total = (parseFloat($("#cantidad").val()) * precio).toFixed(3);
                                }

                                var datarow = {
                                    cod_producto: $("#cod_producto").val(), 
                                    codigo: $("#codigo").val(), 
                                    detalle: $("#producto").val(), 
                                    cantidad: $("#cantidad").val(), 
                                    precio_u: precio, 
                                    descuento: desc,
                                    cal_des: resultado, 
                                    total: total, 
                                    iva: $("#iva_producto").val(),
                                    incluye: $("#incluye").val()
                                    };

                                su = jQuery("#list").jqGrid('addRowData', $("#cod_producto").val(), datarow);
                                limpiar_campos();
                            } else {
                                for (var i = 0; i < filas.length; i++) {
                                    var id = filas[i];

                                    if (id['cod_producto'] === $("#cod_producto").val()) {
                                        repe = 1;
                                        var can = id['cantidad'];
                                    }
                                }

                                if (repe == 1) {
                                    var suma = parseInt(can) + parseInt($("#cantidad").val());

                                    if ($("#descuento").val() !== "") {
                                        desc = $("#descuento").val();
                                        precio = (parseFloat($("#precio").val())).toFixed(3);
                                        multi = (parseFloat(suma) * parseFloat($("#precio").val())).toFixed(3);
                                        descuento = ((multi * parseFloat(desc)) / 100);
                                        flotante = parseFloat(descuento);
                                        resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(3);
                                        total = (multi - resultado).toFixed(3);
                                    } else {
                                        desc = 0;
                                        precio = (parseFloat($("#precio").val())).toFixed(3);
                                        multi = (parseFloat($("#cantidad").val()) * parseFloat($("#precio").val())).toFixed(3);
                                        descuento = ((multi * parseFloat(desc)) / 100);
                                        flotante = parseFloat(descuento);
                                        resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(3);
                                        total = (parseFloat(suma) * precio).toFixed(3);
                                    }

                                    datarow = {
                                        cod_producto: $("#cod_producto").val(), 
                                        codigo: $("#codigo").val(), 
                                        detalle: $("#producto").val(), 
                                        cantidad: suma, 
                                        precio_u: precio, 
                                        descuento: desc,
                                        cal_des: resultado, 
                                        total: total, 
                                        iva: $("#iva_producto").val(),
                                        incluye: $("#incluye").val()
                                        };
                                        
                                    su = jQuery("#list").jqGrid('setRowData', $("#cod_producto").val(), datarow);
                                    limpiar_campos();
                                } else {
                                    if ($("#descuento").val() !== "") {
                                        desc = $("#descuento").val();
                                        precio = (parseFloat($("#precio").val())).toFixed(3);
                                        multi = (parseFloat($("#cantidad").val()) * parseFloat($("#precio").val())).toFixed(3);
                                        descuento = ((multi * parseFloat(desc)) / 100);
                                        flotante = parseFloat(descuento);
                                        resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(3);
                                        total = (multi - resultado).toFixed(3);
                                    } else {
                                        desc = 0;
                                        precio = (parseFloat($("#precio").val())).toFixed(3);
                                        multi = (parseFloat($("#cantidad").val()) * parseFloat($("#precio").val())).toFixed(3);
                                        descuento = ((multi * parseFloat(desc)) / 100);
                                        flotante = parseFloat(descuento);
                                        resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(3);
                                        total = (parseFloat($("#cantidad").val()) * precio).toFixed(3);
                                    }

                                    datarow = {
                                        cod_producto: $("#cod_producto").val(), 
                                        codigo: $("#codigo").val(), 
                                        detalle: $("#producto").val(), 
                                        cantidad: $("#cantidad").val(), 
                                        precio_u: precio, 
                                        descuento: desc,
                                        cal_des: resultado, 
                                        total: total, 
                                        iva: $("#iva_producto").val(),
                                        incluye: $("#incluye").val()
                                    };
                                    su = jQuery("#list").jqGrid('addRowData', $("#cod_producto").val(), datarow);
                                    limpiar_campos();
                                }
                            }   
                                                     
                            var subtotal = 0;
                            var sub = 0;
                            var sub1 = 0;
                            var sub2 = 0;
                            var iva = 0;
                            var iva1 = 0;
                            var iva2 = 0;

                            var fil = jQuery("#list").jqGrid("getRowData");
                                for (var t = 0; t < fil.length; t++) {
                                    var dd = fil[t];
                                    if (dd['iva'] === "Si") {
                                        if(dd['incluye'] == "No"){
                                            subtotal = dd['total'];
                                            sub1 = subtotal;
                                            iva1 = (sub1 * 0.12).toFixed(3);                                          

                                            subtotal0 = parseFloat(subtotal0) + 0;
                                            subtotal12 = parseFloat(subtotal12) + parseFloat(sub1);
                                            descu_total = parseFloat(descu_total) + parseFloat(dd['cal_des']);
                                            iva12 = parseFloat(iva12) + parseFloat(iva1);
                                        
                                            subtotal0 = parseFloat(subtotal0).toFixed(3);
                                            subtotal12 = parseFloat(subtotal12).toFixed(3);
                                            iva12 = parseFloat(iva12).toFixed(3);
                                            descu_total = parseFloat(descu_total).toFixed(3);
                                        } else {
                                            if(dd['incluye'] == "Si"){

                                                subtotal = dd['total'];
                                                sub2 = (subtotal / 1.12).toFixed(3);
                                                iva2 = (sub2 * 0.12).toFixed(3);

                                                subtotal0 = parseFloat(subtotal0) + 0;
                                                subtotal12 = parseFloat(subtotal12) + parseFloat(sub2);
                                                iva12 = parseFloat(iva12) + parseFloat(iva2);
                                                descu_total = parseFloat(descu_total) + parseFloat(dd['cal_des']);
                                             
                                                subtotal0 = parseFloat(subtotal0).toFixed(3);
                                                subtotal12 = parseFloat(subtotal12).toFixed(3);
                                                iva12 = parseFloat(iva12).toFixed(3);
                                                descu_total = parseFloat(descu_total).toFixed(3);
                                            }
                                        }
                                    } else {
                                        if (dd['iva'] === "No") {                                               
                                            subtotal = dd['total'];
                                            sub = subtotal;

                                            subtotal0 = parseFloat(subtotal0) + parseFloat(sub);
                                            subtotal12 = parseFloat(subtotal12) + 0;
                                            iva12 = parseFloat(iva12) + 0;
                                            descu_total = parseFloat(descu_total) + parseFloat(dd['cal_des']);
                                            
                                            subtotal0 = parseFloat(subtotal0).toFixed(3);
                                            subtotal12 = parseFloat(subtotal12).toFixed(3);
                                            iva12 = parseFloat(iva12).toFixed(3);
                                            descu_total = parseFloat(descu_total).toFixed(3);                                  
                                        }       
                                    }
                                }                                                          
                                total_total = parseFloat(total_total) + (parseFloat(subtotal0) + parseFloat(subtotal12) + parseFloat(iva12));
                                total_total = parseFloat(total_total).toFixed(3);

                                $("#total_p").val(subtotal0);
                                $("#total_p2").val(subtotal12);
                                $("#iva").val(iva12);
                                $("#desc").val(descu_total);
                                $("#tot").val(total_total);
                                $("#codigo_barras").focus();
                        }
                    }
                }
            }
        }
    }
}

function comprobar3() {
    if ($("#serie").val() === "") {
        $("#serie").focus();
        alertify.error("Ingrese una serie");
    }else{
        if ($("#tipo_comprobante").val() === "") {
            $("#tipo_comprobante").focus();
            alertify.error("Seleccione tipo documento");
        } else {
            if ($("#empresa").val() === "") {
                $("#ruc_ci").focus();
                alertify.error("Indique un Proveedor");
            } else {
                $("#autorizacion").focus();
            }
        }
    }    
}

function comprobar4() {
    if ($("#serie").val() === "") {
        $("#serie").focus();
        alertify.error("Ingrese una serie");
    }else{
        if ($("#tipo_comprobante").val() === "") {
            $("#tipo_comprobante").focus();
            alertify.error("Seleccione tipo documento");
        } else {
            if ($("#empresa").val() === "") {
                $("#ruc_ci").focus();
                alertify.error("Indique un Proveedor");
            } else {
               if ($("#empresa").val() === "") {
                $("#ruc_ci").focus();
                alertify.error("Indique un Proveedor");
                }else{
                    $("#codigo_barras").focus();
                } 
            }
        }
    } 
}

function agregar() {
    if ($("#serie").val() !== "") {
        var filas2 = jQuery("#list2").jqGrid("getRowData");
        var su;
        var count = 0;
        var canti = $("#cantidad").val();
        
        $.ajax({
            type: "POST",
            url: "comparar_series.php",
            data: "serie=" + $("#serie").val(),
            success: function(data) {
                var val = data;
                if (val == 1) {
                    $("#serie").val("");
                    $("#serie").focus();
                    alertify.alert("Error... Serie ya registrada");
                }else{
                    if (filas2.length < canti) {
                        if (filas2.length === 0) {
                            var datarow = {
                                id_serie: count = count + 1, 
                                serie: $("#serie").val()
                                };
                            su = jQuery("#list2").jqGrid('addRowData', count, datarow);
                            $("#serie").val("");
                            $("#serie").focus();
                        } else {
                            var repe = 0;
                            for (var i = 0; i < filas2.length; i++) {
                                var id = filas2[i];
                                if (id['serie'] === $("#serie").val()) {
                                    repe = 1;
                                }
                            }
                            if (repe === 0) {
                                datarow = {
                                    id_serie: count = count + 1, 
                                    serie: $("#serie").val()
                                    };
                                su = jQuery("#list2").jqGrid('addRowData', count, datarow);
                                $("#serie").val("");
                                 $("#serie").focus();
                            } else {
                                $("#serie").val("");
                                $("#serie").focus();
                                alertify.alert("Error... Serie ingresada");
                            }
                        }
                    } else {
                        $("#serie").val("");
                        $("#btnAgregar").attr("disabled", "disabled");
                        alertify.alert("Error... Alcanzo el limite máximo");
                    }
                }
            }
        });
    } else {
        $("#serie").focus();
        alertify.alert("Error... Indique una serie");
    }
}

function guardar_serie() {
    var tam2 = jQuery("#list2").jqGrid("getRowData");
    if ($("#cod_producto").val() === "") {
        alertify.alert("Error... Seleccione un producto");
    } else {
        if (tam2.length > 0) {
            var v1 = new Array();
            var string_v1 = "";
            var fil = jQuery("#list2").jqGrid("getRowData");

            for (var i = 0; i < fil.length; i++) {
                var datos = fil[i];
                v1[i] = datos['serie'];
            }

            for (i = 0; i < fil.length; i++) {
                string_v1 = string_v1 + "|" + v1[i];
            }
            $.ajax({
                type: "POST",
                url: "guardar_series.php",
                data: "cod_producto=" + $("#cod_producto").val() + "&campo1=" + string_v1+ "&comprobante=" + $("#comprobante").val(),
                success: function(data) {
                   var  val = data;
                    if (val == 1) {
                        $("#list2").jqGrid("clearGridData", true);
                        $("#series").dialog("close");
                        $("#descuento").focus();  
                    }
                }
            });
        } else {
            alertify.alert("Error... Ingrese las series");
        }
    }
}

function guardar_factura() {
var tam = jQuery("#list").jqGrid("getRowData");

if ($("#serie").val() === "") {
    $("#serie").focus();
    alertify.error("Ingrese una serie");
    } else {
        if ($("#tipo_comprobante").val() === "") {
            $("#tipo_comprobante").focus();
            alertify.error("Seleccione el comprobante");
        } else {
            if ($("#tipo_docu").val() === "") {
                $("#tipo_docu").focus();
                alertify.error("Seleccione tipo documento");
            } else {
                if ($("#id_proveedor").val() === "") {
                    $("#ruc_ci").focus();
                    alertify.error("Indique un Proveedor");
                } else {
                    var num_fac = $("#serie").val();
                    $.ajax({
                        type: "POST",
                        url: "comparar_num_compra.php",
                        data: "num_fac=" + num_fac + "&id_proveedor=" + $("#id_proveedor").val(),
                        success: function(data) {
                            var val = data;
                            if (val == 1) {
                                $("#serie").focus();
                                alertify.error("Error... El número de factura ya existe");
                            }else{
                                if ($("#autorizacion").val() === "") {
                                    $("#autorizacion").focus();
                                    alertify.error("Ingrese la autorización");
                                }else{
                                    if (tam.length === 0) {
                                        alertify.error("Error... Inrese productos a la factura");
                                    } else {
                                        $("#btnGuardar").attr("disabled", true);
                                        var v1 = new Array();
                                        var v2 = new Array();
                                        var v3 = new Array();
                                        var v4 = new Array();
                                        var v5 = new Array();
                                        var string_v1 = "";
                                        var string_v2 = "";
                                        var string_v3 = "";
                                        var string_v4 = "";
                                        var string_v5 = "";
                                        var fil = jQuery("#list").jqGrid("getRowData");
                                        for (var i = 0; i < fil.length; i++) {
                                            var datos = fil[i];
                                            v1[i] = datos['cod_producto'];
                                            v2[i] = datos['cantidad'];
                                            v3[i] = datos['precio_u'];
                                            v4[i] = datos['descuento'];
                                            v5[i] = datos['total'];
                                        }
                                        for (i = 0; i < fil.length; i++) {
                                            string_v1 = string_v1 + "|" + v1[i];
                                            string_v2 = string_v2 + "|" + v2[i];
                                            string_v3 = string_v3 + "|" + v3[i];
                                            string_v4 = string_v4 + "|" + v4[i];
                                            string_v5 = string_v5 + "|" + v5[i];
                                        }
                                        var seriee = $("#serie").val();
                                        $.ajax({
                                            type: "POST",
                                            url: "guardar_factura_compra.php",
                                            data: "id_proveedor=" + $("#id_proveedor").val() + "&comprobante=" + $("#comprobante").val() + "&fecha_actual=" + $("#fecha_actual").val() + "&hora_actual=" + $("#hora_actual").val() + "&fecha_registro=" + $("#fecha_registro").val() + "&fecha_emision=" + $("#fecha_emision").val() + "&fecha_caducidad=" + $("#fecha_caducidad").val() + "&tipo_comprobante=" + $("#tipo_comprobante").val() + "&serie=" + seriee + "&autorizacion=" + $("#autorizacion").val() + "&cancelacion=" + $("#cancelacion").val() + "&formas=" + $("#formas").val() + "&tarifa0=" + $("#total_p").val() + "&tarifa12=" + $("#total_p2").val() + "&iva=" + $("#iva").val() + "&desc=" + $("#desc").val() + "&tot=" + $("#tot").val() + "&campo1=" + string_v1 + "&campo2=" + string_v2 + "&campo3=" + string_v3 + "&campo4=" + string_v4 + "&campo5=" + string_v5,
                                            success: function(data) {
                                               var  val = data;
                                                if (val == 1) {
                                                    alertify.alert("Factura Guardada correctamente", function(){
                                                    window.open("../../reportes/factura_compra.php?hoja=A4&id="+$("#comprobante").val(),'_blank');    
                                                    location.reload();
                                                    });
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
    }
}

function modificar_factura() {
var tam = jQuery("#list").jqGrid("getRowData");

    if ($("#id_factura_compra").val() === "") {
        alertify.error("Selccione una factura");
        $("#buscar_facturas_compras").dialog("open"); 
    } else {
        if ($("#serie").val() === "") {
            $("#serie").focus();
            alertify.error("Ingrese una serie");
            } else {
                if ($("#tipo_comprobante").val() === "") {
                    $("#tipo_comprobante").focus();
                    alertify.error("Seleccione el comprobante");
                } else {
                    if ($("#tipo_docu").val() === "") {
                        $("#tipo_docu").focus();
                        alertify.error("Seleccione tipo documento");
                    } else {
                        if ($("#id_proveedor").val() === "") {
                            $("#ruc_ci").focus();
                            alertify.error("Indique un Proveedor");
                        } else {
                            if ($("#autorizacion").val() === "") {
                                $("#autorizacion").focus();
                                alertify.error("Ingrese la autorización");
                            }else{
                                if (tam.length === 0) {
                                    alertify.error("Error... Inrese productos a la factura");
                                } else {
                                    $("#btnModificar").attr("disabled", true);
                                    var v1 = new Array();
                                    var v2 = new Array();
                                    var v3 = new Array();
                                    var v4 = new Array();
                                    var v5 = new Array();
                                    var string_v1 = "";
                                    var string_v2 = "";
                                    var string_v3 = "";
                                    var string_v4 = "";
                                    var string_v5 = "";
                                    var fil = jQuery("#list").jqGrid("getRowData");
                                    for (var i = 0; i < fil.length; i++) {
                                        var datos = fil[i];
                                        v1[i] = datos['cod_producto'];
                                        v2[i] = datos['cantidad'];
                                        v3[i] = datos['precio_u'];
                                        v4[i] = datos['descuento'];
                                        v5[i] = datos['total'];
                                    }
                                    for (i = 0; i < fil.length; i++) {
                                        string_v1 = string_v1 + "|" + v1[i];
                                        string_v2 = string_v2 + "|" + v2[i];
                                        string_v3 = string_v3 + "|" + v3[i];
                                        string_v4 = string_v4 + "|" + v4[i];
                                        string_v5 = string_v5 + "|" + v5[i];
                                    }

                                    var seriee = $("#serie").val();
                                    $.ajax({
                                        type: "POST",
                                        url: "modificar_factura_compra.php",
                                        data: "id_factura_compra=" + $("#id_factura_compra").val() + "&id_proveedor=" + $("#id_proveedor").val() + "&comprobante=" + $("#comprobante").val() + "&fecha_actual=" + $("#fecha_actual").val() + "&hora_actual=" + $("#hora_actual").val() + "&fecha_registro=" + $("#fecha_registro").val() + "&fecha_emision=" + $("#fecha_emision").val() + "&fecha_caducidad=" + $("#fecha_caducidad").val() + "&tipo_comprobante=" + $("#tipo_comprobante").val() + "&serie=" + seriee + "&autorizacion=" + $("#autorizacion").val() + "&cancelacion=" + $("#cancelacion").val() + "&formas=" + $("#formas").val() + "&tarifa0=" + $("#total_p").val() + "&tarifa12=" + $("#total_p2").val() + "&iva=" + $("#iva").val() + "&desc=" + $("#desc").val() + "&tot=" + $("#tot").val() + "&campo1=" + string_v1 + "&campo2=" + string_v2 + "&campo3=" + string_v3 + "&campo4=" + string_v4 + "&campo5=" + string_v5,
                                        success: function(data) {
                                           var  val = data;
                                            if (val != 0) {
                                                alertify.alert("Factura Modificada correctamente", function(){
                                                window.open("../../reportes/factura_compra.php?hoja=A4&id="+ val,'_blank');    
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
        }    
}

function flecha_atras(){
    $.ajax({
        type: "POST",
        url: "../../procesos/flechas.php",
        data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "factura_compra" + "&id_tabla=" + "id_factura_compra" + "&tipo=" + 1,
        success: function(data) {
            var val = data;
            if(val != ""){
                $("#comprobante").val(val);
                var valor = $("#comprobante").val();
                 // llamar factura flechas primera parte
                $("#btnGuardar").attr("disabled", true);

                $("#ruc_ci").attr("disabled", "disabled");
                $("#serie").attr("disabled", "disabled");

                $("#formas").val("Contado");
                $("#list").jqGrid("clearGridData", true);
                $("#total_p").val("0.000");
                $("#total_p2").val("0.000");
                $("#iva").val("0.000");
                $("#desc").val("0.000");
                $("#tot").val("0.000");

                $.getJSON('retornar_factura_compra.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 22) {
                            $("#id_factura_compra").val(data[i]);
                            $("#fecha_actual").val(data[i + 1]);
                            $("#hora_actual").val(data[i + 2]);
                            $("#digitador").val(data[i + 3] + " " + data[i + 4] );
                            $("#id_proveedor").val(data[i + 5]);
                            $("#tipo_docu").val(data[i + 6]);
                            $("#ruc_ci").val(data[i + 7]);
                            $("#empresa").val(data[i + 8]);
                            $("#tipo_comprobante").val(data[i + 9]);
                            $("#fecha_registro").val(data[i + 10]);
                            $("#fecha_emision").val(data[i + 11]);
                            $("#fecha_caducidad").val(data[i + 12]);
                            $("#serie").val(data[i + 13]);
                            $("#autorizacion").val(data[i + 14]);
                            $("#cancelacion").val(data[i + 15]);
                            $("#formas").val(data[i + 16]);
                            $("#total_p").val(data[i + 17]);
                            $("#total_p2").val(data[i + 18]);
                            $("#iva").val(data[i + 19]);
                            $("#desc").val(data[i + 20]);
                            $("#tot").val(data[i + 21]);
                        }
                    }
                });
                
                $.getJSON('retornar_factura_compra2.php?com=' + valor, function(data) {
                    var tama = data.length;
                    var descuento = 0;
                    var total = 0;
                    var su = 0;
                    var precio = 0;
                    var multi = 0;
                    var flotante = 0;
                    var resultado = 0;

                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 9) {
                            desc = data[i + 5];
                            precio = (parseFloat(data[i + 4])).toFixed(3);
                            multi = (parseFloat(data[i + 3]) * parseFloat(data[i + 4])).toFixed(3);
                            descuento = ((multi * parseFloat(desc)) / 100).toFixed(3);
                            flotante = parseFloat(descuento);
                            resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(3);
                            total = (multi - resultado).toFixed(3);

                            var datarow = {
                                cod_producto: data[i], 
                                codigo: data[i + 1], 
                                detalle: data[i + 2], 
                                cantidad: data[i + 3], 
                                precio_u: precio, 
                                descuento: desc, 
                                cal_des: resultado,  
                                total: data[i + 6], 
                                iva: data[i + 7],
                                incluye: data[i + 8]
                            };
                            var su = jQuery("#list").jqGrid('addRowData', data[i], datarow);
                        }
                    }
                });
             } else {
                alertify.alert("No hay mas registros posteriores!!");
            }
        }
    });
} 

function flecha_siguiente(){
$.ajax({
        type: "POST",
        url: "../../procesos/flechas.php",
        data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "factura_compra" + "&id_tabla=" + "id_factura_compra" + "&tipo=" + 2,
        success: function(data) {
            var val = data;
            if(val != ""){
            $("#comprobante").val(val);
            var valor = $("#comprobante").val();
            // llamar factura flechas primera parte/////
            $("#btnGuardar").attr("disabled", true);

            $("#ruc_ci").attr("disabled", "disabled");
            $("#serie").attr("disabled", "disabled");

            $("#formas").val("Contado");
            $("#adelanto").val("");
            $("#meses").val("");
            $("#cuotas").val("");
            $("#list").jqGrid("clearGridData", true);
            $("#total_p").val("0.000");
            $("#total_p2").val("0.000");
            $("#iva").val("0.000");
            $("#desc").val("0.000");
            $("#tot").val("0.000");
            // fin
    
            $.getJSON('retornar_factura_compra.php?com=' + valor, function(data) {
                var tama = data.length;
                if (tama !== 0) {
                    for (var i = 0; i < tama; i = i + 22) {
                        $("#id_factura_compra").val(data[i]);
                        $("#fecha_actual").val(data[i + 1]);
                        $("#hora_actual").val(data[i + 2]);
                        $("#digitador").val(data[i + 3] + " " + data[i + 4] );
                        $("#id_proveedor").val(data[i + 5]);
                        $("#tipo_docu").val(data[i + 6]);
                        $("#ruc_ci").val(data[i + 7]);
                        $("#empresa").val(data[i + 8]);
                        $("#tipo_comprobante").val(data[i + 9]);
                        $("#fecha_registro").val(data[i + 10]);
                        $("#fecha_emision").val(data[i + 11]);
                        $("#fecha_caducidad").val(data[i + 12]);
                        $("#serie").val(data[i + 13]);
                        $("#autorizacion").val(data[i + 14]);
                        $("#cancelacion").val(data[i + 15]);
                        $("#formas").val(data[i + 16]);
                        $("#total_p").val(data[i + 17]);
                        $("#total_p2").val(data[i + 18]);
                        $("#iva").val(data[i + 19]);
                        $("#desc").val(data[i + 20]);
                        $("#tot").val(data[i + 21]);
                    }
                }
            });
            
            $.getJSON('retornar_factura_compra2.php?com=' + valor, function(data) {
                var tama = data.length;
                var tama = data.length;
                var descuento = 0;
                var total = 0;
                var su = 0;
                var precio = 0;
                var multi = 0;
                var flotante = 0;
                var resultado = 0;

                if (tama !== 0) {
                    for (var i = 0; i < tama; i = i + 9) {
                        desc = data[i + 5];
                        precio = (parseFloat(data[i + 4])).toFixed(3);
                        multi = (parseFloat(data[i + 3]) * parseFloat(data[i + 4])).toFixed(3);
                        descuento = ((multi * parseFloat(desc)) / 100).toFixed(3);
                        flotante = parseFloat(descuento);
                        resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(3);
                        total = (multi - resultado).toFixed(3);

                        var datarow = {
                            cod_producto: data[i], 
                            codigo: data[i + 1], 
                            detalle: data[i + 2], 
                            cantidad: data[i + 3], 
                            precio_u: precio, 
                            descuento: desc, 
                            cal_des: resultado,  
                            total: data[i + 6], 
                            iva: data[i + 7],
                            incluye: data[i + 8]
                        };

                        var su = jQuery("#list").jqGrid('addRowData', data[i], datarow);
                    }
                }
            });
            }else{
                alertify.alert("No hay mas registros superiores!!");
            }
        }
    });    
} 

function cancelar(){
    $("#list2").jqGrid("clearGridData", true);
    $("#series").dialog("close");
    $("#descuento").focus();
    $("#btnAgregar").attr("disabled", false);
}

function limpiar_factura(){
    location.reload(); 
}

function limpiar_campo(){
    if($("#ruc_ci").val() === ""){
        $("#id_proveedor").val("");
        $("#empresa").val("");
    }
}

function limpiar_campo2(){
    if($("#codigo").val() === "") {
        $("#cod_producto").val("");
        $("#codigo_barras").val("");
        $("#producto").val("");
        $("#cantidad").val("");
        $("#precio").val("");
        $("#descuento").val("");
        $("#iva_producto").val("");
        $("#carga_series").val("");
        $("#incluye").val("");
    }
}

function limpiar_campo3(){
    if($("#producto").val() === "") {
        $("#cod_producto").val("");
        $("#codigo_barras").val("");
        $("#codigo").val("");
        $("#cantidad").val("");
        $("#precio").val("");
        $("#descuento").val("");
        $("#iva_producto").val("");
        $("#carga_series").val("");
        $("#incluye").val("");
    }
}

function numeros(e) { 
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==8) return true;
patron = /\d/;
te = String.fromCharCode(tecla);
return patron.test(te);
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

var combo_1 = '';
var combo_2 = '';

function inicio() {
    $("[data-mask]").inputmask();
    alertify.set({ delay: 1000 });
    // jQuery().UItoTop({ easingType: 'easeOutQuart' });    
    show();

    /////////////cambiar idioma///////
     $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);

    function combo() {
        $.ajax({
            type: "POST",
            url: "buscar_producto.php",        
            success: function(resp) {             
                combo_1 = JSON.parse(resp);          
            }
        });    
        return combo_1;
    }

    function combo1() {
        $.ajax({
            type: "POST",
            url: "buscar_producto2",        
            success: function(resp) {             
                combo_2 = JSON.parse(resp);          
            }
        });    
        return combo_2;
    }

    $("#btncargar").click(function(e) {
        e.preventDefault();
    });
    $("#btnAgregar").click(function(e) {
        e.preventDefault();
    });
    $("#btnGuardarSeries").click(function(e) {
        e.preventDefault();
    });
    $("#btnCancelarSeries").click(function(e) {
        e.preventDefault();
    });
    $("#btnGuardar").click(function(e) {
        e.preventDefault();
    });
    $("#btnModificar").click(function(e) {
        e.preventDefault();
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
    });
    $("#btnNuevo").click(function(e) {
        e.preventDefault();
    });
    $("#btnImprimir").click(function () {
        $.ajax({
            type: "POST",
            url: "../../procesos/validacion.php",
            data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "factura_compra" + "&id_tabla=" + "id_factura_compra" + "&tipo=" + 1,
            success: function(data) {
                var val = data;
                if(val != "") {
                    window.open("../../reportes/factura_compra.php?hoja=A4&id="+$("#comprobante").val(),'_blank');  
                } else {
                  alertify.alert("Factura no creada!!");
                }   
            }
        });
    });

    $("#btncargar").on("click", abrirDialogo);
    $("#btnAgregar").on("click", agregar);
    $("#btnGuardarSeries").on("click", guardar_serie);
    $("#btnCancelarSeries").on("click", cancelar);
    $("#btnGuardar").on("click", guardar_factura);
    $("#btnModificar").on("click", modificar_factura);
    $("#btnNuevo").on("click", limpiar_factura);
    $("#btnAtras").on("click", flecha_atras);
    $("#btnAdelante").on("click", flecha_siguiente);

    $("#series").dialog(dialogo);
    $("#buscar_facturas_compras").dialog(dialogo2);

    $("#btnBuscar").click(function (){
        $("#buscar_facturas_compras").dialog("open");   
    });

    $("#cantidad").validCampoFranz("0123456789");
    $("#autorizacion").validCampoFranz("0123456789");
    $("#descuento").validCampoFranz("0123456789");

    $("#ruc_ci").on("keyup", limpiar_campo);
    $("#codigo").on("keyup", limpiar_campo2);
    $("#producto").on("keyup", limpiar_campo3);
    $("#codigo").on("keypress", enter);
    $("#producto").on("keypress", enter);
    $("#cantidad").on("keypress", enter);
    $("#precio").on("keypress", enter2);
    $("#descuento").on("keypress", enter3);
    $("#ruc_ci").on("keypress", enter4);
    $("#empresa").on("keypress", enter4);
    $("#serie").on("keypress", enter4);
    $("#autorizacion").on("keypress", enter5);

    //////////atributos////////////
    $("#ruc_ci").attr("disabled", "disabled");
    $("#empresa").attr("disabled", "disabled");
    $("#adelanto").attr("disabled", "disabled");
    $("#meses").attr("disabled", "disabled");
    $("#cuotas").attr("disabled", "disabled");

    //////////////para precio////////
    $("#precio").on("keypress",punto);
    
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

    $('.ui-spinner-button').click(function() {
        $(this).siblings('input').change();
    });

    //////////////////calcular meses/////////
    $("#meses").change(function() {
        $("#meses").val("");
        if ($("#formas").val() === "Contado") {
            alertify.alert("Error...No se puede diferer");
        } else {
            if ($("#formas").val() === "Credito") {
                var resta = ($("#tot").val() - $("#adelanto").val());
                var cuo = resta / $("#meses").val();
                var entero = parseFloat(cuo).toFixed(2);
                $("#cuotas").val(entero);
            }
        }
    });

    /////////series//////////////
    $("#formas").change(function() {
        var tam2 = jQuery("#list").jqGrid("getRowData");
        if ($("#formas").val() === "Contado") {
            $("#adelanto").attr("disabled", "disabled");
            $("#adelanto").val("");
            $("#meses").attr("disabled", "disabled");
            $("#meses").val("");
            $("#cuotas").attr("disabled", "disabled");
            $("#cuotas").val("");
        } else {
            if ($("#formas").val() === "Credito") {
                if (tam2.length > 0) {
                    $("#adelanto").removeAttr("disabled");
                    $("#meses").removeAttr("disabled");
                    $("#cuotas").removeAttr("disabled");
                } else {
                    alertify.alert("Error...Ingrese un monto a la factura");
                    $("#formas option[value=" + 'Contado' + "]").attr("selected", true);
                }
            }
        }
    });
    ////////////////////////

    ////////////////buscar producto codigo barras///////////////
    $("#codigo_barras").change(function(e) {
    var codigo = $("#codigo_barras").val();
    $.getJSON('search.php?codigo_barras=' + codigo, function(data) {
            var tama = data.length;
            if (tama !== 0) {
               for (var i = 0; i < tama; i = i + 7) {
                    $("#codigo").val(data[i]);
                    $("#producto").val(data[i + 1]);
                    $("#precio").val(data[i + 2]);
                    $("#iva_producto").val(data[i + 3]);
                    $("#carga_series").val(data[i + 4]);
                    $("#cod_producto").val(data[i + 5]);
                    $("#incluye").val(data[i + 6]);
                    $("#cantidad").focus();
                }
            } else {
                $("#codigo").val("");
                $("#producto").val("");
                $("#precio").val("");
                $("#iva_producto").val("");
                $("#carga_series").val("");
                $("#cod_producto").val("");
                $("#incluye").val("");
                alertify.error("Producto no ingresado");
                $("#codigo_barras").val("");
            }
        });
    });
    //////////////////////////////////////////////

   ////////////////////buscar producto codigo/////
    $("#codigo").autocomplete({
        source: "buscar_producto.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#codigo_barras").val(ui.item.codigo_barras);
        $("#codigo").val(ui.item.value);
        $("#producto").val(ui.item.producto);
        $("#precio").val(ui.item.precio);
        $("#iva_producto").val(ui.item.iva_producto);
        $("#carga_series").val(ui.item.carga_series);
        $("#cod_producto").val(ui.item.cod_producto);
        $("#incluye").val(ui.item.incluye);
        return false;
        },
        select: function(event, ui) {
        $("#codigo_barras").val(ui.item.codigo_barras);
        $("#codigo").val(ui.item.value);
        $("#producto").val(ui.item.producto);
        $("#precio").val(ui.item.precio);
        $("#iva_producto").val(ui.item.iva_producto);
        $("#carga_series").val(ui.item.carga_series);
        $("#cod_producto").val(ui.item.cod_producto);
        $("#incluye").val(ui.item.incluye);
        return false;
        }

        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    ///////////////////////////////////////////

    /////////////////buscar producto nombre/////////////
    $("#producto").autocomplete({
        source: "buscar_producto2.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#codigo_barras").val(ui.item.codigo_barras);
        $("#producto").val(ui.item.value);
        $("#codigo").val(ui.item.codigo);
        $("#precio").val(ui.item.precio);
        $("#iva_producto").val(ui.item.iva_producto);
        $("#carga_series").val(ui.item.carga_series);
        $("#cod_producto").val(ui.item.cod_producto);
        $("#incluye").val(ui.item.incluye);
        return false;
        },
        select: function(event, ui) {
        $("#codigo_barras").val(ui.item.codigo_barras);
        $("#producto").val(ui.item.value);
        $("#codigo").val(ui.item.codigo);
        $("#precio").val(ui.item.precio);
        $("#iva_producto").val(ui.item.iva_producto);
        $("#carga_series").val(ui.item.carga_series);
        $("#cod_producto").val(ui.item.cod_producto);
        $("#incluye").val(ui.item.incluye);
        return false;
        }

        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    //////////////////////////////////////////////

    $('#fecha_actual').datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');
    $('#fecha_registro').datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');
    $("#fecha_emision").datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');
    $("#fecha_caducidad").datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');
    $("#cancelacion").datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');

    /////////////////////datos tabla//////////////////////////
    jQuery("#list").jqGrid({
        datatype: "local",
        colNames: ['', 'ID', 'Código', 'Detalle', 'Cantidad', 'Precio. U', 'Descuento','Calculado', 'Total', 'Iva','Incluye'],
        colModel: [
            {name: 'myac', width: 50, fixed: true, sortable: false, resize: false, formatter: 'actions',
                formatoptions: {keys: false, delbutton: true, editbutton: false}
            },
            {name: 'cod_producto', index: 'cod_producto', editable: false, search: false, hidden: true, editrules: {edithidden: false}, align: 'center', frozen: true, width: 50},
            {name: 'codigo', index: 'codigo', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 100},
            {name: 'detalle', index: 'detalle', editable: false, frozen: true, editrules: {required: true}, align: 'center', width: 290},
            {name: 'cantidad', index: 'cantidad', editable: false, frozen: true, editrules: {required: true}, align: 'center', width: 70, editoptions:{maxlength: 10, size:15,dataInit: function(elem){$(elem).bind("keypress", function(e) {return numeros(e)})}}}, 
            {name: 'precio_u', index: 'precio_u', editable: false, search: false, frozen: true, editrules: {required: true}, align: 'center', width: 110, editoptions:{maxlength: 10, size:15,dataInit: function(elem){$(elem).bind("keypress", function(e) {return punto(e)})}}}, 
            {name: 'descuento', index: 'descuento', editable: false, frozen: true, editrules: {required: true}, align: 'center', width: 70},
            {name: 'cal_des', index: 'cal_des', editable: false, hidden: true, frozen: true, editrules: {required: true}, align: 'center', width: 90},
            {name: 'total', index: 'total', editable: false, search: false, frozen: true, editrules: {required: true}, align: 'center', width: 110},
            {name: 'iva', index: 'iva', align: 'center', width: 100, hidden: true},
            {name: 'incluye', index: 'incluye', editable: false, hidden: true, frozen: true, editrules: {required: true}, align: 'center', width: 90}
        ],
        rowNum: 30,
        // width: 810,
        height: 300,
        sortable: true,
        rowList: [10, 20, 30],
        pager: jQuery('#pager'),
        sortname: 'cod_producto',
        sortorder: 'asc',
        viewrecords: true,
        cellEdit: true,
        cellsubmit: 'clientArray',
        shrinkToFit: true,
        delOptions: {
            modal: true,
            jqModal: true,
            onclickSubmit: function(rp_ge, rowid) {
                var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
                jQuery('#list').jqGrid('restoreRow', id);
                var ret = jQuery("#list").jqGrid('getRowData', id);
                var subtotal0 = 0;
                var subtotal12 = 0;
                var iva12 = 0;
                var total_total = 0;
                var descu_total = 0;

                var subtotal = 0;
                var sub = 0;
                var sub1 = 0;
                var sub2 = 0;
                var iva = 0;
                var iva1 = 0;
                var iva2 = 0;

                var fil = jQuery("#list").jqGrid("getRowData"); 
                for (var t = 0; t < fil.length; t++) {
                    if(ret.iva == "Si") {
                      if(ret.incluye == "No") {
                        subtotal = ret.total;
                        sub1 = subtotal;
                        iva1 = (sub1 * 0.12).toFixed(3);                                          

                        subtotal0 = parseFloat($("#total_p").val()) + 0;
                        subtotal12 = parseFloat($("#total_p2").val()) - parseFloat(sub1);
                        iva12 = parseFloat($("#iva").val()) - parseFloat(iva1);
                        descu_total = parseFloat($("#desc").val()) - parseFloat(ret.cal_des);

                        subtotal0 = parseFloat(subtotal0).toFixed(3);
                        subtotal12 = parseFloat(subtotal12).toFixed(3);
                        iva12 = parseFloat(iva12).toFixed(3);
                        descu_total = parseFloat(descu_total).toFixed(3);

                      } else {
                            if(ret.incluye == "Si") {
                              subtotal = ret.total;
                              sub2 = (subtotal / 1.12).toFixed(3);
                              iva2 = (sub2 * 0.12).toFixed(3);

                              subtotal0 = parseFloat($("#total_p").val()) + 0;
                              subtotal12 = parseFloat($("#total_p2").val()) - parseFloat(sub2);
                              iva12 = parseFloat($("#iva").val()) - parseFloat(iva2);
                              descu_total = parseFloat($("#desc").val()) - parseFloat(ret.cal_des);

                              subtotal0 = parseFloat(subtotal0).toFixed(3);
                              subtotal12 = parseFloat(subtotal12).toFixed(3);
                              iva12 = parseFloat(iva12).toFixed(3);
                              descu_total = parseFloat(descu_total).toFixed(3);
                            }
                        }
                    } else {
                        if (ret.iva == "No") {
                            subtotal = ret.total;
                            sub = subtotal;

                            subtotal0 = parseFloat($("#total_p").val()) - parseFloat(sub);
                            subtotal12 = parseFloat($("#total_p2").val()) + 0;
                            iva12 = parseFloat($("#iva").val()) + 0;
                            descu_total = parseFloat($("#desc").val()) - parseFloat(ret.cal_des);
                              
                            subtotal0 = parseFloat(subtotal0).toFixed(3);
                            subtotal12 = parseFloat(subtotal12).toFixed(3);
                            iva12 = parseFloat(iva12).toFixed(3);
                            descu_total = parseFloat(descu_total).toFixed(3);
                        }
                    }
                }

                total_total = parseFloat(total_total) + (parseFloat(subtotal0) + parseFloat(subtotal12) + parseFloat(iva12));
                total_total = parseFloat(total_total).toFixed(3);

                $("#total_p").val(subtotal0);
                $("#total_p2").val(subtotal12);
                $("#iva").val(iva12);
                $("#desc").val(descu_total);
                $("#tot").val(total_total);

                var su = jQuery("#list").jqGrid('delRowData', rowid);
                   if (su === true) {
                   rp_ge.processing = true;
                   $(".ui-icon-closethick").trigger('click'); 
                   }
                return true;
            },
            processing: true
        },
        afterSaveCell : function(rowid,name,val,iRow,iCol) {
            var subtotal = 0;
            var iva = 0;
            var t_fc = 0;
            var mu = 0;
            var des = 0;
            var descu = 0;
            var cal = 0;
            var cal2 = 0;
            var tot = 0;
            
            var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
            jQuery('#list').jqGrid('restoreRow', id);
            var ret = jQuery("#list").jqGrid('getRowData', id);
            
            if(name == 'cantidad') {
                
               var precio = jQuery("#list").jqGrid('getCell',rowid,iCol+1);
               var descuento = jQuery("#list").jqGrid('getCell',rowid,iCol+2);
                              
               var operacion = (parseFloat(val)* parseFloat(precio)).toFixed(2);
               cal = ((operacion * descuento)/100).toFixed(2);
               tot = (operacion - cal).toFixed(2);
               
               jQuery("#list").jqGrid('setRowData',rowid,{precio_t: tot});
               
               if (ret.iva === "Si") {
                   var fil = jQuery("#list").jqGrid("getRowData");
                   for (var t = 0; t < fil.length; t++) {
                        var dd = fil[t];
                        if (dd['iva'] === "Si") {
                            subtotal = (subtotal + parseFloat(dd['precio_t']));
                            var sub = parseFloat(subtotal).toFixed(2);
                            iva = ((subtotal * 12) / 100).toFixed(2);
                            mu = (dd['cantidad'] * dd['precio_u']).toFixed(2);
                            des = ((mu * dd['descuento'])/100).toFixed(2);
                            descu = (parseFloat(descu) + parseFloat(des)).toFixed(2);
                            t_fc = ((parseFloat(subtotal) + parseFloat(iva)) + parseFloat($("#total_p").val())).toFixed(2);
                            $("#iva_producto").val("");
                        }
                    }

                    $("#total_p2").val(sub);
                    $("#iva").val(iva);
                    $("#desc").val(descu);
                    $("#tot").val(t_fc);
               } else {
                    fil = jQuery("#list").jqGrid("getRowData");
                    subtotal = 0;
                    t_fc = 0;
                    iva = 0;
                    mu = 0;
                    des = 0;
                    descu = 0;
                    for (t = 0; t < fil.length; t++) {
                    dd = fil[t];
                    if (dd['iva'] === "No") {
                        subtotal = (subtotal + parseFloat(dd['precio_t']));
                        sub = parseFloat(subtotal).toFixed(2);
                         iva = parseFloat($("#iva").val());
                        mu = (dd['cantidad'] * dd['precio_u']).toFixed(2);
                        des = ((mu * dd['descuento'])/100).toFixed(2);
                        descu = (parseFloat(descu) + parseFloat(des)).toFixed(2);
                        t_fc = ((parseFloat(subtotal) + parseFloat(iva)) + parseFloat($("#total_p2").val())).toFixed(2);
                        $("#iva_producto").val("");
                    }
                }
                $("#total_p").val(sub);
                $("#desc").val(descu);
                $("#tot").val(t_fc);
               }
            }
            
            if(name == 'precio_u') {
               var cantidad = jQuery("#list").jqGrid('getCell',rowid,iCol-1);
               var descuento2 = jQuery("#list").jqGrid('getCell',rowid,iCol+1);
               
               var operacion2 = (parseFloat(cantidad) * parseFloat(val)).toFixed(2); 
               cal2 = ((operacion2 * descuento2)/100).toFixed(2);
               tot = (operacion2 - cal2).toFixed(2);
               
               jQuery("#list").jqGrid('setRowData',rowid,{precio_t: tot});
               
               if (ret.iva === "Si") {
                   fil = jQuery("#list").jqGrid("getRowData");
                   for (t = 0; t < fil.length; t++) {
                        dd = fil[t];
                        if (dd['iva'] === "Si") {
                            subtotal = (subtotal + parseFloat(dd['precio_t']));
                            sub = parseFloat(subtotal).toFixed(2);
                            iva = ((subtotal * 12) / 100).toFixed(2);
                            mu = (dd['cantidad'] * dd['precio_u']).toFixed(2);
                            des = ((mu * dd['descuento'])/100).toFixed(2);
                            descu = (parseFloat(descu) + parseFloat(des)).toFixed(2);
                            t_fc = ((parseFloat(subtotal) + parseFloat(iva)) + parseFloat($("#total_p").val())).toFixed(2);
                            $("#iva_producto").val("");
                        }
                    }
                    $("#total_p2").val(sub);
                    $("#iva").val(iva);
                    $("#desc").val(descu);
                    $("#tot").val(t_fc);
                } else {
                    fil = jQuery("#list").jqGrid("getRowData");
                    subtotal = 0;
                    t_fc = 0;
                    iva = 0;
                    mu = 0;
                    des = 0;
                    descu = 0;
                    for (t = 0; t < fil.length; t++) {
                    dd = fil[t];
                    if (dd['iva'] === "No") {
                        subtotal = (subtotal + parseFloat(dd['precio_t']));
                        sub = parseFloat(subtotal).toFixed(2);
                        iva = parseFloat($("#iva").val());
                        mu = (dd['cantidad'] * dd['precio_u']).toFixed(2);
                        des = ((mu * dd['descuento'])/100).toFixed(2);
                        descu = (parseFloat(descu) + parseFloat(des)).toFixed(2);
                        t_fc = ((parseFloat(subtotal) + parseFloat(iva)) + parseFloat($("#total_p2").val())).toFixed(2);
                        $("#iva_producto").val("");
                    }
                }
                $("#total_p").val(sub);
                $("#desc").val(descu);
                $("#tot").val(t_fc);
               }
            }
        }
    });

    ///////////////////////////tabla series////////////////////////////
    jQuery("#list2").jqGrid({
        datatype: "local",
        colNames: ['', 'cod_serie', 'Series'],
        colModel: [
            {name: 'myac', width: 50, fixed: true, sortable: false, resize: false, formatter: 'actions',
                formatoptions: {keys: false, delbutton: true, editbutton: false}
            },
            {name: 'id_series', index: 'id_series', editable: false, search: false, hidden: true, editrules: {edithidden: false}, align: 'center',
                frozen: true, width: 50},
            {name: 'serie', index: 'serie', editable: false, search: false, hidden: false, editrules: {edithidden: true}, align: 'center',
                frozen: true, width: 100}
        ],
        rowNum: 30,
        width: 450,
        sortable: true,
        rowList: [10, 20, 30],
        pager: jQuery('#pager2'),
        sortname: 'id_series',
        sortorder: 'asc',
        viewrecords: true,
        cellEdit: true,
        cellsubmit: 'clientArray',
        shrinkToFit: true,
        delOptions: {
            onclickSubmit: function(rp_ge, rowid) {
                rp_ge.processing = true;
                var su = jQuery("#list2").jqGrid('delRowData', rowid);
                if (su === true) {
                    $("#delmodlist2").hide();
                    return true;
                }
                //$(".ui-icon-closethick").trigger('click');
            },
            processing: true
        }
    }).jqGrid('navGrid', '#pager2',
            {
                add: false,
                edit: false,
                del: false,
                refresh: true,
                search: true,
                view: true
            });
        ///////////////////////////////////////////////////////////////////////

        ////////////////////////////buscador facturas compra///////////////////   
        jQuery("#list3").jqGrid({
        url: 'xmlBuscarFacturaCompra.php',
        datatype: 'xml',
        colNames: ['ID','IDENTIFICACIÓN','EMPRESA', 'FACTURA NRO.','MONTO TOTAL','FECHA'],
        colModel: [
            {name: 'id_factura_compra', index: 'id_factura_compra', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 50},
            {name: 'identificacion_pro', index: 'identificacion_pro', editable: false, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 150},
            {name: 'empresa_pro', index: 'empresa_pro', editable: true, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 200},
            {name: 'num_serie', index: 'num_serie', editable: true, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 200},
            {name: 'total_compra', index: 'total_compra', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 100},
            {name: 'fecha_compra', index: 'fecha_compra', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 100},
        ],
        rowNum: 30,
        width: 750,
        height:220,
        sortable: true,
        rowList: [10, 20, 30],
        pager: jQuery('#pager3'),
        sortname: 'id_factura_compra',
        sortorder: 'asc',
        viewrecords: true,              
        ondblClickRow: function(){
        var id = jQuery("#list3").jqGrid('getGridParam', 'selrow');
        jQuery('#list3').jqGrid('restoreRow', id);
        
        if (id) {
            var ret = jQuery("#list3").jqGrid('getRowData', id);
            var valor = ret.id_factura_compra;
            /////////////agregregar factura compra////////
            $("#comprobante").val(valor);
            $("#btnGuardar").attr("disabled", true);

            $("#ruc_ci").attr("disabled", "disabled");

            $("#formas").val("Contado");

            $("#list").jqGrid("clearGridData", true);
            $("#total_p").val("0.00");
            $("#total_p2").val("0.00");
            $("#iva").val("0.00");
            $("#desc").val("0.00");
            $("#tot").val("0.00");            
    
            $.getJSON('retornar_factura_compra.php?com=' + valor, function(data) {
            var tama = data.length;
            if (tama !== 0) {
                for (var i = 0; i < tama; i = i + 22) {
                    $("#id_factura_compra").val(data[i]);
                    $("#fecha_actual").val(data[i + 1]);
                    $("#hora_actual").val(data[i + 2]);
                    $("#digitador").val(data[i + 3] + " " + data[i + 4] );
                    $("#id_proveedor").val(data[i + 5]);
                    $("#tipo_docu").val(data[i + 6]);
                    $("#ruc_ci").val(data[i + 7]);
                    $("#empresa").val(data[i + 8]);
                    $("#tipo_comprobante").val(data[i + 9]);
                    $("#fecha_registro").val(data[i + 10]);
                    $("#fecha_emision").val(data[i + 11]);
                    $("#fecha_caducidad").val(data[i + 12]);
                    $("#serie").val(data[i + 13]);
                    $("#autorizacion").val(data[i + 14]);
                    $("#cancelacion").val(data[i + 15]);
                    $("#formas").val(data[i + 16]);
                    $("#total_p").val(data[i + 17]);
                    $("#total_p2").val(data[i + 18]);
                    $("#iva").val(data[i + 19]);
                    $("#desc").val(data[i + 20]);
                    $("#tot").val(data[i + 21]);
                }
            }
        });
        
        $.getJSON('retornar_factura_compra2.php?com=' + valor, function(data) {
            var tama = data.length;
            var tama = data.length;
            var descuento = 0;
            var total = 0;
            var su = 0;
            var precio = 0;
            var multi = 0;
            var flotante = 0;
            var resultado = 0;

            if (tama !== 0) {
                for (var i = 0; i < tama; i = i + 9) {
                    desc = data[i + 5];
                    precio = (parseFloat(data[i + 4])).toFixed(3);
                    multi = (parseFloat(data[i + 3]) * parseFloat(data[i + 4])).toFixed(3);
                    descuento = ((multi * parseFloat(desc)) / 100).toFixed(3);
                    flotante = parseFloat(descuento);
                    resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(3);
                    total = (multi - resultado).toFixed(3);

                    var datarow = {
                        cod_producto: data[i], 
                        codigo: data[i + 1], 
                        detalle: data[i + 2], 
                        cantidad: data[i + 3], 
                        precio_u: precio, 
                        descuento: desc, 
                        cal_des: resultado,  
                        total: data[i + 6], 
                        iva: data[i + 7],
                        incluye: data[i + 8]
                    };

                    var su = jQuery("#list").jqGrid('addRowData', data[i], datarow);
                }
            }
        });
        $("#buscar_facturas_compras").dialog("close");

        } else {
          alertify.alert("Seleccione una Factura");
        }
    }
        }).jqGrid('navGrid', '#pager3',
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
        
       jQuery("#list3").jqGrid('navButtonAdd', '#pager3', {caption: "Añadir",
       onClickButton: function() {
        var id = jQuery("#list3").jqGrid('getGridParam', 'selrow');
        jQuery('#list3').jqGrid('restoreRow', id);
        if (id) {
           var ret = jQuery("#list3").jqGrid('getRowData', id);
           var valor = ret.id_factura_compra;
            /////////////agregregar factura compra////////
            $("#comprobante").val(valor);
            $("#btnGuardar").attr("disabled", true);

            $("#ruc_ci").attr("disabled", "disabled");

            $("#formas").val("Contado");
            $("#list").jqGrid("clearGridData", true);
            $("#total_p").val("0.00");
            $("#total_p2").val("0.00");
            $("#iva").val("0.00");
            $("#desc").val("0.00");
            $("#tot").val("0.00");
            ///////////////////////////////////////////////////   
    
            $.getJSON('retornar_factura_compra.php?com=' + valor, function(data) {
            var tama = data.length;
            if (tama !== 0) {
                for (var i = 0; i < tama; i = i + 22) {
                    $("#id_factura_compra").val(data[i]);
                    $("#fecha_actual").val(data[i + 1]);
                    $("#hora_actual").val(data[i + 2]);
                    $("#digitador").val(data[i + 3] + " " + data[i + 4] );
                    $("#id_proveedor").val(data[i + 5]);
                    $("#tipo_docu").val(data[i + 6]);
                    $("#ruc_ci").val(data[i + 7]);
                    $("#empresa").val(data[i + 8]);
                    $("#tipo_comprobante").val(data[i + 9]);
                    $("#fecha_registro").val(data[i + 10]);
                    $("#fecha_emision").val(data[i + 11]);
                    $("#fecha_caducidad").val(data[i + 12]);
                    $("#serie").val(data[i + 13]);
                    $("#autorizacion").val(data[i + 14]);
                    $("#cancelacion").val(data[i + 15]);
                    $("#formas").val(data[i + 16]);
                    $("#total_p").val(data[i + 17]);
                    $("#total_p2").val(data[i + 18]);
                    $("#iva").val(data[i + 19]);
                    $("#desc").val(data[i + 20]);
                    $("#tot").val(data[i + 21]);
                } 
            }
        });
        
        $.getJSON('retornar_factura_compra2.php?com=' + valor, function(data) {
            var tama = data.length;
            var tama = data.length;
            var descuento = 0;
            var total = 0;
            var su = 0;
            var precio = 0;
            var multi = 0;
            var flotante = 0;
            var resultado = 0;

            if (tama !== 0) {
                for (var i = 0; i < tama; i = i + 9) {
                    desc = data[i + 5];
                    precio = (parseFloat(data[i + 4])).toFixed(3);
                    multi = (parseFloat(data[i + 3]) * parseFloat(data[i + 4])).toFixed(3);
                    descuento = ((multi * parseFloat(desc)) / 100).toFixed(3);
                    flotante = parseFloat(descuento);
                    resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(3);
                    total = (multi - resultado).toFixed(3);

                    var datarow = {
                        cod_producto: data[i], 
                        codigo: data[i + 1], 
                        detalle: data[i + 2], 
                        cantidad: data[i + 3], 
                        precio_u: precio, 
                        descuento: desc, 
                        cal_des: resultado,  
                        total: data[i + 6], 
                        iva: data[i + 7],
                        incluye: data[i + 8]
                    };

                    var su = jQuery("#list").jqGrid('addRowData', data[i], datarow);
                }
            }
        });
       $("#buscar_facturas_compras").dialog("close");
        } else {
          alertify.alert("Seleccione una Factura");
        }
    }
  });

jQuery(window).bind('resize', function () {
    jQuery("#list").setGridWidth(jQuery('#grid_container').width(), true);
}).trigger('resize');
}




