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
# @version: 2.0.0
# -----------------------
# Grabado de logs de la APP
# -----------------------

final class Sfphp_Logs {

	public static function set($data, $ext = "txt") {
		# Registro de logs
		$_file = "./Etc/Logs/".date('YW').".".$ext;
		if($log_file = fopen($_file, 'a+')) {
			$_data = print_r($data, TRUE);
			fwrite($log_file, date("mdGis")."\r\n");
			fwrite($log_file, $_data);
			fwrite($log_file,"URL: http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']."\r\n");
			fwrite($log_file, "SESSION: "."\r\n-->id: ".session_id()."\r\n-->data: \r\n");
			foreach ($_SESSION as $key => $value) {
				if(!is_array($value))
					fwrite($log_file, "-->-->{$key} = ".$value."\r\n");
			}
			fwrite($log_file, "IP: ".Sfphp::obtenIP()." - PHP ".phpversion()." - ".PHP_OS."(".PHP_SYSCONFDIR." ".PHP_BINARY.")\r\n");
			fwrite($log_file,"--------------------------------------------\r\n");
			fclose($log_file);
		} else
			echo "No se puede escribir el log ".$_file;
	}

	public static function procesa($data) {

	}

	public static function error($e) {
		var_dump($e);die();
		Sfphp_Logs::escribe($e); #Escribir el log de errores
		if(DEV_SHOWERRORS) {
			if(stripos($e->getMessage(), "SQLSTATE") > -1)
				Sfphp_Logs::pantallaBD($e);
			else
				Sfphp_Logs::pantalla($e);
		} else {
			header('HTTP/1.1 500 Internal Server Error');
			echo "Error interno pide al administrador que revise el log ".str_replace("./Etc/Logs/", "", $_file);
		}
	}

	private static function escribe($data) {
		if (!is_dir('./Etc/Logs/')) {
            mkdir('./Etc/Logs/');
            chmod('./Etc/Logs/', 0740);
            file_put_contents("./Etc/Logs/.htaccess", "Options -Indexes");
        }
		if($log_file = fopen($_file, 'a+')) {
			fwrite($log_file, date("mdGis").'::'.$e->getMessage()."(".$e->getCode().")\r\n");
			fwrite($log_file, "--> ".$e->getFile()."::".$e->getLine()."\r\n");
			fwrite($log_file, "-->--> ".$e->getTraceAsString()."\r\n\r\n");
			fwrite($log_file,"URL: http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']."\r\n");
			fwrite($log_file, "SESSION: "."\r\n-->id: ".session_id()."\r\n-->data: \r\n");
			foreach ($_SESSION as $key => $value) {
				if(!is_array($value))
					fwrite($log_file, "-->-->{$key} = ".$value."\r\n");
			}
			fwrite($log_file, "IP: ".Sfphp::obtenIP()." - PHP ".phpversion()." - ".PHP_OS."(".PHP_SYSCONFDIR." ".PHP_BINARY.")\r\n");
			fwrite($log_file,"--------------------------------------------\r\n");
			fclose($log_file);
		} else
			echo "No se puede escribir el log ".$_file;
	}

	private static function pantalla($e) {
		echo "<html><head><style>h1{font-family:Arial, Helvetica, sans-serif; font-size:16px;} body{font-family:Courier; font-size:12px;}</style></head>";
		echo "<h1>".$e->getMessage()."(".$e->getCode().")</h1>";
		echo $e->getFile()."::".$e->getLine()."<br/>";
		echo $e->getTraceAsString()."<br/><hr/>";
		echo "URL: http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']."<br/>";
		echo "SESSION: "."<br/>-->id: ".session_id()."<br/>-->data: <br/>";
		foreach ($_SESSION as $key => $value) {
			echo "-->-->{$key} = ".$value."<br/>";
		}
		echo "<hr/>IP: ".Sfphp::obtenIP()." - PHP ".phpversion()." - ".PHP_OS."(".PHP_SYSCONFDIR." ".PHP_BINARY.")<br/>";
		echo "<hr/>Simple Framework PHP - ".APP_NAME." - ".APP_COMPANY;
		echo "</html>\n<br>";
	}

	private static function pantallaBD($e) {
		echo "<html><head><style>h1{font-family:Arial, Helvetica, sans-serif; font-size:16px;} body{font-family:Courier; font-size:12px;}</style></head>";
		echo "<h1>".$e->getMessage()."(".$e->getCode().")</h1>";
		echo $e->getFile()."::".$e->getLine()."<hr/>";
		echo "URL: http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']."<br/>";
		echo "SESSION: "."<br/>-->id: ".session_id()."<br/>-->data: <br/>";
		foreach ($_SESSION as $key => $value) {
			echo "-->-->{$key} = ".$value."<br/>";
		}
		echo "<hr/>IP: ".Sfphp::obtenIP()." - PHP ".phpversion()." - ".PHP_OS."(".PHP_SYSCONFDIR." ".PHP_BINARY.")<br/>";
		echo "<hr/>Simple Framework PHP - ".APP_NAME." - ".APP_COMPANY;
		echo "</html>\n<br>";
	}
}