<!DOCTYPE html>
<html>
	<head>
		<title>Entré</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="<?php echo Settings::$path;?>js/jquery.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo Settings::$path;?>templates/ajax/entrance.css"/>
		<script type="text/javascript">
			$(function(){
				$(".focusme").focus();
				$(".back").click(function(){
					window.location = "<?php echo Router::url('index');?>";
				});
			});
		</script>
	</head>
	<body>
		<?php //var_dump($member_want);
			echo $_POST['SSN'];
		?>
		<form action="<?php if(empty($_REQUEST['SSN'])):?><?php echo Router::url('check');?><?php else:?><?php echo Router::url('checkin');?><?php endif;?>" method="POST">
		<div id="heading">
			<h1>Entré</h1>
		</div>
		<div id="content">
			<div style="width: 40%; padding: 1%; margin-left: auto; margin-right: auto; background-color: #FFAAAA; margin-top: 2em; border: 0.1em dashed red;">
				<?php if($member_want):?>
					Ser det konstigt ut? När det gäller medlemmar finns det ett problem, samma medlem kan ha flera användare.<br/>
					Om det ser konstigt ut, eller om saker saknas kan det vara att det finns en dublett. Peta på teknikern om det är så.
				<?php endif;?>
			</div>
			<div class="centercontent">
			<?php if(false):?>
				<h1>Scanna in en biljett, ordernummer, eller skriv in ett personnummer nedan</h1>
					<input type="text" value="" name="SSN" class="focusme"/>
				(Personnummer är i formatet <strong>ÅÅMMDD-XXXX</strong>)
				<div class="error">
					Kunde inte hitta en order. Försök igen.
				</div>
			</div>
			<?php else:?>
				<h1><?php echo $member_want['firstName'] . ' ' . $member_want['lastName'];?><?php if(!empty($order_want)):?><?php if($order_want[0]['status'] == 'COMPLETED'):?><p style="color: green;">(BETALT)</p><?php else:?><p style="color: red;">(EJ BETALD)<p><?php endif;?></h1><?php else:?></h1><?php endif;?>
				<hr/>
				<?php if(!empty($order_want)):?>
					<?php if(@$order_want[0]['status'] == 'COMPLETED'):?><?php else:?>
						<p style="color: red;">
							Viktigt! När du trycker 'Nästa' kommer ordern markeras som betald, om den inte redan är så markerad. <br/>Du måste alltså ta betalt för att få lämna ut saker.
						</p>
					<?php endif;?>
				<?php endif;?>
				<table>
					<thead style="text-align: left;">
						<tr>
							<th>Antal</th><th>Uthämtad</th><th>Namn</th><th width="1%" style="text-align: right;">Kostnad</th>
						</tr>
					</thead>
					<tbody style="text-align: left;">
						<?php foreach($orders_values_want as $thing):?>
							<tr>
								<td width="5%" style="text-align: center"><?php echo $thing['ammount'];?></td><td width="10%" style="font-family: monospace;"><input type="checkbox" name="value[<?php echo $thing['value_id'];?>]" value="y"<?php echo $thing['given'] ? ' checked="checked" ' : '';?>/></td><td><?php echo $thing['name'];?></td><td><?php echo $thing['cost'];?>kr</td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				<?php 
					$canContinue = true;
					$sleepinghall = mysql_query("SELECT * FROM sleepinghalls_selections WHERE user_id = '".$user_want['id']."'");
					$row = mysql_fetch_assoc($sleepinghall);
					$sleepinghallnick = mysql_query("SELECT * FROM sleepinghalls_halls WHERE nr = '".$row["hall"]."'");
					$row = mysql_fetch_assoc($sleepinghallnick);
					
					function getNrTickets($hallnr)
					{
						//Hämta antal biljetter i en viss sovsal
						$orders = mysql_query("SELECT * FROM `sleepinghalls_selections` WHERE `hall` = '".$hallnr."'");
						return mysql_num_rows($orders);

					}
					
					if(isset($_POST['sleepinghall']))
					{
						$result = mysql_query("SELECT * FROM `sleepinghalls_halls` WHERE `nr` = '".$_POST["sleepinghall"]."'");
						$row = mysql_fetch_assoc($result);

						$ticket = mysql_query("SELECT * FROM `sleepinghalls_selections` WHERE `user_id` = '".$user_want['id']."'");
						$user_num_ticket = mysql_num_rows($ticket);

						if ($row["free_places"] > getNrTickets($row["nr"])){
								mysql_query("INSERT INTO `sleepinghalls_selections` VALUES ('".$user_want['id']."','".$row["nr"]."')");
						}else{
							   echo "Sovsalen har blivit full, välj en annan.";
						}
					}
				?>
				<br/>	
				<?php if(!empty($row["nickname"])): ?>
				<h2>Sover i:  <?php echo $row["nickname"]; ?>	</h2>
				<?php else: ?>
					<?php 
						$nr = 0; // Börja med antal = noll
						$orders = mysql_query("SELECT * FROM `orders` WHERE `status`='COMPLETED' AND `user_id` = '".$user_want['id']."'");
						while($orderdata = mysql_fetch_array($orders)){
								$order = mysql_query("SELECT * FROM `orders_values` WHERE `order_id` = '".$orderdata["id"]."' AND `order_alternative_id` = '4'");
								while ($row = mysql_fetch_array($order)){
										if (isset($row["ammount"])){
												$nr += 1 * $row["ammount"];
										}
								}
						}
						if($nr > 1)
						{
							echo "<h2>Personen har mer än en sovsalsbiljett, <br/>Skicka till sovsalskassa.</h2>";
						}
						elseif($nr == 1)
						{
							echo "<h2>Personen har inte valt någon sovsal. <br/>Välj sal:</h2>";							
							echo "<select name='sleepinghall' onchange = 'javascript:document.forms[\"sleepform\"].elements[\"sleepinghall\"].value = this.options[this.selectedIndex].value;'>";
							$result = mysql_query("SELECT * FROM `sleepinghalls_halls`");
							while($row = mysql_fetch_array($result))
							{
								if ($row["free_places"] > getNrTickets($row["nr"]))
								{
									if(empty($value))
										$value = $row['nr'];
										
									echo "<option value = '".$row["nr"]."'>".$row["nickname"]."</option>";
								}
							}
							echo "</select><input type='button' onClick = 'javascript:document.forms[\"sleepform\"].submit();' value='Spara' style = 'width:45px;height:22px;font-size:10px;'/><br/>";
							echo "(Detta val kan INTE ändras!)";
							$canContinue = false;
						}
						else
						{
							echo "<h2>Personen har ingen sovsalsbiljett</h2>";
						}
					?>
				<?php endif; ?>
			<?php endif;?>
		</div>
		<div id="commands">
			<table class="actions" border="0">
			<tr>
				<?php if(empty($_REQUEST['SSN'])):?>
				<td>
					<input type="submit" value="Nästa (Enter)"/>
				</td>
				<?php else:?>
				<td>
					<input type="button" class="back" value="Avbryt"/>
				</td>
				<td>
					<input type="submit" value="Nästa" <?php if (!$canContinue) echo "disabled=\"true\""; ?>/>
				</td>
				<?php endif;?>
			</tr>
			</table>
		</div>
			<?php if(!empty($order_want)):?><input type="hidden" name="order_id" value="<?php echo $order_want[0]['id'];?>"/><?php endif;?>
		</form>
		<form name = 'sleepform' action = '<?php echo Router::url('check'); ?>' method = 'POST'>
			<input type = 'hidden' name = 'SSN' value = '<?php echo $_POST['SSN']; ?>'/>
			<input type = 'hidden' name = 'sleepinghall' value = '<?php echo $value; ?>'/>
		</form>
	</body>
</html>
