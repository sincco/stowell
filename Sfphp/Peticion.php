<?php
# 
# -/:::::::::::::::::::/- `/soooooooooooooooooooy: ./::::::::::::::::::://`                                                                             
# +:-------------------:+.-ho+/////////////////+sh.:/:------------------:*                                                                             
# +////:::::::::::::////+--hyyyssooooooooooossyyyh-+/////:::::::::::::////+                                                                             
# +/////////////////////+--hyyyyyyyyyyyyyyyyyyyyyh-+//////////////////////+                                                                             
# +/////////////////////+-.hyyyyyyyyyyyyyyyyyyyyyh-+//////////////////////+                                                                             
# +/////////////////////+--hyyyyyyyyyyyyyyyyyyyyyh-+//////////////////////+                                                                             
# +/////////////////////+.-hyyyyyyyyyyyyyyyyyyyyyh.//////////////////////+:                                                                             
# :///////////////////+/. `ohyyyyyyyyyyyyyyyyyyhh/ `////////////////////+:`                                                                             
#  .-------------------.    --------------------.   ```.------.``````````                            .......`           `......            `......`     
# +o+++++++++++++++++++so `:::::::::::::::::::::/-   -syhhyyyhyss-    sssss  ysssss+`    +sssy.  `:+shhyyyyhyy/-    `-ssyhyyyyhsy+`    `/osyhyyyyhys/.  
# hs++///////////////++sh:.+::-----------------:/+`-syyyhyyyyyyyyy+   yyyyh  dyyyyyys.   oyyyh.`:yyyyyyyyyyyyyyho` /hyyyyyyyyyyyyyy+  +hyyyyhyyyyyyyyyo.
# hyyyssssooooooossssyyyh/`+//////::::::::://////+`/hyyyd/-```ohyyh:  yyyyh  dyyyhyyyh:  oyyyh./hyyyy+`   `-hyyyh/.hyyyhs.    /yyyyho-hyyyho-   .-syyyyy
# hyyyyyyyyyyyyyyyyyyyyyh/`+/////////////////////+`-yyyyyyyyyyhss+:   yyyyh  dyyyhsyyyhh`oyyyh-oyyyh:       `----`yyyyys        ----.oyyyyo       `yyyyh
# hyyyyyyyyyyyyyyyyyyyyyh/`+/////////////////////+```/oshyyyyyyyyyho  yyyyh  dyyyy +hyyyhhyyyh-yyyyy/       .:::::hyyyys       `::::-oyyyys       -yyyyh
# hyyyyyyyyyyyyyyyyyyyyyh/`+/////////////////////+.yhyyds`  .:ohyyyd` yyyyh  dyyyy  `yyyyhyyyh./hyyyho.   ./syyyh/.hyyyh+-   `:yyyyh/.hyyyy+:    /yyyyys
# hyyyyyyyyyyyyyyyyyyyyyy-.+/////////////////////+`-yyyyyhyoyhhyyyh:  yyyyh  dyyyy    +hyyyyyh. +hyyyyyhhhyyyyyh+  -hyyyyyhhhyyyyyy/  :yhyyyyhhhyyyyyy+`
# +hhyyyyyyhhhhhhhhhhhhd-  -+++++++++++++++++++++.   /ohhyyyyyhhoo.   hhhhh  dhhhy     -shhhhd.   .syhhhyyhhyo:`     :+shhhyyhhho/      -/ohhhyyhhdo:`  
# 
# NOTICE OF LICENSE
#
# This source file is subject to the Open Software License (OSL 3.0)
# that is available through the world-wide-web at this URL:
# http://opensource.org/licenses/osl-3.0.php
#
# -----------------------
# @author: Iván Miranda
# @version: 1.0.0
# -----------------------
# Manejo de peticiones en el framework
# -----------------------

final class Sfphp_Peticion 
{
	private $_modulo;
	private $_control;
	private $_accion;
	private $_parametros;
	private $_previa;
	private $_metodo;
	private static $_instancia;

# La estructura de una peticion es:
#   modulo/controlador/accion/[parametros]
	private function __construct() {
		$this->_metodo = strtoupper(trim($_SERVER['REQUEST_METHOD']));
		if(isset($_SERVER['HTTP_REFERER']))
			$this->_previa = $_SERVER['HTTP_REFERER'];
		else
			$this->_previa = NULL;
		if(!isset($_GET['url'])) {
			$this->_modulo = NULL;
			$this->_control = "inicio";
			$this->_accion = "inicio";
			$this->_parametros = self::procesaParametros(array());
		} else {
			$_segmentos = array_filter(explode('/', urldecode($_GET['url'])));
		# Si no existe el modulo específico, se quita para buscarlo a nivel
		# general de la app
			if(is_dir("./App/Local/".ucwords(array_shift(array_filter(explode('/', urldecode($_GET['url']))))))) {
				$this->_modulo = array_shift($_segmentos);
			} elseif(is_dir("./App/Core/".ucwords(array_shift(array_filter(explode('/', urldecode($_GET['url']))))))) {
				$this->_modulo = array_shift($_segmentos);
			} else {
				$this->_modulo = NULL;
			}
			$this->_control = array_shift($_segmentos);
			$this->_accion = array_shift($_segmentos);
		# Los objetos que no se pasan por URL se inician a inicio
			if(trim($this->_control) == "")
				$this->_control = "inicio";
			if(trim($this->_accion) == "")
				$this->_accion = "inicio";
		# Lista de parametros recibidos (GET y POST)
			$this->_parametros = self::procesaParametros($_segmentos);
		}
	}

# Regresa la peticion
	public static function get($atributo = '') {
		if(!self::$_instancia instanceof self)
			self::$_instancia = new self();
		$_variables = get_object_vars(self::$_instancia);
		if(strlen(trim($atributo)))
			return $_variables[$atributo];
		else
			return $_variables;
	}

# Regresa la peticion
	public static function parametros($atributo = '') {
		if(!self::$_instancia instanceof self)
			self::$_instancia = new self();
		if(strlen(trim($atributo)))
			return self::$_instancia->_parametros[$atributo];
		else
			return self::$_instancia->_parametros;
	}

# Nombre del atributo a usarse en los __get __set
	private function nombreAtributo($atributo) {
		$atributo = str_replace("(", "", $atributo);
		$atributo = str_replace(")", "", $atributo);
		$atributo = "_".strtolower(substr($atributo, 3));
		return $atributo;
	}

# De los parametros recibidos se genera un arreglo único
	private function procesaParametros($segmentos) {
		$_parametros = array();
	#GET
		foreach ($segmentos as $key => $value) {
			$segmentos[$key] = self::limpiarGET($value);
		}
		while(count($segmentos)) {
			$_parametros[array_shift($segmentos)] = array_shift($segmentos);
		}
	#POST
		$_contenido = file_get_contents("php://input");
		$_contenido_tipo = FALSE;
		if(isset($_SERVER['CONTENT_TYPE'])) {
			$_contenido_tipo = $_SERVER['CONTENT_TYPE'];
		}
		switch($_contenido_tipo) {
			case "application/json":
			case "application/json;":
			case "application/json; charset=UTF-8":
			if(trim($_contenido) != "") {
				foreach (json_decode($_contenido, TRUE) as $key => $value) {
					$_parametros[$key] = self::limpiarEntradaPOST($value);
				}
			}
			break;
			case "application/x-www-form-urlencoded":
				parse_str($_contenido, $postvars);
				foreach($postvars as $field => $value) {
					$_parametros[$field] = self::limpiarEntradaPOST($value);
				}
			break;
			default:
				parse_str($_contenido, $postvars);
				foreach($postvars as $field => $value) {
					$_parametros[$field] = self::limpiarEntradaPOST($value);
				}
			break;
		}
		return $_parametros;
	}

	private function limpiarGET($valor) {
		$_busquedas = array(
		'@<script[^>]*?>.*?</script>@si',   #Quitar javascript
		'@<[\/\!]*?[^<>]*?>@si',            #Quitar html
		'@<style[^>]*?>.*?</style>@siU',    #Quitar css
		'@<![\s\S]*?--[ \t\n\r]*>@'         #Quitar comentarios multilinea
		);
		if (is_array($valor)) {
			foreach ($valor as $_key => $_value)
				$valor[$_key] = self::limpiarGET($_value); #Recursivo para arreglos
		}else {
			$valor = preg_replace($_busquedas, '', $valor);
			$valor = filter_var($valor,FILTER_SANITIZE_STRING);
			if (get_magic_quotes_gpc())
				$valor = stripslashes($valor);
		}
		return $valor;
	}

	private function limpiarEntradaPOST($valor) {
		$_busquedas = array(
		'@<script[^>]*?>.*?</script>@si',   #Quitar javascript
		'@<[\/\!]*?[^<>]*?>@si',            #Quitar html
		'@<style[^>]*?>.*?</style>@siU',    #Quitar css
		'@<![\s\S]*?--[ \t\n\r]*>@'         #Quitar comentarios multilinea
		);
		if (is_array($valor)) {
			foreach ($valor as $_key => $_value)
				$valor[$_key] = self::limpiarEntradaPOST($_value); #Recursivo para arreglos
		}else
			$valor = preg_replace($_busquedas, '', $valor);
		return $valor;
	}
}
