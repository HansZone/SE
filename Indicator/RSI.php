<?php
/**
 * Created by PhpStorm.
 * User: MAX
 * Date: 2017/4/24
 * Time: 16:30
 */

class RSI{
    public function CalculateRSI($name){
        $conn = @mysql_connect("localhost","root","");
        if (!$conn){
            die("Failed to connect database" . mysql_error());
        }
        $db=mysql_select_db("seteam", $conn);
        if(!$db)
        {
            die("Failed to connect to MySQL:". mysql_error());
        }
        $data=mysql_query("SELECT close FROM {$name}_historical ORDER BY `date` DESC LIMIT 30");

        //calculate up
        $UP=0;
        //calculate down
        $DOWN=0;

        for ($x=0; $x<=30; $x++)
        {
            //select close of one day
            $sql = "SELECT close FROM {$name}_historical LIMIT $x,1";
            $query=mysql_query($sql) or die($query."<br/><br/>".mysql_error());
            $c1=mysql_result($query,0);

            //select close of the day before
            $x++;
            $sql = "SELECT close FROM {$name}_historical LIMIT $x,1";
            $query=mysql_query($sql) or die($query."<br/><br/>".mysql_error());
            $c2=mysql_result($query,0);

            if ($c1>$c2) $UP=$UP+$c1-$c2;
            if ($c1<$c2) $DOWN=$DOWN-$c1+$c2;

        }

        //caculate RS
        $RS=$UP/$DOWN;
        //calculate RSI
        $RSI=$RS/(1+$RS)*100;

        return $RSI;
    }
    public function Analysis($index){
        if ($index<30) {
            echo "It's likely oversold. Suggestion: BUY.";
            return 1;
        }
        if ($index>=30 && $index<70) {
            echo " It's safe area. Suggestion: HOLD or SIT OUT.";
            return 0;
        }
        if ($index>=70) {
            echo "It's likely overbought. Suggestion: SELL.";
            return -1;
        }
    }
}
?>
