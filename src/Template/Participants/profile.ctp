<?php
$this->layout = 'profile';
?>

<section class="container">
    <div class="row">

        <div class="col-md-offset-3 col-md-6">
            <?php echo $this->Html->image('banner_gpt.jpg', array('class' => 'img-responsive ', 'alt' => 'User profile picture')); ?>
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <?php echo $this->Html->image('banner_br.png', array('class' => 'profile-user-img img-responsive img-circle', 'alt' => 'User profile picture')); ?>

                    <?php if ($participant) { ?>
                        <h3 class="profile-username text-center"><?= $participant->name; ?></h3>

                        <p class="text-muted text-center"><?= $participant->team; ?></p>
                        <?php
                            foreach ($participant->types as $type) :
                                ?>
                            <a href="<?php echo $this->Url->build('/certificate/' . $participant->qr . '?type=' . $type->alias); ?>" target="_blank" class="btn btn-info btn-block"><i class="fa fa-certificate"></i> <b>Certificado <?= mb_strtoupper($type->name); ?></b></a>
                            
                            <hr>
                        <?php
                            endforeach;
                            ?>

                    <?php } else { ?>
                        <?= $this->Form->create($participant, ['id' => 'participant']) ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo $this->Form->input('ci', ['label' => 'Ingrese CI']); ?>
                                <?php echo $this->Form->input('qr', ['type' => 'hidden', 'value' => $qr_hash]); ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block"><i class="fa fa-save"></i> Validar</button>
                        <?= $this->Form->end() ?>
                    <?php } ?>
                    <p class="text-center">Si tiene alguna duda comunicarse vía Telegram o Whatsapp <a href="tel:+65257719">65257719</a> </p>
                </div>
            </div>
            <!-- /.box -->
        </div>

    </div>
</section>