<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	const ERROR_NONE=0;
    const ERROR_USERNAME_INVALID=1;
    const ERROR_PASSWORD_INVALID=2;
    const ERROR_USERNAME_INACTIVE = 3;
    const ERROR_UNKNOWN_IDENTITY=100;

	private $_id;
	public $errorCode=self::ERROR_UNKNOWN_IDENTITY;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	/*public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}*/
	public function authenticate()
	{
		$users= User::model()->findByAttributes(array('username'=>$this->username));
		if($users === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;	
		}else if($users->password !== $users->hashPassword($this->password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}else if($users->status !== '1') {
			$this->errorCode = self::ERROR_USERNAME_INACTIVE;
		}else {
			/*$cek = $users->username.'---'.$users->password;
			file_put_contents('alfin.txt',$cek);*/
			$this->_id = $users->id;
			$this->username = $users->username;
			$this->setState('level', $users->level);
			$this->setState('status', $users->status);
			$this->setState('username', $users->username);
			$this->setState('id_user', $users->id);
			$this->errorCode = self::ERROR_NONE;
		}
		return $this->errorCode;
	}

	public function getId() {
		return $this->_id;
	}
}