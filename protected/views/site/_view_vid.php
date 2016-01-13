<?php $itemsNum = $dataProvider->pagination->currentPage*$dataProvider->pagination->pageSize+$index+1;?>
<?php
$start=array(); 
for($i=1;$i<=$dataProvider->getTotalItemCount();$i+=4){
  $start[]=$i;  
}
?>
<?php 
if(in_array($itemsNum,$start)){
  echo '<div class="row">';
}
?>

  <div class="col-lg-3 text-center">
    <div class="panel panel-default">
      <div class="panel-body">
      <img src="<?php echo Yii::app()->request->baseUrl?>/public/thumb/thumbs.jpg" alt="ss"/>
      </div>
    </div>            
  </div>

<?php
$end=array(); 
for($x=4;$x<=$dataProvider->getTotalItemCount();$x+=4){
  $end[]=$x;  
}
?>
<?php 
if(in_array($itemsNum,$end)){
  echo '</div>';
}
?>