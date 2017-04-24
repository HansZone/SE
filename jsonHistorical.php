<!--
// written by:Sirun Xu
// debugged by:Sirun Xu
-->



<?php  
  
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("seteam", $con);

$sql="SELECT name FROM stocks";
$result=mysql_query($sql);
while ($name=mysql_fetch_assoc($result)){
$sql="SELECT date,open,high,low,close,volume FROM {$name['name']}_historical ORDER BY `date` ASC";  
$countt=mysql_query("SELECT count(*) FROM {$name['name']}_historical ORDER BY `date` ASC");
$countt=mysql_fetch_assoc($countt);
echo $countt['count(*)'];
$result2 = mysql_query($sql);   
if ($result2)
{
    $i=0; 
	$fp=fopen("{$name['name']}.json","w");
	fwrite($fp,"[");
    for ($i=0;$i<$countt['count(*)'];$i++){ 
		$row=mysql_fetch_assoc($result2);
		$year=((int)substr($row['date'],0,4));//ȡ???
		$month=((int)substr($row['date'],5,2));//ȡ??·?
		$day=((int)substr($row['date'],8,2));//ȡ?ü???
			$row['date']=mktime(0,0,0,$month,$day,$year)."000";
		$str="[".$row['date'].",".$row['open'].",".$row['high'].",".$row['low'].",".$row['close'].",".$row['volume']."],";
		if ($i!=$countt['count(*)']-1) $str="[".$row['date'].",".$row['open'].",".$row['high'].",".$row['low'].",".$row['close'].",".$row['volume']."],";
		else  $str="[".$row['date'].",".$row['open'].",".$row['high'].",".$row['low'].",".$row['close'].",".$row['volume']."]";
			fwrite($fp,$str);
			fwrite($fp,"\n");
    } 
	        
}
   
  fwrite($fp,']');
fclose($fp);
}   

mysql_close($con);

  
?>  