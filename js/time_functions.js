$(document).ready(function(){

	$.ajax({
		type: 'post',
		url : 'http://localhost:8888/blipp_contest/login/get_times.php',
		dataType : 'json',
		success: function(data){
			for(var i=0;i<data.length;i++){
				//there are 720 minutes in 12 hours, which means that by the face of a clock, half a degree of rotation per minute...
				var time = data[i]['time'];
				var hours = parseInt(time.split(":")[0]);
				var minutes = parseInt(time.split(":")[1]);
				if(hours > 12){
					var twelve = 12;
					var clock = 'pm';
				}
				else {
					var twelve = 0;
					var clock = 'am';
				}
				var totalMinsAfterTwelve = (hours - twelve)*60 + minutes;
				var degrees = totalMinsAfterTwelve / 2;
				$('.'+clock+'_clock').append("<img src='../images/hand.png' style='transform:rotate("+degrees+"deg)'></img>");				
			}
		}
	});
	
});