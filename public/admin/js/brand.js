$(document).ready(function () {
    var domain = window.location.origin+'/20sections';


    /**
     *
     * Select Branding for edit product
     *
     */

    $('#edit-products-category').change(function(){
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
                    $('#edit-products-branding').html('<option value="">Chon danh thương hiệu</option>');
                    branding.forEach(function (index) {
                        option = '<option value="';
                        option += index.id;
                        option += '">';
                        option += index.name;
                        option += '</option>';
                        $('#edit-products-branding').append(option);
                    });
                }else{
                    $('#edit-products-branding').html('<option value="">Chưa có thương hiệu cho danh mục trên</option>');
                }
            },
        });
    });





    /**
     *
     * Auto select Branding when edit product
     *
     */


    $('.edit-product').click(function (e) {
        $('#edit-products-image').removeClass('check-image');
        e.preventDefault();
        $('.image-preview').css('display', 'block');
        $('.btn-activity-product').html('Cập nhật')
        var url = '/20s-admin/brand/detailProduct';
        var productId = $(this).data('id');
        $('.form-edit-product').attr('action', domain+'/20s-admin/product/update/'+productId);
        var categoryId = $(this).data('category');
        var token = $( "input[name='_token']" ).val();
        $.ajax({
            url: domain + url,
            method: 'POST',
            data: {
                productId : productId, categoryId : categoryId , _token: token
            },
            success: function(res){
                $('.old-image').html('');
                if(res.success == true){
                    var branding = res.branding;
                    $('#edit-products-branding').html('<option value="">Chon danh thương hiệu</option>');
                    branding.forEach(function (index) {
                        option = '<option value="';
                        option += index.id;
                        option += '">';
                        option += index.name;
                        option += '</option>';
                        $('#edit-products-branding').append(option);
                    });
                    $('#edit-products-name').val(res.product.name);
                    $('#edit-products-quantity').val(res.product.quantity);
                    $('#edit-products-price').val(res.product.price);
                    $('#edit-products-description').val(res.product.description);
                    $('#edit-products-content').val(res.product.content);
                    $('#edit-products-time').val(res.product.time);
                    $('#edit-products-production').val(res.product.production);
                    $('#edit-products-madein').val(res.product.madein);
                    $('#edit-products-madeof').val(res.product.madeof);
                    $('#edit-products-weight').val(res.product.weight);
                    $('#edit-products-volume').val(res.product.volume);
                    $('#edit-products-category').val(res.product.category_id);
                    $('#edit-products-branding').val(res.product.branding_id);

                    var image = JSON.parse(res.product.image);
                    image.forEach(function (index) {
                        img = '<div>';
                        img += '<img src="http://localhost/20sections/storage/app/products/'+res.product.slug+'/'+index+'" width="150px">';
                        img += '<a href="javascript:void(0);" class="remove-image" data-id="' + res.product.id + '" data-image="' + index + '"><span class="close-preview"><i class="fa fa-2x fa-close" aria-hidden="true"></i></span></a>';
                        img += '</div>';
                        $('.old-image').append(img);
                    });

                }else{
                    $('#edit-products-branding').html('<option value="">Chưa có thương hiệu cho danh mục trên</option>');
                }
            },
        });
    });

    $('.btn-create-product').click(function () {
        $('#edit-products-image').addClass('check-image');
        $('.form-edit-product').attr('action', domain+'/20s-admin/product');
        $('.btn-activity-product').html('Thêm mới')
        $('.image-preview').css('display', 'none');
        $('#edit-products-name').val('');
        $('#edit-products-category').val('');
        $('#edit-products-branding').val('');
        $('#edit-products-quantity').val('');
        $('#edit-products-price').val('');
        $('#edit-products-description').val('');
        $('#edit-products-content').val('');
        $('#edit-products-time').val('');
        $('#edit-products-production').val('');
        $('#edit-products-madein').val('');
        $('#edit-products-madeof').val('');
        $('#edit-products-weight').val('');
        $('#edit-products-volume').val('');
    });

    $('#form-detail-product').validate({
        rules: {
            name: "required",
            category_id: "required",
            branding_id: "required",
            quantity: {
                required: true,
                digits: true
            },
            price: {
                required: true,
                digits: true
            },
            'image[]': {
                required: function () {
                    if($('#edit-products-image').hasClass('check-image')){
                        return true;
                    }
                    return false;
                },
                accept: "image/jpg, image/png, image/jpeg, image/gif"
            },
            description: "required",
            content: "required",
            production: "required",
        },
        messages: {
            name: "Vui lòng nhập Tên sản phẩm",
            category_id: "Vui lòng nhập Danh mục sản phẩm",
            branding_id: "Vui lòng nhập Thương hiệu sản phẩm",
            quantity: {
                required: "Vui lòng nhập Số lượng sản phẩm",
                digits: "Vui lòng nhập số nguyên dương"
            },
            price: {
                required: "Vui lòng nhập Giá sản phẩm",
                digits: "Vui lòng nhập số nguyên dương"
            },
            'image[]': {
                required: "Vui lòng upload Hình ảnh",
                accept: "Định dạng file không đúng"
            },
            description: "Vui lòng nhập Giới thiệu cho sản phẩm",
            content: "Vui lòng nhập Nội dung sản phẩm",
            production: "Vui lòng nhập Nhà sản xuất"
        }
    });

    /**
     *
     * Auto select brand when search
     *
     */

    $('#search_products_category').change(function(){
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
                    $('#search_products_branding').html('<option value="">Chon danh thương hiệu</option>');
                    branding.forEach(function (index) {
                        option = '<option value="';
                        option += index.id;
                        option += '">';
                        option += index.name;
                        option += '</option>';
                        $('#search_products_branding').append(option);
                    });
                }else{
                    $('#search_products_branding').html('<option value="">Chưa có thương hiệu cho danh mục trên</option>');
                }
            },
        });
    });


    /**
     *
     * Auto select Branding when window on load
     *
     */
    $('#search_products_category').each(function(){
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
                        $('#search_products_branding').html('<option value="">Chon danh thương hiệu</option>');
                        branding.forEach(function (index) {
                            option = '<option value="';
                            option += index.id;
                            option += '">';
                            option += index.name;
                            option += '</option>';
                            $('#search_products_branding').append(option);
                        });
                        complete = true;
                    }

                    if(complete){
                        var value = $( "input[name='products_branding_id']" ).val();
                        $('#search_products_branding').val(value);
                    }



                }else{
                    $('#search_products_branding').html('<option value="">Chưa có thương hiệu cho danh mục trên</option>');
                }
            },
        });
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

    /**
     *
     * Remove image in edit function
     *
     */
    $('.detail-product').on('click', '.remove-image', function () {
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
                        check.parent().fadeOut();
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
});