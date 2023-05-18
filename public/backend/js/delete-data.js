	function deleteData(id,url,token,table){
		if (confirm("Are you sure you want to delete?")) {
			$.ajax({
				
        url: url,
        type: "DELETE",
        data: {
            "id": id,
            "_token": token,
        },

        success: function(response) {
	        if (response.success) {
	        	notifyMsg(response.message,'success');
	            table.ajax.reload(null, false);
	        } else {
	        	notifyMsg(response.message,'error');
	        }
        }
      });
		}
	}
