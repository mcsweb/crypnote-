<?
if ($_SESSION['open']){
    include('notes/'.$_SESSION['login'].'/conf.php');
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//RU">
<html>
    <header>
        <title> Блокнот</title>
        <link href="css/index.css" type="text/css" rel="stylesheet" /> 
        <link rel="shortcut icon" href="../favicon.ico" />
        
        <link type="text/css" rel="stylesheet" href="js/jquery-te-1.4.0.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        

        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="js/functions.js" charset="utf-8"></script>
    </header>
    <body  <?if ($_SESSION['open']){?>  style="background:#fff;" onload="refresh();logout();"<?}else{?>   style="background: linear-gradient(45deg, #292929 25%, transparent 25%, transparent 75%, #292929 75%), linear-gradient(45deg, #292929 25%, transparent 25%, transparent 75%, #292929 75%) 0.1875em 0.1875em, radial-gradient(at 50% 0, #484847, #090909);
background-size: 0.375em 0.375em, 0.375em 0.375em, 100% 100%;" <?}?>>
    <input type="checkbox" id="nav-toggle" hidden>
    <!-- 
    Выдвижную панель размещаете ниже
    флажка (checkbox), но не обязательно 
    непосредственно после него, например
    можно и в конце страницы
    -->
    <nav class="nav">
        <!-- 
    Метка с именем `id` чекбокса в `for` атрибуте
    Символ Unicode 'TRIGRAM FOR HEAVEN' (U+2630)
    Пустой атрибут `onclick` используем для исправления бага в iOS < 6.0
    См: http://timpietrusky.com/advanced-checkbox-hack 
    -->
        <label for="nav-toggle" class="nav-toggle" onclick></label>
        <!-- 
    Здесь размещаете любую разметку,
    если это меню, то скорее всего неупорядоченный список <ul>
    -->
        <h2 class="logo"> 
            <a href="#"></a>Блокноты <? echo $_SESSION['login'];?></a> 
        </h2>
        <center>
<?if ($_SESSION['open']){?>            
            <button class="instrumental" onclick="window.location.href = '?logout=unlog';"><i class="fas fa-sign-out-alt"></i></button> 
<?}else{?>
            <button class="instrumental" onclick="window.location.href = '?';"><i class="fas fa-sign-in-alt"></i></i></button>
<?}?>
            <button class="instrumental" onclick="window.location.href = '?note_link=Инструкция.txt';"><i class="fas fa-users-cog"></i></button> 
            <button class="instrumental" onclick="window.location.href = '../crypnote.zip';"><i class="fas fa-download"></i></button>
            <br>
            <hr>
<?
if ($_SESSION['open']){?>
    <fieldset>
<?

    $dir = 'notes/'.$_SESSION['login'];
    $files1 = scandir($dir);
//  $files1 = scandir($dir, 1);
//  print_r($files1);
    $new_files1=array_shift($files1);
    $new_files1=array_shift($files1);
//  print_r($files1);

    $files1=array_flip($files1);
    unset($files1["Инструкция.txt"]);
    unset($files1["conf.php"]);
    $files1=array_flip($files1);
            
    foreach ($files1 as $key => $value) {
        $str = substr($files1[$key],0,-4);
        $str= trim($str);
        echo '          <div><a href="?note_link='.$str.'.txt" title="Открыть запись"><b>'.$str.'</b></a>' ; if ($str!="Инструкция"&&$str!="1_Первый блокнот"){echo '| <i id="'.$str.'" class="far fa-window-close"  title="Удалить запись" style="color:#fff;"></i></div>';}; echo "\n";
    }
?>
<!--            <div><a href="?note_link=Инструкция.txt" title="Открыть запись"><b>Инструкция_log</b></a>-->
        </fieldset>
        <hr>
        
        
<!--
        <form id="form1" action="#" method="get">
            <input type="hidden" name="logout" value="unlog">
            <button>Завершить</button>
        </form>
-->        
     
<?}else{?>
<!--           <fieldset id="fild">
           <div>
                <a href="?note_link=Инструкция.txt" title="Открыть запись"><b>Инструкция_unlog</b></a><br>
                <a href="?" title="Открыть запись"><b>Вход</b></a><br>
            </div>
        </fieldset>
        <br><br>
-->  
<?}?>
      <fieldset>
        <span style="color:#fff;"><b>Криптографический блокнот </b><br>
        Доступен по лицензии <a href="http://www.wtfpl.net/about/"  target ="_blank" style="color:#fff;">WTFPL</a><br>
        2017-<? echo date ( 'Y' ) ;?><br>Версия 1.0
        </fieldset>
        <hr>
        <fieldset>
            <a href="https://fontawesome.com/"><i class="fab fa-fort-awesome"></i></a>&nbsp;&nbsp;&nbsp;
            <a href="https://github.com/mcsweb/crypnote-"><i class="fab fa-github"></i></a>&nbsp;&nbsp;&nbsp;
            <a href=""><img src="img/logo-jquery.png" style="height:1em;"></a>&nbsp;&nbsp;&nbsp;
            <a href="http://jqueryte.com"><img src="img/jquerytelogo.png" style="height:1em;"></a>&nbsp;&nbsp;&nbsp;
            <a href="https://rusitblog.blogspot.com/"><i class="fab fa-blogger-b"></i></a>&nbsp;&nbsp;&nbsp;
        </fieldset>
        <hr>
        </center>
       

    </nav>
    <!-- 
    Маска (затемнение) основного контента при включенной панели
    по-умолчанию данная фишка не используется, если оно вам надо,
		просто расккоментируйте div-контейнер ниже
	-->	
    <div class="mask-content"></div>

		
    <!-- 
    Далее размещаем любую разметку,
    много слов, картинки и т.д...
    -->
    <i id="ttt" class="fas fa-save" style="float:left;margin:1vh 1vw 2vh 3vw;font-size:8vh;"></i>
    <div id="note_name" style="margin:1vh 0 2vh 6vw;padding:1vh 0 2vh 1vw;border-bottom:1px solid #000;width:85vw;height:5vh;font-size:4.5vh;" contenteditable="true">
        
<?  
if ($_SESSION['open']){
    
    if($_GET['note_link']&&file_exists('notes/'.$_SESSION['login'].'/'.$_GET['note_link'])){
        $note_link=substr($_GET['note_link'],0,-4);
        $note_puth='notes/'.$_SESSION['login'].'/'.$_GET['note_link'];
    }else{
        $note_link=substr($files1[0],0,-4);
        $note_puth='notes/'.$_SESSION['login'].'/'.$files1[0];
    }
    echo $note_link;
}else{
    echo "Доступ к блокноту :";
}
?>
        
    </div>
    
<?
if ($_SESSION['open']){?>
    <div id="" style="margin:0vh 0 0.5vh 3vw;padding:0px;width:85vw;height:5vh;font-size:2vh;color:grey;">| <b>Путь к файлу: </b><? echo $note_puth;?> | <b>Вы запросили документ</b> : <?if($_GET['note_link']!=""){echo $_GET['note_link'];}else{echo "запрос отсутствует";}?> |</div>
<?}
if ($_SESSION['open']){
    echo "  <script>var note_title='".$note_link."'</script>\n";
}?>
    <textarea class="jqte-test" id="edit">
<?
if ($_SESSION['open']){
    if($note_link!="Инструкция"){
        $iz_file_text_b4=file_get_contents($note_puth);
    	$iz_file_text_un_b4=base64_decode($iz_file_text_b4) ;
    	
    	$mc_d = mcrypt_module_open(MCRYPT_BLOWFISH,'',MCRYPT_MODE_CFB,'');
    	$iv_size_d = mcrypt_enc_get_iv_size($mc_d);
    	
    	$decrypt_text = substr( $iz_file_text_un_b4 , $iv_size_d );
    	mcrypt_generic_init ( $mc_d , $_SESSION['key'] , $_SESSION['iv']);
    	$text = mdecrypt_generic( $mc_d , $decrypt_text);
    	mcrypt_generic_deinit($mc_d);
    	mcrypt_module_close($mc_d);
    	echo $text;
    }else{
        include('notes/'.$_SESSION['login'].'/'.$_GET['note_link']);
    }
}else{
    if($_GET['note_link']=="Инструкция.txt"){
        include('notes/'.$_GET['note_link']);
    }else{
        include('auth.php');
    }
}
?>
	</textarea>
<?
if ($_SESSION['open']){?>
	<div id="tut" style="font-size:0.8rem;color:green;margin-left:5vw;">Автосохранение каждые <span id="timer"></span> мин.</div>
<?}?>
    </div>
    
    <script>
        $('.jqte-test').jqte({
            change: function(){ 
                red_css();
                clearTimeout(end_session);
                logout();
            }
        });
    	
    </script>


    <script>
        <?if ($_SESSION['open']){?>
        function green_css(){
            /*$("#ttt").html('Сохранено');*/
            $("#ttt").css({'color':'green'});
            save_icon=setTimeout (function(){black_css()},5000);
        }
        function red_css(){
            /*$("#ttt").html('Редактируется...');*/
            $("#ttt").css({'color':'red'});
            save_icon=setTimeout (function(){black_css()},5000);
        }
        function black_css(){
            /*$("#ttt").html('Редактируется...');*/
            $("#ttt").css({'color':'black'});
            clearTimeout(save_icon);
        }
        
        $('#ttt').click(function(){save_note();});
        <?}?>
        $('.fa-window-close').click(function(){del_file($(this).attr('id'));});
    </script>
    <script>
        function save_note(){
            
            var head= $("#note_name").html().trim();
            var text= $("#edit").val();
            if (head!=note_title){
                if (confirm("Создать новый блокнот?")) {
                  
                } else {
                  head=note_title;
                  $("#note_name").html(head);
                }
            }
        
            $.ajax({
                type: "POST",
                url: "SendData.php",
                data: ({ head : head, text: text}),
                // Выводим то что вернул PHP
        		success: green_css()
            });
            
                min=<?echo $time_for_saving;?>;
                sec=00;
            clearInterval(inter);
            refresh();
            
            
            if (head!=note_title){
                alert("вы создали новый блокнот");
                window.location.href = '?note_link='+head+'.txt';
            }
            
        }
        function del_file(del_file_name){
            if (confirm("Удалить блокнот " + del_file_name +" ?")) {
                $.ajax({
                    type: "POST",
                    url: "SendData.php",
                    data: ({ link : del_file_name}),
                    // Выводим то что вернул PHP
            		success: $("#"+del_file_name).parent().remove()
                });
                alert("Блокнот "+del_file_name+" удален.");
                window.location.href = '?note_link='+del_file_name+'.txt';
            }else{}
        }
    </script>
    
<? if ($_SESSION['open']){?>
	<script language="JavaScript" type="text/javascript">
		
		// выставляем секунды
		var sec=00;
		// выставляем минуты
		var min=<?echo $time_for_saving;?>;

		function refresh()
		
		
		{
			sec--;
			if(sec==-01){sec=59; min=min-1;}
			else{min=min;}
			if(sec<=9){sec="0" + sec;}
			time=(min<=9 ? "0"+min : min) + ":" + sec;
			if(document.getElementById){timer.innerHTML=time;}
			inter=setTimeout("refresh()", 1000);
			// действие, если таймер 00:00
			if(min=='00' && sec=='00'){
				sec="00";
				/* выводим сообщение в элемент с id="tut", например <div id="tut"></div> */
				/*		tut.innerHTML="Сохраненo...!";*/
						save_note();
				
						/* либо модальное окно */
						//alert('Таймер завершил свою работу!');

						/* либо переход на какой-то адрес */
				//window.location='http://www.net-f.ru/';
						
						/* либо любой другой Ваш код */
			}
		}
		function logout(){
		    end_session=setTimeout(function(){ window.location.href = '?logout=unlog';}, <? echo $session_end*60000;?>);
		    }
	</script>
<?}?> 
    </body>
            
</html>
<?exit();?>
