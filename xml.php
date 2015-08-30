<?php
header('Content-Type: text/html; charset=UTF-8');
#-- Hay que habilitar en php.ini la linea ;extension=php_openssl.dll (simplemente quitar el ;)
#-- Config
$timeline="friends"; //user: usuario ; friends: /all
$server = "gnusocial.net";
$username= "colegota";
$protocol = "http://";
$cuantos = 10;
$cont=0;

#-- En la siguiente linea simplemente metemos el timeline del usuario
$xml = simplexml_load_file($protocol.$server."/api/statuses/".$timeline."_timeline/".$username.".xml");

#-- CSS para editar al gusto y adaptar a cada blog
echo '<style type="text/css" media="screen">
#unmensaje
{
word-wrap: break-word;
width: 90%;
margin: 5px auto;
background-color: #fff;
color: #333;
border: 1px solid gray;
}
#cabecera{
padding: .5em;
background-color: #ddd;
border-bottom: 1px solid gray;
}
#cuerpo{
padding: .5em;
background-color: #0;
}
#pie
{
clear: both;
margin: 0;
padding: .5em;
}
#unmensaje a {
color: #666	
}
#unmensaje a:link {
    text-decoration: none;
}
#unmensaje a:visited {
    text-decoration: none;
}
#unmensaje a:hover {
    text-decoration: underline;
}
#unmensaje a:active {
    text-decoration: underline;
}
</style>';

#-- código del script
echo '<div id="mensajes">';
foreach($xml->status as $status)
  {
  $user=$status->user;
  $namespaces = $user->getNamespaces(true);
  $statusnet = $user->children($namespaces["statusnet"]);
  $perfil=$statusnet->profile_url;
    
  $retweet=$status->retweeted_status;
  if ($retweet != "") {
    $status=$status->retweeted_status;
    $RTtext="Repetido por ";
  }
  else {
      $RTtext="";
  }
   
  $usercab=$status->user;
  $namespacescab = $usercab->getNamespaces(true);
  $textocab = $usercab->children($namespacescab["statusnet"]);
  $perfilcab=$textocab->profile_url;
  
  $imagen=$usercab->profile_image_url;
  

 $respuestaa=$status->in_reply_to_screen_name;
 if ($respuestaa != "") {
  	  $textocabecera=$usercab->screen_name.' > '.$respuestaa;
}
else {
  $textocabecera=$usercab->screen_name;
}
    
  $fecha=$status->created_at;
  $fecha=convertirfecha($fecha);
  $namespaces = $status->getNamespaces(true);
  $texto = $status->children($namespaces["statusnet"]);
  $html = $texto->html;
 
 echo '<div id="unmensaje">';
  echo '<div id="cabecera"><img src="'.$imagen.'" Align=ABSMIDDLE>'.'   '.
  '<strong><a target="_blank" href="'.$perfilcab.'">'.$textocabecera.'</a></strong><br \></div>';
  echo '<div id="cuerpo">'.$html.'</div>';
  echo '<div id="pie"> <br /><a target="_blank" href="'.$protocol.$server.'/notice/'.$status->id.'">'.$fecha.'</a>
  <strong>'.$RTtext.'<a target="_blank" href="'.$perfil.'">'.$user->screen_name.'</a></strong>
  </div>';
  echo '</div>';
  if (++$cont>=$cuantos) {
   break;
   }
  }
  echo '</div>';

 function convertirfecha($fecha)
{
   $f=strtotime($fecha);
   $f=date('d/m/Y H:i',$f);
	return $f;
}
?> 


