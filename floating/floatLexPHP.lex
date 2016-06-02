<?php
include 'jlex.php';
%%
floatingliteral = {sign}?{fractionalliteral} {exponentpart}? | {digitsequence} {exponentpart}
fractionalliteral = {digitsequence}? \. {digitsequence} | {digitsequence}\.
exponentpart = e {sign}? {digitsequence} | E {sign}? {digitsequence}
sign = +|-
digitsequence = {digit}|{digitsequence} {digit}
digit = [0-9]
whitespace = [\n\r\t]+
%%
floatingliteral { echo "The number ", $this->yytext(), "\n"; }
whitespace {}
.  {}