$(document).on("ready", inicio);

var dialogo =
{
    autoOpen: false,
    resizable: false,
    width: 500,
    height: 600,
    modal: true
};

function este(){
window.open('../../fpdf/ayuda_general.pdf');
}

function enter(e) {
    if (e.which === 13 || e.keyCode === 13) {
        ingresarSistema();
        return false;
    }
    return true;
}

function cancelar(){
    $("#crear_empresa").dialog("close");  
    $("#txt_usuario").val("");
    $("#txt_contra").val("");
}

function guardar_empresa(){
    if ($("#nombre_empresa").val() === "") {
        $("#nombre_empresa").focus();
        alertify.error("Ingrese nombre de la empresa");
    } else {
        if ($("#ruc_empresa").val() === "") {
            $("#ruc_empresa").focus();
            alertify.error("Ingrese ruc de la empresa");
        }else{
            if ($("#direccion_empresa").val() === "") {
                $("#direccion_empresa").focus();
                alertify.error("Ingrese dirección de la empresa");
            }else{
                if ($("#telefono_empresa").val() === "") {
                    $("#telefono_empresa").focus();
                    alertify.error("Ingrese telefóno de la empresa");
                }else{
                    if ($("#pais_empresa").val() === "") {
                        $("#pais_empresa").focus();
                        alertify.error("Ingrese el país");
                    }else{
                        if ($("#ciudad_empresa").val() === "") {
                            $("#ciudad_empresa").focus();
                            alertify.error("Ingrese la ciudad");
                        }else{
                            $.ajax({
                                type: "POST",
                                url: "../procesos/guardar_empresa.php",
                                data: "nombre_empresa=" + encodeURIComponent($("#nombre_empresa").val()) + "&ruc_empresa=" + $("#ruc_empresa").val() + "&direccion_empresa=" + $("#direccion_empresa").val() +
                                "&telefono_empresa=" + $("#telefono_empresa").val() + "&celular_empresa=" + $("#celular_empresa").val() + "&pais_empresa=" + $("#pais_empresa").val() + "&ciudad_empresa=" + $("#ciudad_empresa").val() + "&fax_empresa=" + $("#fax_empresa").val() + "&correo_empresa=" + $("#correo_empresa").val() + "&pagina_empresa=" + $("#pagina_empresa").val()+ "&propietario_empresa=" + $("#propietario_empresa").val()+ "&descripcion_empresa=" + $("#descripcion_empresa").val(),
                                success: function(data) {
                                    var val = data;
                                    if (val == 1) {
                                        alertify.alert("Empresa guardada Correctamente", function(){
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

function retornar(){
//     location.href("../");
     
     window.location.assign("../");
} 

function inicio() {
    $("#ruc_empresa").validCampoFranz("0123456789");
    $("#telefono_empresa").validCampoFranz("0123456789");
    $("#celular_empresa").validCampoFranz("0123456789");
    $("#ruc_empresa").attr("maxlength", "13");
    
    $("#btnIngreso").click(function(e) {
        e.preventDefault();
    });
    $("#btnGuardar").click(function(e) {
        e.preventDefault();
    });
    $("#btnRetornar").click(function(e) {
        e.preventDefault();
    });
    
    ////////////eventos botones/////////////
    $("#btnCancelar").on("click", cancelar);
    $("#btnGuardar").on("click", guardar_empresa);
    $("#btnIngreso").on("click", ingresarSistema);
    $("#btnRetornar").on("click", retornar);
    //////////////////////////////////////
   
    ////////////dialogo///////////////
    // $("#crear_empresa").dialog(dialogo);
    
    ///////////////////////////////
    $("#txt_usuario").focus();
    $("#txt_contra").on("keypress", enter);
    $("#txt_usuario").on("keypress", enter);
    
}

function ingresarSistema() {
    if ($("#txt_usuario").val() === "") {
        $("#txt_usuario").focus();
        alertify.alert("Ingrese el usuario");
    } else {
        if ($("#txt_contra").val() === "") {
            $("#txt_contra").focus();
            alertify.alert("Ingrese la contraseña");
        }else{
            $.ajax({
                url: '../procesos/index.php',
                type: 'POST',
                data: "usuario=" + $("#txt_usuario").val() + "&clave=" + $("#txt_contra").val() + "&id_empresa=" + $("#empresa").val(),
                success: function(data) {
                    var val = data;
                    if (val == 1) {
                        if($("#empresa").val() === null){
                            alertify.confirm("Desea crear una nueva empresa", function (e) {
                                if (e) {
                                    $("#crear_empresa").dialog("open"); 
                                }else{
                                    $("#txt_usuario").val("");
                                    $("#txt_contra").val(""); 
                                }
                            });
                        }else{
                            window.location.href = "principal";
                        }
                    } else {
                        if (val == 2) {
                            if($("#empresa").val() === "" || $("#empresa").val() === null){
                                $("#txt_usuario").val("");
                                $("#txt_contra").val("");
                                $("#txt_usuario").focus();
                                alertify.alert("Imposible acceder al sistema"); 
                            }else{
                                window.location.href = "principal";  
                            }
                        }else{
                            if (val == 0) {
                                $("#txt_contra").val("")
                                $("#txt_contra").focus();
                                alertify.alert("Error... Los datos son incorrectos ingrese nuevamente");
                            }
                        }
                    }
                }
            });
        }
    }
}

