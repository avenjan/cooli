<?php
/**
 *
 * 内容收藏
 *
 * @version        $Id: stow.php 1 15:38 2010年7月8日Z tianya $
 * @package        DedeCMS.Site
 * @copyright      Copyright (c) 2007 - 2010, DesDev, Inc.
 * @license        http://help.dedecms.com/usersguide/license.html
 * @link           http://www.dedecms.com
 */
 
require_once(dirname(__FILE__)."/../include/common.inc.php");

$aid = ( isset($aid) && is_numeric($aid) ) ? $aid : 0;
$type=empty($type)? "" : $type;
$music_url=empty($music_url)? "" : $music_url;

if($aid==0)
{
    ShowMsg('音乐id不能为空!','javascript:window.close();');
    exit();
}

require_once(DEDEINC."/memberlogin.class.php");
$ml = new MemberLogin();

if($ml->M_ID==0)
{
    ShowMsg('会员特权功能，请您先登陆！<br/>为您转向登陆页面...','/member/login.php',"0",5000);
    exit();
}


//读取文档信息
$arcRow = GetOneArchive($aid);
if($arcRow['aid']=='')
{
    ShowMsg('参数错误无法为您添加！<br/>5秒后关闭...','javascript:window.close();',"0",5000);
    exit();
}
extract($arcRow, EXTR_SKIP);

$addtime = time();
  $row = $dsql->GetOne("SELECT * FROM `#@__member_stow` WHERE aid='$aid' AND mid='{$ml->M_ID}'");
    if(!is_array($row))
    {
        $dsql->ExecuteNoneQuery("INSERT INTO `#@__member_stow`(mid,aid,title,addtime,music_url) VALUES ('".$ml->M_ID."','$aid','".addslashes($arctitle)."','$addtime'); ");
    } else {
		ShowMsg('您已经成功添加，无需重复操作！<br/>5秒后关闭...','javascript:window.close();',"0",5000);
		exit();
	}

    $row = $dsql->GetOne("SELECT * FROM `#@__member_stow` WHERE type='$type' AND (aid='$aid' AND mid='{$ml->M_ID}')");
    if(!is_array($row))
    {
        $dsql->ExecuteNoneQuery(" INSERT INTO `#@__member_stow`(mid,aid,title,addtime,music_url,type) VALUES ('".$ml->M_ID."','$aid','$title','$addtime','$music_url','$type'); ");
    }


//更新用户统计
$row = $dsql->GetOne("SELECT COUNT(*) AS nums FROM `#@__member_stow` WHERE `mid`='{$ml->M_ID}' ");
$dsql->ExecuteNoneQuery("UPDATE #@__member_tj SET `stow`='$row[nums]' WHERE `mid`='".$ml->M_ID."'");

ShowMsg('成功添加一首歌曲到您的播放器列表！<br/>5秒后关闭...','javascript:window.close();',"0",5000);