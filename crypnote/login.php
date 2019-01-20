<?
$login=$_POST['login'];  // получаем значение post
$md5pass=$_POST['md5pass'];  // получаем значение post
$filename = 'notes/'.$_POST['login'].'/conf.php';  // конфигурируем предполагаемый путь к директории пользователя

if (file_exists($filename)){// если путь к директории существует, то инклудим его
    include($filename);
}else{
    header("Location: index.php");
    die;
}

session_start();
if(file_exists($filename)&$md5pass==$user_pass){ 
    
    $_SESSION['$auth']="Авторизация успешна";
    $_SESSION['login'] = $user_name;
    $_SESSION['path']="notes/".$_SESSION['login']."/";
    $_SESSION['conf'] = 'notes/'.$_SESSION['login'].'/conf.php';  // конфигурируем  путь к директории значений пользователя
    $_SESSION['open']=1;
    $_SESSION['iv']=$iv;
    $_SESSION['key']=base64_encode($iv.$user_pass);
    header("Location: index.php");
    die;
}elseif(file_exists($filename)&$md5pass!=$user_pass){
    $_SESSION['$auth']="Авторизация неуспешна";
    header("Location: index.php");
    die;
}elseif (!file_exists($filename)&isset($_POST['md5pass'])){
    $_SESSION['$auth']="Отсутствует пользователь";
    header("Location: index.php");
    die;
}elseif(!isset($_GET["logout"])&!isset($md5pass)){
    $_SESSION['$auth']="Неавторизированный вход";
    header("Location: index.php");
    die;
}
/*
if (isset($_GET["logout"])){
    $auth="Разлогинивание успешно";
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit(); // после передачи редиректа всегда нужен exit или die
    // иначе выполнение скрипта продолжится.
}
*/
/*
echo '$_SESSION[\'login\'] : '.$_SESSION['login'].'<br/>';
echo '$_SESSION[\'path\'] : '.$_SESSION['path'].'<br/>';
echo '$_SESSION[\'conf\'] : '.$_SESSION['conf'].'<br/>';
echo '$_SESSION[\'open\'] : '.$_SESSION['open'].'<br/>';
echo '$_SESSION[\'iv\'] : '.$_SESSION['iv'].'<br/>';
echo '$_SESSION[\'key\'] : '.$_SESSION['key'].'<br/>';
echo 'полученный пароль : '.$md5pass.'<br/>';
echo 'ожидаемый  пароль : '.$user_pass.'<br/>';
echo $auth;
*/
?>