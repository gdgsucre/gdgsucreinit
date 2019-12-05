<?php
$this->layout = 'profile';
?>

<section class="container">
    <div class="row">

        <div class="col-md-offset-3 col-md-6">
            <?php echo $this->Html->image('banner_devfest.jpg', array('class' => 'img-responsive ', 'alt' => 'User profile picture')); ?>
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                        <h3 class="profile-username text-center"><?= $participant->name; ?></h3>

                        <p class="text-muted text-center"><?= $participant->type; ?></p>
                        <?php if($participant->type == 'PARTICIPANT'){ ?>
                             <h4 class="profile-username text-center">Puntos : <?= $participant->points; ?></h3>
                        <?php } ?>
                        
                        <!-- <a href="<?php echo $this->Url->build('/certificate/' . $participant->qr); ?>" target="_blank" class="btn btn-info btn-block"><i class="fa fa-certificate"></i> <b>Certificado</b></a> -->
                    <p class="text-center">Únete al grupo de Whatsapp! <a target="_blank" href="https://chat.whatsapp.com/BlSmrtCoy1iHJeBpwmMbey">Aquí</a> </p>
                </div>
            </div>
            <!-- /.box -->
        </div>

    </div>
</section>