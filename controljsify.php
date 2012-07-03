<?php
// example of how to modify HTML contents
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
   // $newHeadContent.= '<script type="text/javascript" src="http://controljs.googlecode.com/svn-history/trunk/control.js"/>';
    
    $e->innertext = $newHeadContent.$e->innertext;
}


	echo $html;
	return;
		
}


// remove all image
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
   // $newHeadContent.= '<script type="text/javascript" src="http://controljs.googlecode.com/svn-history/trunk/control.js"/>';
    
    $e->innertext = $newHeadContent.$e->innertext;
}


  
// Add base
foreach($html->find('body') as $e){

//$newHeadContent = '<script type="text/javascript">var cjsscript = document.createElement("script");';
//$newHeadContent.='cjsscript.src = "http://mfronteer.com/controljs.php";';
//$newHeadContent.='var cjssib = document.getElementsByTagName("script")[0];';
//$newHeadContent.='cjssib.parentNode.insertBefore(cjsscript, cjssib);</script>';


    $newHeadContent= '<script type="text/javascript" src="http://controljs.googlecode.com/svn-history/trunk/control.js"/>';
    
    $e->innertext = $e->innertext.$newHeadContent;
}


// remove all image
//foreach($html->find('img') as $e)
  //  $e->outertext = '';

// replace all input
//foreach($html->find('input') as $e)
  //  $e->outertext = 'my text';

// dump contents
echo $html;

$html->save('result.html');

?>