<?php
ob_start();
ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');
session_start();

require_once('initialize.php');
require_once('classes/DBConnection.php');
require_once('classes/SystemSettings.php');
$db = new DBConnection;
$conn = $db->conn;

function redirect($url=''){
	if(!empty($url))
	echo '<script>location.href="'.base_url .$url.'"</script>';
}
function validate_image($file){
	if(!empty($file)){
		if(preg_match('/^https?:\/\//i', $file)){
			return $file;
		}
			// exit;
		if(is_file(base_app.$file)){
			return base_url.$file;
		}else{
			return base_url.'assets/img/header-bg.jpg';
		}
	}else{
		return base_url.'assets/img/header-bg.jpg';
	}
}
function package_cover($row){
	if(isset($row['cover_image']) && !empty($row['cover_image'])){
		return validate_image($row['cover_image']);
	}
	$cover = '';
	if(isset($row['id']) && is_dir(base_app.'uploads/package_'.$row['id'])){
		$img = scandir(base_app.'uploads/package_'.$row['id']);
		$k = array_search('.',$img);
		if($k !== false) unset($img[$k]);
		$k = array_search('..',$img);
		if($k !== false) unset($img[$k]);
		$cover = isset($img[2]) ? 'uploads/package_'.$row['id'].'/'.$img[2] : "";
	}
	return validate_image($cover);
}
function package_gallery($row){
	$files = array();
	if(isset($row['gallery_images']) && !empty($row['gallery_images'])){
		$gallery = json_decode($row['gallery_images'], true);
		if(is_array($gallery)){
			foreach($gallery as $img){
				if(!empty($img)) $files[] = validate_image($img);
			}
		}
	}
	if(isset($row['cover_image']) && !empty($row['cover_image']) && !in_array(validate_image($row['cover_image']), $files)){
		array_unshift($files, validate_image($row['cover_image']));
	}
	if(isset($row['id']) && is_dir(base_app.'uploads/package_'.$row['id'])){
		$ofile = scandir(base_app.'uploads/package_'.$row['id']);
		foreach($ofile as $img){
			if(in_array($img,array('.','..'))) continue;
			$files[] = validate_image('uploads/package_'.$row['id'].'/'.$img);
		}
	}
	if(empty($files)) $files[] = validate_image('');
	return array_values(array_unique($files));
}
function render_stars($rating){
	$rating = max(0, min(5, (int)$rating));
	return str_repeat('&#9733;', $rating).str_repeat('&#9734;', 5 - $rating);
}
function isMobileDevice(){
    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        '/android/i' => 'Android', 
        '/blackberry/i' => 'BlackBerry', 
        '/webos/i' => 'Mobile'
    );

    //Return true if Mobile User Agent is detected
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            return true;
        }
    }
    //Otherwise return false..  
    return false;
}
ob_end_flush();
?>
