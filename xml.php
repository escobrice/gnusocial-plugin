<?php
header('Content-Type: text/html; charset=UTF-8');
#-- Hay que habilitar en php.ini la linea ;extension=php_openssl.dll (simplemente quitar el ;)
#-- Config
$timeline="user"; //user: usuario ; friends: /all
$server = "gnusocial.net";
$user= "colegota";
$protocol = "http://";
$cuantos = 10;
$cont=0;
#-- En la siguiente linea simplemente metemos el timeline del usuario
$xml = simplexml_load_file($protocol.$server."/api/statuses/".$timeline."_timeline/".$user.".xml");
echo '<style type="text/css" media="screen">
#unmensaje
{
width: 90%;
margin: 10px auto;
background-color: #fff;
color: #333;
border: 1px solid gray;
}
#cabecera{
padding: .5em;
background-color: #ddd;
border-bottom: 1px solid gray;
}
#pie
{
clear: both;
margin: 0;
padding: .5em;
}
</style>';
echo '<div id="mensajes" style="font-size:small; overflow:scroll">';
foreach($xml->status as $status)
  {
  $retweet=$status->retweeted_status;
  if ($retweet != "") {
    $userini=$status->user;
    $status=$status->retweeted_status;
        $RTtext="Repetido por ";
  }
  else {
    //$user=$status->user;
    $userini=$status->user;
    $RTtext="";
  }
  $user=$status->user;
  $imagen=$user->profile_image_url;
  $perfil=$user->{'statusnet:profile_url'};
  $fecha=$status->created_at;
  $fecha=convertirfecha($fecha);
  //$texto=$status->text;
  $namespaces = $status->getNamespaces(true);
  $texto = $status->children($namespaces["html"]);
  //$texto=$status->statusnet->html;
  //$texto=convertirURL($texto);
  //$texto=convertirgrupo($texto);
  //$texto=convertirusuario($texto);
  //$texto=convertiretiqueta($texto);
  //$html=$status->{'statusnet:html'};
  #--Las siguientes dos lineas se hacen aquí, porque no fui capaz de que funcionara en las funciones
  //$texto=str_replace('group/!','group/',$texto);
  //$texto=str_replace($server.'/@',$server,$texto);
  //$texto=str_replace($server.'/tag/#',$server.'/tag/',$texto);
  echo '<div id="unmensaje">';
  echo '<div id="cabecera"><img src="'.$imagen.'" Align=ABSMIDDLE>'.'   '.
  '<strong>'.$RTtext.'<a target="_blank" href="'.$protocol.$server.'/'.$userini->screen_name.'">'.$userini->screen_name.'</a></strong><br \></div>';
  echo $texto;
  echo '<div id="pie"> <br /><hr width="50%"><a style="text-decoration:none;color:black" target="_blank" href="'.$protocol.$server.'/notice/'.$status->id.'">'.$fecha.'</a><br /></div>';
  echo '</div>';
  if (++$cont>=$cuantos) {
   break;
   }
  }
  echo '</div>';
  function convertirURL($url)
{
    $reg = '/(?<!(?:\]|=))(http:\/\/[\w\/*\?*\&*\=*\.*]+)(?!(?:\[|\]))/i';
	$rep = '<a target="_blank" href="$1">$1</a>';
	return preg_replace($reg, $rep, $url);
}
 function convertirgrupo($url)
{
    $reg= '/(![\w]+)/i';
    $rep = '<a target="_blank" href="'.$protocol.$server.'/group/$1"><i>$1</i></a>';
	return preg_replace($reg, $rep, $url);
}
 function convertirusuario($url)
{
   	$reg= '/(@[\w]+)/i';
	$rep = '<a target="_blank" href="'.$protocol.$server.'/$1"><strong>$1</strong></a>';
	return preg_replace($reg, $rep, $url);
}
 function convertiretiqueta($url)
{
   	$reg= '/(#[\w]+)/i';
	$rep = '<a target="_blank" href="'.$protocol.$server.'/tag/$1"><strong>$1</strong></a>';
	return preg_replace($reg, $rep, $url);
}
 function convertirfecha($fecha)
{
   $f=strtotime($fecha);
   $f=date('d/m/Y H:i',$f);
	return $f;
}
?> 


