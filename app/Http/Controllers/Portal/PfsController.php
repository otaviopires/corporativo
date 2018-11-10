<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pf;



class PfsController extends Controller
{
	public function __construct()
    {
       $this->middleware('auth')->except('logout');
    }
    
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
		//$this->store();
		return $this->showLiveJson();
		//return $this->closeSavedOg();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		// cron every minute
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {	
		$pfs = $this->getpfsFromUrl();
		foreach($pfs as $pf) {		
			if(Pf::where('protocolo',  $pf['PROTOCOLO'])->first()['protocolo'] == $pf['PROTOCOLO']){
				continue;
			}else{
				$pfToSave = new Pf;
				$pfToSave->protocolo = $pf['PROTOCOLO'];
				$pfToSave->fila = $pf['FILA'];
				$pfToSave->circuito = $pf['CIRCUITO'];
				$pfToSave->status = $pf['STATUS'];
				$pfToSave->entrada_fila = $pf['ENTRADA_FILA'];
				$pfToSave->vencimento_anatel = $pf['VENCIMENTO_ANATEL'];
				$pfToSave->data_abertura = $pf['DT_ABERTURA'];
				$pfToSave->produto = $pf['PRODUTO'];
				$pfToSave->servico = $pf['SERVICO'];
				$pfToSave->regional = $pf['REGIONAL'];
				$pfToSave->localidade = $pf['LOCALIDADE'];
				$pfToSave->tecnico = $pf['TECNICO'];
				$pfToSave->save();
				error_log("[NEW] - Pesquisa de falha " . Pf::where('protocolo',  $pf['PROTOCOLO'])->first()['protocolo'] . " salvo com sucesso!");
			}
		}
		$this->closeSavedPfs();
	}
	

    /**
     * Display the specified resource.
     *
     * @param  \App\Og  $og
     * @return \Illuminate\Http\Response
     */
    public function show(Pf $pf)
    {
		// there's no specific view for a single Pf
	}    
	

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Og  $og
     * @return \Illuminate\Http\Response
     */
    public function edit(Pf $pf)
    {
        // there's no editing of Pfs here
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Og  $og
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pf $pf)
    {
        // we don't update saved Pfs, they're static
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Og  $og
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pf $pf)
    {
        // we don't plan do delete save Pfs, they're meant to be a log
    }
	
	public function showOpenPfs()
    {
        $pfs =  Pf::orderBy('protocolo', 'desc');
		foreach($pfs as $i=>$pf){
			if($pf['status'] == "FECHADO"){
				$pfs->forget($i);
			}
		}
		return view('pfs.open')->with('pfs', $pfs);
	}

	public function showSavedPfs()
    {
        $pfs =  Pf::orderBy('protocolo', 'desc')->paginate(20);
		foreach($pfs as $i=>$pf){
			if($pf['status'] == "ABERTO"){
				$pfs->forget($i);
			}
		}
		return view('pfs.list')->with('pfs', $pfs);
	}
    
    public function showLiveJson()
    {
		$pfs = $this->getPfsFromUrl();
		//dd($pfs);
		$pfs = collect($pfs)->sortBy('DT_ABERTURA')->reverse()->toArray();
		return view('pfs.index')->with('pfs', $pfs);
    }
	
	public function getPfsFromUrl()
    {
		/*
		ID 1 - CSO ComutaçãO
		ID 2 - CSO Dados
		ID 3 - Indefinido
		ID 4 - CSO Massiva
		ID 5 - Reincidência Comutação
		ID 6 - Reincidência Dados
		ID 7 - Reincidência Transmissão
		ID 8 - COR Rede Comutação e Celular
		*/

        $url = 'http://portaldesempenho.algartelecom.com.br/api/filas?email=rodrigosv@algartelecom.com.br&password=bXVkYXIxMjM=&id=6';
		$urll = 'http://portaldesempenho.algartelecom.com.br/api/filas?email=rodrigosv@algartelecom.com.br&password=bXVkYXIxMjM=&id=5';
		$urlll ='http://portaldesempenho.algartelecom.com.br/api/filas?email=rodrigosv@algartelecom.com.br&password=bXVkYXIxMjM=&id=7';
		$pfs = json_decode(file_get_contents($url), true);
		$pfs = $pfs['result'];
		return $pfs;
		print $url;
		
    }
	
	public function closeSavedPfs()
	{
		$livePfs = $this->getPfsFromUrl();
		$savedPfs = Pf::pluck('protocolo')->toArray();
		foreach($savedPfs as $saved){
			if(array_search($saved, array_column($livePfs, 'PROTOCOLO'))){
				error_log("[ABERTO] A pesquisa de falha: " . Pf::where('protocolo',  $saved)->first()['protocolo'] . " ainda não foi encerrada. " . "Status atual: " .Pf::where('protocolo',  $saved)->first()['status']);
			}elseif (Pf::where('protocolo',  $saved)->first()['status'] == "FECHADO"){
				error_log("[VERIFICADO] A pesquisa de falha " . Pf::where('protocolo',  $saved)->first()['protocolo'] . " já está encerrada.");
			}else{
				error_log("[ENCERRADO] Pesquisa de falha " . Pf::where('protocolo',  $saved)->first()['protocolo'] . " não foi localizado nas Pfs ativas. Será encerrado.");
				Pf::where('protocolo',  $saved)->update(['status' => "FECHADO"]);
				error_log("[UPDATE] Novo status: " .Pf::where('protocolo',  $saved)->first()['status']);
			}		
		}
	}
	public function findPf(Request $request)
	{
		if (!$request) {
			$pfs = Pf::all();
		} else {
			$pfs = Pf::where('protocolo', 'LIKE', $request)
				->paginate(10);
		}
		
		return view('pfs.list')->with('pfs', $pfs);
	}
	
	public function search(Request $request)
	{
		$protocolo = $request->input('protocolo');

		//now get all user and services in one go without looping using eager loading
		//In your foreach() loop, if you have 1000 users you will make 1000 queries

		$pfs = Pf::with('protocolo', 
			function($query) use ($protocolo) {
				$query->where('protocolo', 'LIKE', '%' . $protocolo . '%');
			})->paginate(10);

		return view('pfs.list', compact('pfs'));
	}
	
}
