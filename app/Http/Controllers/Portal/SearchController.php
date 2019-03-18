<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Og;
use App\Models\Pf;
use App\Models\UsefulLink;
use Log;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{

    public function searchOg (Request $request)
    {
        $q = Input::get ( 'q' );
        $array = [];

        $ogs = Og::where('protocolo', 'LIKE', '%' . $q . '%')
        ->orWhere('localidade','LIKE','%'.$q.'%')
        ->orWhere('regional','LIKE','%'.$q.'%')
        ->orWhere('descricao','LIKE','%'.$q.'%')
        ->orWhere('data_abertura','LIKE','%'.$q.'%')
        ->orderBy('protocolo', 'desc')
        ->paginate(10);

        $total = Og::where('protocolo', 'LIKE', '%' . $q . '%')
        ->orWhere('localidade','LIKE','%'.$q.'%')
        ->orWhere('regional','LIKE','%'.$q.'%')
        ->orWhere('descricao','LIKE','%'.$q.'%')
        ->orWhere('data_abertura','LIKE','%'.$q.'%')
        ->count('protocolo');

        $ogs->withPath('?q=' . $q);

        return view('ogs.find', compact('ogs', 'total'));
    }

    public function searchOpenOg (Request $request)
    {
        $q = Input::get ( 'q' );
        $array = [];

        $ogs = Og::where('protocolo', 'LIKE', '%' . $q . '%')
        ->orWhere('localidade','LIKE','%'.$q.'%')
        ->orWhere('regional','LIKE','%'.$q.'%')
        ->orWhere('descricao','LIKE','%'.$q.'%')
        ->orWhere('data_abertura','LIKE','%'.$q.'%')
        ->orderBy('protocolo', 'desc')
        ->get();

		foreach($ogs as $i=>$og){
			if($og['status'] == "FECHADO"){
				$ogs->forget($i);
            }
        }

        foreach($ogs as $i=>$og){
			$array[$i] = $og['protocolo'];
        }

        if($array != 0 || $array != null){
            $total = array_sum(array_count_values($array));
        }else {
            $total = 0;
        }
        
        return view('ogs.find', compact('ogs', 'total'));
    }

    public function searchPf (Request $request)
    {
        $q = Input::get ( 'q' );

        $pfs = Pf::where('protocolo', 'LIKE', '%' . $q . '%')
        ->orWhere('localidade','LIKE','%'.$q.'%')
        ->orWhere('regional','LIKE','%'.$q.'%')
        ->orWhere('descricao','LIKE','%'.$q.'%')
        ->orWhere('data_abertura','LIKE','%'.$q.'%')
        ->orWhere('fila','LIKE','%'.$q.'%')
        ->orderBy('protocolo', 'desc')
        ->paginate(10);

        $pfs->withPath('?q=' . $q);
        
		return view('pfs.find')->with('pfs', $pfs);
    }

    public function searchOpenPf (Request $request)
    {
        $q = Input::get ( 'q' );

        $pfs = Pf::where('protocolo', 'LIKE', '%' . $q . '%')
        ->orWhere('localidade','LIKE','%'.$q.'%')
        ->orWhere('regional','LIKE','%'.$q.'%')
        ->orWhere('descricao','LIKE','%'.$q.'%')
        ->orWhere('data_abertura','LIKE','%'.$q.'%')
        ->orWhere('fila','LIKE','%'.$q.'%')
        ->orderBy('protocolo', 'desc')
        ->get();


		foreach($pfs as $i=>$pf){
			if($pf['status'] == "FECHADO"){
				$pfs->forget($i);
            }
        }

		return view('pfs.find')->with('pfs', $pfs);
    }

    public function searchlink (Request $request)
    {
        $q = Input::get ( 'q' );

        $links = UsefulLink::where('name', 'LIKE', '%' . $q . '%')
        ->orWhere('description','LIKE','%'.$q.'%')
        ->orWhere('url','LIKE','%'.$q.'%')
        ->get();        
        
        return view ('links.index')->with('links', $links);
    }
}
