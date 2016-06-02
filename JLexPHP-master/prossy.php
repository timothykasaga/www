<?php
	require_once('simple.lex.php');
   
   $scanner = new Yylex(fopen("test.php", "r"));
   if($scanner != null){
   while ($scanner->yylex())
	;
   }else{
   echo("Fail");
   }
    	
?>