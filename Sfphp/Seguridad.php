<?php
#Esqueleto para el manejo de seguridad, se valida que las clases derivadas tengan el metodo
#que se invoca desde el control de arranque del framework
abstract class Seguridad {

#Se ejecuta para verificar si se tiene permitido ejecutar el controlador/modelo
	abstract public function Validar_Acceso($controlador = "", $modelo = "");

/*
Se ejecuta en cualquier excepción de seguridad
Codigos de error:
	1 | El token del formulario no corresponde con el tocken de la sesion (posible ataque XSS)
	2 | No se tiene permitido ejecutar el controlador/modelo (se devolvió un FALSE desde Validar_Acceso)
*/
	abstract public function Error_Seguridad($error);
} 