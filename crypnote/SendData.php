<?php
session_start();
if ($_SESSION['open']&&$_POST['head']!=""&&$_POST['head']!==null){ 
    $head = $_POST['head'];
    $head = trim ($head);
    $text = $_POST['text'];
    if($head!="Инструкция"){
    	$mc_d = mcrypt_module_open(MCRYPT_BLOWFISH,'',MCRYPT_MODE_CFB,'');
    	$iv_size = mcrypt_enc_get_iv_size($mc_d);
    	mcrypt_generic_init($mc_d,$_SESSION['key'],$_SESSION['iv']);
    	$crypt_text = mcrypt_generic($mc_d,$text);
    	mcrypt_generic_deinit($mc_d);
    	
    	$crypt_text_b64 = base64_encode($_SESSION['iv'].$crypt_text);
    	file_put_contents('notes/'.$_SESSION['login'].'/'.$head.'.txt', $crypt_text_b64);
    	mcrypt_module_close($mc_d);
    }else{
        file_put_contents('notes/'.$_SESSION['login'].'/'.$head.'.txt', $text);
    }
}

if ($_SESSION['open']&&$_POST['link']!=""&&$_POST['link']!=null){
    $link=$_POST['link'];
    unlink('notes/'.$_SESSION['login'].'/'.$link.'.txt');
}




?>