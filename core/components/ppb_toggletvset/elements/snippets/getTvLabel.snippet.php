<?php
/*
getTVLabel snippet for modx 2.3

Version:
------------------
v0.0.1 (2015-03-06 16:44)

Author:
------------------
info@pepebe.de

Problem:
------------------
You have a selectTV with these input options: "Standard==4||Carousel==8||Cover==9,10||Jumbotron==5,6,7"
In your template you want 
* to use [[$[[*selectTV]]]] 
* to call [[$Standard]] or [[$Carousel]].

In this case you need the selected label instead of the current value.

This snippet will retrieve the label of the value you have selected.

Usage:
------------------------------------------------------
If your TV is not prefixed, use the snippet like this:
[[*Header:getTVLabel]]

If you are working in getResources/pdoResources, etc and your TV is prefixed (example [[+tv.Header]], etc.), use it like this:
[[+tv.Header:getTVLabel=`tv.`]]

*/

    $debug = false;

    /* -------------------------------------------------- */
    if(!function_exists('ppb_msg')){
        function ppb_msg($msg) {
            $output = "<pre>".print_r($msg,true)."</pre>";
            return $output;
        }
    }
    /* -------------------------------------------------- */
    
    $msg = array();  
  
    if(!empty($options)){
        $name = str_replace($options,'',$name);
        $c = array('name'=> $name);
    }
    else {
        $c = array('name'=>$name);
    }
    
    $msg['c']           = $c;
    $msg['name']        = $name;
    $msg['options']     = $options;
    
    $tv = $modx->getObject('modTemplateVar', $c);
    
    $elements = $tv->get('elements');
    $msg['elements'] = $elements;
    $elements = explode('||',$elements);
    
    $tvValue = $modx->resource->getTVValue(reset($c)); 
    $msg['tvValue'] = $tvValue;
    
    foreach($elements as $key => $element){
        $element = explode('==',$element);
        $msg['element'][$key] = $element;
        
        if($element[1] == $tvValue){
            $msg['currentValue'] = $element[0];
            $output = $element[0];
        }
    }
    
    $msg['output'] = $output;
    
    if($debug == true){
        return ppb_msg($msg);
    }
    else {
        return $output;    
    }
