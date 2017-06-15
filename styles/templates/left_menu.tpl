<div id='leftmenu'>
	
<script language="JavaScript">
function f(target_url,win_name) {
  var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=550,height=280,top=0,left=0');
  new_win.focus();
}
function mi_menu(nombremenu){
	if (document.getElementById(nombremenu).style.display == "none"){
		document.getElementById(nombremenu).style.display="";
	}
	else
	{
		document.getElementById(nombremenu).style.display="none";
	}
}
</script>

<center>
<div id='menu'>

<p style="width:110px;"><NOBR>{servername} (<a href="game.php?page=changelog">{version}</a>)</NOBR></p>
<table width="112" cellspacing="0" cellpadding="0">
    <tr>
        <td><img src="{dpath}gfx/ogame-produktion.jpg" width="110" height="40" /></td>
    </tr>
</table>

<table width="112" cellspacing="0" cellpadding="0">   
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=overview'>{lm_overview}</a>
            </font></div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=imperium'>{lm_empire}</a>
            </font></div>
        </td>
    </tr>
 	<tr>
		<td class="c" align="center"><a href="#" onClick="mi_menu('devlp')" ><font color="#D7DF01">{devlp}</font></a></td>
	</tr>
</table>

<div id="devlp">
<table width="112" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=buildings'>{lm_buildings}</a>
            </font></div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=buildings&mode=fleet'>{lm_shipshard}</a>
            </font></div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=buildings&mode=defense' accesskey="d">{lm_defenses}</a>
            </font></div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=buildings&mode=research'>{lm_research}</a>
            </font></div>
        </td>
    </tr>
</table>
</div>

<table width="112" cellspacing="0" cellpadding="0">
  	<tr>
		<td class="c" align="center"><a href="#" onClick="mi_menu('navig')" ><font color="#D7DF01">{navig}</font></a></td>
	</tr>
</table>

<div id="navig">
<table width="112" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=fleet'>{lm_fleet}</a>
            </font></div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=galaxy&mode=0'>{lm_galaxy}</a>
            </font></div>
        </td>
    </tr>
</table>
</div>

<table width="112" cellspacing="0" cellpadding="0">
	<tr>
		<td class="c" align="center"><a href="#" onClick="mi_menu('observ')" ><font color="#D7DF01">{observ}</font></a></td>
	</tr>
</table>

<div id="observ">
<table width="112" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=resources'>{lm_resources}</a>
            </font></div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=statistics&range={user_rank}'>{lm_statistics}</a>
            </font></div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=techtree'>{lm_technology}</a>
            </font></div>
        </td>
    </tr>
</table>
</div>

<table width="112" cellspacing="0" cellpadding="0">
	<tr>
		<td class="c" align="center"><a href="#" onClick="mi_menu('comercio')" ><font color="#D7DF01">{comercio}</font></a></td>
	</tr>
</table>

<div id="comercio">
<table width="112" cellspacing="0" cellpadding="0">
 	<tr>
        <td>
            <div align="center"><font color="#FFFFFF">
	   		<a  href='game.php?page=officier'><font color='FF8900'>{lm_officiers}</font></a>
            </font></div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center" ><font color="#FFFFFF">
            <a href='game.php?page=trader'><font color='FF8900'>{lm_trader}</font></a> 
            </font></div>
        </td>
    </tr>
</table>
</div>

<table width="112" cellspacing="0" cellpadding="0">
	<tr>
		<td class="c" align="center"><a href="#" onClick="mi_menu('commun')" ><font color="#D7DF01">{commun}</font></a></td>
	</tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=messages'>{lm_messages} {nuevos_msj}</a>
            </font></div>
        </td>
    </tr>
</table>

<div id="commun" style="display:none;">
<table width="112" cellspacing="0" cellpadding="0">
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=alliance'>{lm_alliance}</a>
            </font></div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=search'>{lm_search}</a>
            </font></div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href="#" onClick="f('game.php?page=notes', '{lm_notes}')">{lm_notes}</a>
            </font></div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=buddy'>{lm_buddylist}</a>
            </font></div>
        </td>
    </tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href="{forum_url}" target="_blank">{lm_forums}</a>
            </font></div>
        </td>
    </tr>
</table>
</div>

<br />

<table width="112" cellspacing="0" cellpadding="0">
	<tr>
		<td class="c" align="center"><font color="#D7DF01">{servidor}</font></td>
	</tr>
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=options'>{lm_options}</a>
            </font></div>
        </td>
    </tr>
    {admin_link}
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href='game.php?page=logout'>{lm_logout}</a>
            </font></div>
        </td>
    </tr>
    <tr >
        <td><img src="{dpath}img/bg1.jpg" width="110" height="2" /></td>
    </tr>    
    <tr>
        <td>
            <div align="center"><font color="#FFFFFF">
            <a href="#" title="Powered by XG Proyect {version} &copy; 2008 - 2010 GNU General Public License">&copy; 2008 - 2010</a>
            </font></div>
        </td>
    </tr>
</table>

</center>
</div>

<!-- END LEFTMENU -->