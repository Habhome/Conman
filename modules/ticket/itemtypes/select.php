<?php if(file_exists(__DIR__ . '/../../../products/'.$alternative['id'].'.png')):?><a class="fancybox" href="<?php echo Settings::$path;?>products/<?php echo $alternative['id'];?>.png"><?php endif;?><?php echo $alternative['name'];?><?php if(file_exists(__DIR__ . '/../../../products/'.$alternative['id'].'.png')):?></a><?php endif;?>
</td>
<td>
	<select name="ammount[<?php echo $alternative['id'];?>]">
        	<?php for($i = 0; $i <= $alternative['max_in_view']; $i++):?>
                	<option <?php if(@$_REQUEST['ammount'][$alternative['id']] == $i):?> selected="selected" <?php endif;?>><?php echo $i;?></option>
                <?php endfor;?>
        </select>
</td>
<td><?php echo $alternative['cost'];?>kr</td>
<td width="400"><?php if(!empty($alternative['description'])):?> <?php echo '<div class="italic">' . $alternative['description'];?><?php endif;?><br/>
	
	<!-- NärCon-fix-->
	<?php if ($alternative['name'] == 'T-shirt' || $alternative['name'] == 'NärCon-kit') {
		echo 'Välj t-shirt:';
	} else {
		echo 'Välj typ: ';
	}
	?>
<select name="val[<?php echo $alternative['id'];?>]">
<?php
	$opt = @json_decode($alternative['extra']);
	if(!empty($opt->allowEmpty) && $opt->allowEmpty != false):
?>
	<option value="NULL">Ingen</option>
	<?php endif;?>
	<?php
		
		foreach($alternatives_children[$alternative['id']] as $child)
		{
			if(!empty($child['template_override'])){
				print_alternative($child, $alternatives_children);
			} else {
				?><option value="<?php echo $child['id'];?>" <?php if(@$_REQUEST['val'][$alternative['id']] == $child['id']):?> selected="selected" <?php endif;?>/><?php echo $child['name'];?> (<?php echo $child['cost'];?> kr)</option><?php				
			}
		}
	?>
</select>
<?php if(!empty($alternative['description'])):?> <?php echo '</div>';?><?php endif;?> <!-- Fullösning >_< -->
<br/>
