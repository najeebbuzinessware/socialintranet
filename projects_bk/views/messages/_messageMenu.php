<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
	'type' => 'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	'htmlOptions' => array('class'=>'pull-right'),
	'buttons' => array(
		array('label' => 'Action', 'url' => '#'), // this makes it split :)
		array('items' => array(
			array('label' => 'Inbox', 'url' =>array('index')),
			array('label' => 'Compose', 'url' =>array('create')),
			array('label' => 'Sent', 'url' =>array('sentItems')),
		)),
	),
)); ?>