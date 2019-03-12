<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Og;
use App\Models\Pf;
use View;

class OgsController extends Controller
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
		//return $this->showOpenOgs();
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
		$ogs = $this->getOgsFromUrl();
		foreach($ogs as $og) {		
			if(Og::where('protocolo',  $og['PROTOCOLO'])->first()['protocolo'] == $og['PROTOCOLO']){
				Og::where('protocolo',  $og['PROTOCOLO'])->update(['descricao' => $og['DESC_EQPTO']]);
				error_log("[UPDATE] - Observações do protocolo " . Og::where('protocolo',  $og['PROTOCOLO'])->first()['protocolo'] . " atualizadas.");
				continue;
			}else{
				$ogToSave = new Og;
				$ogToSave->protocolo = $og['PROTOCOLO'];
				$ogToSave->fila = $og['FILA'];
				$ogToSave->circuito = $og['CIRCUITO'];
				$ogToSave->status = $og['STATUS'];
				$ogToSave->entrada_fila = $og['ENTRADA_FILA'];
				$ogToSave->vencimento_anatel = $og['VENCIMENTO_ANATEL'];
				$ogToSave->data_abertura = $og['DT_ABERTURA'];
				$ogToSave->produto = $og['PRODUTO'];
				$ogToSave->servico = $og['SERVICO'];
				$ogToSave->regional = $og['REGIONAL'];
				$ogToSave->localidade = $og['LOCALIDADE'];
				$ogToSave->tecnico = $og['TECNICO'];
				$ogToSave->descricao = $og['DESC_EQPTO'];
				
				// if($og['INTERROMPEU'] == "Y"){
				// 	$ogToSave->interrompeu = "Sim";
				// }elseif($og['INTERROMPEU'] == "N"){
				// 	$ogToSave->interrompeu = "Não";
				// }else{
				// $ogToSave->interrompeu = "Não informado";
				// }
				
				// $ogToSave->qtd_clientes = $og['QNT_CLIENTE'];
				// $ogToSave->obs = $og['OBS'];
				$ogToSave->save();
				error_log("[NEW] - Protocolo " . Og::where('protocolo',  $og['PROTOCOLO'])->first()['protocolo'] . " salvo com sucesso!");
			}
		}
		$this->closeSavedOgs();
	}
	

    /**
     * Display the specified resource.
     *
     * @param  \App\Og  $og
     * @return \Illuminate\Http\Response
     */
    public function show(Og $og)
    {
		// there's no specific view for a single Pf
	}    
	

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Og  $og
     * @return \Illuminate\Http\Response
     */
    public function edit(Og $og)
    {
        // there's no editing of OGs here
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Og  $og
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Og $og)
    {
        // we don't update saved OGs, they're static
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Og  $og
     * @return \Illuminate\Http\Response
     */
    public function destroy(Og $og)
    {
        // we don't plan do delete save OGs, they're meant to be a log
    }
	
	public function showOpenOgs()
    {
        $ogs =  Og::orderBy('protocolo', 'desc');
		foreach($ogs as $i=>$og){
			if($og['status'] == "FECHADO"){
				$ogs->forget($i);
			}
		}
		return view('ogs.open')->with('ogs', $ogs);
	}

	public function showClosedOgs()
    {
        $ogs =  Og::orderBy('protocolo', 'desc')->paginate(15);
		foreach($ogs as $i=>$og){
			if($og['status'] == "ABERTO"){
				$ogs->forget($i);
			}
		}
		return view('ogs.closed')->with('ogs', $ogs);
	}
    
    public function showLiveJson()
    {
		$ogs = $this->getOgsFromUrl();
		//dd($ogs);
		$ogs = collect($ogs)->sortBy('DT_ABERTURA')->reverse()->toArray();
		return view('ogs.index')->with('ogs', $ogs);
    }
	
	public function getOgsFromUrl()
    {
        $url = 'http://portaldesempenho.algartelecom.com.br/api/filas?email=rodrigosv@algartelecom.com.br&password=bXVkYXIxMjM=&id=8';
		$ogs = json_decode(file_get_contents($url), true);
		$ogs = $ogs['result'];
		return $ogs;
		print $url;
    }
	
	public function closeSavedOgs()
	{
		$liveOgs = $this->getOgsFromUrl();
		$savedOgs = Og::pluck('protocolo')->toArray();
		foreach($savedOgs as $saved){
			if(array_search($saved, array_column($liveOgs, 'PROTOCOLO'))){
				error_log("[ABERTO] O chamado: " . Og::where('protocolo',  $saved)->first()['protocolo'] . " ainda não foi encerrado. " . "Status atual: " .Og::where('protocolo',  $saved)->first()['status']);
			}elseif (Og::where('protocolo',  $saved)->first()['status'] == "FECHADO"){
				error_log("[VERIFICADO] Chamado " . Og::where('protocolo',  $saved)->first()['protocolo'] . " já está encerrado.");
			}else{
				error_log("[ENCERRADO] Chamado " . Og::where('protocolo',  $saved)->first()['protocolo'] . " não foi localizado nas OGS ativas. Será encerrado.");
				Og::where('protocolo',  $saved)->update(['status' => "FECHADO"]);
				error_log("[UPDATE] Novo status: " .Og::where('protocolo',  $saved)->first()['status']);
			}		
		}
	}
	
	public function retunDataToHomeChart()
    {
		$open = $this->returnCountedOpenOgs();
		$closed = $this->retunCountedClosedOgs();
		$openPfs = $this->returnCountedOpenPfs();
		$closedPfs = $this->returnCountedClosedPfs();

		return view('home', compact('open', 'closed', 'openPfs', 'closedPfs'));	
	}

	protected function returnCountedOpenOgs(){
		$regionais = [];
		$ogs = $this->getOgsFromUrl();

		foreach($ogs as $i=>$og){
			$regionais[$i] = $og['REGIONAL'];
		}

		return array_count_values($regionais);
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

		return array_count_values($regionais);
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

		return array_count_values($regionais);
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

		return array_count_values($regionais);
	}	

}
