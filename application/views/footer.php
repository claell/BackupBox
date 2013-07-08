<script src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url();?>/js/vendor/jquery-1.9.0.min.js"><\/script>')</script>
<script src="<?php echo base_url();?>/assets/js/vendor/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/main.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('.box_content').click(function() {

		$('#device_container').load('/index.php/main/devices/'+this.id, function() {
			var local_ip = $("#localip").attr("value");

			var img = new Image();
			img.onload = function() {
			  if(this.height == 10) {
				  $(".deviceicon").removeClass("locked").addClass("unlocked");
				  
			  }
			}

			img.src = 'http://'+local_ip+'/blank.png';

		});

    });
});

function getImgSize(imgSrc)
{
	var newImg = new Image();
	newImg.src = imgSrc;
	return newImg.height;
}
</script>


</body>
</html>
