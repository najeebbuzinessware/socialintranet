<div class="sideMenu">
     <?php
          $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'list',
                'items' => array(
                     array('label'=>'Activities', 'url'=>'/wall/', 'icon'=>'icon-home', 'active'=>(Yii::app()->controller->Id=="wall")? "true" : ""),
                     array('label'=>'Tasks', 'icon'=>'icon-calendar', 'active'=>(Yii::app()->controller->Id=="tasks")? "true" : "",'items'=>array(
                     		
                     		array('label'=>'All Tasks', 'icon'=>'icon-calendar', 'url'=>'/tasks/', 'active'=>(Yii::app()->controller->Id=="tasks")? "true" : ""),
                     		array('label'=>'My Tasks', 'icon'=>'icon-calendar', 'url'=>'/tasks/admin', 'active'=>(Yii::app()->controller->Id=="tasks" && Yii::app()->controller->action->Id=="admin")? "true" : ""),
                     		array('label'=>'Create', 'icon'=>'icon-file-alt', 'url'=>'/tasks/create', 'active'=>(Yii::app()->controller->Id=="tasks" && Yii::app()->controller->action->Id=="create")? "true" : ""),
                     		
                     )
                     		
                ),
                     array('label'=>'Contacts', 'icon'=>'icon-user', 'url'=>'/contacts/', 'active'=>(Yii::app()->controller->Id=="contacts")? "true" : ""),
                     array('label'=>'Files', 'icon'=>'icon-file-alt', 'url'=>'/fileManager/', 'active'=>(Yii::app()->controller->Id=="fileManager")? "true" : ""),
                	array('label'=>'Timesheets', 'icon'=>'icon-time', 'url'=>'#/timesheet/', 'active'=>(Yii::app()->controller->Id=="timesheet")? "true" : ""),

                )
           )); 
      ?>
</div>