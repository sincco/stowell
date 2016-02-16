<?php 
class Controladores_Inicio extends Sfphp_Controlador { 
	public function inicio() { 
		var_dump($this->modeloInsumos->get());
	} 
}