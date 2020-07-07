<?php
function toggleElementInArray($array, $elementValue)
{
  if (($key = array_search($elementValue, $array)) !== false) {
      unset($array[$key]);
  }else{
    array_push($array, $elementValue);
  }
  return $array;
}

 ?>
