	            <input id="localip" type="hidden" value="<?php echo($backupbox->local_ip); ?>" />
	            <div id="deb" style="display: none;"></div>
	            <ul class="devices">
	            <?php 
	            foreach($devicelist as $d) { ?>
		            <li>
		            	<a href='#'>
		            		<img class="deviceicon locked" src='<?php echo base_url()."assets/img/".$d->icons[$d->type] ?>.png' /></a>
		            	<br />
		            	<a href='#'><?php echo $d->name ?></a>
		            	<div class='info' id='<?php echo $d->id ?>'>
		            		<table>
			            		<tr>
			            			<td align="left">Size</td><td align="right"><?php echo $d->device_size ?></td></tr>
			            			<td align="left">Backup Size</td><td align="right"><?php echo $d->backup_size ?></td></tr>
			            			<td align="left">Last Backup</td><td align="right"><?php echo substr($d->last_successful_backup, 0, 10) ?></td></tr>
		            		</table>
		            	</div>
		            </li> <?php
	            }
	             ?>
	             <br class="clear" />
	             </ul>