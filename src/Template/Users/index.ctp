<section class="content-header">
    <h1>
        Usuarios
        <small>Listado de Usuarios</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Usuarios</a></li>
        <li class="active">Listado</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary no-margin-bottom">
                <div class="box-header with-border">
                    <a class="btn btn-sm btn-success" data-toggle="modal" id="btnAddUser"><i class="fa fa-plus-circle"></i> Nuevo</a>
                    <a class="btn btn-sm btn-warning" data-toggle="modal" id="btnEditUser"><i class="fa fa-edit"></i> Modificar</a>
                    <a class="btn btn-sm btn-danger" data-toggle="modal" id="btnDeleteUser"><i class="fa fa-trash"></i> Borrar</a>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="jqgUsers"></table>
                            <div id="jqgUsersPager"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
echo $this->Form->create(null, ['id' => 'UserDelete', 'url' => $this->Url->build(['controller' => 'users', 'action' => 'delete'])]);
echo $this->Form->input('id', ['type' => 'hidden']);
echo $this->Form->end();
?>

<div class="modal fade" id="modalUsers" role="dialog" data-backdrop="static" data-keyboard="false"></div>

<?php $this->start('scriptBottom'); ?>
<script>
    $.jgrid.defaults.width = 780;
    $.jgrid.defaults.responsive = true;
    $.jgrid.defaults.styleUI = 'Bootstrap';
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#jqgUsers").jqGrid({
            url: '<?php echo $this->Url->build(['controller' => 'users', 'action' => 'data']); ?>',
            mtype: "GET",
            datatype: "json",
            page: 1,
            colModel: [{
                    name: 'id',
                    index: 'id',
                    key: true,
                    hidden: true
                },
                {
                    label: 'Documento',
                    name: 'document',
                    width: 100
                },
                {
                    label: 'Nombre',
                    name: 'name',
                    width: 250
                },
                {
                    label: 'Correo electrónico',
                    name: 'email',
                    width: 250
                },
                {
                    label: 'Usuario',
                    name: 'username',
                    width: 200
                },
                {
                    label: 'Rol',
                    name: 'role_name',
                    width: 200,
                    stype: "select",
                    searchoptions: {value: "<?php echo $rolesList; ?>"}
                },
                {
                    label: "Estado",
                    name: 'status',
                    width: 100,
                    stype: "select",
                    searchoptions: {value: ":[Todos];A:Activo;I:Inactivo"},
                    formatter: statusFormatter
                },
                {
                    label: 'Ultimo acceso',
                    name: 'last_access',
                    width: 150
                },
                {
                    label: 'Ultima IP',
                    name: 'last_ip',
                    width: 150
                },
                {
                    label: 'Ultimo cambio de Contraseña',
                    name: 'last_change_password',
                    width: 200
                }
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
            pager: "#jqgUsersPager"
        });

        // activate the toolbar searching
        $('#jqgUsers').jqGrid('filterToolbar');
        $('#jqgUsers').jqGrid('navGrid', "#jqgUsersPager", {
            search: false, // show search button on the toolbar
            add: false,
            edit: false,
            del: false,
            refresh: true
        });

        $(window).bind('resize', function () {
            $("#jqgUsers").setGridWidth($('#gbox_jqUsers').parent().width());
            $("#jqgUsers").setGridHeight($(window).height() - 385);
        }).trigger('resize');

    });

    $(document).ready(function () {
        /** Formulario Nuevo */
        $('#btnAddUser').click(function () {
            $('#modalUsers').load('<?php echo $this->Url->build(['controller' => 'users', 'action' => 'add']); ?>', null,
                    function () {
                        $('#modalUsers').modal('show');
                    }
            );
        });
        /** Formulario Editar */
        $('#btnEditUser').click(function () {
            var row = jQuery('#jqgUsers').jqGrid('getGridParam', 'selrow');
            rowId = jQuery('#jqgUsers').jqGrid('getCell', row, 'id');
            if (rowId != null) {
                $('#modalUsers').load('<?php echo $this->Url->build(['controller' => 'users', 'action' => 'edit']); ?>/' + rowId, null,
                        function () {
                            $('#modalUsers').modal('show');
                        }
                );
            } else {
                alert('Por favor, seleccione un registro');
            }
        });
        /** Acción para borrar */
        $('#btnDeleteUser').click(function () {
            var row = jQuery('#jqgUsers').jqGrid('getGridParam', 'selrow');
            rowId = jQuery('#jqgUsers').jqGrid('getCell', row, 'id');
            if (rowId != null) {
                rowName = jQuery('#jqgUsers').jqGrid('getCell', row, 'name');
                if (confirm('Está segur@ de eliminar el Usuario "' + rowName + '"?')) {
                    $('#UserDelete #id').val(rowId);
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $this->Url->build(['controller' => 'users', 'action' => 'delete']); ?>/' + rowId,
                        data: $('#UserDelete').serialize(),
                        success: function (response)
                        {
                            if (response.error == 0) {
                                $('#modalUsers').modal('hide');
                                $('#jqgUsers').trigger('reloadGrid');
                            } else {
                                alert(response.message);
                            }
                        }
                    });
                }
            } else {
                alert('Por favor, seleccione un registro');
            }
        });
    });
</script>
<?php $this->end(); ?>
