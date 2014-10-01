$(document).ready(function(){
	
	$('.submit_button').click(function(){
		$('.preloader_overlay').show();
		$.ajax({
			url: 'api/checker.php',
			type: 'GET',
			success: function(data){
				$('.preloader_overlay').hide();
				var xmlDoc = $.parseXML(data),
					$xml = $(xmlDoc),
					$prize = $xml.find('prize');
				$('.submit').fadeOut(function(){
					switch($prize.text()) {
						case '0':
							var result = "Sorry, you didn't win today!";
							var winner = false;
							break;
						case '1': 
							var result = "You won a free t-shirt!";
							var winner = true;
							break;
						case '2':
							var result = "You won a free cap!";
							var winner = true;
							break;
						case '3':
							var result = "You won a free music download!";
							var winner = true;
							break;
						default:
							var result = "Please try again in 24 hours";
							var winner = false;
					}
					$('.results p').html(result);
					if(winner){
						$('.results').append('<a href="https://www.facebook.com/dialog/oauth/?client_id=351030431737051&redirect_uri=http://localhost:8888/blipp_contest/api/redeem_fbook.php&scope=email,public_profile">Redeem Via Facebook <img src="images/fbook.jpg" width="15px"></img></a><br />');
						$('.results').append('<a href="http://localhost:8888/blipp_contest/api/twitteroauth/redirect.php">Redeem Via Twitter <img src="images/twitterbird.png" width="15px"></img></a>');
					}
					$('.results').fadeIn();
				});
			}
			
		})
	});
	
	if(document.URL.split("?cheater=")[1] != undefined && /true/.test(document.URL.split("?cheater=")[1].split("&")[0])){
		$('.submit').fadeOut(function(){
			$('.results p').html('Please try again in 24 hours');
			$('.results').fadeIn();
		});
	}
	
});