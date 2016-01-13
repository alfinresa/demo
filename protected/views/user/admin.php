<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Create User','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('user-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="page-header">
	<h3>Kelola User</h3>
</div>
<div class="well well-large">
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
		'id'=>'user-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'type' => 'striped bordered condensed',
		'columns'=>array(
			array(
				'header' => 'No',
				'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1'
			),
			array(
				'name' => 'username',
				'value' => '$data->username'
			),
			array(
				'name' => 'level',
				'value' => 'User::getLevel($data->level)',
				'filter'=>User::getLevel(),
			),
			array(
				'name' => 'status',
				'value' => 'Utility::getStatus($data->status)',
				'filter'=>Utility::getStatus(),
			),
			array(
				'name' => 'last_login',
				'value' => 'date("d-m-Y H:i", strtotime($data->last_login))',
			),
			array(
	            'header' => 'Options',
	            'class'=>'booster.widgets.TbButtonColumn',
	            'buttons' => array(
	                'view' => array(
	                    'label' => 'lihat',
	                    'options' => array(
	                        'class' => 'view',
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
</div>	
