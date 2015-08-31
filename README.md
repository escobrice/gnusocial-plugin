# GNUSocialPress (gnusocial-plugin)
## casi un plugin para GNU Social en WordPress

GNUSocialPress es casi un plugin para ver las líneas de tiempo de GNUSocial en WordPress.
Se trata de un script PHP que se puede incluir en un widget de texto y el efecto es el mismo que las líneas de tiempo que muestran la actividad de una cuenta en redes sociales.

![Ejemplo](http://www.fotolibre.org/albums/userpics/10002/normal_gnusocialpress.png)

Además, aunque inicialmente esté orientado a WordPress, el código PHP puede incrustarse en cualquier página web que soporte este lenguaje. Si este es tu caso, obvia todo lo que hace referencia a WordPress en las siguientes líneas y sustitúyelo por el equivalente en la página donde quieras insertar este código. :-D

## Requisitos
* Una versión reciente de WordPress (suponemos que valdrá cualquiera, pero sólo lo hemos probado en WP 4.2 ;)
* Un plugin que permita activar PHP en los widgets como [PHP Text Widget](https://wordpress.org/plugins/php-text-widget/) y  un widget de texto como el que viene por defecto en WordPress. Pero hay más combinaciones que pueden valer siempre que se permita ejecutar PHP en un widget.
* Para grabar PHP en un widget de texto en WordPress sólo se suele poder hacer con el usuario administrador del sitio.
* Una cuenta en [GNUSocial](https://flosspirit.wordpress.com/2014/10/12/gnu-social-como-twitter-pero-mejor/) que no tiene que ser la tuya porque al estar basado en el RSS puede ser cualquiera.


## Instrucciones
1. Añadir un widget de texto (o el del plugin que elijas que lo permita) en WordPress.
2. Copiar y pegar ahí el script [xml.php](https://github.com/escobrice/gnusocial-plugin/blob/master/xml.php) o descargartelo y modificar con un editor de código.
3. Elegir entre la línea de tiempo del usuario o la de él y sus amigos
    `$timeline="user"; //user: usuario ; friends: /all' 
3. Modificar la línea con el servidor/nodo GNU Social
    Ej.: `$server = "gnusocial.net";`
4. Modificar la línea con el usuario/cuenta:
    Ej.: `$username= "colegota";`
5. Modificar la línea con el protocolo:
    Ej.: `$protocol = "http://";`
4. Indicar cuantos mensajes queremos mostrar:
    Ej.: `$cuantos = 10;`
7. Modificar el CSS para adaptar a la estética de tu blog.

Puedes ver [un ejemplo funcionando aquí](http://colegota.fotolibre.net).

## Continuidad y soporte
La idea no es tanto el mantener y ampliar el script como que sea usado y mejorado por la Comunidad. Se trata de un script muy sencillo que tiene poco que explicar.
¡Haz tus propias versiones y compártelas!
A nosotros nos puedes contactar en el grupo [!gnusocialpress](https://gnusocial.net/group/gnusocialpress) en GNU Social.

## Sobre GNU Social
[GNU social: lo más básico](https://flosspirit.wordpress.com/2015/01/16/gnu-social-lo-mas-basico/).

[GNU social: como Twitter, pero mejor](https://flosspirit.wordpress.com/2014/10/12/gnu-social-como-twitter-pero-mejor/).

[Hola, soy nuevo en “Quitter”. Enlaces de interés](https://flosspirit.wordpress.com/2015/01/17/quitter/).



