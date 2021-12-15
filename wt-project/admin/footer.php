	<footer class="py-2 bg-dark" id="footer" style="clear: both; position: relative; height: 75px; margin-top: 280px;">
        <p class="m-6 text-center text-white">Developed by Group 02</p>
        <p class="m-0 text-center text-white">Webtech [P] Fall-21/22</p>
    </footer>

<script type="text/javascript">
	var last_id = 5;

	$(document).ready(function(){
		var to = $('#total-orders').val();
		if(last_id >= to){
			$('#xd').hide();
		}
		else{
			$('#xd').show();	
		}
         });

	$('#viewall').click(function(){
	 	$('#xd').show();
	 });

	$('#load-more').click(function(){
		var total_order = $('#total-orders').val();
		//ajax
		$.ajax({
			url: "loadorders.php",
			method: "post",
			data: {last_id:last_id},
			dataType: "text",
			success: function(data){
				$('#load-more').hide();
				$('#loading').html("Loading...<img src='../resourses/loading.gif' height='30' width='30'>");
				window.setTimeout(function(){
					$('#loading').html('');
					$(data).appendTo('#l-data').hide().fadeIn(500);
					$('#load-more').show();
				},500);
				
				last_id += 5;
				if(last_id >= total_order){
					window.setTimeout(function(){
					$('#order-info').html('Thats all of the orders');
					$('.load-more').hide();
					},1000);
				}
			}
		});
	});
</script>

</body>
</html>

