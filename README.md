# Sfphp
#### Simple Framework (for) PHP

Simplificando al máximo las características de todo framework para PHP, este permite ser un punto de entrada
para quienes aún no están utilizando alguno, o desean entender cada elemento que componen uno.

Haciendo uso de patrones singleton, carga de clases tipo Zend, y una implementación sencilla y propia de manejo
de vistas, Sfphp, te puede ayudar a desarrollar una aplicación en un menor tiempo y organizando tus códigos
de mejor manera.

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
- [ivan mirandar](http://ivanmiranda.me)
