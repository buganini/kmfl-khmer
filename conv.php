<?php
$s=file_get_contents($argv[1]);
$s=str_replace("\r\n","\n",$s);
$a=explode("\n",$s);
$b=array();
foreach($a as $v){
	if($v[0]=='#') continue;
	$b[]=explode("\t",$v);
}
$a=$b;
function quot($s){
	if(strpos($s,'"')===false) return '"'.$s.'"';
	if(strpos($s,'\'')===false) return '\''.$s.'\'';
	die('Dont know how to quote '.$s);
}
for($i=1;$i<count($a);++$i){
	for($j=1;$j<count($a[$i]);++$j){
		if(!empty($a[$i][$j])) echo '+ ['.$a[$i][0].$a[0][$j].'] > '.quot($a[$i][$j])."\n";
	}
}
?>
