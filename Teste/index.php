<?php

$teste = array( 'usuario' => 'bla', 'cargo' => 'la', 'logar' => 'ka' );

print_r(array_keys($teste));
$i = 0;
foreach (array_keys($teste) as $key => $value) {
  echo (sizeof($teste) - 1) == $i ? ":".$value." " : ":".$value.", ";
  $i++;
}
