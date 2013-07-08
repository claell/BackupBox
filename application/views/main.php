<?php $this->load->view('header') ?>

  <div class="container">
      <div class="row">
      	  <div id="dd"></div>
          <div class="device-list">
             <?php
	             if($is_admin) { ?>
				  <div id="box_holder">
				  	<?php
					foreach($all_boxes as $b) {
				  	?>
		          	<div id="<?php echo($b->id); ?>" class="box_content">
		          		<?php
		          		if((time() - strtotime($b->last_ping)) > 60) { ?>
				  			<a href="#" class=""><img src="<?php echo base_url() ?>assets/img/box_offline.png" /></a><br />
		          		<?php	
		          		} else  { ?>
				  			<a href="#" class=""><img src="<?php echo base_url() ?>assets/img/box_online.png" /></a><br />		          		
		          		<?php 
		          		}
		          		?>
			            <div class="info">
			            	<table>
			            	<?php
				            	echo "<tr><td>Public IP</td><td>".$b->public_ip."</td></tr>";
				            	echo "<tr><td>Local IP</td><td>".$b->local_ip."</td></tr>";
				            	echo "<tr><td>Used space</td><td>".$b->free_space."</td></tr>";			            	
			            	?>
			            	</table>
			            </div>
		            </div>
		            <?php
			        }    
		            ?>
		          <br class="clear" />
		          </div>
		          <div id="device_container">  
		          </div>
	         <?php } else {
             ?>
				  <div id="box_holder">
		          	<div class="box_content">
			            <img src="<?php echo base_url() ?>assets/img/box_online.png" /><br />
			            <div class="info">
			            	<table>
			            	<?php
				            	echo "<tr><td>Last online</td><td>".date('y/m/d h:i', strtotime($backupbox->last_ping))."</td></tr>";
				            	echo "<tr><td>Public IP</td><td>".$backupbox->public_ip."</td></tr>";
				            	echo "<tr><td>Local IP</td><td>".$backupbox->local_ip."</td></tr>";
				            	echo "<tr><td>Total size</td><td>".$backupbox->available_space."</td></tr>";
				            	echo "<tr><td>Used space</td><td>".$backupbox->free_space."</td></tr>";			            	
			            	?>
			            	</table>
			            </div>
		            </div>
		            <br style="clear:both;" />
		          </div>
		        <div id="device_container">  
		            <ul class="devices">
		            <?php 
		            foreach($devices as $d) { ?>
			            <li>
			            	<a href='#'>
			            		<img src='<?php echo base_url()."assets/img/".$d->icons[$d->type] ?>.png' /></a>
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
		             <br style="clear:both;" />
		             </ul>
				</div>
             <?php
	             }
             ?>
          </div>
      </div><!-- row -->      
  </div>
  </div>

  <!-- ****************************************************************** -->
  <!--                        NEW USER Modal Window                       -->
  <!-- ****************************************************************** -->

  <div class="modal hide" id="myModal">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">x</button>
      <h3>New User Details</h3>
    </div>
    <div class="modal-body">
        <p><input type="text" class="span4" name="first_name" id="first_name" placeholder="First Name"></p>
        <p><input type="text" class="span4" name="last_name" id="last_name" placeholder="Last Name"></p>
        <p><input type="text" class="span4" name="email" id="email" placeholder="Email"></p>
        <p>
          <select class="span4" name="teamId" id="teamId">
            <option value="">Team Number...</option>
            <option value="1">1</option>
            <option value="2">2</option>
          </select>
        </p>
        <p>
          <label class="checkbox span4">
            <input type="checkbox" id="isAdmin" name="isAdmin"> Is an admin?
          </label>
        </p>
        <p><input type="password" class="span4" name="password" id="password" placeholder="Password"></p>
        <p><input type="password" class="span4" name="password2" id="password2" placeholder="Confirm Password"></p>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn btn-warning" data-dismiss="modal">Cancel</a>
      <a href="#" id="btnModalSubmit" class="btn btn-primary">Create</a>
    </div>
  </div>
<?php $this->load->view('footer') ?>