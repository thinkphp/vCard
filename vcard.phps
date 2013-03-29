<?php

     require_once('vcard.class.php');

     $card = new vcard();

     foreach($_POST as $c=>$v) {

            $card->data[$c] = $v;          
     } 
/*
     echo"<pre>";
     print_r($card->data);
     echo"</pre>";
*/

     $card->download();
?>