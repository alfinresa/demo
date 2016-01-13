<?php

class LoginDialog extends CWidget
{

	public function init() {
	}

	public function run() {
		$this->renderContent();
	}

	protected function renderContent() {
		$model=new LoginForm;

		$this->render('login_dialog',array(
			'model'=>$model,
		));	
	}
}
?>