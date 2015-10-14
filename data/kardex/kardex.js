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

function nuevo(){
 location.reload();   
}

function limpiar_campo1(){
    if($("#codigo").val() == ""){
        $("#cod_producto").val("");
        $("#codigo_barras").val("");
        $("#producto").val("");
    }
}

function limpiar_campo2(){
    if($("#producto").val() == ""){
        $("#cod_producto").val("");
        $("#codigo_barras").val("");
        $("#codigo").val("");
    }
}

function kardex() {
     window.open("../../reportes/kardex.php?hoja=A4&id="+$("#cod_producto").val() + "&inicio=" + $("#fecha_inicio").val() + "&fin=" + $("#fecha_fin").val(),'_blank');    
}

function inicio() {
    alertify.set({ delay: 1000 });
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
    //////////////para hora///////////
    show();
    ///////////////////

    // cambiar idioma
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
    
    //////Botones//////////
    $("#btnGenerar").click(function(e) {
        e.preventDefault();
    });
    
    //////inmput////////
    $("#codigo").on("keyup", limpiar_campo1);
    $("#producto").on("keyup", limpiar_campo2);
    ///////////////////

    $("#btnGenerar").on("click", kardex);
    
    $("#codigo_barras").change(function(e) {
        var codigo = $("#codigo_barras").val();
        $.getJSON('search3.php?codigo_barras=' + codigo, function(data) {
                var tama = data.length;
                if (tama !== 0) {
                   for (var i = 0; i < tama; i = i + 3) {
                        $("#codigo").val(data[i]);
                        $("#producto").val(data[i + 1]);
                        $("#cod_producto").val(data[i + 2]);
                    }
                } else {
                    $("#codigo").val("");
                    $("#producto").val("");
                    $("#cod_producto").val("");
                }
            });
    });
    
    $("#codigo").autocomplete({
        source: "buscar_codigo.php",
        minLength: 1,
        focus: function(event, ui) {
            $("#codigo_barras").val(ui.item.codigo_barras);
            $("#codigo").val(ui.item.value);
            $("#producto").val(ui.item.producto);
            $("#cod_producto").val(ui.item.cod_producto);
            return false;
        },
        select: function(event, ui) {
            $("#codigo_barras").val(ui.item.codigo_barras);
            $("#codigo").val(ui.item.value);
            $("#producto").val(ui.item.producto);
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
        source: "buscar_producto.php",
        minLength: 1,
        focus: function(event, ui) {
            $("#codigo_barras").val(ui.item.codigo_barras);
            $("#producto").val(ui.item.value);
            $("#codigo").val(ui.item.codigo);
            $("#cod_producto").val(ui.item.cod_producto);
            return false;
        },
        select: function(event, ui) {
            $("#codigo_barras").val(ui.item.codigo_barras);
            $("#producto").val(ui.item.value);
            $("#codigo").val(ui.item.codigo);
            $("#cod_producto").val(ui.item.cod_producto);
            return false;
        }

        }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
        .append("<a>" + item.value + "</a>")
        .appendTo(ul);
    };
    
    // fechas
    $('#fecha_actual').datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');

    $('#fecha_inicio').datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');

    $('#fecha_fin').datepicker({
        dateFormat: 'yy-mm-dd'
    }).datepicker('setDate', 'today');

}



