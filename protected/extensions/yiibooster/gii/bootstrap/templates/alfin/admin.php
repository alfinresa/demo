<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<?php
echo "<?php\n";
$label = $this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Manage',
);\n";
?>

$this->menu=array(
array('label'=>'List <?php echo $this->modelClass; ?>','url'=>array('index')),
array('label'=>'Create <?php echo $this->modelClass; ?>','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('<?php echo $this->class2id($this->modelClass); ?>-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Kelola <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>



<?php echo "<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>"; ?>

<div class="search-form" style="display:none">
	<?php echo "<?php \$this->renderPartial('_search',array(
	'model'=>\$model,
)); ?>\n"; ?>
</div><!-- search-form -->

<?php echo "<?php"; ?> $this->widget('booster.widgets.TbGridView',array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type' => 'striped bordered condensed',
	'columns'=>array(
		<?php
		$count = 0;
		foreach ($this->tableSchema->columns as $column) {
			if (++$count == 7) {
				echo "\t\t/*\n";
			}
			echo "\t\t'" . $column->name . "',\n";
		}
		if ($count >= 7) {
			echo "\t\t*/\n";
		}
		?>
		array(
			'class'=>'booster.widgets.TbButtonColumn',
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
