<?php $this->layout = 'profile'; ?>
<section class="container">
<div class="row">
            
        <div class="col-md-offset-3 col-md-6">
        <?php  echo $this->Html->image('banner.jpg', array('class' => 'img-responsive ', 'alt' => 'User profile picture')); ?> 
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <?php  echo $this->Html->image('logo.png', array('class' => 'profile-user-img img-responsive img-circle', 'alt' => 'User profile picture')); ?> 

              <h3 class="profile-username text-center">Name</h3>

              <p class="text-muted text-center">occupation</p>

              <strong><i class="fa fa-phone margin-r-5"></i> Celular</strong>

              <p class="text-muted">
                mobile
              </p>
              <strong><i class="fa fa-envelope  margin-r-5"></i> Email</strong>

                <p class="text-muted">
                email
                </p>
              <strong><i class="fa fa-book margin-r-5"></i> Tecnologías</strong>

              <p class="text-muted">
                technologies
              </p>

              <hr>

              <strong><i class="fa fa-code margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <a href="#" class="btn btn-primary btn-block"><b>Ver Certificado</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

 </div>   
</section>