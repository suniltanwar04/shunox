<script>
    var baseUrl = "<?php echo base_url() ?>";
    $(document).ready(function(){

        $(".clear-cart").on('click', function(){
            var userId = $(this).attr('id');
            var permission = confirm("Are you sure you want to clear your cart ?");
            if(permission === true){
                 $.ajax({
                    url:baseUrl+"site/SiteCart/clearCart",
                    type:"POST",
                    data:{userId:userId},
                    success:function(data){
                        if(data == 1){
                            window.location.reload();
                        }
                    }
                });
            }
        })

        $(".remove-cart-item").on('click', function(){
            var cartId = $(this).attr('id');
             var permission = confirm("Are you sure you want to remove this item ?");
             if(permission === true){
                 $.ajax({
                    url:baseUrl+"site/SiteCart/removeCartItem",
                    type:"POST",
                    data:{cartId:cartId},
                    success:function(data){
                        if(data == 1){
                            window.location.reload();
                        }
                    }
                });
            }
        })

        $(".updateQuantity").on('click', function(){
            var qauntity = $(this).siblings("input.item-cart-qantity").val();
            var cartId = $(this).attr('id');
            $("#loader").fadeIn();
            $.ajax({
                url:baseUrl+"site/SiteCart/updateCartQauntity",
                type:"POST",
                data:{cartId:cartId, qauntity:qauntity},
                success:function(data){
                    $("#loader").fadeOut();
                    if(data == 1){
                        window.location.reload();
                    }
                }
            });
        })
		$('.scan_id').on('change', function() {
            var scan_id = $("select.scan_id").val();
            var cartId = $(this).attr('id');
            $("#loader").fadeIn();
            $.ajax({
                url:baseUrl+"site/SiteCart/updateScanID",
                type:"POST",
                data:{cartId:cartId, scan_id:scan_id},
                success:function(data){
                    $("#loader").fadeOut();
                    if(data == 1){
                        window.location.reload();
                    }
                }
            });
        });

        $('input[type=radio][name=scanradio]').change(function() {
            if (this.value == '0') {
                $(".scan_id").css("display", "block");
                var scan_id = '-2';
                var cartId = $(this).attr('id');
                $("#loader").fadeIn();
                $.ajax({
                    url:baseUrl+"site/SiteCart/updateScanID",
                    type:"POST",
                    data:{cartId:cartId, scan_id:scan_id},
                    success:function(data){
                        $("#loader").fadeOut();
                        if(data == 1){
                            window.location.reload();
                        }
                    }
                });
            }
            else if (this.value == '1') {
                $(".scan_id").css("display", "none");
                var scan_id = '-1';
                var cartId = $(this).attr('id');
                $("#loader").fadeIn();
                $.ajax({
                    url:baseUrl+"site/SiteCart/updateScanID",
                    type:"POST",
                    data:{cartId:cartId, scan_id:scan_id},
                    success:function(data){
                        $("#loader").fadeOut();
                        if(data == 1){
                            window.location.reload();
                        }
                    }
                });
            }
        });

        var rd_val = $('input[name=scanradio]:checked').val();
		console.log(rd_val);
        if(rd_val == '0'){
			
            $(".scan_id").css("display", "block");
			var scan_id_val = $("select.scan_id").val();
			if(scan_id_val == -2){ 
				$('.btn-proceed-checkout').attr('disabled','disabled');
				$('.btn-proceed-checkout').css('cursor','not-allowed');
			}
        }
        else if(rd_val == '1'){
			console.log(rd_val);
            $(".scan_id").css("display", "none");
			$('.btn-proceed-checkout').removeAttr('disabled');
            $('.btn-proceed-checkout').css('cursor','pointer');
        }
		else{
			$(".scan_id").css("display", "none");
		}

        
        // $('.scan_id').on('change', function() {
        //     var val = this.value;
        //     if(val == -2){ 
        //         $('.btn-proceed-checkout').attr('disabled','disabled');
        //         $('.btn-proceed-checkout').css('cursor','not-allowed');
        //     }
        //     else{
        //         $('.btn-proceed-checkout').removeAttr('disabled');
        //         $('.btn-proceed-checkout').css('cursor','pointer');
        //     }
        // });


        $("#ApplyCoupon").on("click", function(){
            var btn = $(this);
            var code = $.trim($("#coupon_code").val());
            var products = $.trim($("#products").val());
            if(code != ""){
                $("#coupon_code").css("border-color","#eee");
                btn.attr("disabled","disabled");
                $.ajax({
                    url:baseUrl+"site/SiteCart/validateAndApplyCoupon",
                    type:"POST",
                    data:{coupon:code,products:products},
                    cache:false,
                    success:function(data){
                        btn.removeAttr("disabled");
                        // console.log(data);
                        // return false;
                       if(data == -1){
                            $("#appliedCouponResult").text("Invalid Coupon Code").css("color","red");
                       }else if(data == -2){
                            $("#appliedCouponResult").text("Sorry, You have already used this coupon !").css("color","red");
                       }else{
                            window.location.reload();
                       }
                    }
                });
            }else{
                $("#coupon_code").css("border-color","red");
            }
        });

        $("#checkout-btn").on("click",function(){
			var scan_id = $("select.scan_id").val();
            var cartId = $('.scan_id').attr('id');
            $("#loader").fadeIn();
            $.ajax({
                url:baseUrl+"site/SiteCart/updateScanID",
                type:"POST",
                data:{cartId:cartId, scan_id:scan_id},
                success:function(data){
                    // $("#loader").fadeOut();
                    // if(data == 1){
                        // window.location.reload();
                    // }
                }
            });
            $.ajax({
                url:baseUrl+"site/Site/loggedInUserType",
                type:"POST",
                success:function(result){
                    if(result == 1){
                        window.location.href = baseUrl+"checkout/shipping";
                    }
                    if(result == 0){
                        window.location.href = baseUrl+"checkout";
                    }
                }
            });
            // window.location.href = baseUrl+"checkout";
        });

        $(".updateCartProdctAttribute").on('click', function(){
          var cartId = $(this).attr("data-cart-id");
          var newAttrValue = $("#updateCartProdctAttribute"+cartId).val();
          if(newAttrValue != ""){
            $("#loader").fadeIn(200);
            $.ajax({
                url:baseUrl+"site/SiteCart/changeCartAttributeValue",
                type:"POST",
                data:{cart:cartId,attrVal:newAttrValue},
                cache:false,
                success:function(result){
                  if(result == 1){
                    window.location.reload();
                  }
                }
            });
          }

        });


    })
</script>
