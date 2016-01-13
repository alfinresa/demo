<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Manage User','url'=>array('admin')),
);
?>
<div class="page-header">
	<h3>Tambah User</h3>
</div>
<div class="well">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>