<?php

namespace App\Http\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Og;
use App\Models\Pf;



Class GraphsHelper
{
	public static function retunDataToHomeChart()
	{
		$open = returnCountedOpenOgs();
		$closed = retunCountedClosedOgs();
	
		return view('home', compact('open', 'closed'));	
	}
	
	public static function returnCountedOpenOgs()
	{
		$regionais = [];
		// $ogs = OgController@getOgsFromUrl();
	
		$ogs =  Og::orderBy('protocolo', 'desc')->get();
		foreach($ogs as $i=>$og){
			if($og['status'] == "FECHADO"){
				$ogs->forget($i);
			}
		}
	
		foreach($ogs as $i=>$og){
			$regionais[$i] = $og['regional'];
		}
	
		return array_count_values($regionais);
	}
	
	public function retunCountedClosedOgs()
	{
		$regionais = [];
		$ogs =  Og::orderBy('protocolo', 'desc')->get();
		foreach($ogs as $i=>$og){
			if($og['status'] == "ABERTO"){
				$ogs->forget($i);
			}
		}
	
		foreach($ogs as $i=>$og){
			$regionais[$i] = $og['regional'];
		}
	
		return array_count_values($regionais);
	}
}