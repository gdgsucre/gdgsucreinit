<?php $this->layout = 'profile'; ?>
<section class="container">
    <div class="row">

        <div class="col-md-offset-3 col-md-6">
            <?php  echo $this->Html->image('banner.jpg', array('class' => 'img-responsive ', 'alt' => 'User profile picture')); ?>
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <?php  echo $this->Html->image('logo.png', array('class' => 'profile-user-img img-responsive img-circle', 'alt' => 'User profile picture')); ?>

                    <?php if ($participant) { ?>
                    <h3 class="profile-username text-center"><?=  $participant->name;?></h3>

                    <p class="text-muted text-center"><?=  $participant->occupation;?></p>

                    <strong><i class="fa fa-phone margin-r-5"></i> Celular</strong>

                    <p class="text-muted">
                        <?=  $participant->mobile;?>
                    </p>
                    <strong><i class="fa fa-envelope  margin-r-5"></i> Email</strong>

                    <p class="text-muted">
                        <?=  $participant->email;?>
                    </p>
                    <strong><i class="fa fa-book margin-r-5"></i> Tecnologías</strong>

                    <p class="text-muted">
                        <?=  $participant->technologies;?>
                    </p>

                    <hr>

                    <strong><i class="fa fa-code margin-r-5"></i> Skills</strong>
                    <?php $skills = $participant->skills; ?>
                    <?php $skills = explode(",", $skills);?>
                    <p>
                        <?php
                        $i = 0;
                        foreach ($skills as $skill) {
                            echo "<span style='margin-right:5px' class='label label-".$colors[$i]."'>".$skill."</span>";

                            if($i==4){$i = 0;};
                            $i++;
                        }
                        ?>
                    </p>

                    <hr>

                    <a href="<?php echo $this->Url->build('/certificate/' . $participant->qr); ?>" target="_blank" class="btn btn-primary btn-block"><i class="fa fa-certificate"></i> <b>Ver Certificado</b></a>
                    <?php } else { ?>
                        <h3 class="profile-username text-center">Registro inválido</h3>
                    <?php } ?>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </div>
</section>
