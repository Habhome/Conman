<?php if(!$valid):?>
Tyv�rr s� st�mde inte din aktiveringskod �verrens med vad vi har lagrat. Kontakta administrat�ren av sidan :).
<?php else:?>
Bara ett steg kvar!
Nu ska du bara knyta en anv�ndare till ditt medlemskap, sedan �r du klar :D
<form action="<?php echo Router::url('createuser')?>" method="post">
	Anv�ndarnamn: <input type="text" name="username"/><br/>
	L�senord: <input type="password" name="password"/><br/>
	L�senord (igen):<input type="password" name="password_again"/><br/>
	<input type="hidden" name="SSN" value="<?php echo $SSN;?>"/>
	<input type="hidden" name="code" value="<?php echo $code;?>"/>
	<input type="submit" value="Skapa anv�ndare!"/>
</form>
<?php endif;?>