<?php
$this->breadcrumbs=array(
	'Biodata',
);
?>

<?php
Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('biodata-grid', {
			data: $(this).serialize()
		});
		return false;
	});
");
?>

<h1>Biodata</h1>

<?php $this->widget('booster.widgets.TbButton',array(
    'label' => '',
    'context' => 'info',
    'size' => 'small',
    'url'=>array('create'),
	'icon'=>'plus-sign',
	'buttonType'=>'link',
)); ?>

<?php $this->widget('booster.widgets.TbButton',array(
    'label' => '',
    'context' => 'info',
    'size' => 'small',
	'icon'=>'search',
	'htmlOptions'=>array('class'=>'search-button'),
)); ?>

<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView',array(
	'id'=>'biodata-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type' => 'striped bordered condensed',
	'columns'=>array(
		array(
			'header' => 'No',
			'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
		),
		array(
			'name' => 'nik',
			'value' => '$data->nik'
		),	
		array(
			'name' => 'fullname',
			'value' => '$data->fullname'
		),	
		array(
			'name' => 'address',
			'value' => '$data->address'
		),	
		array(
			'name' => 'phone',
			'value' => '$data->phone'
		),
		array(
			'name' => 'email',
			'value' => '$data->email'
		),	
		array(
			'name' => 'gender',
			'value' => '$data->gender==1 ? "Pria" : "Wanita"',
			'filter'=>array('1'=>'Pria', '2'=>'Wanita')
		),
		array(
			'name' => 'birth_date',
			'value' => 'date("d-m-Y",strtotime($data->birth_date))'
		),
		array(
			'name' => 'birth_place',
			'value' => 'Biodata::getPlace($data->birth_place)',
			'filter'=>Biodata::getPlace(),
		),
		array(
            'header' => 'Options',
            'class'=>'booster.widgets.TbButtonColumn',
            'buttons' => array(
                'view' => array(
                    'label' => 'lihat',
                    'options' => array(
                        'class' => 'view'
                    ),
                    'url' => 'Yii::app()->controller->createUrl("view",array("id"=>$data->primaryKey))'),
                'update' => array(
                    'label' => 'ubah',
                    'options' => array(
                        'class' => 'edit'
                    ),
                    'url' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))'),
                'delete' => array(
                    'label' => 'hapus',
                    'options' => array(
                        'class' => 'delete'
                    ),
                    'url' => 'Yii::app()->controller->createUrl("delete",array("id"=>$data->primaryKey))')
            ),
            'template' => '{view}&nbsp;{update}&nbsp;{delete}',
        ),
	),
)); ?>

