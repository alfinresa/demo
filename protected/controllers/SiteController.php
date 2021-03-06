<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		Yii::app()->theme = 'alfin';
		$this->layout = 'column2';

		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		Yii::app()->theme = 'alfin';
		$this->layout = 'column2';
		
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				if (Yii::app()->user->level == 1) {
					$this->redirect(Yii::app()->createUrl('dashboard'));
				}else{
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionTes()
	{
		/*$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
		$authorizer->authManager->assign('clients', $model->id);
		$roles=Rights::getAssignedRoles(Yii::app()->user->Id);*/

		//echo Yii::app()->user->username;

		/*$x= realpath(__DIR__ . '/../extensions/bootstrap');
		echo $x;*/
		/*$model = Meta::model()->findAll();
		
		foreach($model as $alfin){
			echo $alfin->id.'-';
			echo $alfin->judul.'-';
		}*/
		$sitePath = str_replace('/','\\',$_SERVER['DOCUMENT_ROOT']);
		$basePath = $sitePath."\\mySite\\";
		$ffmpegPath = $basePath."ffmpeg\\ffmpeg\\";
		$imagePath = YiiBase::getPathOfAlias('webroot.public.');
		$kopet = Yii::app()->baseUrl;
		$hoho = str_replace('/','\\',YiiBase::getPathOfAlias('webroot.ffmpeg.bin'));
		echo $hoho;
		echo '<br/>';
		echo $kopet;
		echo '<br/>';
		echo $imagePath;
		echo '<br/>';
		echo $sitePath;
		echo '<br/>';
		echo $basePath;
		echo '<br/>';
		echo $ffmpegPath;
		echo '<br/>';
		echo 'xxx--'.Yii::app()->basePath;
		echo '<br/>';
		//$testinggg = YiiBase::getPathOfAlias('webroot.');

	}
}