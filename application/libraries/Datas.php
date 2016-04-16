<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
	class Datas {		
		private $date; 
		private $dia; 
		private $mes;
		private $ano;
		private $semana; 
		
		public function __construct(){
			$this->date =  date('d/m/Y'); 
			$this->dia = date('d');
			$this->mes = date('m');
			$this->ano = date('Y');
			$this->semana = date('w');
		}
		
		// retorna a data de hoje no formato ex: Sexta-feira, 10 de maio de 2001
		public function getFullDateExtenso(){
			$mes = $this->getMesExtenso();
			$semana = $this->getSemanaExtenso();
			return $semana.', '.$this->dia.' de '.$mes.' de '.$this->ano;  			
			
		} 
		
		//retorna a data no formato ex: 10/05/2001, Sexta-feira
		public function getMinDateExtenso(){
			$mes = $this->getMesExtenso();
			$semana = $this->getSemanaExtenso();
			return $this->date.', '.$semana; 
		}
		
		public function getMesExtenso(){
			switch ($this->mes){
				case 1: $mes = "janeiro"; break;
				case 2: $mes = "fevereiro"; break;
				case 3: $mes = "março"; break;
				case 4: $mes = "abril"; break;
				case 5: $mes = "maio"; break;
				case 6: $mes = "junho"; break;
				case 7: $mes = "julho"; break;
				case 8: $mes = "agosto"; break;
				case 9: $mes = "setembro"; break;
				case 10: $mes = "outubro"; break;
				case 11: $mes = "novembro"; break;
				case 12: $mes = "dezembro"; break;
			}
			return $mes;
		}
		
		public function getSemanaExtenso(){
			switch ($this->semana) {
				case 0: $semana = "Domingo"; break;
				case 1: $semana = "Segunda-feira"; break;
				case 2: $semana = "Terça-feira"; break;
				case 3: $semana = "Quarta-feira"; break;
				case 4: $semana = "Quinta-feira"; break;
				case 5: $semana = "Sexta-feira"; break;
				case 6: $semana = "Sábado"; break;
			}
			return $semana;			
		}
		
		public function datetimeToBR($datetimeUS){
			return implode("/", array_reverse(explode("-", substr($datetimeUS, 0, 10)))).substr($datetimeUS, 10);
		} 
		
		public function dateToBr ($dateUS){			
			$a = explode('-', $dateUS);
			$dataBR = $a[2].'/'.$a[1].'/'.$a[0];
			return $dataBR;
		}

		public function dateToUS ($dateBR){			
			$a = explode('/', $dateBR);
			$dataUS = $a[2].'-'.$a[1].'-'.$a[0];
			return $dataUS;
		}
		
		public function checkDataValida($data){
			$dt = explode("/", $data); 
			$d = $dt[0];
			$m = $dt[1];
			$y = $dt[2];			
			$res = checkdate($m,$d,$y);
						
			return ($res == 1) ? TRUE : FALSE;			
		}
		
		public function getAnoUS ($dateUS){			
			$a = explode('-', $dateUS);
			$ano = $a[0];
			return $ano;
		}	
		
		public function getAnoBR ($dateBR){			
			$a = explode('/', $dateBR);
			$ano = $a[2];
			return $ano;
		}			

	}
?>