<?php

include('./util.php');

$byteArray = unpack('C*', 'hello');
var_dump($byteArray);
echo "<br/>";

var_dump(string2ByteArray('hello'));
echo "<br/>";

var_dump(byteArray2String($byteArray));
echo "<br/>";

var_dump(byteArray2Hex($byteArray));
echo "<br/>";

var_dump(hex2ByteArray('68656c6c6f'));
echo "<br/>";

var_dump(string2Hex('hello'));
echo "<br/>";

var_dump(hex2String('68656c6c6f'));
echo "<br/>";

/*
array(5) { [1]=> int(104) [2]=> int(101) [3]=> int(108) [4]=> int(108) [5]=> int(111) }
array(5) { [1]=> int(104) [2]=> int(101) [3]=> int(108) [4]=> int(108) [5]=> int(111) }
string(5) "hello"
string(10) "68656c6c6f"
array(5) { [1]=> int(104) [2]=> int(101) [3]=> int(108) [4]=> int(108) [5]=> int(111) }
string(10) "68656c6c6f"
string(5) "hello"
*/
?>