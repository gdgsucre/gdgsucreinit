<section class="content-header">
  <h1>
    <?php echo __('Type'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                                                                                                <dt><?= __('Name') ?></dt>
                                        <dd>
                                            <?= h($type->name) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Alias') ?></dt>
                                        <dd>
                                            <?= h($type->alias) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('Created By') ?></dt>
                                <dd>
                                    <?= $this->Number->format($type->created_by) ?>
                                </dd>
                                                                                                                <dt><?= __('Modified By') ?></dt>
                                <dd>
                                    <?= $this->Number->format($type->modified_by) ?>
                                </dd>
                                                                                                
                                                                                                                                                                                                
                                            
                                    </dl>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Participants']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <?php if (!empty($type->participants)): ?>

                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                                                    
                                    <th>
                                    Id
                                    </th>
                                        
                                                                    
                                    <th>
                                    Name
                                    </th>
                                        
                                                                    
                                    <th>
                                    Email
                                    </th>
                                        
                                                                    
                                    <th>
                                    Ci
                                    </th>
                                        
                                                                    
                                    <th>
                                    Team
                                    </th>
                                        
                                                                    
                                    <th>
                                    Mobile
                                    </th>
                                        
                                                                    
                                    <th>
                                    Qr
                                    </th>
                                        
                                                                    
                                    <th>
                                    Gender
                                    </th>
                                        
                                                                    
                                    <th>
                                    Type
                                    </th>
                                        
                                                                    
                                    <th>
                                    Types
                                    </th>
                                        
                                                                    
                                    <th>
                                    Printed
                                    </th>
                                        
                                                                    
                                    <th>
                                    Status
                                    </th>
                                        
                                                                    
                                    <th>
                                    Validate
                                    </th>
                                        
                                                                                                                                            
                                    <th>
                                    Created By
                                    </th>
                                        
                                                                    
                                    <th>
                                    Modified By
                                    </th>
                                        
                                                                    
                                <th>
                                    <?php echo __('Actions'); ?>
                                </th>
                            </tr>

                            <?php foreach ($type->participants as $participants): ?>
                                <tr>
                                                                        
                                    <td>
                                    <?= h($participants->id) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->name) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->email) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->ci) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->team) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->mobile) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->qr) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->gender) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->type) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->types) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->printed) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->status) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->validate) ?>
                                    </td>
                                                                                                                                                
                                    <td>
                                    <?= h($participants->created_by) ?>
                                    </td>
                                                                        
                                    <td>
                                    <?= h($participants->modified_by) ?>
                                    </td>
                                    
                                                                        <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Participants', 'action' => 'view', $participants->id], ['class'=>'btn btn-info btn-xs']) ?>

                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Participants', 'action' => 'edit', $participants->id], ['class'=>'btn btn-warning btn-xs']) ?>

                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Participants', 'action' => 'delete', $participants->id], ['confirm' => __('Are you sure you want to delete # {0}?', $participants->id), 'class'=>'btn btn-danger btn-xs']) ?>    
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                                    
                        </tbody>
                    </table>

                <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
