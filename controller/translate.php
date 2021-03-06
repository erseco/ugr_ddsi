<?php
/*******************************************
 *
 * 2014 - DDSI (Diseño y desarrollo de sistemas de información)
 * Grado en Ingeniería Informática
 *
 * Ernesto Serrano <erseco@correo.ugr.es>
 * Garoé Expósito Luis <garoluis@correo.ugr.es
 * Daniel Pérez Gázquez <Plenidag@correo.ugr.es>
 * Jose Fco Alcalde <jfap0003@correo.ugr.es>
 *
 *
 *******************************************
 *
 * 	Estas funciones me permiten usar la API de google translate desde mi web
 *	(De momento no se está implementando porque es mas cómodo lanzar la traducción
 *	en una ventana propia de google translate, así si se pueden permutar las oraciones)
 *
 ******************************************************************************/
?>
<?php

function curl($url,$params = array(),$is_coockie_set = false)
{

if(!$is_coockie_set){
/* STEP 1. let’s create a cookie file */
$ckfile = tempnam ("/tmp", "CURLCOOKIE");

/* STEP 2. visit the homepage to set the cookie properly */
$ch = curl_init ($url);
curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec ($ch);
}

$str = ''; $str_arr= array();
foreach($params as $key => $value)
{
$str_arr[] = urlencode($key)."=".urlencode($value);
}
if(!empty($str_arr))
$str = '?'.implode('&',$str_arr);

/* STEP 3. visit cookiepage.php */

$Url = $url.$str;

$ch = curl_init ($Url);
curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);
return $output;
}

function Translate($word,$conversion = 'hi_to_en')
{
$word = urlencode($word);

// // dutch to english
// if($conversion == 'nl_to_en')
// $url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=nl&tl=en&multires=1&otf=2&pc=1&ssel=0&tsel=0&sc=1';

// // english to hindi
// if($conversion == 'en_to_hi')
// $url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=en&tl=hi&ie=UTF-8&oe=UTF-8&multires=1&otf=1&ssel=3&tsel=3&sc=1';

// // hindi to english
// if($conversion == 'hi_to_en')
// $url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=hi&tl=en&ie=UTF-8&oe=UTF-8&multires=1&otf=1&pc=1&trs=1&ssel=3&tsel=6&sc=1';

// // spanish to english
// if($conversion == 'es_to_en')
// $url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=es&tl=en&ie=UTF-8&oe=UTF-8&multires=1&otf=1&pc=1&trs=1&ssel=3&tsel=6&sc=1';



$arr_langs = explode(‘_to_’, $conversion);
$url = "http://translate.google.com/translate_a/t?client=t&text=$word&hl=".$arr_langs[1]."&sl=".$arr_langs[0]."&tl=".$arr_langs[1]."&ie=UTF-8&oe=UTF-8&multires=1&otf=1&pc=1&trs=1&ssel=3&tsel=6&sc=1";

$name_en = curl($url);

$name_en = explode('"',$name_en);
return  $name_en[1];
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<?php
echo "<br><br> Hindi To English <br>";
echo  Translate('कानूनी नोटिस: यह गूगल के अनुवादक सेवाओं की एक दुरुपयोग है, आप इस के लिए भुगतान करना होगा.');
echo "<br><br> English To Hindi <br> ";
echo  Translate('legal notice: This is an abuse of google translator services ,  you must pay for this.','en_to_hi');
echo "<br><br> Dutch To English <br>";
echo  Translate('Disclaimer: Dit is een misbruik van Google Translator diensten, moet u betalen.','nl_to_en');

echo "<br><br> Spanish To English <br>";
echo  Translate('Estaba la pajara pinta sentada en el verde limón.','es_to_en');

echo "<br><br> Just Kidding ....... :)";


?>
</body>
</html>