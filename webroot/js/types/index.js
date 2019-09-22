
$(document).ready(function () {
    $.jgrid.defaults.width = 780;
    $.jgrid.defaults.responsive = true;
    $.jgrid.defaults.styleUI = 'Bootstrap';

    $("#jqgTypes").jqGrid({
        url: urlListTypes,
        mtype: "GET",
        datatype: "json",
        page: 1,
        colModel: [
            {
                name: 'id',
                index: 'id',
                hidden: true
            },
            {
                label: 'Nombre',
                name: 'name',
                width: 300
            },
            {
                label: 'Alias',
                name: 'alias',
                width: 350,
                search: false
            },
        ],
        rowNum: 20,
        rowList: [10, 20, 30, 50],
        viewrecords: true,
        autowidth: true,
        shrinkToFit: false,
        height: 400,
        // multiselect: true,
        emptyrecords: 'No existen registros para mostrar',
        rownumbers: true,
        height: '100%',
        pager: "#jqgTypesPager",
        sortname: 'name',
        sortorder: 'DESC',
        loadComplete: function (response) {
            if (response.records == 0) {
                alert('No existen Tipos de Participantes')
            }
        }
    });

    // activate the toolbar searching
    $('#jqgTypes').jqGrid('filterToolbar');
    $('#jqgTypes').jqGrid('navGrid', "#jqgTypesPager", {
        search: false, // show search button on the toolbar
        add: false,
        edit: false,
        del: false,
        refresh: true
    });

    $(window).bind('resize', function () {
        $("#jqgTypes").setGridWidth($('#gbox_jqTypes').parent().width());
        $("#jqgTypes").setGridHeight($(window).height() - 385);
    }).trigger('resize');

    /** Formulario Nuevo */
    $('#btnAddType').click(function () {
        $('#modalTypes').load(urlAddType, null,
            function () {
                $('#modalTypes').modal('show');
            }
        );
    });
    /** Formulario Editar */
    $('#btnEditType').click(function () {

        var row = jQuery('#jqgTypes').jqGrid('getGridParam', 'selrow');
        rowId = jQuery('#jqgTypes').jqGrid('getCell', row, 'id');
        if (rowId != null) {
            $('#modalTypes').load(urlEditType + '/' + rowId, null,
                function () {
                    $('#modalTypes').modal('show');
                }
            );
        } else {
            alert('Por favor, seleccione un registro');
        }
    });

    $('#btnDeleteType').click(function () {
        var row = jQuery('#jqgTypes').jqGrid('getGridParam', 'selrow');
        rowId = jQuery('#jqgTypes').jqGrid('getCell', row, 'id');
        console.log("rowid", rowId);
        if (rowId != null) {
            $('#modalTypes').load(urlDeleteType + '/' + rowId, null,
                function () {
                    $('#modalTypes').modal('show');
                }
            );
        } else {
            alert('Por favor, seleccione un registro');
        }
    });

});