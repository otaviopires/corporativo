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
    //

    public function searchOg (Request $request)
    {
        $q = Input::get ( 'q' );

        $ogs = Og::where('protocolo', 'LIKE', '%' . $q . '%')
        ->orWhere('localidade','LIKE','%'.$q.'%')
        ->orWhere('regional','LIKE','%'.$q.'%')
        ->orWhere('descricao','LIKE','%'.$q.'%')
        ->orWhere('data_abertura','LIKE','%'.$q.'%')
        ->orderBy('protocolo', 'desc')
        ->paginate(50);
        
		return view('ogs.closed')->with('ogs', $ogs);

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
        
		return view('pfs.list')->with('pfs', $pfs);
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
