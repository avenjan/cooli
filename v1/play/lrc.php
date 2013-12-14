<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
if($song_id) 
{
        $str=$song_id;
        $mids=explode(",",$str);
        foreach($mids as $id)
        {
        $sql2 = "select t.title,f.introduce,t.mid from `#@__archives` t
        left join `#@__addonsoft` f on t.id=f.aid where id ='".$id."'";
        $r2 = $dsql->GetOne($sql2);
        $ss1.=''.$r2['introduce'].'';
        }
        $ss2.=$ss1; 
        echo $ss2;
}
?>