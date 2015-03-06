<?php

/* 
Output filter to retrieve names of TVs from a list of TV ids
info@pepebe.de

Idea:
Use it with toogleTVSet plugin (included below) to handel different template options.

Usage:
This is a simple output filter. 
You can use it in snippets like getResources or pdoTools to add TVs to your query:

Example:
&includeTVs=`[[*Header:getTVNames]]`

*/

$tvNames = array();

$tvIds = explode(',' ,$input);

foreach($tvIds as $tvId){
    $tv = $modx->getObject('modTemplateVar', $tvId);
    $tvNames[] = $tv->get('name');
}

$tvNames = implode(',',$tvNames);

return $tvNames;