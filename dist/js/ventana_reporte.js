$(document).on("ready",inicio);

var modal = (function(){
    var 
    method = {},
    $overlay,
    $modal,
    $content,
    $close;
    method.center = function () {
        var top, left;
        top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;
        left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;
        $modal.css({
            top:top + $(window).scrollTop(), 
            left:left + $(window).scrollLeft()
        });
    };
    method.open = function (settings) {    	
        $content.empty().append(settings.content);
        $modal.css({
            width: settings.width || 'auto', 
            height: settings.height || 'auto'
        });

        method.center();
        $(window).bind('resize.modal', method.center);
        $modal.show();
        $overlay.show();
    };

    method.close = function () {
        $modal.hide();
        $overlay.hide();
        $content.empty();
        $(window).unbind('resize.modal');
    };

    $overlay = $('<div id="overlay"></div>');
    $modal = $('<div id="modal"></div>');
    $content = $('<div id="content"></div>');
    $close = $('<a id="close" href="">close</a>');

    $modal.hide();
    $overlay.hide();
    $modal.append($content, $close);

    $(document).ready(function(){
        $('body').append($overlay, $modal);						
    });

    $close.click(function(e){
        e.preventDefault();
        method.close();
    });

    return method;
}());

function inicio(){
    $("#producto_general").on("click",ventana);
    $("#producto_marca_categoria").on("click",ventana_mar_cat);
    $("#producto_existencia_minima").on("click",ventana_existencia);
    $("#agrupados_proveedor").on("click",ventana_agrupados_prov);    
    $("#reporte_factura_compra").on("click",ventana_factura_compra);
    $("#reporte_factura_venta").on("click",ventana_factura_venta);
    $("#resumenFacturas").on("click",resumen_facturas);
    $("#resumenFacturasCompras").on("click",resumen_facturas_compras);
    $("#ventaGeneralClientes").on("click",venta_general_clientes);
    $("#ventaGeneral").on("click",venta_general);
    $("#estadosCuentaProveedores").on("click",estadosCuentaProveedores);
    $("#estadosCuentaClientes").on("click",estadosCuentaClientes);
    
    $("#reporte_nota_credito").on("click",reporte_nota_credito);
    $("#proformas").on("click",proformas);
    $("#reporte_dev_compras").on("click",reporte_dev_compras);
    $("#reporte_facturas_notas_anuladas").on("click",reporte_facturas_notas_anuladas);
    $("#reporte_general").on("click",reporte_general);
    $("#cobros_realizados").on("click",cobros_realizados);
    $("#pagos_realizados").on("click",pagos_realizados);
    $("#facturas_canceladas").on("click",facturas_canceladas);
    $("#facturas_canceladas_proveedor").on("click",facturas_canceladas_proveedor);
    $("#facturas_pagar_proveedor").on("click",facturas_pagar_proveedor);
    $("#facturas_cobrar_clientes").on("click",facturas_cobrar_clientes);
    $("#reporte_utilidad_producto").on("click",reporte_utilidad_producto);
    $("#reporte_utilidad_factura").on("click",reporte_utilidad_factura);
    $("#reporte_utilidad_factura_general").on("click",reporte_utilidad_factura_general);
    $("#orden_produccion").on("click",orden_produccion);
    $("#lista_proformas").on("click",lista_proformas);
    $("#equipos_recibidos").on("click",equipos_recibidos);
    $("#equipos_reparados").on("click",equipos_reparados);
    $("#equipos_en_reparacion").on("click",equipos_en_reparacion);
    $("#equipos_entregados").on("click",equipos_entregados);
    
    $("#autorizaciones_cliente").on("click",autorizaciones_cliente);
    $("#autorizaciones_cliente_fechas").on("click",autorizaciones_cliente_fechas);
    $("#autorizaciones_cliente_caducidad").on("click",autorizaciones_cliente_caducidad);
    
    $("#gastos").on("click",gastos);
    $("#gastos_general").on("click",gastos_general);
    $("#buscar_serie").on("click",buscar_serie);
    $("#gastos_internos").on("click",gastos_internos);
    $("#diario_caja").on("click",diario_caja);
    $("#ordenes_produccion_fechas").on("click",ordenes_produccion_fechas);
    $("#total_director").on("click",total_director);
    
}
function Defecto(e){
    e.preventDefault();
}
function ventana(e){
    modal.open({
        content: "<input type='radio' name='group1' id='excel' value='Reporte en Excel' > <label for='excel'>Reporte en Excel</label> <br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte' onclick='return fn_reporte(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporte').button();
    e.preventDefault();  
}

function fn_reporte(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){    	
        window.open('../../phpexcel/reporte_productos.php', '_blank');	
    } else{
        window.open('../../reportes/reporte_productos.php', '_blank');		
    }  
    modal.close();  
}

function ventana_mar_cat(e){	
    modal.open({
        content: "<input type='radio' name='group1' id='excel' value='Reporte en Excel' > <label for='excel'>Reporte en Excel</label> <br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><label>Categorías</label><select id='sel_categoria' style='width:150px;float:right'></select><br><label>Marcas</label><select id='sel_marcas' style='width:150px;float:right'></select><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_mar_cat' onclick='return fn_reporte_mar_cat(event)' href='#'>Generar Reporte</a>"
    });
    $("#sel_marcas").load("../productos/marcas_combos.php");   
    $("#sel_categoria").load("../productos/categorias_combos.php"); 
    $('.generarReporte_mar_cat').button();	
    e.preventDefault();  
}

function fn_reporte_mar_cat(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){    	
        window.open('../../phpexcel/reporte_categoria_marcas.php?marca='+$('#sel_marcas').val()+'&categoria='+$('#sel_categoria').val(), '_blank');	
    } else{
        window.open('../../reportes/reporte_categoria_marcas.php?marca='+$("#sel_marcas").val()+'&categoria='+$("#sel_categoria").val(), '_blank');		
    } 
    modal.close();  
}

function ventana_existencia(e){	
    modal.open({
        content: "<input type='radio' name='group1' id='excel' value='Reporte en Excel' > <label for='excel'>Reporte en Excel</label> <br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_existencia' onclick='return fn_reporte_existencia(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporte_existencia').button();
    e.preventDefault();  
}

function fn_reporte_existencia(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){    	
        window.open('../../phpexcel/reporte_existencia_minima.php', '_blank');	
    } else{
        window.open('../../reportes/reporte_existencia_minima.php', '_blank');		
    }  
}

function fn_cambio(e){
    if(document.getElementById("tam_hoja").value=='Personalizar'){		
        $("#content").append("<br id='1' class='s' ><br id='2' class='s'><div id='tam'><label for='largo' style='line-height:20px;float:left'>Largo</label><input type='number' value='73'  id='largo' style='float: right;' /></div><br id='3' class='s'>")
    } else{	
        $(".s").remove();		
        $("#1").remove();		
        $("#2").remove();
        $("#3").remove();		
        $("#tam").remove();
    }
}

function ventana_agrupados_prov(e){ 
    modal.open({
        content: "<label for='buscarProv'>Buscar</label><input type='text' name='buscarProv' id='buscarProv' /><input type='hidden' id='idProv' /><br><input type='radio' name='group1' id='excel' value='Reporte en Excel' > <label for='excel'>Reporte en Excel</label> <br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_agrupados_prov' onclick='return fn_reporte_agrupados_prov(event)' href='#'>Generar Reporte</a>"
    });
    $("#buscarProv").autocomplete({
        source: "../../procesos/buscar_proveedor_nombre.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#buscarProv").val(ui.item.value);            
        $("#idProv").val(ui.item.id_proveedor);
        return false;
        },
        select: function(event, ui) {
        $("#buscarProv").val(ui.item.value);            
        $("#idProv").val(ui.item.id_proveedor);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    $('.generarReporte_agrupados_prov').button();   
    e.preventDefault();  
}

function fn_reporte_agrupados_prov(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');    
    } else{
        window.open('../../reportes/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');      
    }   
}
function ventana_factura_compra(e){ 
    modal.open({
        content: "<label for='buscarNumero'>Buscar Factura: </label><input type='text' name='buscarNumero' id='buscarNumero' /><input type='hidden' id='idFac' /><br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_factura_compra' onclick='return fn_reporte_factura_compras(event)' href='#'>Generar Reporte</a>"
    });
    $("#buscarNumero").autocomplete({
        source: "../../procesos/buscar_factura_compra.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#buscarNumero").val(ui.item.value);            
        $("#idFac").val(ui.item.id_factura_compra);
        return false;
        },
        select: function(event, ui) {
        $("#buscarNumero").val(ui.item.value);            
        $("#idFac").val(ui.item.id_factura_compra);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    $('.generarReporte_factura_compra').button();   
    e.preventDefault();  
}
function fn_reporte_factura_compras(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');    
    } else{
        window.open("../../reportes/factura_compra.php?id="+$("#idFac").val(),'_blank');
    }   
}

function ventana_factura_venta(e){ 
    modal.open({
        content: "<label for='buscarNumero'>Buscar Factura: </label><input type='text' name='buscarNumero' id='buscarNumero' /><input type='hidden' id='idFac' /><br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_factura_venta' onclick='return fn_reporte_factura_venta(event)' href='#'>Generar Reporte</a>"
    });
    $("#buscarNumero").autocomplete({
        source: "../../procesos/buscar_factura_venta.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#buscarNumero").val(ui.item.value);            
        $("#idFac").val(ui.item.id_factura_venta);
        return false;
        },
        select: function(event, ui) {
        $("#buscarNumero").val(ui.item.value);            
        $("#idFac").val(ui.item.id_factura_venta);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    $('.generarReporte_factura_venta').button();   
    e.preventDefault();  
}

function fn_reporte_factura_venta(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/factura_venta.php?id='+$('#idProv').val(), '_blank');    
    } else{
        window.open('../../reportes/factura_venta.php?hoja='+"A4"+"&id="+$('#idFac').val(), '_blank');      
    }   
}

function resumen_facturas_compras(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='excel' value='Reporte en Excel' > <label for='excel'>Reporte en Excel</label> <br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteFacturasCompras' onclick='return fn_reporte_factura_compra(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteFacturasCompras').button();
    $( "#inicio" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_reporte_factura_compra(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}

function resumen_facturas(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='excel' value='Reporte en Excel' > <label for='excel'>Reporte en Excel</label> <br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteResumen' onclick='return fn_resumen_facturas(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteResumen').button();
    $( "#inicio" ).datepicker({
     
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
    
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}
function fn_resumen_facturas(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/facturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/facturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}

function venta_general_clientes(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='excel' value='Reporte en Excel' > <label for='excel'>Reporte en Excel</label> <br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteVenta' onclick='return fn_venta_general_clientes(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteVenta').button();
    $( "#inicio" ).datepicker({
     
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
    
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_venta_general_clientes(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasVentas.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/resumenFacturasVentas.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}

function venta_general(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='excel' value='Reporte en Excel' > <label for='excel'>Reporte en Excel</label> <br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteVentaGeneral' onclick='return fn_venta_general(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteVentaGeneral').button();
    $( "#inicio" ).datepicker({
     
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
    
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_venta_general(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/facturasVentas.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/facturasVentas.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
//////////////////
function estadosCuentaProveedores(e){ 
    modal.open({
        content: "<label for='buscarProv' style='padding:6px;'>Buscar</label><input type='text' name='buscarProv' id='buscarProv' style='float: right;padding:2px;' /><input type='hidden' id='idProv' /><br><label style='padding:6px;'>Fecha Inicio</label> <input type='text' id='inicio' style='padding:2px;'><br> <label style='padding:6px;'>Fecha Fin</label> <input type='text' id='fin' style='float: right;padding:2px;'><br><input type='radio' name='group1' id='excel' value='Reporte en Excel' > <label for='excel'>Reporte en Excel</label> <input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_estadosCuentaProveedores' onclick='return fn_estadosCuentaProveedores(event)' href='#'>Generar Reporte</a>"
    });
    $("#buscarProv").autocomplete({
        source: "../../procesos/buscar_proveedor_nombre.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#buscarProv").val(ui.item.value);            
        $("#idProv").val(ui.item.id_proveedor);
        return false;
        },
        select: function(event, ui) {
        $("#buscarProv").val(ui.item.value);            
        $("#idProv").val(ui.item.id_proveedor);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    $('.generarReporte_estadosCuentaProveedores').button();   
    $( "#inicio" ).datepicker({
     
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
    
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_estadosCuentaProveedores(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');    
    } else{        
        window.open('../../reportes/reporte_agrupados_prov.php?hoja='+hoja+"&id="+$('#idProv').val(), '_blank');      
    }   
}
////////////////////////////
function estadosCuentaClientes(e){ 
    modal.open({
        content: "<label for='buscarCli' style='padding:6px;'>Buscar</label><input type='text' name='buscarCli' id='buscarCli' style='float: right;padding:2px;' /><input type='hidden' id='idCli' /><br><label style='padding:6px;'>Fecha Inicio</label> <input type='text' id='inicio' style='padding:2px;'><br> <label style='padding:6px;'>Fecha Fin</label> <input type='text' id='fin' style='float: right;padding:2px;'><br><input type='radio' name='group1' id='excel' value='Reporte en Excel' > <label for='excel'>Reporte en Excel</label> <input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_estadosCuentaClientes' onclick='return fn_estadosCuentaClientes(event)' href='#'>Generar Reporte</a>"
    });
    $("#buscarCli").autocomplete({
        source: "../../procesos/busquedaCliente.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#buscarCli").val(ui.item.value);            
        $("#idCli").val(ui.item.id_proveedor);
        return false;
        },
        select: function(event, ui) {
        $("#buscarCli").val(ui.item.value);            
        $("#idCli").val(ui.item.id_proveedor);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    $('.generarReporte_estadosCuentaClientes').button();   
    $( "#inicio" ).datepicker({
     
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
    
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_estadosCuentaClientes(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');    
    } else{        
        window.open('../../reportes/reporte_agrupados_prov.php?hoja='+hoja+"&id="+$('#idProv').val(), '_blank');      
    }   
}
///////////////////////


function reporte_nota_credito(e){ 
    modal.open({
        content: "<label for='buscarNotaCredito' style='padding:6px;'>Buscar</label><input type='text' name='buscarNotaCredito' id='buscarNotaCredito' style='float: right;padding:2px;' /><input type='hidden' id='idNC' /><br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_notasCredito' onclick='return fn_reporte_nota_credito(event)' href='#'>Generar Reporte</a>"
    });
    $("#buscarNotaCredito").autocomplete({
        source: "../../procesos/buscar_dev_venta.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#buscarNotaCredito").val(ui.item.value);            
        $("#idNC").val(ui.item.id_devolucion_venta);
        return false;
        },
        select: function(event, ui) {
        $("#buscarNotaCredito").val(ui.item.value);            
        $("#idNC").val(ui.item.id_devolucion_venta);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    $('.generarReporte_notasCredito').button();   
    
    e.preventDefault();  
}
function fn_reporte_nota_credito(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
    //window.open('../phpexcel/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');    
    } else{        
        window.open('../../reportes/notaCredito.php?id='+$("#idNC").val(), '_blank');      
    }   
}
///////////////////////

function proformas(e){ 
    modal.open({
        content: "<label for='buscarProforma' style='padding:6px;'>Buscar</label><input type='text' name='buscarProforma' id='buscarProforma' style='float: right;padding:2px;' /><input type='hidden' id='idProf' /><br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_proforma' onclick='return fn_proformas(event)' href='#'>Generar Reporte</a>"
    });
    $("#buscarProforma").autocomplete({
        source: "../../procesos/buscar_proforma.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#buscarProforma").val(ui.item.value);            
        $("#idProf").val(ui.item.id_proforma);
        return false;
        },
        select: function(event, ui) {
        $("#buscarProforma").val(ui.item.value);            
        $("#idProf").val(ui.item.id_proforma);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    $('.generarReporte_proforma').button();   
    
    e.preventDefault();  
}
function fn_proformas(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
    //window.open('../phpexcel/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');    
    } else{        
        window.open('../../reportes/proforma.php?id='+$("#idProf").val(), '_blank');      
    }   
}
/////////////////////////
function reporte_dev_compras(e){ 
    modal.open({
        content: "<label for='buscar_dev_compra' style='padding:6px;'>Buscar</label><input type='text' name='buscar_dev_compra' id='buscar_dev_compra' style='float: right;padding:2px;' /><input type='hidden' id='idDevCom' /><br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_devCompra' onclick='return fn_reporte_dev_compras(event)' href='#'>Generar Reporte</a>"
    });
    $("#buscar_dev_compra").autocomplete({
        source: "../../procesos/buscar_dev_compra.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#buscar_dev_compra").val(ui.item.value);            
        $("#idDevCom").val(ui.item.id_devolucion_compra);
        return false;
        },
        select: function(event, ui) {
        $("#buscar_dev_compra").val(ui.item.value);            
        $("#idDevCom").val(ui.item.id_devolucion_compra);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    $('.generarReporte_devCompra').button();   
    
    e.preventDefault();  
}
function fn_reporte_dev_compras(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
    //window.open('../phpexcel/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');    
    } else{        
        window.open('../../reportes/devolucion_compra.php?id='+$("#idDevCom").val(), '_blank');      
    }   
}
/////////////////////////
function reporte_facturas_notas_anuladas(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteFacturasNotasAnuladas' onclick='return fn_reporte_facturas_notas_anuladas(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteFacturasNotasAnuladas').button();
    $( "#inicio" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_reporte_facturas_notas_anuladas(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../phpexcel/resumenFacturasNotasAnuladas.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/resumenFacturasNotasAnuladas.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
////////////////////////////
function reporte_general(e){
    var hoja=$("#tam_hoja").val()
    window.open('../../reportes/general.php', '_blank');        
}
/////////////////////////
function cobros_realizados(e){ 
    modal.open({
        content: "<label for='tipoCobro' style='padding:6px;'>Buscar</label><select name='tipoCobro' id='tipoCobro' style='float: right;padding:2px;'><option value='1'>Cuentas Internas</option><option value='2'>Cuentas Externas</option></select><br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_cobrosRealizados' onclick='return fn_cobros_realizados(event)' href='#'>Generar Reporte</a>"
    });
    
    $('.generarReporte_cobrosRealizados').button();   
    
    e.preventDefault();  
}
function fn_cobros_realizados(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
    //window.open('../phpexcel/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');    
    } else{        
        if($("#tipoCobro").val()==1){
            window.open('../../reportes/cobros_realizados_internos.php', '_blank');         
        }else{
            window.open('../../reportes/cobros_realizados.php', '_blank');      
        }
    }   
}
/////////////////////////
function pagos_realizados(e){ 
    modal.open({
        content: "<label for='tipoCobro' style='padding:6px;'>Buscar</label><select name='tipoCobro' id='tipoCobro' style='float: right;padding:2px;'><option value='1'>Cuentas Internas</option><option value='2'>Cuentas Externas</option></select><br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_pagosRealizados' onclick='return fn_pagos_realizados(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporte_pagosRealizados').button();   
    e.preventDefault();  
}

function fn_pagos_realizados(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
    //window.open('../phpexcel/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');    
    } else{        
        if($("#tipoCobro").val()==1){
            window.open('../../reportes/pagos_realizados_internos.php', '_blank');         
        }else{
            window.open('../../reportes/pagos_realizados.php', '_blank');      
        }
        
    }   
}
//////////////
function facturas_canceladas(e){
    var hoja=$("#tam_hoja").val()
    facturas_canceladas
    window.open('../../reportes/facturas_canceladas.php', '_blank');      
    
}
//////////////
function facturas_canceladas_proveedor(e){
    var hoja=$("#tam_hoja").val()
    facturas_canceladas
    window.open('../../reportes/facturas_canceladas_proveedor.php', '_blank');      
    
}
///////////////////
function facturas_cobrar_clientes(e){
    var hoja=$("#tam_hoja").val()
    facturas_canceladas
    window.open('../../reportes/facturas_por_cobrar.php', '_blank');      
    
}
///////////////////
function facturas_pagar_proveedor(e){
    var hoja=$("#tam_hoja").val()
    facturas_canceladas
    window.open('../../reportes/facturas_por_pagar.php', '_blank');      
    
}
/////////////////////////
function reporte_utilidad_producto(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteUtilidadProducto' onclick='return fn_reporte_utilidad_producto(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteUtilidadProducto').button();
    $( "#inicio" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_reporte_utilidad_producto(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/utilidad_productos.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
/////////////////////////
function reporte_utilidad_factura(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteUtilidadFactura' onclick='return fn_reporte_utilidad_factura(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteUtilidadFactura').button();
    $( "#inicio" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_reporte_utilidad_factura(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/utilidad_factura.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
////////////////////////////
function reporte_utilidad_factura_general(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteUtilidadFacturaGeneral' onclick='return fn_reporte_utilidad_factura_general(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteUtilidadFacturaGeneral').button();
    $( "#inicio" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}
function fn_reporte_utilidad_factura_general(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/utilidad_factura_general.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
////////////////////////////
function orden_produccion(e){ 
    modal.open({
        content: "<label for='buscar_orden' style='padding:6px;'>Buscar</label><input type='text' name='buscar_orden' id='buscar_orden' style='float: right;padding:2px;' /><input type='hidden' id='idOrden' /><br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_Orden' onclick='return fn_orden_produccion(event)' href='#'>Generar Reporte</a>"
    });
    $("#buscar_orden").autocomplete({
        source: "../../procesos/buscar_orden.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#buscar_orden").val(ui.item.value);            
        $("#idOrden").val(ui.item.id_ordenes);
        return false;
        },
        select: function(event, ui) {
        $("#buscar_orden").val(ui.item.value);            
        $("#idOrden").val(ui.item.id_ordenes);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    $('.generarReporte_Orden').button();   
    e.preventDefault();  
}
function fn_orden_produccion(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
    //window.open('../phpexcel/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');    
    } else{        
        window.open('../../reportes/orden_produccion.php?id='+$("#idOrden").val(), '_blank');         
    }   
}
/////////////////////////
function lista_proformas(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteListaProformas' onclick='return fn_lista_proformas(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteListaProformas').button();
    $( "#inicio" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_lista_proformas(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/lista_proformas.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
////////////////////////////
function equipos_recibidos(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteRecibidos' onclick='return fn_equipos_recibidos(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteRecibidos').button();
    $( "#inicio" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}
function fn_equipos_recibidos(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/reporteCliente.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
/////////////////////////
function equipos_reparados(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteReparados' onclick='return fn_equipos_reparados(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteReparados').button();
    $( "#inicio" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}
function fn_equipos_reparados(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/reporteReparados.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
/////////////////////////
function equipos_en_reparacion(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteReparacion' onclick='return fn_equipos_en_reparacion(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteReparacion').button();
    $( "#inicio" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_equipos_en_reparacion(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    }
    else{      
        window.open('../../reportes/reporteClienteReparacion.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
/////////////////////////
function equipos_entregados(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteEntregados' onclick='return fn_equipos_entregados(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteEntregados').button();
    $( "#inicio" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}
function fn_equipos_entregados(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/reporteEntregados.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
/////////////////////////
function autorizaciones_cliente(e){ 
    modal.open({
        content: "<label for='buscarCli' style='padding:6px;'>Buscar</label><input type='text' name='buscarCli' id='buscarCli' style='float: right;padding:2px;' /><input type='hidden' id='idCli' /><br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_autorizacion' onclick='return fn_autorizaciones_cliente(event)' href='#'>Generar Reporte</a>"
    });
    $("#buscarCli").autocomplete({
        source: "../../procesos/busquedaCliente.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#buscarCli").val(ui.item.value);            
        $("#idCli").val(ui.item.label);
        return false;
        },
        select: function(event, ui) {
        $("#buscarCli").val(ui.item.value);            
        $("#idCli").val(ui.item.label);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    $('.generarReporte_autorizacion').button();   
   
    e.preventDefault();  
}
function fn_autorizaciones_cliente(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');    
    } else{        
        window.open('../../reportes/reporte_autorizacion.php?id='+$('#idCli').val(), '_blank');      
    }   
}
/////////////////////////////
function autorizaciones_cliente_fechas(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteEntregadosFecha' onclick='return fn_autorizaciones_cliente_fechas(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteEntregadosFecha').button();
    $( "#inicio" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}
function fn_autorizaciones_cliente_fechas(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/reporte_autorizacion_fechas.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
/////////////////////////
function autorizaciones_cliente_caducidad(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Caducidad</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteEntregadosCaducidad' onclick='return fn_autorizaciones_cliente_caducidad(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarReporteEntregadosCaducidad').button();
    $( "#fin" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2
    });
    e.preventDefault();  
}

function fn_autorizaciones_cliente_caducidad(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/reporte_autorizacion_caducidad.php?&fin='+$('#fin').val(), '_blank');      
    }   
}
/////////////////////////////
function gastos(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarGastos' onclick='return fn_gastos(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarGastos').button();
    $( "#inicio" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}
function fn_gastos(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/gastos_realizados.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
/////////////////////////////
function gastos_general(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarGastosGeneral' onclick='return fn_gastos_general(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarGastosGeneral').button();
    $( "#inicio" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}
function fn_gastos_general(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/gasto_acumulado.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
/////////////////////////
function buscar_serie(e){ 
    modal.open({
        content: "<label for='buscarSerie' style='padding:6px;'>Buscar</label><input type='text' name='buscarSerie' id='buscarSerie' style='float: right;padding:2px;' /><input type='hidden' id='idSerie' /><br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporteSerie' onclick='return fn_buscar_serie(event)' href='#'>Generar Reporte</a>"
    });
    $("#buscarSerie").autocomplete({
        source: "../../procesos/buscar_serie.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#idSerie").val(ui.item.value);            
        $("#buscarSerie").val(ui.item.label);
        return false;
        },
        select: function(event, ui) {
        $("#idSerie").val(ui.item.value);            
        $("#buscarSerie").val(ui.item.label);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    $('.generarReporteSerie').button();   
   
    e.preventDefault();  
}
function fn_buscar_serie(e){
    var hoja=$("#tam_hoja").val()
    var tipo;
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/reporte_agrupados_prov.php?id='+$('#idProv').val(), '_blank');    
    } else{        
        window.open('../../reportes/reporte_serie.php?id='+$('#idSerie').val(), '_blank');      
    }   
}
/////////////////////////////
function gastos_internos(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarGastoInternoFechas' onclick='return fn_gastos_internos(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarGastoInternoFechas').button();
    $( "#inicio" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_gastos_internos(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/gastos_fechas.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
/////////////////////////
function diario_caja(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarDiarioCaja' onclick='return fn_diario_caja(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarDiarioCaja').button();
    $( "#inicio" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_diario_caja(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/diario_caja.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
//////////////////////////
function ordenes_produccion_fechas(e){ 
    modal.open({
        content: "<input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br> <label>Fecha Inicio</label> <input type='text' id='inicio'><br> <label>Fecha Fin</label> <input type='text' id='fin' style='float: right;'><br><br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarOrdenProduccionFecha' onclick='return fn_ordenes_produccion_fechas(event)' href='#'>Generar Reporte</a>"
    });
    $('.generarOrdenProduccionFecha').button();
    $( "#inicio" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}
function fn_ordenes_produccion_fechas(e){
    var hoja=$("#tam_hoja").val()    
    if($('#excel').is(':checked')){     
        window.open('../../phpexcel/resumenFacturasCompras.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');    
    } else{      
        window.open('../../reportes/ordenes_produccion_fechas.php?inicio='+$('#inicio').val()+'&fin='+$('#fin').val(), '_blank');      
    }   
}
////////////////////////////
function total_director(e){ 
    modal.open({
        content: "<label for='buscarDir' style='padding:6px;'>Buscar</label><input type='text' name='buscarDir' id='buscarDir' style='float: right;padding:2px;' /><input type='hidden' id='idDir' /><br><label style='padding:6px;'>Fecha Inicio</label> <input type='text' id='inicio' style='padding:2px;'><br> <label style='padding:6px;'>Fecha Fin</label> <input type='text' id='fin' style='float: right;padding:2px;'><br><input type='radio' name='group1' id='pdf' value='Reporte Pdf' checked> <label for='pdf'>Reporte Pdf</label> <br><a 'id='generar' style='cursor:pointer;font-size:12px;margin-left:40px' class='generarReporte_totalDirector' onclick='return fn_total_director(event)' href='#'>Generar Reporte</a>"
    });
    $("#buscarDir").autocomplete({
        source: "../../procesos/busquedaDirector.php",
        minLength: 1,
        focus: function(event, ui) {
        $("#buscarDir").val(ui.item.label);            
        $("#idDir").val(ui.item.value);
        return false;
        },
        select: function(event, ui) {
        $("#buscarDir").val(ui.item.label);            
        $("#idDir").val(ui.item.value);
        return false;
        }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.label + "</a>")
        .appendTo(ul);
    };
    $('.generarReporte_totalDirector').button();   
    $( "#inicio" ).datepicker({
     
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#fin" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#fin" ).datepicker({
    
        changeMonth: true,
        dateFormat: 'yy-mm-dd',
        changeYear: true,   
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true,   
        numberOfMonths: 2,
        onClose: function( selectedDate ) {
            $( "#inicio" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    e.preventDefault();  
}

function fn_total_director(e){
    window.open('../../reportes/reporte_director.php?id='+$("#idDir").val()+"&inicio="+$("#inicio").val()+"&fin="+$("#fin").val(), '_blank');      
       
}