<script type="text/javascript">

  $(document).ready(function(){
      
      
  	var baseUrl = "<?php echo base_url(); ?>";
  	$(".productAttribute").on('click', function(){
  		var productId = $(this).attr('data-product-id');
    	var attributeId = $(this).attr("data-attribute-id");
        var attributeValueId = $(this).attr("data-attribute-value-id");
        var Price = parseInt($(this).attr("data-product-price").split('.')[0]);
        var DiscountedPrice = parseInt($(this).attr("data-product-discounted-price").split('.')[0]);
        var finalPrice = DiscountedPrice != 0 ? DiscountedPrice : Price;
        $("#productActualPrice").text(finalPrice+".00");
        $(".addToCartBtn").attr('id',productId);
    	$(".addToCartBtn").attr("attributeId",attributeId);
        $(".addToCartBtn").attr("attributeValueId",attributeValueId);
  	});

    $(".increase").on('click', function(){
        var quantity = parseInt($("#itemQuantity").val());
        var max = parseInt($("#itemQuantity").attr("max"));
        if(quantity < max){
          $("#itemQuantity").val((quantity + 1));
          $(".addToCartBtn").attr("quantity",$("#itemQuantity").val());
        }
    });

    $(".reduced").on('click', function(){
        var quantity = parseInt($("#itemQuantity").val());
        if(quantity > 1){
          $("#itemQuantity").val((quantity - 1));
        }
        $(".addToCartBtn").attr("quantity",$("#itemQuantity").val());
    });

    $(document).off('click', '.addToCart').on('click', '.addToCart', function (e){

        e.preventDefault;
                var productId = $('#pro_id').val();
                var size = $('#size').val();
                var attributeId = $('#attributeId').val();
                var quantity = $('#quantity').val();
            if(quantity==''){
                $('#error').html('Please choose quantity');
                return false;
            }else if(size==''){
                $('#error').html('Please choose  size');
                return false;
            }else{
                 $('#error').html('');
            $.ajax({
                url: '<?php echo base_url();?>' + 'add-to-cart',
                type: 'post',
                data: {
                    productId: productId,
                    quantity: quantity,
                    attributeId: attributeId,
                    attributeValueId: size
                },
                cache: false,
                success: function (result) {
                    var bucketCartCount = $('#bucketCartCount').text();
                    if (result == -2) {
                         $('.addToCart').val('Buy Now');
                        $('.addToCart').removeClass('addToCart');
                        $('.submit').addClass('goToCart');
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
                        var newCartCount = parseInt(bucketCartCount) + 1;
                        $('#bucketCartCount').text(newCartCount);
                        $('.addToCart').val('Buy Now');
                        $('.addToCart').removeClass('addToCart');
                        $('.submit').addClass('goToCart');
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
            }

        });
        
        $(document).off('click', '.goToCart').on('click', '.goToCart', function (e) {
            window.location.href = '<?php echo base_url();?>' + 'cart';
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
                        console.log(result);
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

        $("#NotifyMe").on('click', function(){
          var productId = $(this).attr("productId");
          $.ajax({
              url: '<?php echo base_url();?>' + 'check-user-login',
              type: 'post',
              data: {checkLogin: '1'},
              cache: false,
              success: function (result) {
                  if (result == 1) {
                    $("#loader").fadeIn(200);
                    $.ajax({
                        url: '<?php echo base_url();?>' + 'site/SiteProduct/notifyMe',
                        type: 'post',
                        data: {productId:productId},
                        cache: false,
                        success: function (result) {
                            $("#loader").fadeOut(200);
                            if(result == 1){
                              $("#notifyResponse").fadeIn().text("Mesage Sent").removeClass("alert-danger").addClass("alert-success");
                            }

                            if(result == -1){
                              $("#notifyResponse").fadeIn().text("You have Already Requested for this product").removeClass("alert-success").addClass("alert-danger");
                            }
                        }
                    });
                  } else {
                      $("#login-modal").modal('show');
                      $("#myModalLabel").text('Please Login to your account for further access !');
                  }
              }
          });
        });

        $("#sizeChart").on('click', function(){
          $("#imageSizeChart").fadeToggle();
        });

      $(document).on('click', '#submit_review',function(){
          if($('#name').val()==''){
                $('#error-review').text('Please enter name');
                $('#name').focus();
          return false;
            }else {
              $('#error-review').text('');
              var rating = $("input[name='star[]']:checked").val();
              var desc = $("#desc").val();
              var productId = $("#pro_id").val();
              var name = $("#name").val();
              $.ajax({
                  url: '<?php echo base_url();?>' + 'review',
                  type: 'post',
                  data: {
                      productId: productId,
                      rating: rating,
                      name: desc,
                      desc: desc

                  },
                  cache: false,
                  success: function (result) {

                      if (result == 1) {
                          $('#suc').text('Your review submit');
                          $('#error-review').css('color', 'green');
                          $("#name").val('');
                          $("#desc").val('');
                      } else {
                      }
                  }

              });
          }

      });

      $(document).on('click', '.change_image', function(){
          var str = this.id;
          //var res = str.split('_');
          // var sort = res[1];
          var sort = '1';
          // var imgId = res[0];
          var imgId = str;
          var productId = $('#pro_id').val();

          $.ajax({
             type : 'POST',
              data : {sort : sort, imgId : imgId, pro_id : productId},
              url : '<?php echo base_url()?>image-change',
              success: function (result) {
				$('#image-change').html(result);
              }
          });
      });
	  $(document).on('click', '.change_image_color', function(){
          var str = this.id;
          //var res = str.split('_');
          // var sort = res[1];
          var sort = '1';
          // var imgId = res[0];
          var imgId = str;
          var productId = $('#pro_id').val();

          $.ajax({
             type : 'POST',
              data : {sort : sort, imgId : imgId, pro_id : productId},
              url : '<?php echo base_url()?>image-change-color',
              success: function (result) {
				$('#unqimgid').html(result);
              }
          });
      })

  });
  
 
		

		
	
</script>
