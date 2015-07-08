<?php
header('Content-Type: text/html; charset=UTF-8');
#-- Hay que habilitar en php.ini la linea ;extension=php_openssl.dll (simplemente quitar el ;)
#-- Config
$server = "gnusocial.net";
$user = "colegota";
$protocol = "http://";
#-- En la siguiente linea simplemente metemos el timeline del usuario
$xml = simplexml_load_file($protocol.$server."/api/statuses/user_timeline/".$user.".xml");
echo '<div style="font-size:small; width: 300; height: 300; overflow:scroll">';
foreach($xml->status as $status)
  {
  $retweet=$status->retweeted_status;
  if ($retweet != "") {
  $user=$retweet->user;}
  else {
  $user=$status->user;
  }
  $imagen=$user->profile_image_url;
  $perfil=$user->{'statusnet:profile_url'};
  $fecha=$status->created_at;
  $fecha=convertirfecha($fecha);
  $texto=$status->text;
  $texto=convertirURL($texto);
  $texto=convertirgrupo($texto);
  $texto=convertirusuario($texto);
  $texto=convertiretiqueta($texto);
  $html=$status->{'statusnet:html'};
  #--Las siguientes dos lineas se hacen aquí, porque no fui capaz de que funcionara en las funciones
  $texto=str_replace('group/!','group/',$texto);
  $texto=str_replace($server.'/@',$server,$texto);
  $texto=str_replace($server.'/tag/#',$server.'/tag/',$texto);
  echo '<img src="'.$imagen.'" Align=ABSMIDDLE>'.'   '.
  '<strong><a target="_blank" href="'.$protocol.$server.'/'.$status->user->screen_name.'">'.
  $status->user->screen_name.'</a></strong><br \> '.
  $texto.'<br /><a style="text-decoration:none;color:black" target="_blank" href="'.$protocol.$server.'/notice/'.$status->id.'">'.$fecha.'</a><br /><hr>';
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

