<?
session_start();

if($_GET["logout"]){
    session_unset();
    session_destroy();
    header("Location: /crypnote");
    exit();
    
}
include ('function.php');
include("templ.php");
?>
