<?php
	require_once('mylex.lex.php');
    $scanner = new Yylex(fopen("myin.txt", "r"));
    while ($scanner->yylex()){
	//echo($scanner);
}
        

?>