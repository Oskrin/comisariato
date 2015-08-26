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

var dialogos =
{
    autoOpen: false,
    resizable: false,
    width: 860,
    height: 350,
    modal: true
};

var dialogos_categoria =
{
    autoOpen: false,
    resizable: false,
    width: 230,
    height: 180,
    modal: true
};

var dialogos_marca =
{
    autoOpen: false,
    resizable: false,
    width: 230,
    height: 180,
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

var dialogo5 ={
    autoOpen: false,
    resizable: false,
    width: 500,
    height: 400,
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
    $("#productos").dialog("open");
}

function abrirCategoria() {
    $("#categorias").dialog("open");
}

function abrirMarca() {
    $("#marcas").dialog("open");
}

function abrirCuenta() {
    $("#cuentas").dialog("open");
}

$(function(){
    Test = {
        UpdatePreview: function(obj){
            if(!window.FileReader){
            // don't know how to proceed to assign src to image tag
            } else {
                var reader = new FileReader();
                var target = null;
                reader.onload = function(e) {
                    target =  e.target || e.srcElement;
                    $("#foto").prop("src", target.result);
                };
                reader.readAsDataURL(obj.files[0]);
            }
        }
    };
});

function guardar_producto(){
    if ($("#cod_prod").val() === "") {
        $("#cod_prod").focus();
        alertify.error("Indique un Código");
    } else {
        if ($("#nombre_art").val() === "") {
            $("#nombre_art").focus();
            alertify.error("Nombre del producto");
        } else {
            if ($("#iva").val() === "") {
                $("#iva").focus();
                alertify.error("Seleccione una opción");
            } else {
                if ($("#precio_compra").val() === "") {
                    $("#precio_compra").focus();
                    alertify.error("Indique un precio");
                } else {
                    if ($("#series").val() === "") {
                        $("#series").focus();
                        alertify.error("Seleccione una opción");
                    } else {
                        if ($("#precio_minorista").val() === "") {
                            $("#precio_minorista").focus();
                            alertify.error("Ingrese precio minorista");
                        } else {
                            if ($("#precio_mayorista").val() === "") {
                                $("#precio_mayorista").focus();
                                alertify.error("Ingrese precio mayorista");
                            } else {
                                if ($("#fecha_creacion").val() === "") {
                                    $("#fecha_creacion").focus();
                                    alertify.error("Indique una fecha");
                                }else{
                                    $("#productos_form").submit(function(e) {
                                        var formObj = $(this);
                                        var formURL = formObj.attr("action");
                                        if(window.FormData !== undefined) {	
                                            var formData = new FormData(this);   
                                            formURL=formURL; 
                                            
                                            $.ajax({
                                                url: "guardar_productos.php",
                                                type: "POST",
                                                data:  formData,
                                                mimeType:"multipart/form-data",
                                                contentType: false,
                                                cache: false,
                                                processData:false,
                                                success: function(data, textStatus, jqXHR) {
                                                    var res=data;
                                                    if(res == 1){
                                                        alertify.success('Datos Agregados Correctamente');						    		
                                                        setTimeout(function() {
                                                            location.reload();
                                                        }, 1000);
                                                    } else{
                                                        alertify.error("Error..... Datos no Guardados");
                                                    }
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) 
                                                {
                                                } 	        
                                            });
                                            e.preventDefault();
                                        } else {
                                            var  iframeId = "unique" + (new Date().getTime());
                                            var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');
                                            iframe.hide();
                                            formObj.attr("target",iframeId);
                                            iframe.appendTo("body");
                                            iframe.load(function(e) {
                                                var doc = getDoc(iframe[0]);
                                                var docRoot = doc.body ? doc.body : doc.documentElement;
                                                var data = docRoot.innerHTML;
                                            });
                                        }
                                    });
                                    $("#productos_form").submit();
                                }
                            }
                        }
                    }
                }
            }
        }
    }     
}

function modificar_producto(){
    if ($("#cod_productos").val() === "") {
        alertify.error("Seleccione un producto");
    } else {
        if ($("#cod_prod").val() === "") {
            $("#cod_prod").focus();
            alertify.error("Indique un Código");
        } else {
            if ($("#nombre_art").val() === "") {
                $("#nombre_art").focus();
                alertify.error("Nombre del producto");
            } else {
                if ($("#iva").val() === "") {
                    $("#iva").focus();
                    alertify.error("Seleccione una opción");
                } else {
                    if ($("#precio_compra").val() === "") {
                        $("#precio_compra").focus();
                        alertify.error("Indique un precio");
                    } else {
                        if ($("#series").val() === "") {
                            $("#series").focus();
                            alertify.error("Seleccione una opción");
                        } else {
                            if ($("#precio_minorista").val() === "") {
                                $("#precio_minorista").focus();
                                alertify.error("Ingrese precio minorista");
                            } else {
                                if ($("#precio_mayorista").val() === "") {
                                    $("#precio_mayorista").focus();
                                    alertify.error("Ingrese precio mayorista");
                                } else {
                                    if ($("#fecha_creacion").val() === "") {
                                        $("#fecha_creacion").focus();
                                        alertify.error("Indique una fecha");
                                    }else{
                                        $("#productos_form").submit(function(e) {
                                            var formObj = $(this);
                                            var formURL = formObj.attr("action");
                                            if(window.FormData !== undefined) {	
                                                var formData = new FormData(this);   
                                                formURL=formURL; 
                                            
                                                $.ajax({
                                                    url: "modificar_productos.php",
                                                    type: "POST",
                                                    data:  formData,
                                                    mimeType:"multipart/form-data",
                                                    contentType: false,
                                                    cache: false,
                                                    processData:false,
                                                    success: function(data, textStatus, jqXHR) {
                                                        var res=data;
                                                        if(res == 1){
                                                            alertify.success('Datos Modificados Correctamente');						    		
                                                            setTimeout(function() {
                                                                location.reload();
                                                            }, 1000);
                                                        } else{
                                                            alertify.error("Error..... Datos no Modificados");
                                                        }
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) 
                                                    {
                                                    } 	        
                                                });
                                                e.preventDefault();
                                            } else {
                                                var  iframeId = "unique" + (new Date().getTime());
                                                var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');
                                                iframe.hide();
                                                formObj.attr("target",iframeId);
                                                iframe.appendTo("body");
                                                iframe.load(function(e)
                                                {
                                                    var doc = getDoc(iframe[0]);
                                                    var docRoot = doc.body ? doc.body : doc.documentElement;
                                                    var data = docRoot.innerHTML;
                                                });
                                            }
                                        });
                                        $("#productos_form").submit();
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


function eliminar_productos() {
    if ($("#cod_productos").val() === "") {
        alertify.error("Seleccione un producto");
    } else {
        $("#clave_permiso").dialog("open");  
    }
}

function validar_acceso(){
    if($("#clave").val() == ""){
        $("#clave").focus();
        alertify.error("Ingrese la clave");
    }else{
        $.ajax({
            url: '../../procesos/validar_acceso.php',
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
        url: "eliminar_productos.php",
        data: "cod_productos=" + $("#cod_productos").val(),
        success: function(data) {
            var val = data;
            if (val == 1) {
                alertify.error('Error... El Producto tiene movimientos en el sistema');						    		
                setTimeout(function() {
                    //location.reload();
                },1000);
            }else{
                alertify.success('Producto Eliminado Correctamente');						    		
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

function nuevo_producto() {
    location.reload();
}

function agregar_categoria() {
    if ($("#nombre_categoria").val() === "") {
        $("#nombre_categoria").focus();
        alertify.error("Nombre Categoria");
    }else{
        $.ajax({
            type: "POST",
            url: "guardar_categoria.php",
            data: "nombre_categoria=" + $("#nombre_categoria").val(),
            success: function(data) {
                var val = data;
                if (val == 1) {
                    $("#nombre_categoria").val("");
                    $("#categoria").load("categorias_combos.php");
                    $("#categorias").dialog("close");
                }else{
                    $("#nombre_categoria").val("");
                    alertify.error("Error.... La categoria ya existe");
                }
            }
        });
    }
}

function agregar_marca() {
    if ($("#nombre_marca").val() === "") {
        $("#nombre_marca").focus();
        alertify.error("Nombre Marca");
    }else{
        $.ajax({
            type: "POST",
            url: "guardar_marca.php",
            data: "nombre_marca=" + $("#nombre_marca").val(),
            success: function(data) {
                var val = data;
                if (val == 1) {
                    $("#nombre_marca").val("");
                    $("#marca").load("marcas_combos.php");
                    $("#marcas").dialog("close");
                }else{
                    $("#nombre_marca").val("");
                    alertify.error("Error.... La marca ya existe");
                }
            }
        });
    }
}

function Valida_punto() {
    var key;
    if (window.event)
    {
        key = event.keyCode;
    } else if (event.which)
{
        key = event.which;
    }

    if (key < 48 || key > 57)
    {
        if (key === 46 || key === 8)
        {
            return true;
        } else {
            return false;
        }
    }
    return true;
}

function ValidNum() {
    if (event.keyCode < 48 || event.keyCode > 57) {
        event.returnValue = false;
    }
    return true;
}

function enter(e) {
    if (e.which === 13 || e.keyCode === 13) {
        porcenta();
        return false;
    }
    return true;
}

function enter2(e) {
    if (e.which === 13 || e.keyCode === 13) {
        porcenta2();
        return false;
    }
    return true;
}

// function porcenta(){
//     var resta = parseFloat($("#precio_minorista").val() - $("#precio_compra").val());
//     var entero = resta * 100;
//     var val = Math.round(entero / parseFloat($("#precio_compra").val()));
//    $("#utilidad_minorista").val(val); 
// }

// function porcenta2(){
//     var resta = parseFloat($("#precio_mayorista").val() - $("#precio_compra").val());
//     var entero = resta * 100;
//     var val = Math.round(entero / parseFloat($("#precio_compra").val()));
//     $("#utilidad_mayorista").val(val);    
// }

function inicio() {
    $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
    alertify.set({ delay: 1000 });
    // jQuery().UItoTop({
    //     easingType: 'easeOutQuart'
    // });  
    $("#cod_prod").focus();  
    
    function getDoc(frame) {
        var doc = null;     
     	
        try {
            if (frame.contentWindow) {
                doc = frame.contentWindow.document;
            }
        } catch(err) {
        }
        if (doc) { 
            return doc;
        }
        try { 
            doc = frame.contentDocument ? frame.contentDocument : frame.document;
        } catch(err) {
       
            doc = frame.document;
        }
        return doc;
    }
    
    $("#cod_prod").keyup(function() {
        $.ajax({
            type: "POST",
            url: "comparar_codigo.php",
            data: "codigo=" + $("#cod_prod").val(),
            success: function(data) {
                var val = data;
                if (val == 1) {
                    $("#cod_prod").val("");
                    $("#cod_prod").focus();
                    alertify.error("Error... El código ya existe");
                }
            }
        });
    });
      
    $("#cod_barras").keyup(function() {
        $.ajax({
            type: "POST",
            url: "comparar_codigo2.php",
            data: "codigo=" + $("#cod_barras").val(),
            success: function(data) {
                var val = data;
                if (val == 1) {
                    $("#cod_barras").val("");
                    $("#cod_barras").focus();
                    alertify.error("Error... El código de barras ya existe");
                }
            }
        });
    });
    
    $("#utilidad_minorista").attr("maxlength", "5");
    $("#utilidad_mayorista").attr("maxlength", "5");
    $("#precio_minorista").attr("maxlength", "10");
    $("#precio_mayorista").attr("maxlength", "10");
    $("#precio_compra").keypress(Valida_punto);
    $("#precio_minorista").keypress(Valida_punto);
    $("#precio_mayorista").keypress(Valida_punto);
    $("#utilidad_minorista").keypress(ValidNum);
    $("#utilidad_mayorista").keypress(ValidNum);
    $("#descuento").keypress(ValidNum);
    $("#stock").keypress(ValidNum);
    $("#stock").attr("maxlength", "5");
    $("#maximo").keypress(ValidNum);
    $("#maximo").attr("maxlength", "5");
    $("#minimo").keypress(ValidNum);
    $("#minimo").attr("maxlength", "5");
    
    $("#btnCategoria").click(function(e) {
        e.preventDefault();
    });
    $("#btnMarca").click(function(e) {
        e.preventDefault();
    });
    $("#btnGuardarCategoria").click(function(e) {
        e.preventDefault();
    });
    $("#btnGuardarMarca").click(function(e) {
        e.preventDefault();
    });
    $("#btnGuardar").click(function(e) {
        e.preventDefault();
    });
    $("#btnModificar").click(function(e) {
        e.preventDefault();
    });
    $("#btnEliminar").click(function(e) {
        e.preventDefault();
    });
    $("#btnBuscar").click(function(e) {
        e.preventDefault();
    });
    $("#btnNuevo").click(function(e) {
        e.preventDefault();
    });
    $("#btnNuevo").click(function(e) {
        e.preventDefault();
    });
    $("#btnCuenta").click(function(e) {
        e.preventDefault();
    });
    
    $("#btnGuardarCategoria").on("click", agregar_categoria);
    $("#btnGuardarMarca").on("click", agregar_marca);
    $("#btnGuardar").on("click", guardar_producto);
    $("#btnModificar").on("click", modificar_producto);
    $("#btnNuevo").on("click", nuevo_producto);
    $("#btnCategoria").on("click", abrirCategoria);
    $("#btnMarca").on("click", abrirMarca);
    $("#btnBuscar").on("click", abrirDialogo);
    $("#btnEliminar").on("click", eliminar_productos);
    $("#btnAceptar").on("click", aceptar);
    $("#btnSalir").on("click", cancelar);
    $("#btnAcceder").on("click", validar_acceso);
    $("#btnCancelar").on("click", cancelar_acceso);
    $("#btnCuenta").on("click", abrirCuenta);
    
    $("#precio_minorista").on("keypress", enter);
    $("#precio_mayorista").on("keypress", enter2);
    
    $("#productos").dialog(dialogos);
    $("#categorias").dialog(dialogos_categoria);
    $("#marcas").dialog(dialogos_marca);
    $("#clave_permiso").dialog(dialogo3);
    $("#seguro").dialog(dialogo4);
    $("#cuentas").dialog(dialogo_cuenta);
    
    $("#fecha_creacion").datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');
    
    // $("#utilidad_minorista").keyup(function() {
    //     if($("#precio_compra").val() === ""){
    //         alertify.error("Error... Ingrese precio compra", function (){
    //             $("#precio_compra").focus();   
    //             $("#utilidad_minorista").val(""); 
    //         });
    //     }else{
    //         if ($("#utilidad_minorista").val() === "") {
    //             $("#precio_minorista").val("");
    //         }else {
    //             var precio_minorista = ((parseFloat($("#precio_compra").val()) * parseFloat($("#utilidad_minorista").val())) / 100) + parseFloat($("#precio_compra").val());
    //             var entero = precio_minorista.toFixed(2);
    //             $("#precio_minorista").val(entero);
    //         }
    //     }
    // });    

    // $("#utilidad_mayorista").keyup(function() {
    //     if($("#precio_compra").val() === ""){
    //         alertify.error("Error... Ingrese precio compra", function (){
    //             $("#precio_compra").focus();   
    //             $("#utilidad_mayorista").val(""); 
    //         });
    //     }else{
    //         if ($("#utilidad_mayorista").val() === "") {
    //             $("#precio_mayorista").val("");
    //         } else {
    //             var precio_mayorista = ((parseFloat($("#precio_compra").val()) * parseFloat($("#utilidad_mayorista").val())) / 100) + parseFloat($("#precio_compra").val());
    //             var entero2 = precio_mayorista.toFixed(2);
    //             $("#precio_mayorista").val(entero2);
    //         }
    //     }
    // });

    ////////////cambio evento/////////////
    $("#iva").change(function() {
       if($("#iva").val() == "Si"){
          $("#incluye").val("Si");
          $("#incluye").attr("readOnly", false);
       }else{
        if($("#iva").val() == "No"){
              $("#incluye").val("No");
              $("#incluye").attr("readOnly", true);
        }
       }
    });
    /////////////////////////////////////

    $("#precio_minorista").keyup(function() {
        if($("#precio_compra").val() === ""){
             $("#precio_minorista").val("");
             $("#precio_compra").focus();  
             alertify.error("Error... Ingrese precio compra");
        }else{
            if ($("#precio_minorista").val() === "") {
                $("#utilidad_minorista").val("");
            }
        }
    });


    $("#precio_mayorista").keyup(function() {
        if($("#precio_compra").val() === ""){
             $("#precio_mayorista").val("");
             $("#precio_compra").focus();  
             alertify.error("Error... Ingrese precio compra");
        }else{
            if ($("#precio_mayorista").val() === "") {
                $("#utilidad_mayorista").val("");
            }
        }
    });

    jQuery("#list").jqGrid({
        url: 'datos_productos.php',
        datatype: 'xml',
        colNames: ['ID', 'CÓDIGO', 'CÓDIGO BARRAS', 'ARTICULO', 'IVA', 'SERIES', 'PRECIO COMPRA', 'UTILIDAD MINORISTA', 'PRECIO MINORISTA', 'UTILIDAD MAYORISTA', 'PRECIO MAYORISTA', 'CATEGORIA', 'MARCA', 'DESCUENTO', 'STOCK', 'MÍNIMO', 'MÁXIMO', 'FECHA COMPRA', 'CARACTERISTICAS', 'OBSERVACIONES', 'ESTADO','INVENTARIABLE', 'IMAGEN','','BODEGA','INCLUYE IVA'],
        colModel: [
            {name: 'cod_productos', index: 'cod_productos', editable: true, align: 'center', width: '60', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'cod_prod', index: 'cod_prod', editable: true, align: 'center', width: '120', search: false, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'cod_barras', index: 'cod_barras', editable: true, align: 'center', width: '120', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'nombre_art', index: 'nombre_art', editable: true, align: 'center', width: '180', search: true, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'iva', index: 'iva', editable: true, align: 'center', width: '50', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'series', index: 'series', editable: true, align: 'center', width: '50', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'precio_compra', index: 'precio_compra', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'utilidad_minorista', index: 'utilidad_minorista', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'precio_minorista', index: 'precio_minorista', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'utilidad_mayorista', index: 'utilidad_mayorista', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'precio_mayorista', index: 'precio_mayorista', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'categoria', index: 'categoria', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'marca', index: 'marca', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'descuento', index: 'descuento', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'stock', index: 'stock', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'minimo', index: 'minimo', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'maximo', index: 'maximo', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'fecha_creacion', index: 'fecha_creacion', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'modelo', index: 'modelo', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'aplicacion', index: 'aplicacion', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'vendible', index: 'vendible', editable: true, align: 'center', hidden: true, width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'inventario', index: 'inventario', editable: true, align: 'center', hidden: true, width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'imagen', index: 'imagen', editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'bodegas', index: 'bodegas',hidden: true, editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'descripcion', index: 'descripcion',hidden: false, editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}},
            {name: 'incluye', index: 'incluye',hidden: false, editable: true, align: 'center', width: '120', search: false, frozen: true, editoptions: {readonly: 'readonly'}, formoptions: {elmprefix: ""}}
        ],
        rowNum: 10,
        width: 830,
        height: 200,
        rowList: [10, 20, 30],
        pager: jQuery('#pager'),
        sortname: 'cod_productos',
        shrinkToFit: false,
        sortorder: 'asc',
        caption: 'Lista de Productos',        
        viewrecords: true,
         ondblClickRow: function(){
         var id = jQuery("#list").jqGrid('getGridParam', 'selrow');
         jQuery('#list').jqGrid('restoreRow', id);   
         var ret = jQuery("#list").jqGrid('getRowData', id);
         $("#foto").attr("src", "fotos_productos/"+ ret.imagen);
         jQuery("#list").jqGrid('GridToForm', id, "#productos_form");
         $("#btnGuardar").attr("disabled", true);
         document.getElementById("cod_prod").readOnly = true;
         $("#productos").dialog("close");      
         }
    }).jqGrid('navGrid', '#pager',
        {
            add: false,
            edit: false,
            del: false,
            refresh: true,
            search: true,
            view: false
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

            if (id) {
            jQuery('#list').jqGrid('restoreRow', id);   
            var ret = jQuery("#list").jqGrid('getRowData', id);
            $("#foto").attr("src", "fotos_productos/"+ ret.imagen);
            jQuery("#list").jqGrid('GridToForm', id, "#productos_form");
            $("#btnGuardar").attr("disabled", true);
            document.getElementById("cod_prod").readOnly = true;
            $("#productos").dialog("close"); 
            } else {
                alertify.alert("Seleccione un fila");
            }

        }
    });   
}


