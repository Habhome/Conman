<?php

?>

<style type="text/css">
label{
	display: block;
}
</style>
<div style="width: 800px;">
<form action="<?php echo Router::url("login");?>" method="post" style="float: left; width: 200px;">
	<fieldset>
		<legend>Logga in</legend>
		<label for="username">Anv�ndarnamn:</label><input type="text" name="username"/><br/>
		<label for="password">L�senord:</label><input type="password" name="password"/><br/>
		<input type="submit" value="Logga in"/>
	</fieldset>
</form>
<form action="<?php echo Router::url("register");?>" method="post" style="float: right; width: 400px;">
	<fieldset>
		<legend>Skapa anv�ndare</legend>
		F�rst beh�ver vi kolla om du redan �r medlem i Hikari-Kai. F�r att g�ra det, skriv in ditt personnummer nedan och tryck p� 'n�sta'.<br/>
		<label for="pnr[0]">Personnummer:</label> <input type="text" size="3" maxlength="6" name="pnr[0]"/>-<input type="text" size="1" maxlength="4" name="pnr[1]"/><br/>
		<input type="submit" value="N�sta"/>
	</fieldset>
</form>
</div>