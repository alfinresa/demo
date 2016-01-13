<?php

/**
 * This is the model class for table "biodata".
 *
 * The followings are the available columns in table 'biodata':
 * @property string $id
 * @property string $nik
 * @property string $fullname
 * @property string $address
 * @property string $phone
 * @property integer $gender
 * @property integer $marital
 * @property string $wife_husband
 * @property string $child
 * @property string $photo
 * @property integer $religion
 * @property double $salary
 * @property integer $status
 * @property string $created
 * @property string $updated
 * @property string $author
 * @property string $updater
 * @property string $birth_date
 * @property string $birth_place
 * @property integer $blood_type
 * @property string $email
 */
class Biodata extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'biodata';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nik, fullname, address, phone, gender, marital, wife_husband, child, religion, salary, status, created, updated, author, updater, birth_date, birth_place, blood_type, email', 'required'),
			array('gender, marital, religion, status, blood_type', 'numerical', 'integerOnly'=>true),
			array('salary', 'numerical'),
			array('nik, child, author, updater, birth_place', 'length', 'max'=>10),
			array('fullname, wife_husband, email', 'length', 'max'=>50),
			array('phone', 'length', 'max'=>20),
			array('photo', 'length', 'max'=>100),
			array('photo', 'file', 'types'=>'png,jpg', 'allowEmpty'=>true),
			array('photo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nik, fullname, address, phone, gender, marital, wife_husband, child, photo, religion, salary, status, created, updated, author, updater, birth_date, birth_place, blood_type, email', 'safe', 'on'=>'search'),
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
			'nik' => 'NIK',
			'fullname' => 'Nama Lengkap',
			'address' => 'Alamat',
			'phone' => 'No Telp',
			'gender' => 'Jenis Kelamin',
			'marital' => 'Status Pernikahan',
			'wife_husband' => 'Nama Suami/Istri',
			'child' => 'Jumlah Anak',
			'photo' => 'Photo',
			'religion' => 'Agama',
			'salary' => 'Gaji',
			'status' => 'Status',
			'created' => 'Created',
			'updated' => 'Updated',
			'author' => 'Author',
			'updater' => 'Updater',
			'birth_date' => 'Tanggal Lahir',
			'birth_place' => 'Tempat Lahir',
			'blood_type' => 'Gol Darah',
			'email' => 'Email',
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
		$criteria->compare('nik',$this->nik,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('marital',$this->marital);
		$criteria->compare('wife_husband',$this->wife_husband,true);
		$criteria->compare('child',$this->child,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('religion',$this->religion);
		$criteria->compare('salary',$this->salary);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('updater',$this->updater,true);
		$criteria->compare('birth_date',$this->birth_date,true);
		$criteria->compare('birth_place',$this->birth_place,true);
		$criteria->compare('blood_type',$this->blood_type);
		$criteria->compare('email',$this->email,true);
		if(!isset($_GET['Biodata_sort'])){
			$criteria->order = 'id DESC';
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Biodata the static model class
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
			$this->updated= date('Y-m-d H:i:s');
			$this->updater= Yii::app()->user->id_user;
			if($this->isNewRecord) {
				$this->created = date('Y-m-d H:i:s');
				$this->author = Yii::app()->user->id_user;
				if($this->marital != '2'){
					$this->wife_husband = '-';
					$this->child = '0';
				}
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
			if($this->isNewRecord) {
				$this->birth_date = date('Y-m-d H:i:s',strtotime($this->birth_date));			
			}else {
				$this->birth_date = date('Y-m-d H:i:s',strtotime($this->birth_date));
			}

			$image = CUploadedFile::getInstance($this, 'photo');
			if($image != null){
				$imagePath = YiiBase::getPathOfAlias('webroot.public.thumb');
				
				$fileName = time().'_'.$image->getName();
				
				$saveImage = $image->saveAs($imagePath.'/'.$fileName);
				@chmod($imagePath.'/'.$fileName, 0777);
				
				
				//@unlink($imagePath.'/'.$fileName);
				
				
				$this->photo = $fileName;
				
				/*if(!$this->isNewRecord){
					@unlink($imagePath.'/'.$this->oldImage);
				}
			}else{
				$this->image = $this->oldImage;*/
			}
		}
		return true;
	}

	public static function getStatusNikah($id=null) {
		$arrStat = array(
         	1 => 'Lajang',
          	2 => 'Menikah',
          	3 => 'Duda/Janda',
        );
        if($id != null)
        	if($id != '0'){
            	return $arrStat[$id];
        	}else{
        		return '-';
        	}
        else
            return $arrStat;
	}

	public static function getBlood($id=null) {
		$arrStat = array(
         	1 => 'A',
          	2 => 'B',
          	3 => 'AB',
          	4 => 'O',
        );
        if($id != null)
        	if($id != '0'){
            	return $arrStat[$id];
        	}else{
        		return '-';
        	}
        else
            return $arrStat;
	}

	public static function getAgama($id=null) {
		$arrStat = array(
         	1 => 'Islam',
          	2 => 'Kristen',
          	3 => 'Katholik',
          	4 => 'Hindu',
          	5 => 'Budha',
        );
        if($id != null)
        	if($id != '0'){
            	return $arrStat[$id];
        	}else{
        		return '-';
        	}
        else
            return $arrStat;
	}

	public static function getPlace($id=null) {
		$arrStat = array(
         	1 => 'Jakarta',
          	2 => 'Jawa Tengah',
          	3 => 'Jawa timur',
          	4 => 'Jawa Barat',
          	5 => 'Yogyakarta',
        );
        if($id != null)
        	if($id != '0'){
            	return $arrStat[$id];
        	}else{
        		return '-';
        	}
        else
            return $arrStat;
	}
}
