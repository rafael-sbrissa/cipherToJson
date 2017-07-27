<?php
$cifra = "is-this-love.txt";
$regex = '/(([A-G]{1})([#bMm\d]))(\/([A-G]){1}([#bMm\d]))*/';
$cifra_obj = new SplFileObject($cifra, "r");

$cifras_array = array();
$linha_n = 1;
while (!$cifra_obj->eof()) {
  $linha = $cifra_obj->fgets();

  if(preg_match($regex, $linha)){
    $espacos = 1;
    $acorde = null;
    $acorde_n = 1;
    for ($i=0; $i <= strlen($linha); $i++) {
      if(isset($linha[$i]) && $linha[$i] == chr(ord(" "))){
        $cifras_array['linha' . $linha_n]["espaco" . $acorde_n] = $espacos++;
      }
      if(isset($linha[$i+1]) && $linha[$i+1] != chr(ord(" "))){
        $j = $i+1;
        $acorde .= $linha[$j];
        $cifras_array['linha' . $linha_n]["acorde" . $acorde_n] = $acorde;
        if(!isset($linha[$j+1]) || $linha[$j+1] == chr(ord(" "))){
          $acorde = null;
          $acorde_n++;
        }
        $espacos = 1;

      }

    }
    $linha_n++;
  }

}
echo "<pre>";
echo json_encode($cifras_array);
//var_dump($cifras_array);
echo "</pre>";

?>
