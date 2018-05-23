<?php
if(isset($_POST['file'])){
    $file = '../img/users/' . $_POST['file'];
    if(file_exists($file)){
		session_start();
		//$_SESSION['image'][$_POST['file']]='';
		 unset($_SESSION['image'][$_POST['file']]);
		//session_unset(['image']$_POST['file']);
        unlink($file);
    }
}
?>
