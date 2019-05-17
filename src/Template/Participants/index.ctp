<section class="content-header">
    <h1>
        Participantes
        <small>Listado de Participantes</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Participantes</a></li>
        <li class="active">Listado</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary no-margin-bottom">
                <div class="box-header with-border">
                    <a class="btn btn-sm btn-success" data-toggle="modal" id="btnAddParticipant"><i class="fa fa-plus-circle"></i> Nuevo</a>
                    <a class="btn btn-sm btn-warning" data-toggle="modal" id="btnEditParticipant"><i class="fa fa-edit"></i> Modificar</a>
                    <!-- <a class="btn btn-sm btn-danger" data-toggle="modal" id="btnDeleteParticipant"><i class="fa fa-trash"></i> Borrar</a> -->

                    <a class="btn btn-sm btn-primary pull-right" target="_blank" href="<?php echo $this->Url->build(['controller' => 'participants', 'action' => 'credentials']); ?>"><i class="fa fa-print"></i> Imprimir</a>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="jqgParticipants"></table>
                            <div id="jqgParticipantsPager"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
echo $this->Form->create(null, ['id' => 'ParticipantDelete', 'url' => $this->Url->build(['controller' => 'participants', 'action' => 'delete'])]);
echo $this->Form->input('id', ['type' => 'hidden']);
echo $this->Form->end();
?>

<div class="modal fade" id="modalParticipants" role="dialog" data-backdrop="static" data-keyboard="false"></div>

<?php $this->start('scriptBottom'); ?>
<script>
    $.jgrid.defaults.width = 780;
    $.jgrid.defaults.responsive = true;
    $.jgrid.defaults.styleUI = 'Bootstrap';
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#jqgParticipants").jqGrid({
            url: '<?php echo $this->Url->build(['controller' => 'participants', 'action' => 'data']); ?>',
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
                    label: 'Nombre',
                    name: 'name',
                    width: 200
                },
                {
                    label: 'Correo electrónico',
                    name: 'email',
                    width: 200
                },
                {
                    label: 'Teléfono Móvil',
                    name: 'mobile',
                    width: 120
                },
                {
                    label: 'Género',
                    name: 'gender',
                    width: 120,
                    stype: "select",
                    searchoptions: {value: "<?php echo $gender; ?>"},
                    formatter: genderFormatter
                },
                {
                    label: 'Ocupación',
                    name: 'occupation',
                    width: 120
                },
                {
                    label: 'Aptitudes',
                    name: 'skills',
                    width: 200
                },
                {
                    label: 'Tecnologías utilizadas',
                    name: 'technologies',
                    width: 200
                },
                {
                    label: 'Tipo',
                    name: 'type',
                    width: 100,
                    stype: "select",
                    searchoptions: {value: "<?php echo $type; ?>"},
                    formatter: typeFormatter
                },
                {
                    label: '¿Impreso?',
                    name: 'printed',
                    width: 100,
                    stype: "select",
                    searchoptions: {value: "<?php echo $printed; ?>"},
                    formatter: printedFormatter
                },
                {
                    label: "Estado",
                    name: 'status',
                    width: 100,
                    stype: "select",
                    searchoptions: {value: "<?php echo $status; ?>",defaultValue:'A'},
                    formatter: statusFormatter,
                    
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
            pager: "#jqgParticipantsPager",
            sortname: 'created',
            sortorder: 'DESC',
            postData: {
                status: 'A'
            },
        });

        // activate the toolbar searching
        $('#jqgParticipants').jqGrid('filterToolbar');
        $('#jqgParticipants').jqGrid('navGrid', "#jqgParticipantsPager", {
            search: false, // show search button on the toolbar
            add: false,
            edit: false,
            del: false,
            refresh: true
        });

        $(window).bind('resize', function () {
            $("#jqgParticipants").setGridWidth($('#gbox_jqParticipants').parent().width());
            $("#jqgParticipants").setGridHeight($(window).height() - 385);
        }).trigger('resize');

    });

    $(document).ready(function () {
        /** Formulario Nuevo */
        $('#btnAddParticipant').click(function () {
            $('#modalParticipants').load('<?php echo $this->Url->build(['controller' => 'participants', 'action' => 'add']); ?>', null,
                    function () {
                        $('#modalParticipants').modal('show');
                    }
            );
        });
        /** Formulario Editar */
        $('#btnEditParticipant').click(function () {
            var row = jQuery('#jqgParticipants').jqGrid('getGridParam', 'selrow');
            rowId = jQuery('#jqgParticipants').jqGrid('getCell', row, 'id');
            if (rowId != null) {
                $('#modalParticipants').load('<?php echo $this->Url->build(['controller' => 'participants', 'action' => 'edit']); ?>/' + rowId, null,
                        function () {
                            $('#modalParticipants').modal('show');
                        }
                );
            } else {
                alert('Por favor, seleccione un registro');
            }
        });
    });
</script>
<?php $this->end(); ?>
