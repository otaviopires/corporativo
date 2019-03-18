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
    
    public function index()
    {	
		//$this->store();
		return $this->showLiveJson();
		//return $this->showOpenOgs();
    }

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
				$ogToSave->save();
				error_log("[NEW] - Protocolo " . Og::where('protocolo',  $og['PROTOCOLO'])->first()['protocolo'] . " salvo com sucesso!");
			}
		}
		$this->closeSavedOgs();
	}
	
	public function showOpenOgs()
    {
        $ogs =  Og::orderBy('protocolo', 'desc')->get();
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
}
