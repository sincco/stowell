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
# Inicia la configuración básica del frame, creando los directorios necesarios
# y un archivo de configuración con los parametros obligados
# -----------------------

require_once './Sfphp/_base.php';

if(!file_exists("./Etc/Config/config.xml")) {
	echo "Inicializando el framework...<br>";
	file_put_contents("./sfphp.md5", Sfphp_Disco::MD5("./Sfphp"));
	echo "Inicializando directorios...<br>";
	if(!is_dir("./App")) {
		mkdir("./App", 0774);
		mkdir("./App/Core", 0774);
		file_put_contents("./App/.htaccess", "Options -Indexes");
	}
	if(!is_dir("./Libs"))
		mkdir("./Libs", 0774);
	if(!is_dir("./Etc")) {
		mkdir("./Etc", 0774);
		mkdir("./Etc/Config", 0774);
		mkdir("./Etc/Logs", 0774);
		mkdir("./Etc/Sesiones", 0774);
		file_put_contents("./Etc/.htaccess", "Options -Indexes");
		file_put_contents("./Etc/Config/.htaccess", "Options -Indexes");
		file_put_contents("./Etc/Logs/.htaccess", "Options -Indexes");
		file_put_contents("./Etc/Sesiones/.htaccess", "Options -Indexes");
	}
	echo "Inicializando archivo de configuración...<br>";
	$_llave_encripcion = strtoupper(md5(microtime().rand()));
	$_config = array (
		'app' => array (
			'key' => $_llave_encripcion,
			'name' => 'sfphp',
			'company' => 'sincco.com',
		),
		'front' => array (
			'url' => sprintf("%s://%s%s",
				isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
			    $_SERVER['SERVER_NAME'],
			    $_SERVER['REQUEST_URI']
			),
		),
		'bases' => array (
			'base' => array(
				'host' => 'sfphp',
				'user' => 'sfphp',
				'password' => Sfphp::encrypt('sfphp',$_llave_encripcion),
				'dbname' => 'sfphp',
				'type' => 'mysql',
				'default' => 1,
			),
			'type' => "DEFAULT",
			'name' => "sfphp",
			'ssonly' => 0,
			'inactivity' => 60,
		),
		'session' => array (
			'type' => "DEFAULT",
			'name' => "sfphp",
			'ssonly' => 0,
			'inactivity' => 60,
		),
		'dev' => array (
			'log' => 1,
			'showerrors' => 0,
			'showphperrors' => 0,
		),
	);
	if(Sfphp_Disco::arregloXML($_config,"config","./Etc/Config/config.xml"))
	{
		chmod("./Etc/Config/config.xml", "774")
		echo 'Configuración básica completa.';
	}
	else
		echo 'Hubo un error al escribir la configuración.';
} else {
	echo "El framework ya está configurado<br>Configura tu aplicación";
}
