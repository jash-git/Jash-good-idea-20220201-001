<?php

function string2ByteArray($string) {
  return unpack('C*', $string);
}

function byteArray2String($byteArray) {
  $chars = array_map("chr", $byteArray);
  return join($chars);
}

function byteArray2Hex($byteArray) {
  $chars = array_map("chr", $byteArray);
  $bin = join($chars);
  return bin2hex($bin);
}

function hex2ByteArray($hexString) {
  $string = hex2bin($hexString);
  return unpack('C*', $string);
}

function string2Hex($string) {
  return bin2hex($string);
}

function hex2String($hexString) {
  return hex2bin($hexString);
}

?>