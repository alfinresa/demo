<div class="col-md-2">
    <div class="thumbnail">
        <img src="<?php echo Yii::app()->request->baseUrl?>/public/thumb/thumbs.jpg" alt="ss"/>
        <!-- <div class="caption">
            <h3><?php echo $data->meta->judul?></h3>
            <p><?php echo $data->meta->keterangan?></p>
            <p><a href="#" class="btn btn-info btn-sm" role="button">Button</a> 
            <a href="#" class="btn btn-default btn-sm" role="button">Button</a></p>
            <p class="author"><a href="#" class="author">John Maniya</a></p>
			<p class="views">2,114,200 views</p>
        </div> -->
        <div class="resent-grid-info recommended-grid-info">
			<h5><a href="single.html" class="title"><?php echo $data->meta->judul?></a></h5>
			<p class="author"><a href="#" class="author"><?php echo $data->meta->contribut->nama;?></a></p>
			<p class="views"><?php echo $data->view?> views</p>
		</div>
    </div>

</div>