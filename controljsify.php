<?php

include('simplehtmldom_1_5/simple_html_dom.php');

if($_GET['url'] == ''){
	$_GET['url'] = 'http://www.google.com/';
}


$siteUrl = $_GET['url'];
// get DOM from URL or file
$html = file_get_html($siteUrl);

if($_GET['cj'] == 'false'){

// Add base
foreach($html->find('head') as $e){
    $newHeadContent = '<base href="'.$siteUrl.'"/>';
    $e->innertext = $newHeadContent.$e->innertext;
}

	echo $html;
	return;
		
}


// Change the scr type. Need to use datacjssrc instead of datacjs-src to make simple html dom compatiable.
foreach($html->find('script') as $e){
	if($e->type == ''){
		//echo "Type is empty ...";
	   //$e->type = 'text/javascript';
	}

        if($e->src != ''){
		//echo "Src is not null";
	   $e->datacjssrc = $e->src;
           $e->src = null;

	}

        $e->type='text/cjs';
}


// Add base
foreach($html->find('head') as $e){
    $newHeadContent = '<base href="'.$siteUrl.'"/><!--[if IE]><![endif]-->';
   // $newHeadContent.= '<script type="text/javascript" src="control.js"/>';
    
    $e->innertext = $newHeadContent.$e->innertext;
}


  
// Add base
foreach($html->find('body') as $e){


    $newHeadContent= '<script type="text/javascript" src="control.js"/>';
    
    $e->innertext = $e->innertext.$newHeadContent;
}




// dump contents
echo $html;

//$html->save('result.html');

?>