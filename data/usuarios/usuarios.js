$(document).on("ready", inicio);

function openPDF(){
window.open('../../ayudas/ayuda.pdf');
}

function numeros(e) { 
tecla = (document.all) ? e.keyCode : e.which;
if (tecla==8) return true;
patron = /\d/;
te = String.fromCharCode(tecla);
return patron.test(te);
}

function inicio() {

    $(window).bind('resize', function() {
        jQuery("#list").setGridWidth($('#centro'));
    }).trigger('resize');
    
    jQuery("#list").jqGrid({
        url: 'xmlUsuario.php',
        datatype: 'xml',
        colNames: ['Cod. Usuario', 'CI Usuario', 'Nombres Usuario', 'Apellidos Usuario', 'Dirección Usuario', 'Teléfono Usuario', 'Celular Usuario', 'E-mail Usuario', 'User', 'Clave', 'Cargo'],
        colModel: [
            {name: 'id_usuario', index: 'id_usuario', editable: true, align: 'center', width: '100', search: false, frozen: true, editoptions: {readonly: 'readonly'}},
            {name: 'ci_usuario', index: 'ci_usuario', editable: true, align: 'center', width: '100', size: '10', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}, editoptions:{maxlength: 10, size:20,dataInit: function(elem){$(elem).bind("keypress", function(e) {return numeros(e)})}}}, 
            {name: 'nombre_usuario', index: 'nombre_usuario', editable: true, align: 'center', width: '140', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'apellido_usuario', index: 'apellido_usuario', editable: true, align: 'center', width: '140', search: true, frozen: true, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'direccion_usuario', index: 'direccion_usuario', editable: true, align: 'center', width: '140', search: false},
            {name: 'telefono_usuario', index: 'telefono_usuario', editable: true, align: 'center', width: '140', search: false, editrules: {required: false}, editoptions:{maxlength: 10, size:20,dataInit: function(elem){$(elem).bind("keypress", function(e) {return numeros(e)})}}}, 
            {name: 'celular_usuario', index: 'celular_usuario', editable: true, align: 'center', width: '140', search: false, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}, editoptions:{maxlength: 10, size:20,dataInit: function(elem){$(elem).bind("keypress", function(e) {return numeros(e)})}}}, 
            {name: 'email_usuario', index: 'email_usuario', editable: true, align: 'center', width: '140', search: false, formatter: 'email'},
            {name: 'user', index: 'user', editable: true, align: 'center', width: '140', search: false, formoptions: {elmsuffix: " (*)"}, editrules: {required: true}},
            {name: 'password_usuario', index: 'password_usuario', editable: true, align: 'center', width: '140', search: false, formoptions: {elmsuffix: " (*)"}, editrules: {edithidden: true, required: true}, edittype: 'password', hidden: true},
            {name: 'cargo_usuario', index: 'cargo_usuario', width:'300',search: false, align: 'center', editable: true, edittype: "select", editoptions: {value: "1:Administrador;2:Vendedor"}},
        ],
        rowNum: 10,
        rowList: [10, 20, 30],
        width: null,
        height: 400,
        pager: jQuery('#pager'),
        editurl: "procesosUsuarios.php",
        sortname: 'id_usuario',
        shrinkToFit: false,
        sortordezr: 'asc',
        caption: 'Lista Usuarios',
        viewrecords: true
    }).jqGrid('navGrid', '#pager',
            {
                add: true,
                edit: true,
                del: true,
                refresh: true,
                search: true,
                view: true,
                addtext: "Nuevo",
                edittext: "Modificar",
                deltext: "Eliminar"
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
    // jQuery("#list").setGridWidth($('#centro').width() - 10);
}

function Defecto(e) {
    e.preventDefault();
}

