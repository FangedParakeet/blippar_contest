$(document).ready(function(){
	$('#login_submit').click(function(){
		if($('#username').val() == ""){
			$('#errors').html('Username cannot be left blank');
			$('#errors').fadeIn();
			return false;
		}
		else if($('#password').val() == ""){
			$('#errors').html('Password cannot be left blank');
			$('#errors').fadeIn();
			return false;
		}
		else {
			$('#errors').fadeOut();
			return true;
		}

	});
	
	if(document.URL.split("?sneaky=")[1] != undefined && /true/.test(document.URL.split("?sneaky=")[1].split("&")[0])){
		$('#errors').html("You're not supposed to be there!");
		$('#errors').fadeIn();
	}
	else if(document.URL.split("?login=")[1] != undefined && /false/.test(document.URL.split("?login=")[1].split("&")[0])){
		$('#errors').html("Username and password do not match");
		$('#errors').fadeIn();
	}
	
	
	
});