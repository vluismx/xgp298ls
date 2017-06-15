<?php

##############################################################################
# *																			 #
# * XG PROYECT																 #
# *  																		 #
# * @copyright Copyright (C) 2008 - 2009 By lucky from xgproyect.net      	 #
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

function ShowLeftMenu ()
{
	global $game_config, $dpath, $lang, $user;

	$parse					= $lang;
	$parse['dpath']			= $dpath;
	$parse['version']   	= VERSION;
	$parse['servername']	= $game_config['game_name'];
	$parse['forum_url']     = $game_config['forum_url'];
	$parse['user_rank']     = $user['total_rank'];

	if ($user['authlevel'] > 0)
	{
		$parse['admin_link']	="<tr><td><div align=\"center\"><a href=\"javascript:top.location.href='adm/index.php'\"> <font color=\"lime\">" . $lang['lm_administration'] . "</font></a></div></td></tr>";
	}
	else
	{
		$parse['admin_link']  	= "";
	}
    
    $CurNewMessage = doquery("SELECT COUNT(`message_type`) AS msg_count FROM {{table}} WHERE `message_owner` = '".$user['id']."' AND `message_read` = '1';", 'messages',true);
    if ($CurNewMessage['msg_count'] != 0)
    {
        $parse['nuevos_msj'] = "<font color=\"lime\">(".$CurNewMessage['msg_count'].")</font>";
    }
    else 
    {
        $parse['nuevos_msj'] = "";
    }

	return parsetemplate(gettemplate('left_menu'), $parse);
}
?>