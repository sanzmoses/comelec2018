var data = 1;
$(function(){

	$('.render').on('click', function(){
		var v = 1;
		$.ajax({
			url: 'php.php',
			method: 'GET',
			format: 'json',
			data: {results:v},
			success: function(log){
				console.log('returned success');
				data = log;
			},
			error: function(log){
				console.log(log);
			}
		});
	});	

});
