<?php
session_start();


$_SESSION["gb"]++;



?>

<script language="javascript">
<!--

function regler()
{
        if ((document.form.vname.value == "Erik @ splutt.net") || (document.form.vname.value == "Erik @ Splutt.net") || (document.form.vname.value == "Erik @ Splutt.Net") ||  (document.form.vname.value == "erik @ splutt.net"))
        {
		document.form.vname.value = "";
        	alert('Var det d�r n�dv�ndigt?');
        	return false;
        }
	if (document.form.vname.value == "")
        {
		
        	alert('Du har v�l ett namn?!');
        	return false;
        }
	if (document.form.vcomment.value == "")
        {
		
        	alert('Varf�r skriva ett inl�gg om det �r tomt?');
        	return false;
        }
        if ((document.form.vname.value == "Erik") || (document.form.vname.value == "erik")))
        {
		document.form.vname.value = "Erik (Inte admin)";
        	return true;
        }

}


//-->
</script>

<form method="post" action="http://www.lycktraffen.se/nydesign/gb.php" name="form" onSubmit="return regler()">
      <input type="hidden" name="do" value="add">
            <table border="0">
	     <tr>
		<td>Namn:</td>
		<td><input type="text" name="vname"  ></td>
	     </tr>
              <tr>
                <td width="100">
                  Ditt meddelande:
                </td>
                <td>
                <textarea name="vcomment" cols="50" rows="5"></textarea>
                </td>
              </tr>
            </table>
         <input type="submit" value="Skicka ditt meddelande">
<hr>
</form>


