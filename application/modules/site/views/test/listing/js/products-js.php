<script>
var baseUrl = "<?php echo base_url() ?>";
function priceFilterWithCategory(methodName,category,min,max){

}
	$(document).ready(function(){
		$("#price_filter").on('click', function(){
			var amounts = $("#amount").val().split("-"), methodName, subCategory;
			var min = amounts[0];
			var max = amounts[1];
			var category = $("#category_id").val();
			var currentUrl = window.location.href;

			methodName = "priceFilterWithCategory";
			param = parseInt(currentUrl.split("/").pop());

			if(currentUrl.indexOf("products") > 0){
				methodName = "priceFilterWithSubCategory";
				param = parseInt(currentUrl.split("/").pop());
			}

			if(currentUrl.indexOf("search") > 0){
				methodName = "priceFilterWithSearchedProduct";
				param = currentUrl.split("/").pop();
			}

			if(currentUrl.indexOf("life-style") > 0){
				methodName = "priceFilterWithLifeStyle";
				param = currentUrl.split("/").pop();
			}

			if(currentUrl.indexOf("featured-fashion") > 0){
				methodName = "priceFilterWithFeaturedFashion";
				param = currentUrl.split("/").pop();
			}
			if(max > 0){
				$("#loader").fadeIn(500);
				$.ajax({
					url:baseUrl+"site/SiteProduct/"+methodName,
					type:"POST",
					data:{min:min,max:max,param:param},
					cache:false,
					success:function(data){
						// console.log(data);
						$("#loader").fadeOut(500);
						$("#products_by_category").html(data);
					}
				});

			}
		});


		$(document).off('click', '.addToCart').on('click', '.addToCart', function (e){
                   
	        e.preventDefault;
	        	var productId = this.id;
	        	var attributeId = $(this).attr("attributeId");
            var attributeValueId = $(this).attr("attributeValueId");
	        	var quantity = 1;

			$.ajax({
                url: '<?php echo base_url();?>' + 'add-to-cart',
                type: 'post',
                data: {
                    productId: productId,
                    quantity: quantity,
                    attributeId: attributeId,
                    attributeValueId: attributeValueId
                },
                cache: false,
                success: function (result) {
                    var bucketCartCount = $('#bucketCartCount').text();
                    if (result == -2) {
                        var uniqueId = $.gritter.add({
                            title: 'Cart!',
                            text: 'Product already in cart!',
                            sticky: true,
                            time: '',
                            class_name: 'my-sticky-class'
                        });
                        setTimeout(function () {
                            $.gritter.remove(uniqueId, {
                                fade: true,
                                speed: 'slow'
                            });
                        }, 3000)


                    } else if (result == 1) {
                        var newCartCount = parseInt(bucketCartCount) + quantity;
                        $('#bucketCartCount').text(newCartCount);
                        var uniqueId = $.gritter.add({
                            title: 'Cart!',
                            text: 'Product added to cart successfully.',
                            sticky: true,
                            time: '',
                            class_name: 'my-sticky-class'
                        });
                        setTimeout(function () {
                            $.gritter.remove(uniqueId, {
                                fade: true,
                                speed: 'slow'
                            });
                        }, 3000)
                    } else {


                    }
                }
            });

	    });

 $(document).off('click', '.addToWishlist').on('click', '.addToWishlist', function (e) {
        e.preventDefault;
        var productId = this.id;
        var attributeId = $(this).attr("attributeId");
        var attributeValueId = $(this).attr("attributeValueId");
        var userId = $(this).attr("userId");

            if(userId == 0){
                $("#login-modal").modal('show');
            }else{
                $.ajax({
                    url: '<?php echo base_url();?>' + 'add-to-wishlist',
                    type: 'post',
                    data: {
                        productId: productId,
                        attributeId: attributeId,
                        attributeValueId: attributeValueId
                    },
                    cache: false,
                    success: function (result) {
                        //console.log(result);
                        if (result == -2) {
    //                            bootbox.alert("Product already in wishlist!");
                            var uniqueId = $.gritter.add({
                                title: 'Wishlist!',
                                text: 'Product already in wishlist!',
                                sticky: true,
                                time: '',
                                class_name: 'my-sticky-class'
                            });
                            setTimeout(function () {
                                $.gritter.remove(uniqueId, {
                                    fade: true,
                                    speed: 'slow'
                                });
                            }, 3000)


                        } else if (result == 1) {
                            var uniqueId = $.gritter.add({
                                title: 'Wishlist!',
                                text: 'Product added to wishlist successfully.',
                                sticky: true,
                                time: '',
                                class_name: 'my-sticky-class'
                            });
                            setTimeout(function () {
                                $.gritter.remove(uniqueId, {
                                    fade: true,
                                    speed: 'slow'
                                });
                            }, 3000)
                        } else {


                        }
                    }
                });
            }
        });






	});

$(document).off('click', '.pagination').on('click', '.pagination', function(){
		var currentUrl = window.location.href, modelMethod;
		var offset = $(this).attr('data-offset');
		modelMethod = "getProductsByCategory";
		param = parseInt(currentUrl.split("/").pop());
		if(currentUrl.indexOf("products") > 0){
			modelMethod = "getProductsBySubCategory";
			param = parseInt(currentUrl.split("/").pop());
		}
		$("#loader").fadeIn(500);
		$.ajax({
			url:baseUrl+"site/SiteProduct/"+methodName,
			type:"POST",
			data:{min:min,max:max,param:param},
			cache:false,
			success:function(data){
				// console.log(data);
				$("#loader").fadeOut(500);
				$("#products_by_category").html(data);
			}
		});
});


</script>
