<?php
$this->breadcrumbs=array(
	'Biodata'=>array('admin'),
	'Tambah',
);

$this->menu=array(
array('label'=>'List Biodata','url'=>array('index')),
array('label'=>'Kelola Biodata','url'=>array('admin')),
);
?>

<h1>Tambah Biodata</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>