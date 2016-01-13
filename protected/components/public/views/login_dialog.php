<?php
$cs = Yii::app()->getClientScript();  	
$js=<<<EOP
	$(document).ready(function() {
		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});																
	});
EOP;
$ukey = md5(uniqid(mt_rand(), true));
$cs->registerScript($ukey, $js);
$cs->registerCoreScript('jquery', CClientScript::POS_END);
?>
<div class="header-top-right">

	
	
	<div class="signin">
		<?php if(!Yii::app()->user->isGuest){?>
		<?php
			$this->widget(
			    'booster.widgets.TbButtonGroup',
			    array(
			        'context' => 'info',
			        'buttons' => array(
			            array(
			            	'label'=>Yii::app()->user->name,
			                'items' => array(
			                    array('label' => 'Profil', 'url' => '#'),
			                    
			                    array('label' => 'Logout', 'url' => array('site/logout')),
			                )
			            ),
			            //array('label' => Yii::app()->user->name),
			        ),
			    )
			);
			?>
		<?php } else {?>		
		<a href="#small-dialog" class="play-icon popup-with-zoom-anim">Sign In</a>
		<div id="small-dialog" class="mfp-hide">
			<h3>Login</h3>
			<!-- <div class="social-sits">
				<div class="facebook-button">
					<a href="#">Connect with Facebook</a>
				</div>
				<div class="chrome-button">
					<a href="#">Connect with Google</a>
				</div>
				<div class="button-bottom">
					<p>New account? <a href="#small-dialog2" class="play-icon popup-with-zoom-anim">Signup</a></p>
				</div>
			</div> -->
			<div class="signup">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'action'=>Yii::app()->createUrl('site/login',array('type'=>'ajax')),
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); ?>
					
					<?php //echo $form->labelEx($model,'username'); ?>
					<?php echo $form->textField($model,'username',array('class'=>'email','placeholder'=>'Username')); ?>
					<?php echo $form->error($model,'username'); ?>

					<?php //echo $form->labelEx($model,'password'); ?>
					<?php echo $form->passwordField($model,'password',array('placeholder'=>'Password')); ?>
					<?php echo $form->error($model,'password'); ?>
					
					<?php echo CHtml::submitButton('Login'); ?>

				<?php $this->endWidget(); ?>

				<?php /*
				<form>
					<input type="text" class="email" placeholder="Enter email / mobile" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?"/>
					<input type="password" placeholder="Password" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
					<input type="submit"  value="LOGIN"/>
				</form>
				*/ ?>
				
				<div class="forgot">
					<!-- <a href="#">Forgot password ?</a> -->
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<?php }?>
	</div>
	<div class="clearfix"> </div>
</div>