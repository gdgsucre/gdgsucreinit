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
                    <a class="btn btn-sm btn-warning" data-toggle="modal" id="btnEditParticipant"><i class="fa fa-edit"></i> Puntos</a>
                    <!-- <a class="btn btn-sm btn-danger" data-toggle="modal" id="btnDeleteParticipant"><i class="fa fa-trash"></i> Borrar</a> -->
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
                    // hidden: true
                },
                {
                    label: 'Nombre',
                    name: 'name',
                    width: 400
                },
                {
                    label: 'Puntos',
                    name: 'points',
                    width: 100
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

        /** Formulario Editar */
        $('#btnEditParticipant').click(function () {
            var row = jQuery('#jqgParticipants').jqGrid('getGridParam', 'selrow');
            rowId = jQuery('#jqgParticipants').jqGrid('getCell', row, 'id');
            if (rowId != null) {
                $('#modalParticipants').load('<?php echo $this->Url->build(['controller' => 'participants', 'action' => 'editPoints']); ?>/' + rowId, null,
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
