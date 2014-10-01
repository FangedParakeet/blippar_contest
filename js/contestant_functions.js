$(document).ready(function(){
	$.ajax({
		type: 'post',
		url : 'http://localhost:8888/blipp_contest/login/contestants.php',
		dataType : 'json',
		success: function(data){
			for(var i = 0; i < data.length; i++){
				var serial = i+1,
					thename = data[i]['name'],
					fid = data[i]['fbookId'],
					tid = data[i]['twitId'],
					prize = data[i]['prize'],
					date = data[i]['date'],
					loc = data[i]['location'];
					
					$('#contestants tbody').append("<tr><td>"+serial+"</td><td>"+thename+"</td><td>"+fid+"</td><td>"+tid+"</td><td>"+prize+"</td><td>"+date+"</td><td>"+loc+"</td></tr>");
			
			}
	        $("#contestants").tablesorter({
			    dateFormat: "uk",
			    headers: {
			        // set "sorter : false" (no quotes) to disable the column
					0: {
						sorter: 'digit'
					},
					1: {
						sorter: 'text'
					},
					2: {
						sorter: 'digit'
					},
					3: {
						sorter: 'digit'
					},
					4: {
						sorter: 'text'
					},
					5: {
						sorter: 'shortDate'
					}
			    }
			});
			$('#contestants').tablesorterPager({
				container: $('#paginator')
			});
			
		}
	});
	
});