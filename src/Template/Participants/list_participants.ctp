<?php
$this->layout = 'list_participants';
?>

<section class="container">
    <div class="row">

        <div class="col-md-offset-3 col-md-6">
            <?php echo $this->Html->image('banner_devfest.jpg', array('class' => 'img-responsive ', 'alt' => 'User profile picture')); ?>
            <!-- Profile Image -->
           
        </div>

    </div>
    <div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Ranking</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nombre</th>
                            <th>Puntos</th>
                        </tr>
                        <?php $i = 0; ?>
                        <?php foreach ($participants as $participant) :
                            $i++;
                            ?>
                        <tr>
                            <td><?= $i;?></td>
                            <td><?= h($participant->name) ?></td>
                            <td><?= h($participant->points) ?></td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
</section>
