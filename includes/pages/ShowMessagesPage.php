<?php

##############################################################################
# *																			 #
# * XG PROYECT																 #
# *  																		 #
# * @copyright Copyright (C) 2009 By LuisMX from Xtreme-gameZ.com.ar	     #
# *																			 #
# *																			 #
# *  This program is free software: you can redistribute it and/or modify    #
# *  it under the terms of the GNU General Public License as published by    #
# *  the Free Software Foundation, either version 3 of the License, or       #
# *  (at your option) any later version.									 #
# *																			 #
# *  This program is distributed in the hope that it will be useful,		 #
# *  but WITHOUT ANY WARRANTY; without even the implied warranty of			 #
# *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the			 #
# *  GNU General Public License for more details.							 #
# *																			 #
##############################################################################

if(!defined('INSIDE')){ die(header("location:../../"));}

function RempAcentos($Texto) 
{
    $Texto = str_replace("á","&aacute;",$Texto);
    $Texto = str_replace("é","&eacute;",$Texto);
    $Texto = str_replace("í","&iacute;",$Texto);
    $Texto = str_replace("ó","&oacute;",$Texto);
    $Texto = str_replace("ú","&uacute;",$Texto);
    $Texto = str_replace("Á","&Aacute;",$Texto);
    $Texto = str_replace("É","&Eacute;",$Texto);
    $Texto = str_replace("Í","&Iacute;",$Texto);
    $Texto = str_replace("Ó","&Oacute;",$Texto);
    $Texto = str_replace("Ú","&Uacute;",$Texto);
    $Texto = str_replace("ñ","&ntilde;",$Texto);
    $Texto = str_replace("Ñ","&Ntilde;",$Texto);
    
    return $Texto;
}

function ShowMessagesPage($CurrentUser)
{
    global $lang;
    
    $OwnerID = $_GET['id'];
    $MsgMode = $_GET["mode"];
    $MsgType = $_GET["type"];
    $MsgID   = $_GET["msgid"];
    $DelWhat = $_POST['optdelmsg'];
    
    if ($MsgMode != "delmsg" && $DelWhat != "") {
        $MsgMode = $DelWhat;
    }
    
    $MsgTypes = array('0','3','1','15','2','6');
    
    // mensajes por defecto a mostrar
    if (!in_array($MsgType,$MsgTypes)) {
        $MsgType = '1';
        $Cambiar = 'null';
    } else {
        $Cambiar = $MsgType;
    }
    
    if ($MsgType != 6)
        $MsgSQL = "`message_type` = '".$MsgType."'";
    else 
        $MsgSQL = "`message_type` NOT IN ('0','3','1','15','2')";
    
    if ($MsgMode == "markread") {
		foreach($_POST as $ChkMsg => $ChkValue)
		{
			if (preg_match("/chkdel/i", $ChkMsg) && $ChkValue == 'on')
			{
				$MsgID   = str_replace("chkdel", "", $ChkMsg);
				$MsgHere = doquery("SELECT * FROM {{table}} WHERE `message_id` = '". $MsgID ."' AND `message_owner` = '". $CurrentUser['id'] ."' AND ".$MsgSQL.";", 'messages');
				if (mysql_num_rows($MsgHere)==1)
					doquery("UPDATE {{table}} SET `message_read` = 0 WHERE `message_id` = '".$MsgID."';", 'messages');

			}
		}
        
        header("location:game.php?page=messages&type=".$MsgType);
    } elseif ($MsgMode == "markunread") {
		foreach($_POST as $ChkMsg => $ChkValue)
		{
			if (preg_match("/chkdel/i", $ChkMsg) && $ChkValue == 'on')
			{
				$MsgID   = str_replace("chkdel", "", $ChkMsg);
				$MsgHere = doquery("SELECT * FROM {{table}} WHERE `message_id` = '". $MsgID ."' AND `message_owner` = '". $CurrentUser['id'] ."' AND ".$MsgSQL.";", 'messages');
				if (mysql_num_rows($MsgHere)==1)
					doquery("UPDATE {{table}} SET `message_read` = 1 WHERE `message_id` = '".$MsgID."';", 'messages');

			}
		}
        
        header("location:game.php?page=messages&type=".$MsgType);
    } elseif ($MsgMode == "delmsg") {
        $MsgHere = doquery("SELECT * FROM {{table}} WHERE `message_id` = '".$MsgID."' AND `message_owner` = '".$CurrentUser['id']."' AND ".$MsgSQL.";", 'messages');
        if (mysql_num_rows($MsgHere)==1)
            doquery("DELETE FROM {{table}} WHERE `message_id` = '".$MsgID."';", 'messages');
            
        header("location:game.php?page=messages&type=".$MsgType);
    } elseif ($MsgMode == "delmark") {
		foreach($_POST as $ChkMsg => $ChkValue)
		{
			if (preg_match("/chkdel/i", $ChkMsg) && $ChkValue == 'on')
			{
				$MsgID   = str_replace("chkdel", "", $ChkMsg);
				$MsgHere = doquery("SELECT * FROM {{table}} WHERE `message_id` = '". $MsgID ."' AND `message_owner` = '". $CurrentUser['id'] ."' AND ".$MsgSQL.";", 'messages');
				if (mysql_num_rows($MsgHere)==1)
					doquery("DELETE FROM {{table}} WHERE `message_id` = '".$MsgID."';", 'messages');

			}
		}
        
        header("location:game.php?page=messages&type=".$MsgType);
    } elseif ($MsgMode == "delunmark") {
		foreach($_POST as $ChkMsg => $ChkValue)
		{                   
            $MsgID    = str_replace("showmsg", "", $ChkMsg);
            $ChkSelec = "chkdel".$MsgID;
            $IsSelec  = $_POST[$ChkSelec];
			if (preg_match("/showmsg/i", $ChkMsg) && !isset($IsSelec))
			{
				$MsgHere = doquery("SELECT * FROM {{table}} WHERE `message_id` = '". $MsgID ."' AND `message_owner` = '". $CurrentUser['id'] ."' AND ".$MsgSQL.";", 'messages');
				if (mysql_num_rows($MsgHere)==1)
					doquery("DELETE FROM {{table}} WHERE `message_id` = '".$MsgID."';", 'messages');

			}
		}
        
        header("location:game.php?page=messages&type=".$MsgType);
    } elseif ($MsgMode == "delall") {
        doquery("DELETE FROM {{table}} WHERE `message_owner` = '". $CurrentUser['id'] ."' AND ".$MsgSQL.";", 'messages');
        
        header("location:game.php?page=messages&type=".$MsgType);
    } elseif ($MsgMode == "write") {
		if (!is_numeric($OwnerID))
			header("location:game.php?page=messages&type=".$MsgType);

		$DatOwner = doquery("SELECT * FROM {{table}} WHERE `id` = '".$OwnerID."';", 'users', true);
		if (!$DatOwner)
			header("location:game.php?page=messages&type=".$MsgType);

		$PlanetOwner = doquery("SELECT * FROM {{table}} WHERE `id_planet` = '". $DatOwner["id_planet"] ."';", 'galaxy', true);
		if (!$PlanetOwner)
			header("location:game.php?page=messages&type=".$MsgType);
        
    	$page .= "<script language=\"JavaScript\">\n";
    	$page .= "    function f(target_url, win_name) {\n";
    	$page .= "        var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=800,height=600,top=0,left=0');\n";
    	$page .= "        new_win.focus();\n";
    	$page .= "    }\n";
    	$page .= "</script>\n";
    	$page .= "<br />\n";
    	$page .= "<div id=\"content\">\n";        
            
		if ($_POST)
		{
			$error = 0;
			if (!$_POST["subject"])
			{
				$error++;
				$page .= "<table><tr><td><font color=#FF0000".$lang['mg_no_subject']."</font></td></tr></table>";
			}
			if (!$_POST["text"])
			{
				$error++;
				$page .= "<table><tr><td><font color=#FF0000>".$lang['mg_no_text']."</font></td></tr></table>";
			}
			if ($error == 0)
			{
				$page .= "<table><tr><td><font color=\"#00FF00\">".$lang['mg_msg_sended']."</font></td></tr></table>";

				$_POST['text'] = str_replace("'", '&#39;', $_POST['text']);

				$Owner   	= $OwnerID;
				$Sender  	= $CurrentUser['id'];
				$From    	= $CurrentUser['username'] ." [".$CurrentUser['galaxy'].":".$CurrentUser['system'].":".$CurrentUser['planet']."]";
				$Subject 	= $_POST['subject'];
                $Message	= preg_replace ( "/([^\s]{80}?)/" , "\\1<br />" , trim ( nl2br ( strip_tags ( $_POST['text'], '<br>' ) ) ) );

				SendSimpleMessage($Owner, $Sender, '', 1, $From, $Subject, $Message);

				$subject 	= "";
				$text    	= "";
			}
		}
		$parse['id']           = $OwnerID;
		$parse['to']           = $DatOwner['username'] ." [".$PlanetOwner['galaxy'].":".$PlanetOwner['system'].":".$PlanetOwner['planet']."]";
		$parse['subject']      = (!isset($subject)) ? $lang['mg_no_subject'] : $subject ;
		$parse['text']         = $text;
        

		$page .= parsetemplate(gettemplate('messages_pm_form'), $parse);
        $page .= "</div>\n";
        
        display($page);
    } elseif ($MsgMode == "show") {
        $CurMsg = doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$CurrentUser['id']."' AND `message_id` = '".$MsgID."' AND ".$MsgSQL.";", 'messages', true);
        doquery ("UPDATE {{table}} SET `message_read` = '0' WHERE `message_owner` = '".$CurrentUser['id']."' AND `message_id` = '".$MsgID."' AND ".$MsgSQL.";", 'messages');
        
        $page .= "<div>\n";
        $page .= "    <table width=\"100%\">\n";
        $page .= "        <tr>\n";
        $page .= "            <td class=\"c\" colspan=\"4\"><center><a href=\"#\" title=\"".RempAcentos("Versión 1.0 Copyright (C) 2009 By LuisMX from Xtreme-gameZ.com.ar")."\"><font color=\"yellow\">.:: ".$lang['mg_message_title']." ::.</font></a><br />".RempAcentos($lang['mg_type'][$MsgType])."</center></td>\n";
        $page .= "        </tr>\n";
        $page .= "        <tr>\n";
        $page .= "            <td class=\"x\" width=\"25%\"><font color=\"#6699FF\">".$lang['mg_date']."</font> : ".date("d.m.Y H:i:s", $CurMsg['message_time'])."</td>\n";
        $page .= "            <td class=\"x\" width=\"30%\"><font color=\"#6699FF\">".$lang['mg_msg_from']."</font> : ".RempAcentos(stripslashes($CurMsg['message_from']))."</td>\n";
        $page .= "            <td class=\"x\" width=\"37%\"><font color=\"#6699FF\">".$lang['mg_subject']."</font> : ".RempAcentos(stripslashes($CurMsg['message_subject']))."</td>\n";
        $page .= "            <td class=\"x\" width=\"8%\"><center><a href=\"game.php?page=messages&type=".$MsgType."\"><font color=\"#FF8C00\">Cerrar</font></a></center></td>\n";
        $page .= "        </tr>\n";        
        $page .= "        <tr>\n";
        $page .= "            <td colspan=\"4\">". RempAcentos(stripslashes( nl2br( $CurMsg['message_text'] ) ))."</td>\n";
        $page .= "        </tr>\n";
        $page .= "    </table>\n";
        $page .= "</div>\n";
        display($page, false, '', false, false);
    } else {
        $SumMsgType = doquery("SELECT `message_type`, COUNT(`message_type`) AS message_count FROM {{table}} WHERE `message_owner` = '".$CurrentUser['id']."' AND `message_read` = '1' GROUP BY `message_type`;", 'messages');
        doquery ("UPDATE {{table}} SET `new_message` = '0' WHERE `id` = '".$CurrentUser['id']."';", 'users');
        
        $CountMsg   = array(0=>0, 3=>0, 1=>0, 15=>0, 2=>0, 6=>0);
        while ($CurCountMsg = mysql_fetch_array($SumMsgType)) {
            if (in_array($CurCountMsg['message_type'],$MsgTypes)) {
                $CountMsg[$CurCountMsg['message_type']] += $CurCountMsg['message_count'];
                if ($Cambiar == 'null') {
                    $Cambiar = $CurCountMsg['message_type'];
                    $MsgType = $CurCountMsg['message_type'];
                }
            } else {
                $CountMsg['6'] += $CurCountMsg['message_count'];
                if ($Cambiar == 'null') {
                    $Cambiar = '6';
                    $MsgType = '6';
                }
            }
        }
        
        if ($MsgType != 6)
            $MsgSQL = "`message_type` = '".$MsgType."'";
        else 
            $MsgSQL = "`message_type` NOT IN ('0','3','1','15','2')";
        
    	$UserMsg    = doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$CurrentUser['id']."' AND ".$MsgSQL." ORDER BY `message_time` DESC;", 'messages');
        $NumberMsg  = mysql_num_rows($UserMsg);
        
    	$page .= "<script language=\"JavaScript\">\n";
    	$page .= "    function f(target_url, win_name) {\n";
    	$page .= "        var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=800,height=600,top=0,left=0');\n";
    	$page .= "        new_win.focus();\n";
    	$page .= "    }\n";
    	$page .= "    function marcar_todos() {\n";
    	$page .= "        for (i=0;i<document.forms[0].elements.length;i++)\n";
    	$page .= "           if(document.forms[0].elements[i].type == \"checkbox\")\n";
        $page .= "                document.forms[0].elements[i].checked=1\n";        
    	$page .= "    }\n";
    	$page .= "    function desmarcar_todos() {\n";
    	$page .= "        for (i=0;i<document.forms[0].elements.length;i++)\n";
    	$page .= "           if(document.forms[0].elements[i].type == \"checkbox\")\n";
        $page .= "                document.forms[0].elements[i].checked=0\n";        
    	$page .= "    }\n";           
    	$page .= "</script>\n";
    	$page .= "<br />\n";
    	$page .= "<div id=\"content\">\n";
        $page .= "    <table width=\"600\">\n";
        $page .= "        <tr>\n";
        $page .= "            <td class=\"c\" colspan=\"6\"><center><a href=\"#\" title=\"Versión 1.0 Copyright (C) 2009 By LuisMX from Xtreme-gameZ.com.ar\"><font color=\"yellow\">.:: ".$lang['mg_message_title']." ::.</font></a><br />".$lang['mg_type'][$MsgType]."</center></td>\n";
        $page .= "        </tr>\n";
        $page .= "        <tr>\n";
        $page .= "            <td class=\"k\" width=\"100\"><a href=\"game.php?page=messages&type=0\" title=\"".$lang['mg_type'][0]."\">".($MsgType==0 ? "<font color=\"#FF8C00\">" : "<font color=\"#6699FF\">").$lang['mg_msg_spy'].($CountMsg['0'] != 0 ? " (".$CountMsg['0'].")" : "" )."</font></a></td>\n";
        $page .= "            <td class=\"k\" width=\"100\"><a href=\"game.php?page=messages&type=3\" title=\"".$lang['mg_type'][3]."\">".($MsgType==3 ? "<font color=\"#FF8C00\">" : "<font color=\"#6699FF\">").$lang['mg_msg_battle'].($CountMsg['3'] != 0 ? " (".$CountMsg['3'].")" : "" )."</font></a></td>\n";
        $page .= "            <td class=\"k\" width=\"100\"><a href=\"game.php?page=messages&type=1\" title=\"".$lang['mg_type'][1]."\">".($MsgType==1 ? "<font color=\"#FF8C00\">" : "<font color=\"#6699FF\">").$lang['mg_msg_players'].($CountMsg['1'] != 0 ? " (".$CountMsg['1'].")" : "" )."</font></a></td>\n";
        $page .= "            <td class=\"k\" width=\"100\"><a href=\"game.php?page=messages&type=15\" title=\"".$lang['mg_type'][15]."\">".($MsgType==15 ? "<font color=\"#FF8C00\">" : "<font color=\"#6699FF\">").$lang['mg_msg_expedition'].($CountMsg['15'] != 0 ? " (".$CountMsg['15'].")" : "" )."</font></a></td>\n";
        $page .= "            <td class=\"k\" width=\"100\"><a href=\"game.php?page=messages&type=2\" title=\"".$lang['mg_type'][2]."\">".($MsgType==2 ? "<font color=\"#FF8C00\">" : "<font color=\"#6699FF\">").$lang['mg_msg_alliance'].($CountMsg['2'] != 0 ? " (".$CountMsg['2'].")" : "" )."</font></a></td>\n";
        $page .= "            <td class=\"k\" width=\"100\"><a href=\"game.php?page=messages&type=6\" title=\"".$lang['mg_type'][6]."\">".($MsgType==6 ? "<font color=\"#FF8C00\">" : "<font color=\"#6699FF\">").$lang['mg_msg_other'].($CountMsg['6'] != 0 ? " (".$CountMsg['6'].")" : "" )."</font></a></td>\n";
        $page .= "        </tr>\n";
        $page .= "    </table>\n";
        $page .= "    <table width=\"600\">\n";
        $page .= "        <tr>\n";
        if ($NumberMsg!=0) {
            $page .= "            <td class=\"k\">\n";
            $page .= "                <table width=\"100%\">\n";
            $page .= "                <form action=\"game.php?page=messages&type=".$MsgType."\" method=\"post\">\n";
            $page .= "                    <tr>\n";
            $page .= "                        <td class=\"c\" colspan=\"2\">".$lang['mg_msg_from']."</td>\n";
            $page .= "                        <td class=\"c\">".$lang['mg_subject']."</td>\n";
            $page .= "                        <td class=\"c\" colspan=\"2\">".$lang['mg_date']."</td>\n";
            $page .= "                    </tr>\n";
            while ($CurMsg = mysql_fetch_array($UserMsg)) {
                $Leido  = $CurMsg['message_read'];
                $ChkBox = "<input name=\"showmsg". $CurMsg['message_id'] . "\" type=\"hidden\" value=\"1\">";
                $ChkBox.= "<input name=\"chkdel". $CurMsg['message_id'] . "\" align=\"top\" type=\"checkbox\">";
                $DelMsg = "<a href=\"game.php?page=messages&type=".$MsgType."&mode=delmsg&msgid=".$CurMsg['message_id']."\"><img border=\"0\" src=\"./styles/images/del.gif\" alt=\"Borrar\" title=\"".$lang['mg_msg_del_msg']."\" align=\"top\" width=\"16\" height=\"16\"></a>";
                $page .= "                    <tr>\n";
                $page .= "                        <td class=\"x\" width=\"3%\">" .$ChkBox."</td>\n";
                $page .= "                        <td class=\"x\" width=\"25%\">".($Leido==1 ? "<b>" : "").stripslashes( $CurMsg['message_from'] ).($Leido==1 ? "</b>" : "")."</td>\n";
                $page .= "                        <td class=\"x\" width=\"49%\"><a href=\"game.php?page=messages&type=".$MsgType."&mode=show&msgid=".$CurMsg['message_id']."\" class=\"lbOn\">".($Leido==0 ? "<div id=\"texto_normal\">" : "").stripslashes( $CurMsg['message_subject'] ).($Leido==0 ? "</div>" : "")."</a></td>\n";
                $page .= "                        <td class=\"x\" width=\"20%\">".($Leido==1 ? "<b>" : "").date("d.m.Y H:i:s", $CurMsg['message_time']).($Leido==1 ? "</b>" : "")."</td>\n";
                $page .= "                        <td class=\"x\" width=\"3%\">" .$DelMsg."</td>\n";
                $page .= "                    </tr>\n";
            }
            $page .= "                    <tr>\n";
            $page .= "                        <td colspan=\"5\"><center>\n";
            $page .= "                            <font color=\"#6699FF\"><b>( <a href=\"javascript:marcar_todos()\"><font color=\"#0080FF\">".$lang['mg_msg_mark']."</font></a> / <a href=\"javascript:desmarcar_todos()\"><font color=\"#0080FF\">".$lang['mg_msg_unmark']."</font></a> ) ".$lang['mg_msg_all_msg']."</b></font>\n";
            $page .= "                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n";
            $page .= "                            <select id=\"optdelmsg\" name=\"optdelmsg\">\n";
            $page .= "                                <option value=\"none\">".$lang['mg_msg_select_action']."</option>\n";
            $page .= "                                <option disabled=\"disabled\">-------------------------------------------</option>\n";
            $page .= "                                <option value=\"markread\">".$lang['mg_marked_read']."</option>\n";
            $page .= "                                <option value=\"markunread\">".$lang['mg_marked_unread']."</option>\n";
            $page .= "                                <option value=\"delmark\">".$lang['mg_delete_marked']."</option>\n";
            $page .= "                                <option value=\"delunmark\">".$lang['mg_delete_unmarked']."</option>\n";
            $page .= "                                <option value=\"delall\">".$lang['mg_delete_all']."</option>\n";
            $page .= "                            </select>\n";
            $page .= "                            <input value=\"".$lang['mg_confirm_delete']."\" type=\"submit\">\n";
            $page .= "                        </center></td>\n";
            $page .= "                    </tr>\n";
            $page .= "                </form>\n";
            $page .= "                </table>\n";
            $page .= "            </td>\n";
            $page .= "        </tr>\n";
            $page .= "    </table>\n";
            $page .= "    <table width=\"600\">\n";
            $page .= "        <tr>\n";
            $page .= "            <td class=\"c\"><center>.:: ".$lang['mg_total']." <font color=\"yellow\">".$NumberMsg."</font> ".$lang['mg_message_title']." ::.</center></td>\n";
        } else {
            $page .= "            <td class=\"k\">\n";
            $page .= "                <table width=\"100%\">\n";
            $page .= "                    <tr>\n";
            $page .= "                        <td class=\"k\" colspan=\"6\" height=\"100\"><b>".$lang['mg_msg_no_msg']."</b></td>\n";
            $page .= "                    </tr>\n";
            $page .= "                </table>\n";
            $page .= "            </td>\n";
        }
        $page .= "        </tr>\n";
        $page .= "    </table>\n";
        
    	$page .= "</div>\n";
    	display($page);
    }
}
?>