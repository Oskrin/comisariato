$(document).on("ready", inicio);
function evento(e) {
    e.preventDefault();
}

function openPDF(){
window.open('../../ayudas/ayuda.pdf');
}

var dialogos = {
    autoOpen: false,
    resizable: false,
    width: 860,
    height: 560,
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
        entrar();
        return false;
    }
    return true;
}

function enter1(e) {
    if (e.which === 13 || e.keyCode === 13) {
        entrar2();
        return false;
    }
    return true;
}

function enter2(e) {
    if (e.which === 13 || e.keyCode === 13) {
        comprobar2();
        return false;
    }
    return true;
}

function enter3(e) {
    if (e.which === 13 || e.keyCode === 13) {
        comprobar();
        return false;
    }
    return true;
}

function comprobar() {
    if ($("#id_cliente").val() === "") {
        $("#ruc_ci").focus();
        alertify.alert("Ingrese un cliente");
    } 
}

function entrar() {
    if ($("#cod_producto").val() === "") {
        $("#codigo").focus();
        alertify.alert("Ingrese un producto");
    } else {
        if ($("#codigo").val() === "") {
            $("#codigo").focus();
            alertify.alert("Ingrese un producto");
        } else {
            if ($("#producto").val() === "") {
                $("#producto").focus();
                alertify.alert("Ingrese un producto");
            } else {
                if ($("#cantidad").val() === "") {
                    $("#cantidad").focus();
                    // alertify.alert("Ingrese una cantidad");
                } else {
                    $("#p_venta").focus();
                }
            }
        }
    }
}

function entrar2() {
    if ($("#cod_producto").val() === "") {
        $("#codigo").focus();
        alertify.alert("Ingrese un producto");
    } else {
        if ($("#codigo").val() === "") {
            $("#codigo").focus();
            alertify.alert("Ingrese un producto");
        } else {
            if ($("#producto").val() === "") {
                $("#producto").focus();
                alertify.alert("Ingrese un producto");
            } else {
                if ($("#cantidad").val() === "") {
                    $("#cantidad").focus();
                    // alertify.alert("Ingrese una cantidad");
                } else {
                    if ($("#p_venta").val() === "") {
                    $("#p_venta").focus();
                    alertify.alert("Ingrese un precio");
                  }else{
                    $("#descuento").focus();
                 }
                }
            }
        }
    }
}

function comprobar2() {
    var subtotal0 = 0;
    var subtotal12 = 0;
    var iva12 = 0;
    var total_total = 0;
    var descu_total = 0;
    if ($("#cod_producto").val() === "") {
        $("#codigo").focus();
        alertify.alert("Ingrese un producto");
    } else {
        if ($("#codigo").val() === "") {
            $("#codigo").focus();
            alertify.alert("Ingrese un producto");
        } else {
            if ($("#producto").val() === "") {
                $("#producto").focus();
                alertify.alert("Ingrese un producto");
            } else {
                if ($("#cantidad").val() === "") {
                    $("#cantidad").focus();
                    // alertify.alert("Ingrese una cantidad");
                } else {
                    if ($("#p_venta").val() === "") {
                    $("#p_venta").focus();
                    alertify.alert("Ingrese un precio");
                }else{
                    var filas = jQuery("#list").jqGrid("getRowData");
                    var descuento = 0;
                    var total = 0;
                    var su = 0;
                    var desc = 0;
                    var precio = 0;
                    var multi = 0;
                    var flotante = 0;
                    var resultado = 0;
                    var repe = 0;
                  
                    if (filas.length === 0) {
                        if ($("#descuento").val() !== "") {
                            desc = $("#descuento").val();
                            precio = (parseFloat($("#p_venta").val())).toFixed(2);
                            multi = (parseFloat($("#cantidad").val()) * parseFloat($("#p_venta").val())).toFixed(2);
                            descuento = ((multi * parseFloat($("#descuento").val())) / 100);
                            total = (multi - descuento).toFixed(2);
                            flotante = parseFloat(descuento);
                            resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(2);
                            total = (multi - resultado).toFixed(2);
                        } else {
                            desc = 0;
                            precio = (parseFloat($("#p_venta").val())).toFixed(2);
                            total = (parseFloat($("#cantidad").val()) * precio).toFixed(2);
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
                        $("#cod_producto").val("");
                        $("#codigo_barras").val("");
                        $("#codigo").val("");
                        $("#producto").val("");
                        $("#cantidad").val("");
                        $("#p_venta").val("");
                        $("#descuento").val("");
                        $("#disponibles").val("");
                        $("#incluye").val("");
                    } else {
                        for (var i = 0; i < filas.length; i++) {
                            var id = filas[i];
                            if (id['cod_producto'] === $("#cod_producto").val()) {
                                repe = 1;
                            }
                        }

                        if (repe === 1) {
                            if ($("#descuento").val() !== "") {
                                desc = $("#descuento").val();
                                precio = (parseFloat($("#p_venta").val())).toFixed(2);
                                multi = (parseFloat($("#cantidad").val()) * parseFloat($("#p_venta").val())).toFixed(2);
                                descuento = ((multi * parseFloat($("#descuento").val())) / 100);
                                total = (multi - descuento).toFixed(2);
                                flotante = parseFloat(descuento);
                                resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(2);
                                total = (multi - resultado).toFixed(2);
                                } else {
                                    desc = 0;
                                    precio = (parseFloat($("#p_venta").val())).toFixed(2);
                                    total = (parseFloat($("#cantidad").val()) * precio).toFixed(2);
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

                            su = jQuery("#list").jqGrid('setRowData', $("#cod_producto").val(), datarow);
                            $("#cod_producto").val("");
                            $("#codigo_barras").val("");
                            $("#codigo").val("");
                            $("#producto").val("");
                            $("#cantidad").val("");
                            $("#p_venta").val("");
                            $("#descuento").val("");
                            $("#disponibles").val("");
                            $("#incluye").val("");
                        } else {
                            if(filas.length < 19){
                                if ($("#descuento").val() !== "") {
                                    desc = $("#descuento").val();
                                    precio = (parseFloat($("#p_venta").val())).toFixed(2);
                                    multi = (parseFloat($("#cantidad").val()) * parseFloat($("#p_venta").val())).toFixed(2);
                                    descuento = ((multi * parseFloat($("#descuento").val())) / 100);
                                    flotante = parseFloat(descuento) ;
                                    resultado = (Math.round(flotante * Math.pow(10,2)) / Math.pow(10,2)).toFixed(2);
                                    total = (multi - resultado).toFixed(2);
                                } else {
                                    desc = 0;
                                    precio = (parseFloat($("#p_venta").val())).toFixed(2);
                                    total = (parseFloat($("#cantidad").val()) * precio).toFixed(2);
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
                                $("#cod_producto").val("");
                                $("#codigo_barras").val("");
                                $("#codigo").val("");
                                $("#producto").val("");
                                $("#cantidad").val("");
                                $("#p_venta").val("");
                                $("#descuento").val("");
                                $("#disponibles").val("");
                                $("#incluye").val("");
                            }else{
                                alertify.error("Error... Alcanzo el limite máximo de Items");
                            }
                        }
                    }
                    
                    /////////////////////proceso incluye iva//////////
                    var subtotal = 0;
                    var sub = 0;
                    var sub1 = 0;
                    var sub2 = 0;
                    var iva = 0;
                    var iva1 = 0;
                    var iva2 = 0;
                    ///////////////////                                                    
                    
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
                                descu_total = parseFloat(descu_total) + dd['cal_des'];
                                iva12 = parseFloat(iva12) + parseFloat(iva1);
                            
                                subtotal0 = parseFloat(subtotal0).toFixed(3);
                                subtotal12 = parseFloat(subtotal12).toFixed(3);
                                iva12 = parseFloat(iva12).toFixed(3);
                                descu_total = parseFloat(descu_total).toFixed(3);
                            }else{
                                if(dd['incluye'] == "Si"){
                                    subtotal = dd['total'];
                                    sub2 = (subtotal / 1.12).toFixed(3);
                                    iva2 = (sub2 * 0.12).toFixed(3);

                                    subtotal0 = parseFloat(subtotal0) + 0;
                                    subtotal12 = parseFloat(subtotal12) + parseFloat(sub2);
                                    iva12 = parseFloat(iva12) + parseFloat(iva2);
                                    descu_total = parseFloat(descu_total) + dd['cal_des'];

                                    subtotal0 = parseFloat(subtotal0).toFixed(3);
                                    subtotal12 = parseFloat(subtotal12).toFixed(3);
                                    iva12 = parseFloat(iva12).toFixed(3);
                                    descu_total = parseFloat(descu_total).toFixed(3);
                                }
                            }
                        }else{
                            if (dd['iva'] === "No") {                                               
                                subtotal = dd['total'];
                                sub = subtotal;

                                subtotal0 = parseFloat(subtotal0) + parseFloat(sub);
                                subtotal12 = parseFloat(subtotal12) + 0;
                                iva12 = parseFloat(iva12) + 0;
                                descu_total = parseFloat(descu_total) + dd['cal_des'];
                                
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

function guardar_proforma() {
    var tam = jQuery("#list").jqGrid("getRowData");
    if ($("#id_cliente").val() === "") {
        $("#ruc_ci").focus();
        alertify.error("Ingrese un cliente");
    } else {
        if ($("#tipo_precio").val() === "") {
            $("#tipo_precio").focus();
            alertify.alert("Error... Seleccione tipo de precio");
        } else {
            if (tam.length === 0) {
                alertify.alert("Error... Llene productos en la proforma");
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

                $.ajax({
                    type: "POST",
                    url: "guardar_proforma.php",
                    data: "id_cliente=" + $("#id_cliente").val() + "&comprobante=" + $("#comprobante").val() + "&fecha_actual=" + $("#fecha_actual").val() + "&hora_actual=" + $("#hora_actual").val() + "&tipo_precio=" + $("#tipo_precio").val() + "&tarifa0=" + $("#total_p").val() + "&tarifa12=" + $("#total_p2").val() + "&iva=" + $("#iva").val() + "&desc=" + $("#desc").val() + "&tot=" + $("#tot").val() + "&campo1=" + string_v1 + "&campo2=" + string_v2 + "&campo3=" + string_v3 + "&campo4=" + string_v4 + "&campo5=" + string_v5 + "&observaciones=" + $("#observaciones").val(),
                    success: function(data) {
                        var val = data;
                        if (val == 1) {
                            alertify.alert("Proforma Guardada correctamente",function(){
                            window.open("../../reportes/proforma.php?id="+$("#comprobante").val(),'_blank');    
                            location.reload();
                            });   
                        }
                    }
                });
            }
        }
    }
}

function flecha_atras(){
    $.ajax({
       type: "POST",
       url: "../../procesos/flechas.php",
       data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "proforma" + "&id_tabla=" + "id_proforma" + "&tipo=" + 1,
       success: function(data) {
           var val = data;
           if(val != ""){
                $("#comprobante").val(val);
                var valor = $("#comprobante").val();
                
                  ///////////////////llamar proforma flechas primera parte/////
                $("#btnGuardar").attr("disabled", true);
                $("#btnModificar").attr("disabled", true);

                $("#ruc_ci").attr("disabled", "disabled");
                $("#nombres_completos").attr("disabled", "disabled");

                $("#codigo_barras").attr("disabled", "disabled");
                $("#codigo").attr("disabled", "disabled");
                $("#producto").attr("disabled", "disabled");
                $("#cantidad").attr("disabled", "disabled");
                $("#p_venta").attr("disabled", "disabled");
                $("#descuento").attr("disabled", "disabled");
                $("#observaciones").attr("disabled", "disabled");

                $("#list").jqGrid("clearGridData", true);
                $("#total_p").val("0.00");
                $("#total_p2").val("0.00");
                $("#desc").val("0.00");
                $("#iva").val("0.00");
                $("#tot").val("0.00");

                $.getJSON('retornar_proforma_venta.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 15)
                        {
                            $("#fecha_actual").val(data[i]);
                            $("#hora_actual").val(data[i + 1 ]);
                            $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ]);
                            $("#id_cliente").val(data[i + 4]);
                            $("#ruc_ci").val(data[i + 5]);
                            $("#nombres_completos").val(data[i + 6]);
                            $("#saldo").val(data[i + 7]);
                            $("#tipo_precio").val(data[i + 8]);
                            $("#total_p").val(data[i + 9]);
                            $("#total_p2").val(data[i + 10]);
                            $("#iva").val(data[i + 11]);
                            $("#desc").val(data[i + 12]);
                            $("#tot").val(data[i + 13]);
                            $("#observaciones").val(data[i + 14]);
                        }
                    }
                });                
                $.getJSON('retornar_proforma_venta2.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 8)
                        {
                            var datarow = {
                                cod_producto: data[i], 
                                codigo: data[i + 1], 
                                detalle: data[i + 2], 
                                cantidad: data[i + 3], 
                                precio_u: data[i + 4], 
                                descuento: data[i + 5], 
                                total: data[i + 6], 
                                iva: data[i + 7]
                                };
                            var su = jQuery("#list").jqGrid('addRowData', data[i], datarow);
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
       data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "proforma" + "&id_tabla=" + "id_proforma" + "&tipo=" + 2,
       success: function(data) {
           var val = data;
           if(val != ""){
            $("#comprobante").val(val);
            var valor = $("#comprobante").val();
                 ///////////////////llamar facturas flechas primera parte/////
            $("#btnGuardar").attr("disabled", true);
            $("#btnModificar").attr("disabled", true);

            $("#ruc_ci").attr("disabled", "disabled");
            $("#nombres_completos").attr("disabled", "disabled");

            $("#codigo_barras").attr("disabled", "disabled");
            $("#codigo").attr("disabled", "disabled");
            $("#producto").attr("disabled", "disabled");
            $("#cantidad").attr("disabled", "disabled");
            $("#p_venta").attr("disabled", "disabled");
            $("#descuento").attr("disabled", "disabled");
            $("#observaciones").attr("disabled", "disabled");

            $("#list").jqGrid("clearGridData", true);
            $("#total_p").val("0.00");
            $("#total_p2").val("0.00");
            $("#desc").val("0.00");
            $("#iva").val("0.00");
            $("#tot").val("0.00");
            
            $.getJSON('retornar_proforma_venta.php?com=' + valor, function(data) {
                var tama = data.length;
                if (tama !== 0) {
                    for (var i = 0; i < tama; i = i + 15) {
                        $("#fecha_actual").val(data[i]);
                        $("#hora_actual").val(data[i + 1 ]);
                        $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ] );
                        $("#id_cliente").val(data[i + 4]);
                        $("#ruc_ci").val(data[i + 5]);
                        $("#nombres_completos").val(data[i + 6]);
                        $("#saldo").val(data[i + 7]);
                        $("#tipo_precio").val(data[i + 8]);
                        $("#total_p").val(data[i + 9]);
                        $("#total_p2").val(data[i + 10]);
                        $("#iva").val(data[i + 11]);
                        $("#desc").val(data[i + 12]);
                        $("#tot").val(data[i + 13]);
                        $("#observaciones").val(data[i + 14]);
                    }
                }
            });
            
            $.getJSON('retornar_proforma_venta2.php?com=' + valor, function(data) {
                var tama = data.length;
                if (tama !== 0) {
                    for (var i = 0; i < tama; i = i + 8) {
                        var datarow = {
                            cod_producto: data[i], 
                            codigo: data[i + 1], 
                            detalle: data[i + 2], 
                            cantidad: data[i + 3], 
                            precio_u: data[i + 4], 
                            descuento: data[i + 5], 
                            total: data[i + 6], 
                            iva: data[i + 7]
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

function limpiar_proforma(){
    location.reload(); 
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

function limpiar_campo3(){
    if($("#codigo").val() === ""){
        $("#cod_producto").val("");
        $("#producto").val("");
        $("#cantidad").val("");
        $("#p_venta").val("");
        $("#descuento").val("");
        $("#iva_producto").val("");
    }
}

function limpiar_campo4(){
    if($("#producto").val() === ""){
        $("#cod_producto").val("");
        $("#codigo").val("");
        $("#cantidad").val("");
        $("#p_venta").val("");
        $("#descuento").val("");
        $("#iva_producto").val("");
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
}

function inicio() {
    alertify.set({ delay: 1000 });

    $(".timepicker").timepicker({
      showInputs: false
    });
    //////////////para hora///////////
    show();
    ///////////////////

    //////////////botones//////////
    $("#btnGuardar").click(function(e) {
        e.preventDefault();
    });
    $("#btnModificar").click(function(e) {
        e.preventDefault();
    });
    
    $("#btnNuevo").click(function(e) {
        e.preventDefault();
    });
     $("#btnImprimir").click(function (){
       $.ajax({
        type: "POST",
        url: "../../procesos/validacion.php",
        data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "proforma" + "&id_tabla=" + "id_proforma" + "&tipo=" + 1,
        success: function(data) {
            var val = data;
            if(val != "") {
                window.open("../../reportes/proforma.php?id="+$("#comprobante").val(),'_blank');  
            } else {
              alertify.alert("Proforma no creada!!");
            }   
        }
        });        
    });
    $("#btnAtras").click(function(e) {
        e.preventDefault();
    });
    $("#btnAdelante").click(function(e) {
        e.preventDefault();
    });

    $("#btnGuardar").on("click", guardar_proforma);
    // $(document).bind('keydown', 'F7', guardar_proforma);
    // $('input').unbind('keydown', 'F7', guardar_proforma);
    $("#btnNuevo").on("click", limpiar_proforma);
    $("#btnAtras").on("click", flecha_atras);
    $("#btnAdelante").on("click", flecha_siguiente);
    
    ////////////////////////////////
    $("#buscar_proformas").dialog(dialogo2);

    $("#btnBuscar").click(function(e) {
        e.preventDefault();
        $("#buscar_proformas").dialog("open");  
    });
    ///////////////////////////////////

    $("#cantidad").validCampoFranz("0123456789");
    $("#descuento").validCampoFranz("0123456789");
    $("#descuento").attr("maxlength", "3");

    //////////////validaciones////////////
    $("#ruc_ci").on("keyup", limpiar_campo);
    $("#nombres_completos").on("keyup", limpiar_campo2);
    $("#codigo").on("keyup", limpiar_campo3);
    $("#producto").on("keyup", limpiar_campo4);
    $("#codigo").on("keypress", enter);
    $("#producto").on("keypress", enter);
    $("#cantidad").on("keypress", enter);
    $("#p_venta").on("keypress", enter1);
    $("#descuento").on("keypress", enter2);
    $("#ruc_ci").on("keypress", enter3);
    $("#nombres_completos").on("keypress", enter3);
    //////////////////////////////////////
    
    $("#p_venta").on("keypress",punto);

     //////////////////buscar productos codigo barras//////////////// 
    $("#codigo_barras").keyup(function(e) {
        var precio = $("#tipo_precio").val(); 
        var codigo = $("#codigo_barras").val();
        if (precio === "MINORISTA") {
            $.getJSON('search.php?codigo_barras=' + codigo + '&precio=' + precio, function(data) {
                var tama = data.length;
                if (tama !== 0) {
                    for (var i = 0; i < tama; i = i + 10) {
                        $("#codigo").val(data[i]);
                        $("#producto").val(data[i + 1]);
                        $("#p_venta").val(data[i + 2]);
                        $("#descuento").attr("max",data[i + 7]);
                        $("#disponibles").val(data[i + 3]);
                        $("#iva_producto").val(data[i + 4]);
                        $("#carga_series").val(data[i + 5]);
                        $("#cod_producto").val(data[i + 6]);
                        $("#des").val(data[i + 7]);
                        $("#inventar").val(data[i + 8]);
                        $("#incluye").val(data[i + 9]);
                        $("#cantidad").focus();
                    }
                }else{
                    $("#codigo").val("");
                    $("#producto").val("");
                    $("#p_venta").val("");
                    $("#descuento").val("");
                    $("#disponibles").val("");
                    $("#iva_producto").val("");
                    $("#carga_series").val("");
                    $("#cod_producto").val("");
                    $("#des").val("");
                    $("#inventar").val("");
                    $("#incluye").val("");
                }
            });
        }else{
            if (precio === "MAYORISTA") {
                $.getJSON('search.php?codigo_barras=' + codigo + '&precio=' + precio, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 10) {
                            $("#codigo").val(data[i]);
                            $("#producto").val(data[i + 1]);
                            $("#p_venta").val(data[i + 2]);
                            $("#descuento").attr("max",data[i + 7]);
                            $("#disponibles").val(data[i + 3]);
                            $("#iva_producto").val(data[i + 4]);
                            $("#carga_series").val(data[i + 5]);
                            $("#cod_producto").val(data[i + 6]);
                            $("#des").val(data[i + 7]);
                            $("#inventar").val(data[i + 8]);
                            $("#incluye").val(data[i + 9]);
                            $("#cantidad").focus();
                        }
                    }else{
                        $("#codigo").val("");
                        $("#producto").val("");
                        $("#p_venta").val("");
                        $("#descuento").val("");
                        $("#disponibles").val("");
                        $("#iva_producto").val("");
                        $("#carga_series").val("");
                        $("#cod_producto").val("");
                        $("#des").val("");
                        $("#inventar").val("");
                        $("#incluye").val("");
                    }
                });
            }
        }
    });
    ////////////////////////////////////////////////////////

    //////////////////buscar productos codigo////////////////
    $("#codigo").keyup(function(e) {
     var precio = $("#tipo_precio").val();
       if (precio === "MINORISTA") {
            $("#codigo").autocomplete({
                source: "buscar_producto7.php?tipo_precio=" + precio,
                minLength: 1,
                focus: function(event, ui) {
                $("#codigo_barras").val(ui.item.codigo_barras);
                $("#codigo").val(ui.item.value);
                $("#producto").val(ui.item.producto);
                $("#p_venta").val(ui.item.p_venta);
                $("#descuento").attr("max",ui.item.descuento);
                $("#des").val(ui.item.des);
                $("#iva_producto").val(ui.item.iva_producto);
                $("#cod_producto").val(ui.item.cod_producto);
                $("#incluye").val(ui.item.incluye);
                return false;
                },
                select: function(event, ui) {
                $("#codigo_barras").val(ui.item.codigo_barras);
                $("#codigo").val(ui.item.value);
                $("#producto").val(ui.item.producto);
                $("#p_venta").val(ui.item.p_venta);
                $("#descuento").attr("max",ui.item.descuento);
                $("#des").val(ui.item.des);
                $("#iva_producto").val(ui.item.iva_producto);
                $("#cod_producto").val(ui.item.cod_producto);
                 $("#incluye").val(ui.item.incluye);
                return false;
                }

                }).data("ui-autocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                .append("<a>" + item.value + "</a>")
                .appendTo(ul);
            };
        } else {
            if (precio === "MAYORISTA") {
                $("#codigo").autocomplete({
                    source: "buscar_producto7.php?tipo_precio=" + precio,
                    minLength: 1,
                    focus: function(event, ui) {
                    $("#codigo_barras").val(ui.item.codigo_barras);    
                    $("#codigo").val(ui.item.value);
                    $("#producto").val(ui.item.producto);
                    $("#p_venta").val(ui.item.p_venta);
                    $("#descuento").attr("max",ui.item.descuento);
                    $("#des").val(ui.item.des);
                    $("#iva_producto").val(ui.item.iva_producto);
                    $("#cod_producto").val(ui.item.cod_producto);
                    $("#incluye").val(ui.item.incluye);
                    return false;
                    },
                    select: function(event, ui) {
                    $("#codigo_barras").val(ui.item.codigo_barras);
                    $("#codigo").val(ui.item.value);
                    $("#producto").val(ui.item.producto);
                    $("#p_venta").val(ui.item.p_venta);
                    $("#descuento").attr("max",ui.item.descuento);
                    $("#des").val(ui.item.des);
                    $("#iva_producto").val(ui.item.iva_producto);
                    $("#cod_producto").val(ui.item.cod_producto);
                    $("#incluye").val(ui.item.incluye);
                    return false;
                    }

                    }).data("ui-autocomplete")._renderItem = function(ul, item) {
                    return $("<li>")
                    .append("<a>" + item.value + "</a>")
                    .appendTo(ul);
                };
            }
        }
    });
    ////////////////////////////////////////////////////////////////////////

    ///////////////////////busqueda productos nombres///////////////////////
    $("#producto").keyup(function(e) {
    var precio = $("#tipo_precio").val();
    if (precio === "MINORISTA") {
        $("#producto").autocomplete({
            source: "buscar_producto8.php?tipo_precio=" + precio,
            minLength: 1,
            focus: function(event, ui) {
            $("#codigo_barras").val(ui.item.codigo_barras);
            $("#producto").val(ui.item.value);
            $("#codigo").val(ui.item.codigo);
            $("#p_venta").val(ui.item.p_venta);
            $("#descuento").attr("max",ui.item.descuento);
            $("#des").val(ui.item.des);
            $("#iva_producto").val(ui.item.iva_producto);
            $("#cod_producto").val(ui.item.cod_producto);
            $("#incluye").val(ui.item.incluye);
            return false;
            },
            select: function(event, ui) {
            $("#codigo_barras").val(ui.item.codigo_barras);
            $("#producto").val(ui.item.value);
            $("#codigo").val(ui.item.codigo);
            $("#p_venta").val(ui.item.p_venta);
            $("#descuento").attr("max",ui.item.descuento);
            $("#des").val(ui.item.des);
            $("#iva_producto").val(ui.item.iva_producto);
            $("#cod_producto").val(ui.item.cod_producto);
            $("#incluye").val(ui.item.incluye);
            return false;
            }

            }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li>")
            .append("<a>" + item.value + "</a>")
            .appendTo(ul);
        };
    } else {
        if (precio === "MAYORISTA") {
            $("#producto").autocomplete({
                source: "buscar_producto8.php?tipo_precio=" + precio,
                minLength: 1,
                focus: function(event, ui) {
                $("#codigo_barras").val(ui.item.codigo_barras);
                $("#producto").val(ui.item.value);
                $("#codigo").val(ui.item.codigo);
                $("#p_venta").val(ui.item.p_venta);
                $("#descuento").attr("max",ui.item.descuento);
                $("#des").val(ui.item.des);
                $("#iva_producto").val(ui.item.iva_producto);
                $("#cod_producto").val(ui.item.cod_producto);
                $("#incluye").val(ui.item.incluye);
                return false;
                },
                select: function(event, ui) {
                $("#codigo_barras").val(ui.item.codigo_barras);
                $("#producto").val(ui.item.value);
                $("#codigo").val(ui.item.codigo);
                $("#p_venta").val(ui.item.p_venta);
                $("#descuento").attr("max",ui.item.descuento);
                $("#des").val(ui.item.des);
                $("#iva_producto").val(ui.item.iva_producto);
                $("#cod_producto").val(ui.item.cod_producto);
                $("#incluye").val(ui.item.incluye);
                return false;
                }

                }).data("ui-autocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                .append("<a>" + item.value + "</a>")
                .appendTo(ul);
            };
        }
     }   
  }); 
  ////////////////////////////////////

   ////////////accion limpiar/////////
    $("#tipo_precio").change(function() {
       $("#codigo_barras").val("");
       $("#cod_producto").val("");
       $("#codigo").val("");
       $("#producto").val("");
       $("#cantidad").val("");
       $("#p_venta").val("");
       $("#descuento").val("");
       $("#disponibles").val("");
       $("#inventar").val("");
       $("#des").val("");
       $("#iva_producto").val("");
       $("#carga_series").val("");   
       $("#incluye").val("");
    });
    /////////////////////////////////


    ////////////buscar clientes identificacion//////////
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
    //////////////////////////////
    
    /////buscador clientes nombres///// 
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
    ////////////////////////////// 
    
    ///////////calendarios/////
    $('#fecha_actual').datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');

    ///////////tabla local/////////////  
    var can;
       jQuery("#list").jqGrid({
        datatype: "local",
        colNames: ['', 'ID', 'Código', 'Producto', 'Cantidad', 'PVP', 'Descuento','Calculado', 'Total', 'Iva','Incluye'],
        colModel: [
            {name: 'myac', width: 50, fixed: true, sortable: false, resize: false, formatter: 'actions',
                formatoptions: {keys: false, delbutton: true, editbutton: false}
            },
            {name: 'cod_producto', index: 'cod_producto', editable: false, search: false, hidden: true, editrules: {edithidden: false}, align: 'center',
                frozen: true, width: 50},
            {name: 'codigo', index: 'codigo', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',
                frozen: true, width: 100},
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
        width: 810,
        height: 300,
        sortable: true,
        rowList: [10, 20, 30],
        pager: jQuery('#pager'),
        sortname: 'id_productos',
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
                        descu_total = parseFloat($("#desc").val()) - ret.cal_des;

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
                          descu_total = parseFloat($("#desc").val()) - ret.cal_des;

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
                          descu_total = parseFloat($("#desc").val()) - ret.cal_des;
                          
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
            
            var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
            jQuery('#list').jqGrid('restoreRow', id);
            var ret = jQuery("#list").jqGrid('getRowData', id);
            
            if(name == 'cantidad') {
               var precio = jQuery("#list").jqGrid('getCell',rowid,iCol+1);
               var operacion = (parseFloat(val)* parseFloat(precio)).toFixed(2); 
               jQuery("#list").jqGrid('setRowData',rowid,{total: operacion });
               
               if (ret.iva === "Si") {
                   var fil = jQuery("#list").jqGrid("getRowData");
                   for (var t = 0; t < fil.length; t++) {
                        var dd = fil[t];
                        if (dd['iva'] === "Si") {
                            subtotal = (subtotal + parseFloat(dd['total']));
                            iva = parseFloat((subtotal * 0.12)).toFixed(2);
                            var sub = (parseFloat(subtotal) - parseFloat(iva)).toFixed(2);
                            mu = (dd['cantidad'] * dd['precio_u']).toFixed(2);
                            des = ((mu * dd['descuento'])/100).toFixed(2);
                            descu = (parseFloat(descu) + parseFloat(des)).toFixed(2);
                            t_fc = ((parseFloat(sub) + parseFloat(iva)) + parseFloat($("#total_p").val())).toFixed(2);
                            $("#iva_producto").val("");
                        }
                    }
                    $("#total_p2").val(sub);
                    $("#iva").val(iva);
                    $("#desc").val(descu);
                    $("#tot").val(t_fc);
               }else{
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
                        subtotal = (subtotal + parseFloat(dd['total']));
                        sub = parseFloat(subtotal).toFixed(2);
                        iva = parseFloat($("#iva").val());
                        mu = (dd['cantidad'] * dd['precio_u']).toFixed(2);
                        des = ((mu * dd['descuento'])/100).toFixed(2);
                        descu = (parseFloat(descu) + parseFloat(des)).toFixed(2);
                        t_fc = ((parseFloat(sub) + parseFloat(iva)) + parseFloat($("#total_p2").val())).toFixed(2);
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
               var operacion2 = (parseFloat(cantidad) * parseFloat(val)).toFixed(2); 
               jQuery("#list").jqGrid('setRowData',rowid,{total: operacion2});
               
               if (ret.iva === "Si") {
                   fil = jQuery("#list").jqGrid("getRowData");
                   for (t = 0; t < fil.length; t++) {
                        dd = fil[t];
                        if (dd['iva'] === "Si") {
                            subtotal = (subtotal + parseFloat(dd['total']));
                            iva = parseFloat((subtotal * 0.12)).toFixed(2);
                            sub = (parseFloat(subtotal) - parseFloat(iva)).toFixed(2);
                            mu = (dd['cantidad'] * dd['precio_u']).toFixed(2);
                            des = ((mu * dd['descuento'])/100).toFixed(2);
                            descu = (parseFloat(descu) + parseFloat(des)).toFixed(2);
                            t_fc = ((parseFloat(sub) + parseFloat(iva)) + parseFloat($("#total_p").val())).toFixed(2);
                            $("#iva_producto").val("");
                        }
                    }
                    $("#total_p2").val(sub);
                    $("#iva").val(iva);
                    $("#desc").val(descu);
                    $("#tot").val(t_fc);
               }else{
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
                        subtotal = (subtotal + parseFloat(dd['total']));
                        sub = parseFloat(subtotal).toFixed(2);
                        iva = parseFloat($("#iva").val());
                        mu = (dd['cantidad'] * dd['precio_u']).toFixed(2);
                        des = ((mu * dd['descuento'])/100).toFixed(2);
                        descu = (parseFloat(descu) + parseFloat(des)).toFixed(2);
                        t_fc = ((parseFloat(sub) + parseFloat(iva)) + parseFloat($("#total_p2").val())).toFixed(2);
                    }
                }
                $("#total_p").val(sub);
                $("#desc").val(descu);
                $("#tot").val(t_fc);
               }
            }
        }
    });

    //////////////////////tabla proformas/////////////////////////////   
    jQuery("#list2").jqGrid({
        url: 'xmlBuscarProformas.php',
        datatype: 'xml',
        colNames: ['ID','IDENTIFICACIÓN','CLIENTE','MONTO TOTAL','FECHA'],
        colModel: [
            {name: 'id_proforma', index: 'id_factura_venta', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 50},
            {name: 'identificacion', index: 'identificacion', editable: false, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 150},
            {name: 'nombres_cli', index: 'nombres_cli', editable: true, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 200},
            {name: 'total_proforma', index: 'total_proforma', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 100},
            {name: 'fecha_proforma', index: 'fecha_proforma', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 100},
        ],
        rowNum: 30,
        width: 750,
        height:220,
        sortable: true,
        rowList: [10, 20, 30],
        pager: jQuery('#pager2'),
        sortname: 'id_proforma',
        sortorder: 'asc',
        viewrecords: true,              
        ondblClickRow: function(){
        var id = jQuery("#list2").jqGrid('getGridParam', 'selrow');
        jQuery('#list2').jqGrid('restoreRow', id);
        
        if (id) {
        var ret = jQuery("#list2").jqGrid('getRowData', id);
        var valor = ret.id_proforma;
        /////////////agregregar datos proforma////////
        $("#comprobante").val(valor);
        $("#btnGuardar").attr("disabled", true);
        $("#btnModificar").attr("disabled", true);

        $("#ruc_ci").attr("disabled", "disabled");
        $("#nombres_completos").attr("disabled", "disabled");

        $("#codigo_barras").attr("disabled", "disabled");
        $("#codigo").attr("disabled", "disabled");
        $("#producto").attr("disabled", "disabled");
        $("#cantidad").attr("disabled", "disabled");
        $("#p_venta").attr("disabled", "disabled");
        $("#descuento").attr("disabled", "disabled");
        $("#observaciones").attr("disabled", "disabled");

        $("#list").jqGrid("clearGridData", true);
        $("#total_p").val("0.00");
        $("#total_p2").val("0.00");
        $("#desc").val("0.00");
        $("#iva").val("0.00");
        $("#tot").val("0.00");

        $.getJSON('retornar_proforma_venta.php?com=' + valor, function(data) {
            var tama = data.length;
            if (tama !== 0) {
                for (var i = 0; i < tama; i = i + 15) {
                    $("#fecha_actual").val(data[i]);
                    $("#hora_actual").val(data[i + 1 ]);
                    $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ] );
                    $("#id_cliente").val(data[i + 4]);
                    $("#ruc_ci").val(data[i + 5]);
                    $("#nombres_completos").val(data[i + 6]);
                    $("#saldo").val(data[i + 7]);
                    $("#tipo_precio").val(data[i + 8]);
                    $("#total_p").val(data[i + 9]);
                    $("#total_p2").val(data[i + 10]);
                    $("#iva").val(data[i + 11]);
                    $("#desc").val(data[i + 12]);
                    $("#tot").val(data[i + 13]);
                    $("#observaciones").val(data[i + 14]);
                }
            }
        });
        
        $.getJSON('retornar_proforma_venta2.php?com=' + valor, function(data) {
            var tama = data.length;
            if (tama !== 0) {
                 for (var i = 0; i < tama; i = i + 8) {
                    var datarow = {
                        cod_producto: data[i], 
                        codigo: data[i + 1], 
                        detalle: data[i + 2], 
                        cantidad: data[i + 3], 
                        precio_u: data[i + 4], 
                        descuento: data[i + 5], 
                        total: data[i + 6], 
                        iva: data[i + 7]
                        };
                    var su = jQuery("#list").jqGrid('addRowData', data[i], datarow);
                }
            }
        });
 
         $("#buscar_proformas").dialog("close");
        } else {
            alertify.alert("Seleccione una Proforma");
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
        var valor = ret.id_proforma;
         /////////////agregregar datos proforma////////
        $("#comprobante").val(valor);
        $("#btnGuardar").attr("disabled", true);
        $("#btnModificar").attr("disabled", true);

        $("#ruc_ci").attr("disabled", "disabled");
        $("#nombres_completos").attr("disabled", "disabled");

        $("#codigo_barras").attr("disabled", "disabled");
        $("#codigo").attr("disabled", "disabled");
        $("#producto").attr("disabled", "disabled");
        $("#cantidad").attr("disabled", "disabled");
        $("#p_venta").attr("disabled", "disabled");
        $("#descuento").attr("disabled", "disabled");
        $("#observaciones").attr("disabled", "disabled");

        $("#list").jqGrid("clearGridData", true);
        $("#total_p").val("0.00");
        $("#total_p2").val("0.00");
        $("#desc").val("0.00");
        $("#iva").val("0.00");
        $("#tot").val("0.00");

        $.getJSON('retornar_proforma_venta.php?com=' + valor, function(data) {
            var tama = data.length;
            if (tama !== 0) {
                for (var i = 0; i < tama; i = i + 15) {
                    $("#fecha_actual").val(data[i]);
                    $("#hora_actual").val(data[i + 1 ]);
                    $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ] );
                    $("#id_cliente").val(data[i + 4]);
                    $("#ruc_ci").val(data[i + 5]);
                    $("#nombres_completos").val(data[i + 6]);
                    $("#saldo").val(data[i + 7]);
                    $("#tipo_precio").val(data[i + 8]);
                    $("#total_p").val(data[i + 9]);
                    $("#total_p2").val(data[i + 10]);
                    $("#iva").val(data[i + 11]);
                    $("#desc").val(data[i + 12]);
                    $("#tot").val(data[i + 13]);
                    $("#observaciones").val(data[i + 14]);
                }
            }
        });
        
        $.getJSON('retornar_proforma_venta2.php?com=' + valor, function(data) {
            var tama = data.length;
            if (tama !== 0) {
                for (var i = 0; i < tama; i = i + 8) {
                    var datarow = {
                        cod_producto: data[i], 
                        codigo: data[i + 1], 
                        detalle: data[i + 2], 
                        cantidad: data[i + 3], 
                        precio_u: data[i + 4], 
                        descuento: data[i + 5], 
                        total: data[i + 6], 
                        iva: data[i + 7]
                        };
                    var su = jQuery("#list").jqGrid('addRowData', data[i], datarow);
                }
            }
        });
       $("#buscar_proformas").dialog("close");
        } else {
          alertify.alert("Seleccione una Proforma");
        }
    }
});

jQuery(window).bind('resize', function () {
    jQuery("#list").setGridWidth(jQuery('#grid_container').width(), true);
}).trigger('resize');

}
