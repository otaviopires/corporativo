<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Og;
use App\Models\Pf;
use View;


class GraphsController extends Controller
{
	public function retunDataToHomeChart()
	{
		$open = $this->returnCountedOpenOgs();
		$closed = $this->retunCountedClosedOgs();
		$openPfs = $this->returnCountedOpenPfs();
		$closedPfs = $this->returnCountedClosedPfs();
		$top10Ogs = $this->returnTopOgsByRegions();
		$top10Pfs = $this->returnTopPfsByRegions();

		return view('home', compact('open', 'closed', 'openPfs', 'closedPfs', 'top10Ogs', 'top10Pfs'));	
	}

	protected function returnCountedOpenOgs()
	{
		$regionais = [];
		$ogs =  Og::orderBy('protocolo', 'desc')->get();
		foreach($ogs as $i=>$og){
			if($og['status'] == "FECHADO"){
				$ogs->forget($i);
			}
		}
				
		foreach($ogs as $i=>$og){
			$regionais[$i] = $og['regional'];
		}

		$counted = array_count_values($regionais);
		arsort($counted);
		return $counted;
	}

	protected function retunCountedClosedOgs()
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

		$counted = array_count_values($regionais);
		arsort($counted);
		return $counted;
	}

	protected function returnCountedOpenPfs()
	{
		$regionais = [];
		$pfs =  Pf::orderBy('protocolo', 'desc')->get();
		foreach($pfs as $i=>$pf){
			if($pf['status'] == "FECHADO"){
				$pfs->forget($i);
			}
		}

		foreach($pfs as $i=>$pf){
			$regionais[$i] = $pf['regional'];
		}

		$counted = array_count_values($regionais);
		arsort($counted);
		return $counted;
	}	

	protected function returnCountedClosedPfs()
	{
		$regionais = [];
		$pfs =  Pf::orderBy('protocolo', 'desc')->get();
		foreach($pfs as $i=>$pf){
			if($pf['status'] == "ABERTO"){
				$pfs->forget($i);
			}
		}

		foreach($pfs as $i=>$pf){
			$regionais[$i] = $pf['regional'];
		}
		$counted = array_count_values($regionais);
		arsort($counted);
		return $counted;
	}	

	protected function returnTopOgsByRegions(){
		$regionais = [];
		$ogs =  Og::orderBy('protocolo', 'desc')->get();

		foreach($ogs as $i=>$og){
			$regionais[$i] = $og['regional'];
		}
		
		$top_regionais = array_slice(array_count_values($regionais), 0, 10);
		arsort($top_regionais);
		return $top_regionais;
	}

	protected function returnTopPfsByRegions(){
		$regionais = [];
		$pfs =  Pf::orderBy('protocolo', 'desc')->get();

		foreach($pfs as $i=>$pf){
			$regionais[$i] = $pf['regional'];
		}
		
		$top_regionais = array_slice(array_count_values($regionais), 0, 10);
		arsort($top_regionais);
		return $top_regionais;
	}

}
