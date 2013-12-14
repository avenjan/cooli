<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
gettype($song_id);
if(is_int($song_id)||!empty($song_id)){
        $str=base64_decode($song_id);
        $mids=explode(",",$str);
        foreach($mids as $id)
        {
        $sql2 = "select t.title,f.music_url,t.mid,aid from `#@__archives` t
        left join `#@__addonsoft` f on t.id=f.aid where id ='".$id."'";
        $r2 = $dsql->GetOne($sql2);
        $ss1.='<m src="'.$r2['music_url'].'" label="'.$r2['title'].'" aid="'.$r2['aid'].'" />';
        }
        $ss2.='<list>';
        $ss2.=$ss1; 
        $ss2.='</list>';
        echo $ss2;
}else{
	ShowMsg('参数错误，无法为您提供请求的内容！',"javascript:window.close();","0",5000);

}
?>