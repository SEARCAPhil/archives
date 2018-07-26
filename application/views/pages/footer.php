	</body>
</html>
<script src="<?php echo base_url(); ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/javascripts/jquery.tablesorter.min.js"></script>
<script>
$(document).ready(function(){
	$("#listTable").tablesorter( {sortList: [[0,0]]} );

});
</script>