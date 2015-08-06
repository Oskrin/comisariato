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

function enter(e) {
    if (e.which === 13 || e.keyCode === 13) {
        entrar();
        return false;
    }
    return true;
}

function enter2(e) {
    if (e.which === 13 || e.keyCode === 13) {
        entrar2();
        return false;
    }
    return true;
}

function entrar() {
    // reset();
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
//                    alertify.alert("Ingrese una cantidad");
                } else {
                    if ($("#cantidad").val() === "0") {
                        $("#cantidad").focus();
                        alertify.alert("Ingrese una cantidad valida");
                    } else {
                        $("#precio").focus();
                    }
                }
            }
        }
    }
    return false;
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
//                    alertify.alert("Ingrese una cantidad");
                } else {
                    if ($("#cantidad").val() === "0") {
                        $("#cantidad").focus();
                        alertify.alert("Ingrese una cantidad valida");
                    } else {
                        if ($("#precio").val() === "") {
                            $("#precio").focus();
                            alertify.alert("Ingrese un precio");
                        } else {
                            var filas = jQuery("#list").jqGrid("getRowData");
                            var su = 0;
                            var dife = 0;
                            if (filas.length === 0) {
                               dife = (parseInt( $("#cantidad").val()) - Math.abs(parseInt( $("#stock").val())))
                                var datarow = {
                                    cod_producto: $("#cod_producto").val(), 
                                    codigo: $("#codigo").val(), 
                                    nombre_producto: $("#producto").val(), 
                                    precio_compra: $("#precio").val(), 
                                    precio_venta: $("#p_venta").val(), 
                                    stock: $("#cantidad").val(), 
                                    existencia:  $("#cantidad").val(), 
                                    diferencia: dife
                                };
                                su = jQuery("#list").jqGrid('addRowData', $("#cod_producto").val(), datarow);
                                ////////limpiar///////////
                                $("#cod_producto").val("");
                                $("#codigo_barras").val("");
                                $("#codigo").val("");
                                $("#producto").val("");
                                $("#cantidad").val("");
                                $("#precio").val("");
                                $("#stock").val("");
                                $("#p_venta").val("");
                                $("#existencia").val("");
                                $("#diferencia").val("");
                            ///////////////////////////
                            }
                            else {
                                var repe = 0;
                                for (var i = 0; i < filas.length; i++) {
                                    var id = filas[i];
                                    if (id['cod_producto'] === $("#cod_producto").val()) {
                                        repe = 1;
                                    }
                                }
                                if (repe === 1) {
                                   dife = (parseInt( $("#cantidad").val()) - Math.abs(parseInt( $("#stock").val())))
                                    datarow = {
                                        cod_producto: $("#cod_producto").val(), 
                                        codigo: $("#codigo").val(), 
                                        nombre_producto: $("#producto").val(), 
                                        precio_compra: $("#precio").val(), 
                                        precio_venta: $("#p_venta").val(), 
                                        stock: $("#cantidad").val(), 
                                        existencia:  $("#cantidad").val(), 
                                        diferencia: dife
                                    };
                                    su = jQuery("#list").jqGrid('setRowData', $("#cod_producto").val(), datarow);
                                    ////////limpiar///////////
                                    $("#cod_producto").val("");
                                    $("#codigo_barras").val("");
                                    $("#codigo").val("");
                                    $("#producto").val("");
                                    $("#cantidad").val("");
                                    $("#precio").val("");
                                    $("#stock").val("");
                                    $("#p_venta").val("");
                                    $("#existencia").val("");
                                    $("#diferencia").val("");
                                ///////////////////////////
                                }
                                else {
                                    dife = (parseInt( $("#cantidad").val()) - Math.abs(parseInt( $("#stock").val())))
                                    datarow = {
                                        cod_producto: $("#cod_producto").val(), 
                                        codigo: $("#codigo").val(), 
                                        nombre_producto: $("#producto").val(), 
                                        precio_compra: $("#precio").val(), 
                                        precio_venta: $("#p_venta").val(), 
                                        stock: $("#cantidad").val(), 
                                        existencia:  $("#cantidad").val(), 
                                        diferencia: dife
                                    };
                                    su = jQuery("#list").jqGrid('addRowData', $("#cod_producto").val(), datarow);
                                    ////////limpiar///////////
                                    $("#cod_producto").val("");
                                    $("#codigo_barras").val("");
                                    $("#codigo").val("");
                                    $("#producto").val("");
                                    $("#cantidad").val("");
                                    $("#precio").val("");
                                    $("#stock").val("");
                                    $("#p_venta").val("");
                                    $("#existencia").val("");
                                    $("#diferencia").val("");
                                ///////////////////////////
                                }
                            }
                            
                            ///////////////////calcular valores//////////////
                            var valor_cos = 0;
                            var valor_ven = 0;
                            var fil = jQuery("#list").jqGrid("getRowData");
                            for (var t = 0; t < fil.length; t++) {
                                var dd = fil[t];
                                valor_cos = (valor_cos + parseFloat(dd['precio_compra']));
                                var valor_costo = (valor_cos).toFixed(2);
                                valor_ven = (valor_ven + parseFloat(dd['precio_venta']));
                                var valor_venta = (valor_ven).toFixed(2);
                                }
                            $("#total_costo").val(valor_costo);
                            $("#total_venta").val(valor_venta);
                            
                            $("#codigo_barras").focus();
                        }
                    }
                }
            }
        }
    }
}

function guardar_inventario() {
    var tam = jQuery("#list").jqGrid("getRowData");
    
    if (tam.length === 0) {
        $("#codigo_barras").focus();
        alertify.error("Error... Ingrese productos en el inventario");
    } else {
        var v1 = new Array();
        var v2 = new Array();
        var v3 = new Array();
        var v4 = new Array();
        var v5 = new Array();
        var v6 = new Array();
        var string_v1 = "";
        var string_v2 = "";
        var string_v3 = "";
        var string_v4 = "";
        var string_v5 = "";
        var string_v6 = "";
        var fil = jQuery("#list").jqGrid("getRowData");
        for (var i = 0; i < fil.length; i++) {
            var datos = fil[i];
            v1[i] = datos['cod_producto'];
            v2[i] = datos['precio_compra'];
            v3[i] = datos['precio_venta'];
            v4[i] = datos['stock'];
            v5[i] = datos['existencia'];
            v6[i] = datos['diferencia'];
        }
        for (i = 0; i < fil.length; i++) {
            string_v1 = string_v1 + "|" + v1[i];
            string_v2 = string_v2 + "|" + v2[i];
            string_v3 = string_v3 + "|" + v3[i];
            string_v4 = string_v4 + "|" + v4[i];
            string_v5 = string_v5 + "|" + v5[i];
            string_v6 = string_v6 + "|" + v6[i];
        }
        
        $.ajax({
            type: "POST",
            url: "guardar_inventario.php",
            data: "comprobante=" + $("#comprobante").val() + "&fecha_actual=" + $("#fecha_actual").val() + "&hora_actual=" + $("#hora_actual").val() + "&campo1=" + string_v1 + "&campo2=" + string_v2 + "&campo3=" + string_v3 + "&campo4=" + string_v4 + "&campo5=" + string_v5 + "&campo6=" + string_v6,
            success: function(data) {
                var val = data;
                if (val == 1) {
                    alertify.alert("Inventario Guardado correctamente",function(){location.reload();});
                }
            }
        });
    }
}

function flecha_atras(){
    $.ajax({
       type: "POST",
       url: "../../procesos/flechas.php",
       data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "inventario" + "&id_tabla=" + "id_inventario" + "&tipo=" + 1,
       success: function(data) {
           var val = data;
           if(val != ""){
                var valor_costo = 0;
                var valor_venta = 0;
                $("#comprobante").val(val);
                var valor = $("#comprobante").val();
                
                ///////////////////llamar inventario primera parte/////
                $("#btnGuardar").attr("disabled", true);
                $("#codigo").attr("disabled", "disabled");
                $("#codigo_barras").attr("disabled", "disabled");
                $("#producto").attr("disabled", "disabled");
                $("#cantidad").attr("disabled", "disabled");
                $("#list").jqGrid("clearGridData", true);
  
                $.getJSON('retornar_inventario.php?com=' + valor, function(data) {
                    var tama = data.length;
                    
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 4) {
                            $("#fecha_actual").val(data[i]);
                            $("#hora_actual").val(data[i + 1 ]);
                            $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ]);
                        }
                    }
                });
                
                $.getJSON('retornar_inventario2.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 8) {
                            var datarow = {
                                cod_producto: data[i], 
                                codigo: data[i + 1], 
                                nombre_producto: data[i + 2], 
                                precio_compra: data[i + 3], 
                                precio_venta: data[i + 4], 
                                stock: data[i + 5], 
                                existencia: data[i + 6], 
                                diferencia: data[i + 7]
                                };
                            var su = jQuery("#list").jqGrid('addRowData', data[i], datarow);
                            valor_costo = (parseFloat(valor_costo) + parseFloat(data[i + 3])).toFixed(2);
                            var entero = (parseFloat(valor_costo)).toFixed(2);
                            valor_venta = (parseFloat(valor_venta) + parseFloat(data[i + 4])).toFixed(2);
                            var entero2 = (parseFloat(valor_venta)).toFixed(2);
                            $("#total_costo").val(entero);
                            $("#total_venta").val(entero2);
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
       data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "inventario" + "&id_tabla=" + "id_inventario" + "&tipo=" + 2,
       success: function(data) {
           var val = data;
           if(val != ""){
                var valor_costo = 0;
                var valor_venta = 0;
                $("#comprobante").val(val);
                var valor = $("#comprobante").val();
                
                ///////////////////llamar inventario primera parte/////
                $("#btnGuardar").attr("disabled", true);
                $("#codigo").attr("disabled", "disabled");
                $("#codigo_barras").attr("disabled", "disabled");
                $("#producto").attr("disabled", "disabled");
                $("#cantidad").attr("disabled", "disabled");
                $("#list").jqGrid("clearGridData", true);
  
                $.getJSON('retornar_inventario.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 4) {
                            $("#fecha_actual").val(data[i]);
                            $("#hora_actual").val(data[i + 1 ]);
                            $("#digitador").val(data[i + 2 ] + " " + data[i + 3 ]);
                        }
                    }
                });

                $.getJSON('retornar_inventario2.php?com=' + valor, function(data) {
                    var tama = data.length;
                    if (tama !== 0) {
                        for (var i = 0; i < tama; i = i + 8)
                        {
                            var datarow = {
                                cod_producto: data[i], 
                                codigo: data[i + 1], 
                                nombre_producto: data[i + 2], 
                                precio_compra: data[i + 3], 
                                precio_venta: data[i + 4], 
                                stock: data[i + 5], 
                                existencia: data[i + 6], 
                                diferencia: data[i + 7]
                                };
                            var su = jQuery("#list").jqGrid('addRowData', data[i], datarow);
                            valor_costo = (parseFloat(valor_costo) + parseFloat(data[i + 3])).toFixed(2);
                            var entero = (parseFloat(valor_costo)).toFixed(2);
                            valor_venta = (parseFloat(valor_venta) + parseFloat(data[i + 4])).toFixed(2);
                            var entero2 = (parseFloat(valor_venta)).toFixed(2);
                            $("#total_costo").val(entero);
                            $("#total_venta").val(entero2);
                        }
                    }
                });
           }else{
               alertify.alert("No hay mas registros superiores!!");
           }
       }
   }); 
}

function nuevo(){
 location.reload();   
}

function limpiar_campo1(){
    if($("#codigo").val() === ""){
        $("#cod_producto").val("");
        $("#codigo_barras").val("");
        $("#producto").val("");
        $("#cantidad").val("");
        $("#precio").val("");
        $("#stock").val("");
    }
}

function limpiar_campo2(){
    if($("#producto").val() === ""){
        $("#cod_producto").val("");
        $("#codigo_barras").val("");
        $("#codigo").val("");
        $("#cantidad").val("");
        $("#precio").val("");
        $("#stock").val("");
    }
}


function reset () {
    $("#toggleCSS").attr("href", "../../css/alertify.default.css");
    alertify.set({
        labels : {
            ok     : "OK",
            cancel : "Cancel"
        },
        delay : 5000,
        buttonReverse : false,
        buttonFocus   : "ok"
    });
}

function inicio() {
    jQuery('#platform-details').html('<code>' + navigator.userAgent + '</code>');
    alertify.set({ delay: 1000 });
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
    //////////////para hora///////////
    show();
    ///////////////////
    
    //////Botones//////////
    $("#btnGuardar").click(function(e) {
        e.preventDefault();
    });
    $("#btnBuscar").click(function(e) {
        e.preventDefault();
    });
    $("#btnNuevo").click(function(e) {
        e.preventDefault();
    });
    $("#btnImprimir").click(function (){
        $.ajax({
        type: "POST",
        url: "../../procesos/validacion.php",
        data: "comprobante=" + $("#comprobante").val() + "&tabla=" + "inventario" + "&id_tabla=" + "id_inventario" + "&tipo=" + 1,
        success: function(data) {
            var val = data;
            if(val != "") {
                window.open("../../reportes/reportes/reporte_inventario.php?hoja=A4&id="+$("#comprobante").val(),'_blank');  
            } else {
              alertify.alert("Inventario no creado!!");
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
    
    $("#btnGuardar").on("click", guardar_inventario);
    $(document).bind('keydown', 'F7', guardar_inventario);
    $('input').bind('keydown', 'F7', guardar_inventario);
    $("#btnNuevo").on("click", nuevo);
    $("#btnAtras").on("click", flecha_atras);
    $("#btnAdelante").on("click", flecha_siguiente);
    //////////////////////
    
    //////inmput////////
    $("#cantidad").validCampoFranz("0123456789");
    $("#codigo").on("keyup", limpiar_campo1);
    $("#producto").on("keyup", limpiar_campo2);
    
    $("#codigo").on("keypress", enter );
    $("#producto").on("keypress", enter);
    $("#cantidad").on("keypress", enter);
    $("#precio").on("keypress", enter2);
    ///////////////////
    
    $("#codigo_barras").keyup(function(e) {
        var codigo = $("#codigo_barras").val();
        $.getJSON('search3.php?codigo_barras=' + codigo, function(data) {
                var tama = data.length;
                if (tama !== 0) {
                   for (var i = 0; i < tama; i = i + 8) {
                        $("#codigo").val(data[i]);
                        $("#producto").val(data[i + 1]);
                        $("#precio").val(data[i + 2]);
                        $("#stock").val(data[i + 3]);
                        $("#p_venta").val(data[i + 4]);
                        $("#existencia").val(data[i + 5]);
                        $("#diferencia").val(data[i + 6]);
                        $("#cod_producto").val(data[i + 7]);
                        $("#cantidad").focus();
                  }
                }else{
                    $("#codigo").val("");
                    $("#producto").val("");
                    $("#precio").val("");
                    $("#stock").val("");
                    $("#p_venta").val("");
                    $("#existencia").val("");
                    $("#diferencia").val("");
                    $("#cod_producto").val("");
                }
            });
    });
    
    $("#codigo").autocomplete({
        source: "buscar_productoinv1.php",
        minLength: 1,
        focus: function(event, ui) {
            $("#codigo_barras").val(ui.item.codigo_barras);
            $("#codigo").val(ui.item.value);
            $("#producto").val(ui.item.producto);
            $("#precio").val(ui.item.precio);
            $("#stock").val(ui.item.stock);
            $("#p_venta").val(ui.item.p_venta);
            $("#existencia").val(ui.item.existencia);
            $("#diferencia").val(ui.item.diferencia);
            $("#cod_producto").val(ui.item.cod_producto);
            return false;
        },
        select: function(event, ui) {
            $("#codigo_barras").val(ui.item.codigo_barras);
            $("#codigo").val(ui.item.value);
            $("#producto").val(ui.item.producto);
            $("#precio").val(ui.item.precio);
            $("#stock").val(ui.item.stock);
            $("#p_venta").val(ui.item.p_venta);
            $("#existencia").val(ui.item.existencia);
            $("#diferencia").val(ui.item.diferencia);
            $("#cod_producto").val(ui.item.cod_producto);
            return false;
        }

        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    
    /////buscador productos articulo///// 
    $("#producto").autocomplete({
        source: "buscar_productoinv2.php",
        minLength: 1,
        focus: function(event, ui) {
            $("#codigo_barras").val(ui.item.codigo_barras);
            $("#producto").val(ui.item.value);
            $("#codigo").val(ui.item.codigo);
            $("#precio").val(ui.item.precio);
            $("#stock").val(ui.item.stock);
            $("#p_venta").val(ui.item.p_venta);
            $("#existencia").val(ui.item.existencia);
            $("#diferencia").val(ui.item.diferencia);
            $("#cod_producto").val(ui.item.cod_producto);
            return false;
        },
        select: function(event, ui) {
            $("#codigo_barras").val(ui.item.codigo_barras);
            $("#producto").val(ui.item.value);
            $("#codigo").val(ui.item.codigo);
            $("#precio").val(ui.item.precio);
            $("#stock").val(ui.item.stock);
            $("#p_venta").val(ui.item.p_venta);
            $("#existencia").val(ui.item.existencia);
            $("#diferencia").val(ui.item.diferencia);
            $("#cod_producto").val(ui.item.cod_producto);
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
    
    jQuery("#list").jqGrid({
        datatype: "local",
        colNames: ['','ID', 'CÓDIGO', 'PRODUCTO', 'P. COSTO', 'P. VENTA', 'STOCK', 'EXISTENCIA', 'DIFERENCIA'],
        colModel: [
            {name: 'myac', width: 50, fixed: true, sortable: false, search: false, resize: false, formatter: 'actions', formatoptions: {keys: false, delbutton: true, editbutton: false}},
            {name: 'cod_producto', index: 'cod_producto', editable: false, search: false, hidden: true, editrules: {edithidden: false}, align: 'center', frozen: true, width: 50},
            {name: 'codigo', index: 'codigo', editable: false, search: true, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 200},
            {name: 'nombre_producto', index: 'nombre_producto', editable: false, search: true, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 450},
            {name: 'precio_compra', index: 'precio_compra', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 110},
            {name: 'precio_venta', index: 'precio_venta', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 110},
            {name: 'stock', index: 'stock', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 100},
            {name: 'existencia', index: 'existencia', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 110},
            {name: 'diferencia', index: 'diferencia', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center', frozen: true, width: 110}
        ],
        rowNum: 30,
        width: 900,
        height: 400,
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
                
                rp_ge.processing = true;
                var su = jQuery("#list").jqGrid('delRowData', rowid);
                
                var total_costo = 0;
                var total_venta = 0;
                if (su === true) {
                    total_costo = (parseFloat($("#total_costo").val()) - ret.precio_compra).toFixed(2);
                    total_venta = (parseFloat($("#total_venta").val()) - ret.precio_venta).toFixed(2);
                    $("#total_costo").val(total_costo);
                    $("#total_venta").val(total_venta);  
                }
                $(".ui-icon-closethick").trigger('click');
                return true;
            },
            processing: true
        },
        gridComplete: function () {
            if (jQuery("div.ui-jqgrid-bdiv > DIV").height() < 249) {
                jQuery("#list").parents('div.ui-jqgrid-bdiv').css("height", 250);
            }
            else {
                jQuery("#list").parents('div.ui-jqgrid-bdiv').css("height", "100%");
            }
        }
    }).jqGrid('navGrid', '#pager',
            {
                add: false,
                edit: false,
                del: false,
                refresh: false,
                search: true,
                view: true,
                searchtext: "Buscar",
                viewtext: "Ver"
            },
    {
        recreateForm: true, closeAfterEdit: true, checkOnUpdate: true, reloadAfterSubmit: true, closeOnEscape: true
         
    },
    {
        reloadAfterSubmit: true, closeAfterAdd: true, checkOnUpdate: true, closeOnEscape: true,
        bottominfo: "Los campos marcados con (*) son obligatorios", width: 350, checkOnSubmit: false
       
    },
    {
        width: 300, closeOnEscape: true
    },
    {
        closeOnEscape: true,
        multipleSearch: false, overlay: false
    },
    {
        closeOnEscape: true,
        width: 400
    },
    {
        closeOnEscape: true
    });
    

}

jQuery(window).bind('resize', function () {
        jQuery("#list").setGridWidth(jQuery('#grid_container').width(), true);
    }).trigger('resize');


