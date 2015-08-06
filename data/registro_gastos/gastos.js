$(document).on("ready", inicio);

function evento(e) {
    e.preventDefault();
}

function este(){
window.open('../../fpdf/ayuda_general.pdf');
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

var dialogo =
{
    autoOpen: false,
    resizable: false,
    width: 400,
    height: 220,
    modal: true
};

var dialogo2 =
{
    autoOpen: false,
    resizable: false,
    width: 830,
    height: 350,
    modal: true,
    // position: "top",
    show: "explode",
    hide: "blind"    
}

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
    width: 225,
    height: 150,
    modal: true,
    position: "top",
    show: "explode",
    hide: "blind"
    
}

function ValidNum(e) {
    if (e.keyCode < 48 || e.keyCode > 57) {
        e.returnValue = false;
    }
    return true;
}

function limpiar_factura(){
    location.reload(); 
}

function inicio() { 
    show();
    $("#descuento").spinner({
        min: 0, 
        max: 0
    });
    
    $("#btncargar").click(function(e) {
        e.preventDefault();
    });
    $("#btnAgregar").click(function(e) {
        e.preventDefault();
    });
    $("#btnGuardarSeries").click(function(e) {
        e.preventDefault();
    });
    $("#btnGuardar").click(function(e) {
        e.preventDefault();
    });
    $("#btnModificar").click(function(e) {
        e.preventDefault();
    });
    $("#btnImprimir").click(function (){        
        window.open("../../reportes/factura_venta.php?hoja=A4&id="+$("#comprobante").val(),'_blank');
    });
    $("#btnNuevo").click(function(e) {
        e.preventDefault();
    });
    $("#btnAnular").click(function(e) {
        e.preventDefault();
    });
    $("#btnAceptar").click(function(e) {
        e.preventDefault();
    });
    $("#btnSalir").click(function(e) {
        e.preventDefault();
    });
    $("#btnAcceder").click(function(e) {
        e.preventDefault();
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
    });
    $("#btnImprimir").click(function(e) {
        e.preventDefault();
    });
    $("#btnAtras").click(function(e) {
        e.preventDefault();
    });
    $("#btnAdelante").click(function(e) {
        e.preventDefault();
    });

    $("#btnAceptar").click(function (){
        var id = jQuery("#list2").jqGrid('getGridParam', 'selrow');
        jQuery('#list2').jqGrid('restoreRow', id);
        var ret = jQuery("#list2").jqGrid('getRowData', id);
        crear_gasto(ret.id_factura_venta, ret.total_gasto, ret.total_venta);
    });
    
    $("#ingreso_gastos").dialog(dialogo);
    $("#buscar_facturas_venta").dialog(dialogo2);

    $("#btnBuscar").click(function (){
        $("#buscar_facturas_venta").dialog("open");   
    })
      
    $("#valor").keypress(function(e) {
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
    
    //////////////para precio////////
    $("#precio").keypress(function(e) {
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
    ////////////////////////////////

    ///////////calendarios////////////
    $("#fecha_actual").datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');

    jQuery("#list2").jqGrid({
        url: 'xmlBuscarFacturaVenta2.php',
        datatype: 'xml',
        colNames: ['ID','IDENTIFICACIÓN','CLIENTE', 'FACTURA NRO.','FECHA','MONTO TOTAL','SALDO RESTANTE'],
        colModel: [
            {name: 'id_factura_venta', index: 'id_factura_venta', editable: false, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 50},
            {name: 'identificacion', index: 'identificacion', editable: false, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 150},
            {name: 'nombres_cli', index: 'nombres_cli', editable: true, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 200},
            {name: 'num_factura', index: 'num_factura', editable: true, search: true, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 200},
            {name: 'fecha_actual', index: 'fecha_actual', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 100},
            {name: 'total_venta', index: 'total_venta', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 120},
            {name: 'total_gasto', index: 'total_gasto', editable: true, search: false, hidden: false, editrules: {edithidden: false}, align: 'center',frozen: true, width: 140}
        ],
        rowNum: 30,
        width: 800,
        height:220,
        sortable: true,
        rowList: [10, 20, 30],
        pager: jQuery('#pager2'),
        sortname: 'id_factura_venta',
        sortorder: 'asc',
        viewrecords: true,              
        ondblClickRow: function(){
        var id = jQuery("#list2").jqGrid('getGridParam', 'selrow');
        jQuery('#list2').jqGrid('restoreRow', id);
        var ret = jQuery("#list2").jqGrid('getRowData', id); 
        
        if(parseFloat(ret.total_gasto) <= parseFloat(0.00)){
           alertify.alert("Factura al limite");   
        }else{
            $("#ingreso_gastos").dialog("open"); 
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
           if(parseFloat(ret.total_gasto) <= parseFloat(0.00)){
           alertify.alert("Factura al limite");   
            }else{
                $("#ingreso_gastos").dialog("open"); 
            }
        }  else {
            alertify.alert("Seleccione una Factura");
        }
    }
});

}


function crear_gasto(id_factura, total_gasto, total_venta ){
    if($("#descripcion").val() == ""){
        $("#descripcion").focus();
        alertify.alert("Ingrese la descripción");
    }else{
        if($("#valor").val() == ""){
            $("#valor").focus();
            alertify.alert("Ingrese el valor");
        } else{
            if(parseFloat($("#valor").val()) > parseFloat(total_gasto)) {
                alertify.alert("Error... El valor excede al saldo disponible");
            }else{
                ///////////////guardar gastos///////////////////
                $.ajax({
                    type: "POST",
                    url: "guardar_gastos.php",
                    data: "id_factura_venta=" + id_factura + "&comprobante=" + $("#comprobante").val() + "&fecha_actual=" + $("#fecha_actual").val() + "&hora_actual=" + $("#hora_actual").val() + "&descripcion=" + $("#descripcion").val() + "&valor=" + $("#valor").val() + "&saldo=" + total_venta,
                    success: function(data) {
                        var val = data;
                        if (val == 1) {
                            $("#ingreso_gastos").dialog("close");
                            $("#buscar_facturas_venta").dialog("close");
                            alertify.alert("Gasto Agragado");
                        }
                    }
                }); 
                ///////////////////////////////////////////////
        
                //////////recuperar gastos/////////////////////    
                $.ajax({
                    type: "POST",
                    url: "buscar_gastos.php",	
                    data: "id="+id_factura,
                    dataType: 'json',
                    success: function(response) {
                        $("#tablaNuevo").css('display','inline-table');
                        $("#tablaNuevo tbody").empty(); 
                        for (var i = 0; i < response.length; i=i+9) {
                            $("#tablaNuevo tbody").append( "<tr>" +
                                "<td align=center >" + response[i+1] + "</td>" +
                                "<td align=center>" + response[i+2] + "</td>" +	            
                                "<td align=center>" + response[i+3] + "</td>" + 
                                "<td align=center>" + response[i+4] + "</td>" + 
                                "<td align=center>" + response[i+5] + "</td>" + 
                                "<td align=center>" + response[i+6] + "</td>" + 
                                "<td align=center>" + response[i+7] + "</td>" + 
                                "<td align=center>" + response[i+8] + "</td>" +
                                "<tr>");                    
                        }
                        $("#descripcion").val("");
                        $("#valor").val("");
                        $("#list2").trigger('reloadGrid');
                    }                    
                });
            }
        }
    }
}



