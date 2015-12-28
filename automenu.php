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
# Arma un menú automático con todas las funciones creadas en el sistema
# -----------------------

require_once './Sfphp/_base.php';

$menu = array();
// foreach (scandir("App/Core/Controladores") as $_archivo) {
// 	if("php" == pathinfo($_archivo, PATHINFO_EXTENSION)) {
// 		$_clase = "Controladores_".str_replace(".".pathinfo($_archivo, PATHINFO_EXTENSION), "", $_archivo);
// 		$_controlador = new $_clase;
// 		foreach (get_class_methods($_controlador) as $_metodo) {
// 			if("Inicio" != str_replace(".".pathinfo($_archivo, PATHINFO_EXTENSION), "", $_archivo)) {
// 				if("api" != substr($_metodo, 0,3) && "_" != substr($_metodo, 0,1))
// 					if("inicio" == $_metodo)
// 						array_push($menu, array(
// 							"texto"=>ucwords(str_replace(".".pathinfo($_archivo, PATHINFO_EXTENSION), "", $_archivo)), 
// 							"url"=>strtolower(str_replace(".".pathinfo($_archivo, PATHINFO_EXTENSION), "", $_archivo))
// 							)
// 						);
// 					else
// 						array_push($menu, array(
// 							"texto"=>ucwords(str_replace(".".pathinfo($_archivo, PATHINFO_EXTENSION), "", $_archivo)." ".$_metodo), 
// 							"url"=>strtolower(str_replace(".".pathinfo($_archivo, PATHINFO_EXTENSION), "", $_archivo))."/".$_metodo
// 							)
// 						);
// 			}
// 		};
// 	}
// }
$_menu = array();
array_push($_menu, array("texto"=>"Clientes","url"=>"clientes"));
array_push($_menu, array("texto"=>"Proveedores","url"=>"proveedores"));
array_push($menu, array("text"=>"Catalogos","menu"=>$_menu));
var_dump($menu);
Sfphp_Disco::grabaXML($menu,"menu","./Etc/Config/menu2.xml");
