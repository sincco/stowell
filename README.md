# Sfphp
#### Simple Framework (for) PHP

Simplificando al máximo las características de todo framework para PHP, este permite ser un punto de entrada
para quienes aún no están utilizando alguno, o desean entender cada elemento que componen uno.

Haciendo uso de patrones singleton, carga de clases tipo Zend, y una implementación sencilla y propia de manejo
de vistas, Sfphp, te puede ayudar a desarrollar una aplicación en un menor tiempo y organizando tus códigos
de mejor manera.

### Uso
Clona este repositorio, y ejecuta el script:
```
dominio.com/iniciar.php
```
Esto dejará una nueva estructura de directorios dónde comenzarás a alojar tu aplicación
```
App
|-Core
|-Controladores
|-|-Inicio.php
|-Modelos
|-Vistas
Etc
|-Config
|-|-config.xml
|-Logs
|-Sesiones
Libs
```
##### O
Clona el branch skeleton, con una app sencilla de ejemplo

## Configuracion

### General de la APP
```
<app>
	<key>la clave generada por el script iniciar.php o que puedes obtener desde el scrip llave.php</key>
	<name>nombre de la app</name>
	<company>sincco</company>
</app>
```
### Front end
```
<front>
	<url>http://tudominio.com/</url>
</front>
```
### Bases de datos
Sólo puedes tener una por default (a la que se conectan todos los modelos por defecto), pero tantas como necesites con un identificador distinto
```
<bases>
	<default>
		<host></host>
		<user></user>
		<password>encriptado con la llave de la app, puedes usar en script encriptar.php?s=password</password>
		<dbname></dbname>
		<type>firebird|mysql|sqlsrv|otro</type>
	</default>
</bases>
```
### Opciones de desarrollo
```
<dev>
		<log>1|0 activa el log del framework (en Etc/Logs)</log>
		<showerrors>1|0 muestra los errores propios del framework en pantalla</showerrors>
		<showphperrors>1|0 muestra los errores de php</showphperrors>
	</dev>
```

### Peticiones
Cada petición se procesa seccionando la URL del siguiente modo:
```
dominio.com/[modulo]/controlador/accion/[(parametro1/valor1)...(parametron/valorn]
```
El controlador y accion por defecto son 'inicio', por lo que, al no recibirse dentro de la URL, estos son los que se ejecutarán de forma inmediata, así que deben existir dentro de tu estructura de archivos.

##### Parametros get
Los parametros se procesan de forma lineal, por lo que, si no llevan el orden correcto, no podrás encontrar el valor que necesitas. 
```
.../fruta/manzana/color/rojo
```
Se traduce en el siguiente arreglo:
```
(['fruta'] => ['manzana']) ,
(['color'] => ['rojo']) 
```
Mientras que, si se rompe el patrón:
```
.../fruta/color/rojo
```
se obtiene:
```
(['fruta'] => ['color']) ,
(['rojo'] => NULL) 
```
#### NOTICE OF LICENSE
This source file is subject to the Open Software License (OSL 3.0) that is available through the world-wide-web at this URL:
http://opensource.org/licenses/osl-3.0.php

**Happy coding!**
- [ivan miranda](http://ivanmiranda.me)
