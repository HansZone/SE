<?php
/**
 * Created by PhpStorm.
 * User: MAX
 * Date: 2017/4/22
 * Time: 15:45
 */
function KDJfunction($StockName)
{
    // get data from database
    $conn = @mysql_connect("localhost", "root", "");
    if (!$conn) {
        die("Fail to connect database：" . mysql_error());
    }
    $db=mysql_select_db("seteam", $conn);
    if(!$db) {
        die("Failed to connect to MySQL:". mysql_error());
    }
    //calculate K9
    $K9=50;
    //calculate D9
    $D9=50;
    for ($x=30; $x>=0; $x--)
    {
        //select  the latest day
        $sql = "SELECT date FROM {$StockName}_historical LIMIT $x,1";
        $query=mysql_query($sql) or die($query."<br/><br/>".mysql_error());
        $d1=mysql_result($query,0);
        //select the last 9th day
        $y=$x+9;
        $sql = "SELECT date FROM {$StockName}_historical LIMIT $y,1";
        $query=mysql_query($sql) or die($query."<br/><br/>".mysql_error());
        $d9=mysql_result($query,0);
        //select the highest price during the last 9 days
        $sql = "SELECT MAX(high) FROM {$StockName}_historical WHERE date>='$d9' AND date<='$d1'";
        $query=mysql_query($sql) or die($query."<br/><br/>".mysql_error());
        $H9=mysql_result($query,0);
        //select the lowest price during the last 9 days
        $sql = "SELECT MIN(low) FROM {$StockName}_historical WHERE date>='$d9' AND date<='$d1'";
        $query=mysql_query($sql) or die($query."<br/><br/>".mysql_error());
        $L9=mysql_result($query,0);
        //select the closing price of the latest day
        $sql = "SELECT close FROM {$StockName}_historical WHERE date='$d1'";
        $query=mysql_query($sql) or die($query."<br/><br/>".mysql_error());
        $C=mysql_result($query,0);
        //caculate RSV9
        $RSV9=($C-$L9)/($H9-$L9)*100;
        //calculate K9
        $K9=2/3*$K9+1/3*$RSV9;
        //calculate D9
        $D9=2/3*$D9+1/3*$K9;
    }
    //calculate J9
    $J9=3*$K9-2*$D9;
    echo "RSV= ",$RSV9,"<br>";
    echo "K = ",$K9,"<br>";
    echo "D = ",$D9,"<br>";
    echo "J = ",$J9,"<br>";
    if ($K9<10||$D9<20||$J9<0){
        echo "It's a Oversold area, Suggestion: BUY. ";
        return 1;
    }else if ($K9>90||$D9>80||$J9>100){
        echo "It's a Overbought area, Suggestion: SELL. ";
        return -1;
    }else{
        echo "It's a Trade Balance area, Suggestion: HOLD or SIT OUT. ";
        return 0;
    }
}
?>