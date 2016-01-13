<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'View User','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage User','url'=>array('admin')),
);
?>
<div class="well">
	<h1>Ubah User <?php echo $model->username; ?></h1>
</div>

<div class="well">
	<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
</div>