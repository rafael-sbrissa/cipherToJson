<?php
$cifra = "is-this-love.txt";
$regex = '/\b(([A-G]{1})([#bMm\d]))(\/([A-G]){1}([#bMm\d]))*\b/';
$cifra_obj = new SplFileObject($cifra, "r");

$cifras_array = array();
$linha_n = 1;
$title = $cifra_obj->fgets();
while (!$cifra_obj->eof()) {
  $linha = $cifra_obj->fgets();
  if(preg_match($regex, $linha)){
    $espacos = 1;
    $acorde = null;
    $acorde_n = 1;
    for ($i=0; $i <= strlen($linha); $i++) {
      if(isset($linha[$i]) && $linha[$i] == chr(ord(" "))){
        $cifras_array['line' . $linha_n]["placement" . $acorde_n] = $espacos++;
      }
      if(!isset($linha[$i-1]) ){
        $cifras_array['line' . $linha_n]["placement" . $acorde_n] = 0;
      } 
      if(isset($linha[$i]) && $linha[$i] != chr(ord(" "))){
        $acorde .= $linha[$i];
        $cifras_array['line' . $linha_n]["chord" . $acorde_n] = $acorde;
        if(!isset($linha[$i+1]) || $linha[$i+1] == chr(ord(" "))){
          $acorde = null;
          $acorde_n++;
        }
        $espacos = 1;
      }
    }
  }else{
    echo $linha . "<br>";
  }
  $linha_n++;
}
echo "<pre>";
echo $title . "<br>";
echo json_encode($cifras_array);
echo "</pre>";

?>
