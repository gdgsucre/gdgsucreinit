<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-cogs"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Actividad Reciente</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-clock bg-green"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">&Uacute;ltimo acceso</h4>
                            <p><?php echo!empty($this->request->session()->read('Auth.User.last_access')) ? $this->request->session()->read('Auth.User.last_access')->format("H:i:s d-m-Y") : "Es su primer acceso"; ?></p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-laptop bg-yellow"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">&Uacute;ltima direcci&oacute;n IP</h4>
                            <p><?php echo!empty($this->request->session()->read('Auth.User.last_ip')) ? $this->request->session()->read('Auth.User.last_ip') : "Es su primer acceso"; ?></p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-key bg-red"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">&Uacute;ltimo cambio de contrase&ntilde;a</h4>
                            <p><?php echo!empty($this->request->session()->read('Auth.User.changed_password')) ? $this->request->session()->read('Auth.User.changed_password') : "No cambio de contraseña"; ?></p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->
        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <h3 class="control-sidebar-heading">Configuraci&oacute;n General</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="<?php echo $this->Url->build(['controller' => 'access', 'action' => 'profile']) ?>">
                        <i class="menu-icon fa fa-user bg-orange"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Perfil</h4>
                            <p>Datos de Usuario</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->Url->build(['controller' => 'access', 'action' => 'password']) ?>">
                        <i class="menu-icon fa fa-key bg-red"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Contrase&ntilde;a</h4>
                            <p>Clave de acceso al Sistema</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->Url->build(['controller' => 'logs-accesses', 'action' => 'view']) ?>">
                        <i class="menu-icon fa fa-sign-in-alt bg-green"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Registro de Acceso</h4>
                            <p>Logs de Accesos al Sistema</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $this->Url->build(['controller' => 'logs', 'action' => 'view']) ?>">
                        <i class="menu-icon fa fa-clock bg-green"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Registro de Acciones</h4>
                            <p>Logs de Acciones del Sistema</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
