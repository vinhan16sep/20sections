$(document).ready(function(){
	var url = window.location.origin+'/20sections';
	/**
	 *
	 * Remove branding
	 *
	 */
	$('.branding-remove').click(function(e){
		e.preventDefault();
		var check = $(this);
		var id = $(this).data('id');
		var token = $('#token').val();
		if(confirm('Chắc chắn xóa danh mục này')){
			$.ajax({
	            url: url + '/20s-admin/branding/remove',
	            method: 'POST',
	            data: {
	                id : id , _token: token
	            },
	            success: function(res){
	            	if(res.success == true){
	            		check.parents('tr').fadeOut();
	            	}
	            },
	        });
		};
		
	});

	/**
	 *
	 * Active branding
	 *
	 */
	$('.branding-active').click(function(e){
		e.preventDefault();
		var check = $(this);
		var id = $(this).data('id');
		var token = $('#token').val();
		if(confirm('Chắc chắn thay đổi danh mục này')){
			$.ajax({
	            url: url + '/20s-admin/branding/active',
	            method: 'POST',
	            data: {
	                id : id , _token: token
	            },
	            success: function(res){
	            	if(res.success == true){
	            		 window.location.reload();
	            	}
	            },
	        });
	    };
	});
});