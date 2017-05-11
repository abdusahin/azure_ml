<?php 


class Abdrecommend     {
	
	
	public function getRecommend($model,$key, $item, $build) {
		
			$ch = curl_init(  );
			 $url='https://westus.api.cognitive.microsoft.com';
			 $url.=sprintf('/recommendations/v4.0/models/%s/recommend/item?itemIds=%s&numberOfResults=2&minimalScore=60&includeMetadata=false&buildId=%s',$model,$item,$build);
			 
			curl_setopt($ch, CURLOPT_URL, $url); 
			
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt( $ch, CURLOPT_HTTPHEADER, 
				array( 'Content-Type: application/json',
				'Ocp-Apim-Subscription-Key:'.$key));
				
			 
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			 
			$result = curl_exec($ch);
			if (!empty($result)) {
				$json_res=json_decode($result);
				if (is_object($json_res) ) {
					 //print $url."\n";
					//print_r($json_res);
					return $json_res;
				}
				
			}
			curl_close($ch);
			return null;
	}
	
	public function getRecommendBySKU($item) {
		   $ret=$this->getRecommend('1b70d790-9cf0-44ab-b0c2-488bb7320c79','c51ef328a65946f19880cf4b3cc3e8ee',$item,'1625388');
		   $result=null;
		   if ( is_object($ret) &&  is_array(  $ret->recommendedItems )) {
			   
			   $result=array();
			   foreach ($ret->recommendedItems  as $list) {
				    if (is_array( $list->items)) {
						foreach ($list->items as $item) {
							$result[$item->id]=array('name'=>$item->name,'sku'=>$item->id);
						}
					}
			   }
			   
		   }		   
		   return $result;
		   
		   
	}
}