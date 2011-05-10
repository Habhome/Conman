<?php if($status == 'emailsent'):?>
Ett mail har skickats till din registrerade mail, <?php echo $email;?>.
Klicka p� l�nken i mailet f�r att forts�tta :).

�r det inte din mail? Kontakta <a href="mailto:magnusjjj@gmail.com">magnusjjj@gmail.com - Magnus Johnsson</a>
<?php elseif($status == 'wrong_ssid'):?>
Tyv�rr �r personnummret du skrev in inte giltligt. <a href="<?php echo Router::url('index');?>">F�rs�k igen</a>
<?php elseif($status == 'not_member'):?>
Vi hittade dig inte i databasen. �r detta fel? Kontakta <a href="mailto:magnusjjj@gmail.com">magnusjjj@gmail.com - Magnus Johnsson</a><br/>
<br/>
Om detta, inte �r fel, s� f�r du (m�ste) du g�ra n�got s� peppigt som att lbli medlem i Hikari-Kai :).<br/>
Fyll i uppgifterna nedan, klicka p� n�sta. N�r du betalar din medlemsavgift blir du medlem :).<br/>
Du m�ste fylla i alla uppgifter markerade med *<br/>
<?php
	if(@$not_accepted || @$not_filled)
		echo "<ul>";
	if(@$not_accepted)
		echo "<li>Du fyllde i allt r�tt, men du gl�mde godk�nna stadgarna</li>";
	if(@$not_filled)
		echo "<li>Du har tyv�rr inte fyllt i alla f�lt du beh�vde (de �r markerade med *). F�rs�k igen.</li>";
	if(@$not_accepted || @$not_filled)
		echo "</ul>";
?>
<form action="<?php echo Router::url('register')?>" method="post">
	Juridiskt k�n*: <input type="radio" value="K" name="memberdata[gender]"<?php echo @$_REQUEST['memberdata']['gender'] == 'K' ? 'checked="checked"' : '';?>/>Kvinna<input type="radio" value="M" name="memberdata[gender]" <?php echo @$_REQUEST['memberdata']['gender'] == 'M' ? 'checked="checked"' : '';?>/>Man<br/>
	F�rnamn*: <input type="text" name="memberdata[firstName]" value="<?php echo @$_REQUEST['memberdata']['firstName'];?>"/><br/>
	Efternamn*: <input type="text" name="memberdata[lastName]" value="<?php echo @$_REQUEST['memberdata']['lastName'];?>"/><br/>
	CO-adress: <input type="text" name="memberdata[coAddress]" value="<?php echo @$_REQUEST['memberdata']['coAddress'];?>"/><br/>
	Adress*: <input type="text" name="memberdata[streetAddress]" value="<?php echo @$_REQUEST['memberdata']['streetAddress'];?>"/><br/>
	Postnummer*: <input type="text" name="memberdata[zipCode]" value="<?php echo @$_REQUEST['memberdata']['zipCode'];?>"/><br/>
	Postort*: <input type="text" name="memberdata[city]" value="<?php echo @$_REQUEST['memberdata']['city'];?>"/><br/>
	Land*: <input type="text" name="memberdata[country]" value="<?php echo @$_REQUEST['memberdata']['country'];?>"/><br/>
	Telefonnummer*: <input type="text" name="memberdata[phoneNr]" value="<?php echo @$_REQUEST['memberdata']['phoneNr'];?>"/><br/>
	Mobilnummer: <input type="text" name="memberdata[altPhoneNr]" value="<?php echo @$_REQUEST['memberdata']['altPhoneNr'];?>"/><br/>
	Email*: <input type="text" name="memberdata[eMail]" value="<?php echo @$_REQUEST['memberdata']['eMail'];?>"/><br/>
	<input type="hidden" name="pnr[0]" value="<?php echo @$_REQUEST['pnr'][0];?>"/>
	<input type="hidden" name="pnr[1]" value="<?php echo @$_REQUEST['pnr'][1];?>"/>
	Stadgar:<br/>
	<textarea rows="20" cols="50">
�1 F�RENINGENS NAMN
F�reningens namn �r Hikari-Kai.

�2 F�RENINGENS S�TE
Styrelsen har sitt s�te i G�teborg.

�3 F�RENINGSFORM
F�reningen �r en ideell f�rening.

�4 F�RENINGENS SYFTE
Hikari-kai existerar i syfte att sprida �stasiatisk kultur, i huvudsak den Japanska kulturen, fr�mst i form av arkadspel, Tv-Spel, musikspel, karaoke, anime, manga och film.

�5 OBEROENDE
F�reningen �r religi�st och partipolitiskt obunden.

�6 VERKSAMHETS�R
Verksamhets�ret �r 1 januari till 31 december.

�7 MEDLEMMAR
Som medlem antas intresserad som godk�nner dessa stadgar och aktivt tar st�llning f�r ett medlemskap genom att �rligen betala f�reningens medlemsavgift och g�ra en skriftlig anm�lan till f�reningen. Avgiftens storlek beslutas p� �rsm�tet. En medlem som allvarligt skadar f�reningen kan avst�ngas av styrelsen. Avst�ngd medlem m�ste diskuteras p� n�sta �rsm�te, medlemmen f�r r�sta i sin egen sak. Antingen s� upph�vs d� avst�ngningen eller s� utesluts medlemmen. Styrelsen eller �rsm�te kan allts� upph�va avst�ngning och uteslutning.

�8 STYRELSEN
Styrelsen ansvarar f�r f�reningens medlemslista, bidragsans�kningar, medlemsv�rvning, beslut som tas p� �rsm�ten och �vrig verksamhet. F�reningens styrelse best�r av ordf�rande, kass�r och sekreterare. Vid behov kan �ven vice ordf�rande och extra ledam�ter v�ljas. Samma person f�r inte ha flera poster i styrelsen. Styrelsen v�ljs p� �rsm�te och tilltr�der direkt efter valet. Valbar �r medlem i f�reningen.

�9 REVISORER
F�r granskning av f�reningens r�kenskaper och f�rvaltning v�ljs p� �rsm�te en eller tv� revisorer. Valbar �r person som inte sitter i styrelsen. Revisor beh�ver inte vara medlem i f�reningen.

�10 VALBEREDNING
F�r att ta fram f�rslag p� personer till de i stadgarna f�reskrivna valen kan �rsm�tet v�lja en eller flera valberedare. Valbar �r medlem i f�reningen.

�11 ORDINARIE �RSM�TE
Ordinarie �rsm�te ska h�llas senast den 31 mars varje �r. Styrelsen beslutar om tid och plats. F�r att vara beh�rigt m�ste f�reningens medlemmar meddelas minst tv� veckor i f�rv�g. F�ljande �renden ska alltid behandlas p� ordinarie �rsm�te:
1. ) m�tets �ppnande
2. ) m�tets beh�righet
3. ) val av m�tets ordf�rande
4. ) val av m�tets sekreterare
5. ) val av tv� personer att justera protokollet
6. ) styrelsens verksamhetsber�ttelse f�r f�rra �ret
7. ) ekonomisk ber�ttelse f�r f�rra �ret
8. ) revisorernas ber�ttelse f�r f�rra �ret
9. ) ansvarsfrihet f�r f�rra �rets styrelse
10. ) �rets verksamhetsplan
11. ) �rets budget och fastst�llande av medlemsavgift
12. ) val av �rets styrelse
13. ) val av �rets revisor
14. ) val av �rets valberedare
15. ) �vriga fr�gor
16. ) m�tets avslutande

�12 EXTRA �RSM�TE
Om styrelsen eller revisor vill eller minst h�lften av f�reningens medlemmar kr�ver det skall styrelsen kalla till extra �rsm�te. Vid giltigt krav p� extra �rsm�te kan den som kr�vt det sk�ta kallelsen. F�r att vara beh�rigt m�ste f�reningens medlemmar meddelas minst tv� veckor i f�rv�g. P� extra �rsm�te kan bara de �renden som n�mnts i kallelsen behandlas.

�13 FIRMATECKNING
F�reningens firma tecknas av ordf�rande och kass�r var f�r sig. Om s�rskilda sk�l f�religger kan annan person utses att teckna f�reningens firma.

�14 R�STR�TT
Endast fullt betalande n�rvarande medlem har r�str�tt p� �rsm�te. P� styrelsem�ten har endast n�rvarande ur styrelsen r�str�tt. R�stning via fullmakt godtas vid beslut av �rsm�tet

�15 R�STETAL
Alla fr�gor som behandlas p� �rsm�te eller styrelsem�te avg�rs med enkel r�st�vervikt om inget annat st�r i stadgarna. Nedlagda r�ster r�knas ej. Varje person med r�str�tt har en r�st. Vid lika r�stetal f�r ordf�randet avg�ra.

�16 STADGA�NDRING
Dessa stadgar kan �ndras endast vid �rsm�te eller extra �rsm�te. I kallelsen m�ste det st� att stadge�ndring kommer att behandlas. F�r att �ndra i stadgarna kr�vs att minst tv� tredjedelar av de avgivna r�sterna bifaller �ndringen. F�r �ndring av stadgan om (f�reningens syfte) �4, Stadge�ndring �16 och Uppl�sning �17 kr�vs att beslutet tas p� tv� p� varandra f�ljande ordinarie �rsm�ten.

�17 UPPL�SNING
Uppl�sning av f�reningen kan endast ske genom beslut p� �rsm�te. Beslut om uppl�sning skall fattas med minst tv� tredjedelars majoritet. F�rslag om uppl�sning skall finnas upptaget p� kallelsen till �rsm�tet.Vid f�reningens uppl�sning �verl�mnas eventuella tillg�ngar till av �rsm�tet beslutat �ndam�l.
	</textarea>
	<br/>
<input type="checkbox" name="seen_rules" value="1"/> * Jag godk�nner dessa stadgar, och till�ter Hikari-Kai att spara mina uppgifter
<input type="submit" value="N�sta!"/>
</form>
<?php endif;?>