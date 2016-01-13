<div class="well">
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	
	<div class="col-lg-6">
	<?php echo $form->textFieldGroup($model,'nik',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<?php echo $form->textFieldGroup($model,'fullname',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>50)))); ?>

	<?php echo $form->textFieldGroup($model,'address', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->telFieldGroup($model,'phone',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

	<?php echo $form->emailFieldGroup($model,'email',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>50)))); ?>

	<?php echo $form->datePickerGroup($model,'birth_date',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'click')); ?>

	<?php echo $form->dropDownListGroup($model,'birth_place',array('widgetOptions'=>array('data'=>Biodata::getPlace(),'htmlOptions'=>array('class'=>'span5','prompt'=>'---pilih---')))); ?>

	<?php echo $form->radioButtonListGroup($model,'blood_type',array('widgetOptions'=>array('data'=>Biodata::getBlood(),'htmlOptions'=>array('class'=>'span5')),'inline'=>true)); ?>
	</div>
	<div class="col-lg-6">

	<?php echo $form->dropDownListGroup($model,'gender',array('widgetOptions'=>array('data'=>array('1'=>'pria','2'=>'wanita'),'htmlOptions'=>array('class'=>'span5','prompt'=>'---pilih---')))); ?>

	<?php echo $form->dropDownListGroup($model,'marital',array('widgetOptions'=>array('data'=>Biodata::getStatusNikah(),'htmlOptions'=>array('class'=>'span5','prompt'=>'---pilih---')))); ?>
	
	<?php echo $form->textFieldGroup($model,'wife_husband',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>50)))); ?>

	<?php echo $form->textFieldGroup($model,'child',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<?php echo $form->dropDownListGroup($model,'religion',array('widgetOptions'=>array('data'=>Biodata::getAgama(),'htmlOptions'=>array('class'=>'span5','prompt'=>'---pilih---')))); ?>

	<?php echo $form->textFieldGroup($model,'salary',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')), 'prepend'=>'Rp.', 'append'=>'.00')); ?>

	<?php echo $form->dropDownListGroup($model,'status',array('widgetOptions'=>array('data'=>Utility::getStatus(),'htmlOptions'=>array('class'=>'span5','prompt'=>'---pilih---')))); ?>
	</div>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'context'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>
</div>
<?php $this->endWidget(); ?>
