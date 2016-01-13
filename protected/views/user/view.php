<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Create User','url'=>array('create')),
array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage User','url'=>array('admin')),
);
?>
<div class="page-header">
	<h3>Lihat User #<?php echo $model->username; ?></h3>
</div>

<div class="well">
	<?php $this->widget('booster.widgets.TbDetailView',array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'username',
			'password',
			'retype_password',
			'level',
			'status',
			'create',
			'update',
			'author',
			'last_login',
		),
	)); ?>
</div>
