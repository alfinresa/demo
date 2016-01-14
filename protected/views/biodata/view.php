<?php
$this->breadcrumbs=array(
	'Biodata'=>array('admin'),
	$model->nik,
);

$this->menu=array(
array('label'=>'List Biodata','url'=>array('index')),
array('label'=>'Create Biodata','url'=>array('create')),
array('label'=>'Update Biodata','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Biodata','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Biodata','url'=>array('admin')),
);
?>

<h1>Lihat Biodata <?php echo $model->nik; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		array(
			'name'=>'photo',
			'value'=>'<img src="'.Yii::app()->baseUrl . '/public/thumb/' . $model->photo .'"/>',
			'type'=>'raw'
		),
		array(
			'name'=>'nik',
			'value'=>$model->nik,
		),
		array(
			'name'=>'fullname',
			'value'=>$model->fullname,
		),
		array(
			'name'=>'address',
			'value'=>$model->address,
		),
		array(
			'name'=>'phone',
			'value'=>$model->phone,
		),
		array(
			'name'=>'email',
			'value'=>$model->email,
		),
		array(
			'name'=>'gender',
			'value'=>$model->gender=='1' ? 'Pria':'Wanita',
		),
		array(
			'name'=>'birth_date',
			'value'=>date('d-m-Y',strtotime($model->birth_date)),
		),
		array(
			'name'=>'birth_place',
			'value'=>Biodata::getPlace($model->birth_place),
		),
		array(
			'name'=>'blood_type',
			'value'=>Biodata::getBlood($model->blood_type),
		),
		array(
			'name'=>'marital',
			'value'=>Biodata::getStatusNikah($model->marital),
		),
		array(
			'name'=>'wife_husband',
			'value'=>$model->wife_husband,
		),
		array(
			'name'=>'child',
			'value'=>$model->child,
		),
		array(
			'name'=>'religion',
			'value'=>Biodata::getAgama($model->religion),
		),
		array(
			'name'=>'salary',
			'value'=>Utility::rupiah($model->salary),
		),
		array(
			'name'=>'status',
			'value'=>Utility::getStatus($model->status),
		),
		array(
			'name'=>'created',
			'value'=>date('d-m-Y H:i:s', strtotime($model->created)),
		),
		array(
			'name'=>'updated',
			'value'=>date('d-m-Y H:i:s', strtotime($model->updated)),
		),
),
)); ?>
