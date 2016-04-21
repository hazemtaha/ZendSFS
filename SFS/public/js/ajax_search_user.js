var searchUser = function(e){
	e.preventDefault();
var result=$("#search").val();
		$.ajax({
		url:"/ZendSFS/SFS/public/user/admin-search-user",
		method:'post',
		data:{
			"value":result
			
		},
		success:function(response){
			console.log("success");
				},
		error:function(ayaad,status,error){
			console.log(result);
			console.log(error);
		},
		complete:function(ayaad){
			console.log("Complete ");
		},
		//dataType:'xml',
		async:true

	});

     }

$('#search').keyup(searchUser);




    

