<?php
    $scanner = new Yylex(fopen("simple.lex.php", "r"));
    while ($scanner->yylex()){
	echo($scanner);
}
        

?>