<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TechGrid</title>

    <?php
  	$baseUrl = Yii::app()->theme->baseUrl; 
  	$cs = Yii::app()->getClientScript();
  	$cs->registerCoreScript('jquery');
  	$cs->registerCssFile($baseUrl.'/css/bootstrap.css');
  	$cs->registerCssFile($baseUrl.'/css/sb-admin.css');
  	$cs->registerCssFile($baseUrl.'/font-awesome/css/font-awesome.min.css');
  	//$cs->registerCssFile($baseUrl.'/css/morris-0.4.3.min.css');

	// $cs->registerScriptFile($baseUrl.'/js/bootstrap.js');
	
	?>

   
  </head>

  <body>

    <div id="wrapper">

      <?php require_once('navigation.php');?>	

      <div id="page-wrapper">
          <?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('booster.widgets.TbBreadcrumbs', array(
              'links'=>$this->breadcrumbs,
            )); ?><!-- breadcrumbs -->
          <?php endif?>
        
          	
          	<?php echo $content ?>
            
          

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    

 
  </body>
</html>
