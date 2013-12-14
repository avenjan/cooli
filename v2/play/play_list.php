<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");


        $str=(2);
        $mids=explode(",",$str);
        foreach($mids as $id)
        {
        $sql2 = "select t.title,f.music_url,t.mid from `#@__archives` t
        left join `#@__addonsoft` f on t.id=f.aid where id ='".$id."'";
        $r2 = $dsql->GetOne($sql2);
        $ss1.='<m src="'.$r2['music_url'].'" label="'.$r2['title'].'" />';
        }
        $ss2.='<list>';
        $ss2.=$ss1; 
        $ss2.='</list>';
        echo $ss2;
		echo dirname(__FILE__);

?>