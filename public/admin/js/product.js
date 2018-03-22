$(document).ready(function(){
	var domain = window.location.origin+'/20sections';
	/**
	 *
	 * Select Branding for create and edit product
	 *
	 */
	
	$('#products_category').change(function(){
		var url = '/20s-admin/product/selectBranding'
		var category_id = $(this).val();
		var token = $( "input[name='_token']" ).val();
		$.ajax({
                  url: domain + url,
                  method: 'POST',
                  data: {
                      category_id : category_id , _token: token
                  },
                  success: function(res){
                  	if(res.success == true){
                  		var branding = res.branding;
                  		$('#products_branding').html('<option value="">Chon danh thương hiệu</option>');
                  		branding.forEach(function (index) {
                  			option = '<option value="';
                  			option += index.id;
                  			option += '">';
                  			option += index.name;
                  			option += '</option>';
                  			$('#products_branding').append(option);
      					});
                  	}else{
                  		$('#products_branding').html('<option value="">Chưa có thương hiệu cho danh mục trên</option>');
                  	}
                  },
            });
	});


      /**
       *
       * Auto select Branding when window on load
       *
       */
      $('#products_category').each(function(){
            var url = '/20s-admin/product/selectBranding'
            var category_id = $(this).val();
            var token = $( "input[name='_token']" ).val();
            $.ajax({
                  url: domain + url,
                  method: 'POST',
                  data: {
                      category_id : category_id , _token: token
                  },
                  success: function(res){
                        if(res.success == true){
                              complete = false;
                              if(!complete){
                                    var branding = res.branding;
                                    $('#products_branding').html('<option value="">Chon danh thương hiệu</option>');
                                    branding.forEach(function (index) {
                                          option = '<option value="';
                                          option += index.id;
                                          option += '">';
                                          option += index.name;
                                          option += '</option>';
                                          $('#products_branding').append(option);
                                          });
                                    complete = true;
                              }

                              if(complete){
                                    var value = $( "input[name='products_branding_id']" ).val();
                                    $('#products_branding').val(value);
                              }
                              
                              

                        }else{
                              $('#products_branding').html('<option value="">Chưa có thương hiệu cho danh mục trên</option>');
                        }
                  },
            });
      });

      /**
       *
       * Remove image in edit function
       *
       */
      $('.remove-image').click(function(){
            var url = '/20s-admin/product/removeImage';
            var check = $(this);
            var product_id = $(this).data('id');
            var image = $(this).data('image');
            var token = $( "input[name='_token']" ).val();
            if(confirm('Chăc chắn xóa ảnh này')){
                  $.ajax({
                        url: domain + url,
                        method: 'POST',
                        data: {
                            product_id : product_id , image: image, _token: token
                        },
                        success: function(res){
                          if(res.success == true){
                            check.fadeOut();
                          }
                        },
                  });
            }
      });


      /**
       *
       * Remove product
       *
       */
      $('.product-remove').click(function(e){
        e.preventDefault();
        var url = '/20s-admin/product/remove';
        var check = $(this);
        var id = $(this).data('id');
        var token = $( "input[name='_token']" ).val();
        if(confirm('Chắc chắn xóa danh mục này')){
          $.ajax({
              url: domain + url,
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
      $('.product-active').click(function(e){
        e.preventDefault();
        var url = '/20s-admin/product/active';
        var check = $(this);
        var id = $(this).data('id');
        var token = $( "input[name='_token']" ).val();
        if(confirm('Chắc chắn thay đổi danh mục này')){
          $.ajax({
                  url: domain + url,
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