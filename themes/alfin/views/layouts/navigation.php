<!-- Sidebar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
	    <span class="sr-only">Toggle navigation</span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="">Techgrid</a>
	</div>


	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<?php $this->widget('zii.widgets.CMenu',array(
			'htmlOptions' => array( 'class' => 'nav navbar-nav side-nav' ),
			'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
			'activeCssClass'	=> 'active',
			'items'=>array(
				array('label'=>'<i class="fa fa-home"></i> Home', 'url'=>array('/site/index')),
				array('label'=>'<i class="fa fa-list-alt"></i> Biodata', 'url'=>array('/biodata/admin'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'<i class="fa fa-list-alt"></i> Biodata', 'url'=>array('/biodata/index'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'<i class="fa fa-user" ></i> User', 'url'=>array('/user/admin')),
			 	/*array('label'=>'<i class="fa fa-caret-square-o-down"></i> Master <b class="caret"></b>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown'),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
	                    'items'=>array(
	                        array('label'=>'Data Barang', 'url'=>array('/barang/items/admin')),
	                        array('label'=>'Data Pelanggan', 'url'=>array('/users/customer/admin')),
	                        array('label'=>'Data Supplier', 'url'=>array('/users/distributor/admin')),
	                    )),*/
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
			'encodeLabel'=>false,
		)); ?>

	  <ul class="nav navbar-nav navbar-right navbar-user">
	    <li class="dropdown user-dropdown">
	      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo Yii::app()->user->name;?><b class="caret"></b></a>
	      <ul class="dropdown-menu">
	        <li><a href="<?php echo Yii::app()->createUrl('user/profile')?>"><i class="fa fa-user"></i> Profile</a></li>
	        <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
	        <li><a href="<?php echo Yii::app()->createUrl('user/account')?>"><i class="fa fa-gear"></i> Settings</a></li>
	        <li class="divider"></li>
	        <li><a href="<?php echo Yii::app()->createUrl('site/logout')?>"><i class="fa fa-power-off"></i> Log Out</a></li>
	      </ul>
	    </li>
	  </ul>
	</div><!-- /.navbar-collapse -->
</nav>	