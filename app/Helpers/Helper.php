<?php

if(!function_exists('responseApi')){
	function responseApi($array){
		$return = response()->json($array);
		return $return;
	}
}