<!-- Content Header (Page header) -->
<section id="formNewtype" class="modal-dialog modal-md">
  <div class="modal-content">
    <?php echo $this->Form->create($type, ['id' => 'type']); ?>
    <div class="modal-header">
      <button type="button" class="close" onclick="$('#modalTypes').modal('hide')">×</button>
      <h4 class="modal-title">Modificar Tipo de Participante</h4>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <?= $this->Form->control('name', ['label' => 'Nombre']); ?>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-left" onclick="$('#modalTypes').modal('hide')"><i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" id="btnSave" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
    </div>
    <?php echo $this->Form->end(); ?>
  </div>
</section>
<script>
  $(document).ready(function() {
    $('#type').submit(function(e) {
      if ($("#type").valid()) {
        $('#type #btnSave').attr('disabled', true);
        $.ajax({
            type: 'POST',
            url: '<?= $this->Url->build(); ?>',
            data: $('#formNewtype form').serialize(),
            async: false,
          })
          .done(function(res) {
            console.log(res);
            if (res.error == true) {
              $('#type #btnSave').attr('disabled', false);
              validForm([], res);
              alert(res.message);
            } else {
              $('#modalTypes').modal('hide');
              $('#jqgTypes').trigger('reloadGrid');
            }
          })
          .fail(function(err) {
            $('#type #btnSave').attr('disabled', false);
            console.log(err);
          });
      }
      e.preventDefault();
    });

    $("#type").validate({
      ignore: "",
      rules: {},
    });
  });
</script>