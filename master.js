$(function(){

		$('#search').keyup(function(event){
				var keyCode = event.which; // check which key was pressed
				var name = $(this).val(); // get the complete input
				console.log(name);
				var nothing = 'nothingLOL';
				if(name != '')
					{
							 $.ajax({
										url:"php.php",
										method:"POST",
										data:{search:name},
										success:function(data){
												 $('#tbody').html(data);
												 console.log('success!');
										}
							 });
					}
				else{
					$.ajax({
							 url:"php.php",
							 method:"POST",
							 data:{show:nothing},
							 success:function(data){
										$('#tbody').html(data);
										console.log('success!');
							 }
					});
				}
		});
});
