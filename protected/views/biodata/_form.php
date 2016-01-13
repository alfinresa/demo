<?php
$cs = Yii::app()->getClientScript();
$js = <<<EOP
	$('select#Biodata_marital').change(function(){
		var id = $(this).val();
		if(id != '2') {
			$('#tes').slideUp();
		} else {
			$('#tes').slideDown();
		}
	}).change();
	
EOP;
$cs->registerScript('bio', $js, CClientScript::POS_END);
?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'biodata-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data')
)); ?>


<div class="alert alert-info alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  	<p class="help-block">Kolom dengan <span class="required">*</span> wajib diisi.</p>
 </div>
	
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'nik',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>

	<?php echo $form->textFieldGroup($model,'fullname',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>50)))); ?>

	<?php echo $form->redactorGroup($model,'address', array('widgetOptions'=>array('htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	<?php echo $form->telFieldGroup($model,'phone',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>20)))); ?>

	<?php echo $form->emailFieldGroup($model,'email',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>50)))); ?>

	<?php echo $form->datePickerGroup($model,'birth_date',array('widgetOptions'=>array('options'=>array(),'htmlOptions'=>array('class'=>'span5')), 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 'append'=>'Click on Month/Year to select a different Month/Year.')); ?>

	<?php echo $form->dropDownListGroup($model,'birth_place',array('widgetOptions'=>array('data'=>Biodata::getPlace(),'htmlOptions'=>array('class'=>'span5','prompt'=>'---pilih---')))); ?>

	<?php echo $form->radioButtonListGroup($model,'blood_type',array('widgetOptions'=>array('data'=>Biodata::getBlood(),'htmlOptions'=>array('class'=>'span5')),'inline'=>true)); ?>

	<?php echo $form->dropDownListGroup($model,'gender',array('widgetOptions'=>array('data'=>array('1'=>'pria','2'=>'wanita'),'htmlOptions'=>array('class'=>'span5','prompt'=>'---pilih---')))); ?>

	<?php echo $form->dropDownListGroup($model,'marital',array('widgetOptions'=>array('data'=>Biodata::getStatusNikah(),'htmlOptions'=>array('class'=>'span5','prompt'=>'---pilih---')))); ?>

	<div id="tes">
	<?php echo $form->textFieldGroup($model,'wife_husband',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>50)))); ?>

	<?php echo $form->textFieldGroup($model,'child',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>10)))); ?>
	</div>

	<?php if(!$model->isNewRecord && $model->photo != '') {?>
    <div class="control-group">
        <label class="control-label">Foto Lama</label>
        <div class="control">
        	<div style=" padding:0 0 0 200px;">
            <img src="<?php echo Yii::app()->baseUrl?>/public/thumb/<?php echo $model->photo;?>" width="20%"><br/>
        	</div>
        </div>
    </div>
    <?php }?>

	<?php echo $form->fileFieldGroup($model,'photo',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>100)))); ?>

	<?php echo $form->dropDownListGroup($model,'religion',array('widgetOptions'=>array('data'=>Biodata::getAgama(),'htmlOptions'=>array('class'=>'span5','prompt'=>'---pilih---')))); ?>

	<?php echo $form->textFieldGroup($model,'salary',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')), 'prepend'=>'Rp.', 'append'=>'.00')); ?>

	<?php echo $form->dropDownListGroup($model,'status',array('widgetOptions'=>array('data'=>Utility::getStatus(),'htmlOptions'=>array('class'=>'span5','prompt'=>'---pilih---')))); ?>

	

	

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'reset',
			'context'=>'primary',
			'label'=>'Reset',
		)); ?>
</div>

<?php $this->endWidget(); ?>
