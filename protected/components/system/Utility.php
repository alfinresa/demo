<?php
/**
 * Utility class file
 *
 * Contains many function that most used
 */

class Utility
{

	/*
	* Return setting template with typePage: public, admin_sweeto or back_office
	*/
	public static function getCurrentTemplate($typePage) {
		$model = Templates::model()->find(array(
			'select'=>'template, layout',
			'condition' => 'group_page = :g AND default_theme = "1"',
			'params' => array(':g' => $typePage)
		));
		if($model != null) {
			return array('template' => $model->template, 'layout' => $model->layout);
		}
	}

	/**
	 * Refer layout path to current applied theme.
	 *
	 * @param object $module that currently active [optional]
	 * @return void
	 */
	public static function applyCurrentTheme($module = null) {
		$theme = Yii::app()->theme->name;
		Yii::app()->theme = $theme;

		if($module !== null) {
			$themePath = Yii::getPathOfAlias('webroot.themes.'.$theme.'.views.layouts');
			$module->setLayoutPath($themePath);
		}
	}

	/**
	 * Provide style for success message
	 *
	 * @param mixed $msg
	 */
	 public static function flashSuccess($msg) {
		$result  = '<div class="errorSummary success"><p>';
		$result .= $msg.'</p></div>';
		return $result;
	}

	/**
	 * Provide style for error message
	 *
	 * @param mixed $msg
	 */
	public static function flashError($msg) {
		if($msg != ''){
			$result  = '<div class="errorSummary"><p>';
			$result .= $msg.'</p></div>';
		}
		return $result;
	}

	/**
	 * get publish status
	 * 1 = Publish
	 * 2 = Active
	 * 3 = Enabled
	 * 4 = Dialog
	 * 5 = BUG and Report
	 * 6 = Default
	 * 7 = Verify
	 */
	public static function getPublish($id, $type) {
		if($type == '1') {
			$plus = 'aktif';
			$min = 'tidak aktif';
		} else if($type == '2') {
			$plus = 'Activate';
			$min = 'Deactivate';
		} else if($type == '3') {
			$plus = 'Enabled';
			$min = 'Disabled';
		} else if($type == '4') {
			$plus = 'Enabled Dialog';
			$min = 'Disable Dialog';
		} else if($type == '5') {
			$plus = 'Unresolved';
			$min = 'Resolved';
		} else if($type == '6') {
			$plus = 'Defaults';
			$min = 'Defaults';
		} else if($type == '7') {
			$plus = 'Verified';
			$min = 'Unverified';
		} else if($type == '8') {
			$plus = 'Subcribe';
			$min = 'Unsubcribe';
		} else if($type == '9') {
			$plus = 'Approve';
			$min = 'Reject';
		} else if($type == '10') {
			$plus = 'Blocked';
			$min = 'Unblocked';	
		}

		if($id == '1') {
			$publish = '<img src="'.Yii::app()->theme->baseUrl.'/img/publish.png" alt="'.$plus.'" title="'.$plus.'">';
		}else {
			$publish = '<img src="'.Yii::app()->theme->baseUrl.'/img/unpublish.png" alt="'.$min.'" title="'.$min.'">';
		}

		return $publish;
	}

	public static function getPublish2($url, $id, $type) {
		if($type == '1') {
			$plus = 'aktif';
			$min = 'tidak aktif';
		} else if($type == '2') {
			$plus = 'Activate';
			$min = 'Deactivate';
		} else if($type == '3') {
			$plus = 'Enabled';
			$min = 'Disabled';
		} else if($type == '4') {
			$plus = 'Enabled Dialog';
			$min = 'Disable Dialog';
		} else if($type == '5') {
			$plus = 'Unresolved';
			$min = 'Resolved';
		} else if($type == '6') {
			$plus = 'Defaults';
			$min = 'Defaults';
		} else if($type == '7') {
			$plus = 'Verified';
			$min = 'Unverified';
		} else if($type == '8') {
			$plus = 'Subcribe';
			$min = 'Unsubcribe';
		} else if($type == '9') {
			$plus = 'Approve';
			$min = 'Reject';
		} else if($type == '10') {
			$plus = 'Blocked';
			$min = 'Unblocked';	
		}

		if($id == '1') {
			$publish = '<img src="'.Yii::app()->theme->baseUrl.'/img/publish.png" alt="'.$plus.'" title="'.$plus.'">';
		}else {
			$publish = '<img src="'.Yii::app()->theme->baseUrl.'/img/unpublish.png" alt="'.$min.'" title="'.$min.'">';
		}

		return $publish;
	}
	

	/* shortText */
	public static function shortText ($var, $len = 60, $dotted = "...") {
		$var = trim($var);
		if (strlen ($var) < $len) { return $var; }
		if (preg_match ("/(.{1,$len})\s/", $var, $match)) {  return $match [1] . $dotted;  }
		else { return substr ($var, 0, $len) . $dotted; }
	}
	
	/* shortText */
	public static function shortTitle ($var, $len = 20, $dotted = "...") {
		$var = trim($var);
		if (strlen ($var) < $len) { return $var; }
		if (preg_match ("/(.{1,$len})\s/", $var, $match)) {  return $match [1] . $dotted;  }
		else { return substr ($var, 0, $len) . $dotted; }
	}

	/**
	 * replace space with underscore
	 */
	public static function replaceSpaceWithUnderscore($fileName) {
		return str_ireplace(' ', '_', strtolower(trim($fileName)));
	}

	/**
	 * remove folder and file
	 */
	public static function deleteFolder($path) {
		if(file_exists($path)) {
			$fh = dir($path);
			while (false !== ($files = $fh->read())) {
				@unlink($fh->path.'/'.$files);
			}
			$fh->close();
			@rmdir($path);
			return true;

		} else {
			return false;
		}
	}

    // Include Status (Checked/No Checked)
	public static function getTimThumb($src, $width, $height, $zoom) {
		$image = Yii::app()->request->baseUrl.'/timthumb.php?src='.$src.'&h='.$height.'&w='.$width.'&zc='.$zoom;
        return $image;
    }
	
	/*
	* Return template module
	*/
	public static function getTemplateModule($moduleId, $publicControllerActions) {
		$currentControllerAction = str_replace("/{$moduleId}/", '', (str_replace(Yii::app()->baseUrl, '', $_SERVER["REQUEST_URI"])));
		$part = explode('/', $currentControllerAction);
		
		if(in_array($currentControllerAction, $publicControllerActions)) //public group
			$groupPage = 'public';
		else {
			if(!Yii::app()->user->isGuest)
				$groupPage = Yii::app()->user->id == 1 ? 'admin_sweeto' : 'back_office';			
		}
		
		return $arrThemes = Utility::getCurrentTemplate($groupPage);		
	}

	/* Get current action
	@params statik = false, halaman statik tidak dideteksi
	*/
	public static function getCurrentAction($statik = false) {
		// Get query string (ex: index.php?r=site/page)
		$queriString = Yii::app()->request->queryString;
		$arrParam = '';
		if(!empty($queriString)) {
			$arrParam = explode('&', $queriString);
		}

		$aksi        = Yii::app()->controller->id;
		$idAksi      = Yii::app()->controller->action->id;
		$currAction  = '';
		if($statik) {
			if($aksi == 'site' && $idAksi == 'page') {
				$aksiStatik  = @explode('=', $arrParam[1]);
				$currAction  = $aksiStatik[1];
			}
		}else {
			$currAction = $aksi;
		}

		if(!empty($currAction))
			return $currAction;
		else
			return false;
	}

	/*
	Mengembalikan nama hari dalam bahasa indonesia.
	@params short=true, tampilkan dalam 3 huruf, JUM, SAB
	*/
	public static function getLocalDayName($dayName, $short=true) {
		switch($dayName) {
			case 0:
				return ($short ? 'MIN' : 'Minggu');
				break;

			case 1:
				return ($short ? 'SEN' : 'Senin');
				break;

			case 2:
				return ($short ? 'SEL' : 'Selasa');
				break;

			case 3:
				return ($short ? 'RAB' : 'Rabu');
				break;

			case 4:
				return ($short ? 'KAM' : 'Kamis');
				break;

			case 5:
				return ($short ? 'JUM' : 'Jumat');
				break;

			case 6:
				return ($short ? 'SAB' : 'Sabtu');
				break;
		}
	}

	/* Ubah bulan angka ke nama bulan */
	public static function monthInt2Name($month, $shortMonthName=false) {
		if(empty($month))
			return false;

		$bulan = array(
			'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
			'Agustus', 'September', 'Oktober', 'Nopember', 'Desember'
		);

		$shortBulan = array(
			'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul',
			'Agu', 'Sep', 'Okt', 'Nop', 'Des'
		);

		if($shortMonthName == true)
			return $shortBulan[$month-1];
		else
			return $bulan[$month-1];
	}
	
	/* Ubah bulan angka ke nama bulan */
	public static function monthInt2Romawi($month) {
		if(empty($month))
			return false;

		$bulan = array(
			'I', 'II', 'III', 'IV', 'V', 'VI', 'VII',
			'VIII', 'IX', 'X', 'XI', 'XII'
		);
		return $bulan[$month-1];
	}

	/* Fungsi untuk mengubah angka tahun dan bulan ke nama
	@params $waktu = tahun dan bulan (2010-10)
	$shortMonth = true nama bulan di singkat, false nama bulan penuh.
	*/
	public static function ubahKeBulanTahun($waktu, $shortMonth=false) {
		$waktu = explode('-', $waktu);
		return Utility::monthInt2Name($waktu[1], $shortMonth) . " " . $waktu[0];
	}



	public static function getYmStatus($yahooid,$altOn, $altOff) {
		$buka = fopen('http://opi.yahoo.com/online?u='.$yahooid.'&m=t','r')
		or die
		('<img src="http://opi.yahoo.com/online?u='.$yahooid.'&m=g&t=2"/>');
		while ($baca = fread( $buka, 2048 ))
		{ $status = $baca; }
		fclose($buka);

		if($status == $yahooid.' is ONLINE'){
			//$data ='<a href="ymsgr:sendim?'.$yahooid.'" title="'.$altOn.'" > <img src="'.Yii::app()->request->baseUrl.'/images/resource/ym_online.png"  alt="'.$altOn.'"/></a>';
			$data = '<span><a href="ymsgr:sendim?'.$yahooid.'" title="'.$altOn.'">SUPPORT1</a></span>';
			} else {
			//$data =' <a href="ymsgr:sendim?'.$yahooid.'" title="'.$altOff.'"> <img src="'.Yii::app()->request->baseUrl.'/images/resource/ym_sleep.png"  alt="'.$altOff.'"/></a>';
			$data = '<span class="chat-off"><a href="ymsgr:sendim?'.$yahooid.'" title="'.$altOff.'">SUPPORT2</a></span>';
		}

		return $data;
	}


	// Get kata berdasarkan jumlah kata sejumlah $number.
	public static function getContentByWord($string, $number=2) {
		if(strlen($isi) < $max) {
			return $isi;
		}else {
			$kata = trim($string);
			$kata = explode(' ', $kata);
			$result = '';
			for($i=0; $i < 2; $i++) {
				$result .= $kata[$i];
			}
			return trim($result);
		}
	}

	public static function registerJsFile($jsFile, $posisi) {
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($jsFile, $posisi);
	}

	public static function clickable_link($text = '') {
		$text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1:", $text);
		$ret = ' ' . $text;
		$ret = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);
		$ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);
		$ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);
		$ret = substr($ret, 1);
		return $ret;
	}

	/* Mendapatkan max id dari suatu tabel.
	   @params string $namaTabel
	   @params string $namaId
	   @return integer max id. false jika data tidak ditemukan.
	   Example: Utility::getMaxId('user', 'id_user');
	*/
	public static function getMaxId($namaTabel, $namaId) {
		$conn    = Yii::app()->db;
		$sql     = "SELECT IFNULL(MAX($namaId)+1, 1) AS id FROM $namaTabel";
		$command = $conn->createCommand($sql);
		$result  = $command->queryColumn();

		if(count($result) > 0)
			return $result[0];
		else
			return false;
	}


	//change time(H:i:s) to second
	public static function time_to_sec($time) {
		$hours = substr($time, 0, -6);
		$minutes = substr($time, -5, 2);
		$seconds = substr($time, -2);
		return $hours * 3600 + $minutes * 60 + $seconds;
	}


	public static function removeNewLine($str) {
		$pattern = '/\n|\r|\n\r/i';
		$replace = ' ';
		return preg_replace($pattern, $replace, trim($str));
	}

	//cek ukuran file dalam kb
	public static function getSizeFile($ukuranFile){
		if($ukuranFile > 1024)
			return round($ukuranFile/1024, 2);
		else
			$ukuranFile;

	}

	//sent email function
	public static function sentEmail($setFromEmail, $setFromName, $emailDestination, $nameDestination, $subject, $msg,
		$category = 0, $cc = null, $attachment = null)	{
		
		/*
			list category
			0=common, 1=registration, 2=vacancy, 3=test_call, 4=message, 5=finance
		*/
		Yii::import('ext.jphpmailer.JPhpMailer');
		Yii::import('application.modules.email.models.CcnSendEmailLog');
		$mail=new JPhpMailer;
		//log email into database
		$emailLog = new CcnSendEmailLog;
		$emailLog->category = $category;
		$emailLog->date_inserted = date('Y-m-d H:i:s');
		$emailLog->date_sent = date('Y-m-d H:i:s');
		$emailLog->header_from = $setFromEmail;
		$emailLog->email_to = $emailDestination;
		$emailLog->subject = $subject;
		$emailLog->msg = $msg;
		
		if($_SERVER["HTTP_HOST"] =='localhost' || $_SERVER['SERVER_ADDR'] =='192.168.1.250'){	//in localhost or testing condition
			//smtp google
			$mail->IsSMTP();
			$mail->SMTPSecure = "ssl";
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Host       = "smtp.gmail.com"; // sets the SMTP server
			$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
			$mail->Username   = "swevelmail"; // SMTP account username
			$mail->Password   = "0o9i8u7y6t";
			$mail->SetFrom($setFromEmail, $setFromName);
			$mail->Subject = $subject;
			$mail->MsgHTML($msg);
			//$options  = WebOption::model()->findByPk(1);
			//$emailDestination = $options->email_testing;
			$mail->AddAddress($emailDestination, $nameDestination);
			if($cc != null && count($cc) > 0) {
				foreach($cc as $to => $name) {
					$mail->AddAddress($to, $name);
				}
			}
			if($attachment != null){
				$mail->addAttachment($attachment);
			}

		} else {
			//live server
			$mail->IsMail();
			$mail->SetFrom($setFromEmail, $setFromName);
			$mail->Subject = $subject;
			$mail->MsgHTML($msg);
			$mail->AddAddress($emailDestination, $nameDestination);
                        $mail->AddReplyTo($setFromEmail, $setFromName);
            
			if($attachment != null){
				$mail->addAttachment($attachment);
			}
			
			if($cc != null && count($cc) > 0) {
				foreach($cc as $to => $name) {
					$mail->AddAddress($to, $name);
				}
			}
		}
		
	//	file_put_contents('assets/cek_email.html', $msg);
		
		if($_SERVER["HTTP_HOST"] =='localhost'){
			$emailLog->is_sended = 1;
			$emailLog->save();
			$file = fopen('assets/localhost_email_'.$emailDestination.'.html', 'w+');
			fwrite($file, $msg);
			fclose($file);
			return true;
		}else {
			if($mail->Send()){
				$emailLog->is_sended = 1;
				$emailLog->save();
				return true;
			}else{
				$emailLog->is_sended = 0;
				$emailLog->save();
				return false;
			}
		}
	}


	/**
	 * Convert nominal to rupiah currency
	 *
	 * @input int nominal
	 * @access public
	 * @return sting
	 */
	public static function rupiah($nominal) {
		 $rupiah =  number_format($nominal,0, ",",".");
		 $rupiah = "Rp "  . $rupiah . ",00";
		 return $rupiah;
	 }

	 /**
	 * Convert nominal to eye catching format
	 */
	function numberFormat($nominal) {
		 return number_format($nominal,0, ",",".");
	}

	/**
	 * Get page range from pages object
	 *
	 * @param integer $maxButtonCount number of button per page
	 * @param pagination object $pages
	 * @return array page range
	 */
	public static function getPageRange($maxButtonCount, &$pages) {
		$currentPage = $pages->currentPage;
		$pageCount   = $pages->pageCount;

		$beginPage=max(0, $currentPage-(int)($maxButtonCount/2));
		if(($endPage=$beginPage+$maxButtonCount-1)>=$pageCount)
		{
			$endPage=$pageCount-1;
			$beginPage=max(0,$endPage-$maxButtonCount+1);
		}
		return array($beginPage,$endPage);
	}

	/**
	 * Register script file with duplicate check.
	 *
	 * @param string $url url script
	 * @param integer position of script.
	 */
	public static function safeRegisterScriptFile($url, $position=0) {
		$cs  = Yii::app()->getClientScript();
		if(!$cs->isScriptFileRegistered($url, $position)) {
			$cs->registerScriptFile($url, $position);
		}
	}

	/**
	 * Return better uniq id
	 */
	public static function getUniqId() {
		return md5(uniqid(mt_rand(), true));
	}

	/**
	 * Recursively chmod file/folder
	 *
	 * @param string $path
	 * @param octal $fileMode
	 */
	public static function chmodr($path, $fileMode) {
		if (!is_dir($path))
			return chmod($path, $fileMode);

		$dh = opendir($path);
		while (($file = readdir($dh)) !== false) {
			if($file != '.' && $file != '..') {
				$fullpath = $path.'/'.$file;
				if(is_link($fullpath))
					return false;
				elseif(!is_dir($fullpath) && !@chmod($fullpath, $fileMode))
						return false;
				elseif(!self::chmodr($fullpath, $fileMode))
					return false;
			}
		}
		closedir($dh);

		if(@chmod($path, $fileMode))
			return true;
		else
			return false;
	}

	public static function getEnableList() {
		return array(
			1 => 'Ya',
			0 => 'Tidak',
		);
	}

	/**
	 * Copy folder include all files
	 *
	 * @param string $src
	 * @param string $dst
	 * @return void
	 */
	public static function recursiveCopy($src, $dst) {
		$dir      = opendir($src);
		$pathInfo = pathinfo($dst);
		@chmod($pathInfo['dirname'], 0777);
		@mkdir($dst);
		@chmod($dst, 0777);

		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					Utility::recursiveCopy($src . '/' . $file,$dst . '/' . $file);
				}else {
					copy($src . '/' . $file,$dst . '/' . $file);
					@chmod($dst . '/' . $file, 0777);
				}
			}
		}
		closedir($dir);
	}

	/**
	 * Delete files and folder recursively
	 *
	 * @param string $path path of file/folder
	 */
	public static function recursiveDelete($path) {
		if(is_file($path)) {
			@unlink($path);
		}else {
			$it = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($path),
				RecursiveIteratorIterator::CHILD_FIRST
			);

			foreach ($it as $file) {
				if (in_array($file->getBasename(), array('.', '..'))) {
					continue;
				}elseif ($file->isDir()) {
					rmdir($file->getPathname());
				}elseif ($file->isFile() || $file->isLink()) {
					unlink($file->getPathname());
				}
			}
			rmdir($path);
		}
	}
	
	/**
	 * get image publish/unpublish in gridview admin manage
	 *	@param int 0/1
	 *	@return string
	 */
	public static function getPublishedToImg($pub) {
		if($pub == 1)
			return CHtml::image(Yii::app()->theme->baseUrl .'/img/publish.png', 'published', array('title'=>Yii::t('site', 'published')));
		else
			return CHtml::image(Yii::app()->theme->baseUrl .'/img/unpublish.png', 'un-published', array('title'=>Yii::t('site', 'unpublished')));
	}
	

	/**
	 * clear url for alias url
	 * @param url
	 * @return str
	 */
	public static function clearUrl($url) {
        $url = trim(strtolower($url));
        $search = array('–',          ' ', '.', ':', '(', ')', '&', ',', '/' );
        $replace = array('%E2%80%93', '-', '-', '-', '-', '-', '-', '-', '-' );        
        $cleanUrl = str_replace($search, $replace, $url);
        $cleanUrl = str_replace('--', '-', $cleanUrl);
        if(substr($cleanUrl, -1) == '-')
            $cleanUrl = substr ($cleanUrl, 0, -1);
        
		return $cleanUrl;
	}
	
	
	
	/**
	 * @return array of excel column char
	 */
	public static function getExcelColumn() {
		$excelColumn = array();
		for($i=65; $i<=90; $i++) {
			$excelColumn[] = chr($i);
		}
		
		for($i=0; $i<=25; $i++) {
			for($j=0; $j<=25; $j++) {
				$excelColumn[] = $excelColumn[$i].$excelColumn[$j];
			}
		}
		return $excelColumn;
	}
	
    
    //get id language
	public static function getIdLanguage(){
		if(Yii::app()->session['sessionLanguage'] != null)
				$langId = Yii::app()->session['sessionLanguage'];
		else{
			$langId = isset($_GET['lng']) && $_GET['lng'] != ''?$_GET['lng']:null;
			if($langId == null){
                //find default language
                //$model = WebOption::model()->findByPk(1);
                $langId = Yii::app()->params['defaultLanguage'];
			}

		}
		return $langId;
	}
	
	
	
	public static function printDashIfEmpty($text) {
		return $text == '' ? '-' : $text;
	}
	
	
	/**
	 * count date diff between two datetimes
	 * @param datetime date1
	 * @param datetime date2
	 * @return int
	 */
	public static function timeInterval($time1, $time2)
	{
		$time1 = date('H:i', strtotime($time1));
		$time2 = date('H:i', strtotime($time2));
		
		$jam1 = strtotime($time1);
		$jam2 =  strtotime($time2);
		$jam3 =  1388012400;
		$jam4 =  1387926000;
		
		if($jam2 < $jam1){
			$interval = ($jam3-$jam1)+($jam2-$jam4);
		}else{
			$interval = $jam2-$jam1;
		}
		
		$hours = floor($interval/3600);
		
		if ($hours<10)
		{
			$jam='0'.$hours;
		} else {
			$jam=$hours;
		} 
	   	
		$minute = floor(($interval-$jam*3600)/60);
		if ($minute<10)
		{
			$menit='0'.$minute;
		} else {
			$menit=$minute;
		}
		
	   
		$reg_time= $jam.':'.$menit;
		
		return $reg_time;
		//return $interval;

	}
	
	public static function getStatus($id=null) {
		$arrStatus = array(
         	0 => 'Inaktif',
			1 => 'Aktif',
          	2 => 'Draft',
        );
        if($id != null)
            return $arrStatus[$id];
        else
            return $arrStatus;
	}

	public static function getHpp() {
		/*$arrStatus = array(
         	0 => 'Unpublish',
			1 => 'Publish',
          	2 => 'Draft',
        );
        if($id != null)
            return $arrStatus[$id];
        else
            return $arrStatus;*/
	}

	
	
	
}
