<?php 

if (is_file('config.php')) {
	require_once('config.php');
}

// Autoloader
echo '<pre>';


	require_once('catalog/model/tool/Abdrecommend.php');
//python item_recommend.py -m 1b70d790-9cf0-44ab-b0c2-488bb7320c79 -k c51ef328a65946f19880cf4b3cc3e8ee -b 1625388 -i C9F-00080

$n= new Abdrecommend();
$n->getRecommend($model='1b70d790-9cf0-44ab-b0c2-488bb7320c79',$key='c51ef328a65946f19880cf4b3cc3e8ee',
 $item='C9F-00080',$build='1625388');
 
