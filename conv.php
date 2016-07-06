<?php
$map=array(
'`'=>'K_BKQUOTE',
'1'=>'K_1',
'2'=>'K_2',
'3'=>'K_3',
'4'=>'K_4',
'5'=>'K_5',
'6'=>'K_6',
'7'=>'K_7',
'8'=>'K_8',
'9'=>'K_9',
'0'=>'K_0',
'-'=>'K_HYPHEN',
'='=>'K_EQUAL',
'q'=>'K_Q',
'w'=>'K_W',
'e'=>'K_E',
'r'=>'K_R',
't'=>'K_T',
'y'=>'K_Y',
'u'=>'K_U',
'i'=>'K_I',
'o'=>'K_O',
'p'=>'K_P',
'['=>'K_LBRKT',
']'=>'K_RBRKT',
'\\'=>'K_BKSLASH',
'a'=>'K_A',
's'=>'K_S',
'd'=>'K_D',
'f'=>'K_F',
'g'=>'K_G',
'h'=>'K_H',
'j'=>'K_J',
'k'=>'K_K',
'l'=>'K_L',
';'=>'K_COLON',
'\''=>'K_QUOTE',
'z'=>'K_Z',
'x'=>'K_X',
'c'=>'K_C',
'v'=>'K_V',
'b'=>'K_B',
'n'=>'K_N',
'm'=>'K_M',
','=>'K_COMMA',
'.'=>'K_PERIOD',
'/'=>'K_SLASH',
'U+0020'=>'K_SPACE'
);

$shiftmap=array(
'`'=>'~',
'1'=>'!',
'2'=>'@',
'3'=>'#',
'4'=>'$',
'5'=>'%',
'6'=>'^',
'7'=>'&',
'8'=>'*',
'9'=>'(',
'0'=>')',
'-'=>'_',
'='=>'+',
'q'=>'Q',
'w'=>'W',
'e'=>'E',
'r'=>'R',
't'=>'T',
'y'=>'Y',
'u'=>'U',
'i'=>'I',
'o'=>'O',
'p'=>'P',
'['=>'{',
']'=>'}',
'\\'=>'|',
'a'=>'A',
's'=>'S',
'd'=>'D',
'f'=>'F',
'g'=>'G',
'h'=>'H',
'j'=>'J',
'k'=>'K',
'l'=>'L',
';'=>':',
'\''=>'"',
'z'=>'Z',
'x'=>'X',
'c'=>'C',
'v'=>'V',
'b'=>'B',
'n'=>'N',
'm'=>'M',
','=>'<',
'.'=>'>',
'/'=>'?'
);

$s=file_get_contents($argv[1]);
$s=str_replace("\r\n","\n",$s);
$a=explode("\n",$s);
$b=array();
foreach($a as $v){
	if($v=='') continue;
	if($v[0]=='#') continue;
	$b[]=explode("\t",$v);
}
$a=$b;
function quot($s){
	if(substr($s,0,2)=='U+') return $s;
	if(strpos($s,'"')===false) return '"'.$s.'"';
	if(strpos($s,'\'')===false) return '\''.$s.'\'';
	die('Dont know how to quote '.$s);
}
for($i=1;$i<count($a);++$i){
	for($j=1;$j<count($a[$i]);++$j){
		$a[$i][0]=trim($a[$i][0]);
		if(empty($a[$i][0])){
			$key=quot($a[0][$j]);
		}elseif($a[$i][0]=='SHIFT'){
			if(!empty($shiftmap[$a[0][$j]])){
				$key=quot($shiftmap[$a[0][$j]]);
			}elseif(!empty($map[$a[0][$j]])){
				$key='[SHIFT '.$map[$a[0][$j]].']';
			}else{
				die($map[$a[0][$j]]);
			}
		}else{
			$key='['.$a[$i][0].' '.$map[$a[0][$j]].']';
		}
		if(!empty($a[$i][$j])) echo '+ '.$key.' > '.quot($a[$i][$j])." dk(1)\n";
	}
}
?>
