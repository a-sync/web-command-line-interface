<?php
//functions
function e($str = '', $s = 0, $l = false, $q = ENT_QUOTES) {
  if($str == '') { global $i; $str = $i; }
  if($l === false) { $l = strlen($str); }
  return htmlspecialchars(substr($str, $s, $l), $q);
}

function l($str = '', $s = 0, $l = false) {
  if($str == '') { global $i; $str = $i; }
  if($l=== false) { $l = strlen($str); }
  return strtolower(substr($str, $s, $l));
}

//initialization
$i = urldecode($_POST['i']);
$e = '';

//help
$help['about'] = 'In Your Face Interface 1.0 by Vector Akashi (<a href="http://www.onethreestudio.com" target="_blank">www.onethreestudio.com</a>)';
$help['cls'] = 'CLS clears the screen.';
$help['help'] = 'Commands: about, cls, help, time, md5<br/>You can also ask for command specific help: help &lt;command&gt;<br/>eg.: help md5';
$help['md5'] = 'MD5 gives back the md5 hash of the given string.<br/>eg.: md5 foobar';
$help['time'] = 'TIME gives back the current time / date. You can specify the format by giving a php date() format.<br/>eg.: time Y.m.d - H:i:s';

//command tree
if(l() == 'about') {
  $e = $help['about'].'<br/>';
}

elseif(l() == 'cls') {
  die('cls');
}

elseif(l($i, 0, 4) == 'help') {
  if($i{4} == ' ') {
    $e = $help[e($i, 5)].'<br/>';
    if($e == '<br/>') $e = 'There is no help for the \''.e($i, 5).'\' command or there is no command under that name.';
  }
  else $e = $help['help'].'<br/>';
}

elseif(l($i, 0, 3) == 'md5') {
  if($i{3} == ' ') $e = md5(substr($i, 4));
  else $e = $help['md5'].'<br/>';
}

elseif(l($i, 0, 4) == 'time') {
  if($i{4} == ' ') $e = date(e($i, 5));
  else $e = date('Y.m.d - H:i:s');
}

else {
  $e = e();
}

//echo e($i).'<br/>';//debug?
echo $e.'<br/>';
?>