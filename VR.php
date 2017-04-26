<?php
/**
 * Created by PhpStorm.
 * User: MAX
 * Date: 2017/4/23
 * Time: 17:30
 */

class VR{
    public function CalculateVR($name){
        $conn = @mysql_connect("localhost","root","");
        if (!$conn){
            die("Failed to connect database£º" . mysql_error());
        }
        $db=mysql_select_db("seteam", $conn);
        if(!$db)
        {
            die("Failed to connect to MySQL:". mysql_error());
        }
        $data=mysql_query("SELECT open,close,volume FROM {$name}_historical ORDER BY `date` DESC LIMIT 30");
        $AVS=$BVS=$CVS=0;
        while($day=mysql_fetch_assoc($data))
        {
            if ($day['close']>$day['open']) $AVS=$AVS+$day['volume'];
            if ($day['close']<$day['open']) $BVS=$BVS+$day['volume'];
            if ($day['close']==$day['open']) $CVS=$CVS+$day['volume'];
        }
        $VR=($AVS+0.5*$CVS)/($BVS+0.5*$CVS);
        return $VR;
    }
    public function Analysis($index){
        if ($index<0.7) echo "It's likely to form a bottom. Suggestion: BUY.";
        if ($index>=0.7 && $index<1.5) echo " It's safe area. Suggestion: HOLD OR SIT OUT.";
        if ($index>=1.5) echo "It's likely to form a top. Suggestion: SELL.";
    }
}
?>
