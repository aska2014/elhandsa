<?php

class Algorithms{

	public static function two_loops_push($array1, $array2_name)
	{
		$array = array();
		foreach ($array1 as $value1) {
			foreach ($value1->{$array2_name} as $value2) {
				array_push($array, $value2);
			}
		}
		return $array;
	}

	public static function merge_object_arrays_by_id($array2, $array1) 
	{
		foreach ($array1 as $value1) {
			$push = true;
			foreach ($array2 as $value2) {
				if($value1->id == $value2->id)
				{
					$push = false;
					break;
				}
			}
			if($push)
				array_push($array2, $value1);
		}

		return $array2;

	}

	public static function CutText($str, $lenght) {
    
	    if(strlen($str) <= $lenght) {
	        
	        return substr($str, 0, $lenght);
	        
	    }else{
	        
	        return substr($str, 0, $lenght)."..";
	        
	    }
	    
	}



}