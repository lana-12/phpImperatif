<?php


// Display varDump
function dump($variable)
{
    echo '
<pre>';
    var_dump($variable);
    echo '</pre>';
}
