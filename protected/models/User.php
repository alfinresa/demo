<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $retype_password
 * @property integer $level
 * @property integer $status
 * @property string $create
 * @property string $update
 * @property string $author
 * @property string $last_login
 */
class User extends CActiveRecord
{
	public $old_password;
	public $new_password;
	public $confirm_password;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, retype_password, level, status, create, update, author, last_login', 'required'),
			array('level, status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>32),
			array('password, retype_password', 'length', 'max'=>150),
			array('author', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, retype_password, level, status, create, update, author, last_login', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'retype_password' => 'Retype Password',
			'level' => 'Level',
			'status' => 'Status',
			'create' => 'Create',
			'update' => 'Update',
			'author' => 'Author',
			'last_login' => 'Last Login',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('retype_password',$this->retype_password,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('status',$this->status);
		$criteria->compare('create',$this->create,true);
		$criteria->compare('update',$this->update,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('last_login',$this->last_login,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * before validate attributes
	 */
	protected function beforeValidate() {
		if(parent::beforeValidate()) {	
			$action = strtolower(Yii::app()->controller->action->id);		
			/*if($action == 'akun') {
				if($this->old_password != '') {
					$user = User::model()->findByPk(Yii::app()->user->id_user);
					if($user->password !== self::hashPassword($this->old_password)) {
						$this->addError('old_password', 'Password lama tidak sesuai');
					}
				}
			}	*/		
			$this->update= date('Y-m-d H:i:s');
			if($this->isNewRecord) {
				$this->create = date('Y-m-d H:i:s');
				$this->author = Yii::app()->user->id_user;
				$this->last_login = date('Y-m-d H:i:s');
			}else {
				
			}			
		}
		return true;
	} 
	
	/**
	 * before save attributes
	 */
	protected function beforeSave() {
		if(parent::beforeSave()) {
			if(($this->new_password != '') && ($this->new_password == $this->confirm_password)) {
				if(count($this->errors) == 0) {
					$this->password = self::hashPassword($this->new_password);
					$this->retype_password = self::hashPassword($this->confirm_password);
				}
			}else{
				$this->password = self::hashPassword($this->password);
				$this->retype_password = self::hashPassword($this->retype_password);
			}
			/*if($this->isNewRecord) {
				$this->start_date 	= date('Y-m-d', strtotime($this->start_date));			
			}else {
				
			}*/
		}
		return true;
	}
	
	
	/**
	 * After save attributes
	 */
	/* protected function afterSave() {
		parent::afterSave();
		// Create action		
	} */


	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return $this->hashPassword($password) === $this->password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		$salt = self::getSalt();
		return md5($salt.$password);
	}

	/**
	 * Get salt
	 */
	public function getSalt() {
		return Yii::app()->params['salt'];
	}
	
	/**
	 * check whether password is using alpha and numeric combination
	 */
	public function alphaNumeric($attribute){
		$pattern = '/^.*(?=.*[a-zA-Z])[a-zA-Z0-9]+$/';
		if ($this->$attribute) {
			if(!preg_match($pattern, $this->$attribute))
				$this->addError($attribute, Yii::t('', 'Kombinasi password yang diperbolehkan berupa karakter huruf dan angka'));
		}
	}
	
	
	/**
	 * @check password  and confirm password
	 */	
	public function checkConfirmPassword($attribute,$params) {
		if(!empty($this->password) && !empty($this->retype_password)) {
			if($this->password != $this->retype_password)
				$this->addError($attribute, 'retype password tidak sama dengan password anda');
		}
	}	

	/**
	* tipe penjualan
	*/
	public static function getLevel($id=null) {
		$arrLevel = array(
			1 => 'Admin',
          	2 => 'Admin2',
        );
        if($id != null)
            return $arrLevel[$id];
        else
            return $arrLevel;
	}

	
}
