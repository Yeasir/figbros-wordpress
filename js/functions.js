;(function ($, window, document, undefined) {
    var $win = $(window);
    var $doc = $(document);
    var $body = $('body');

    $doc.ready(function () {

        var chilis = $('.overlay-bg').find('h1');

        if(chilis.text() === 'iCHILL'){
            chilis.addClass('none-case');
        }




        $(window).scroll(function() {
            if ($(this).scrollTop() > 130){
                $('header').addClass("sticky");
            }
            else{
                $('header').removeClass("sticky");
            }
        });


        var trrigger =  $(".woocommerce").find('.img-box');
        trrigger.each(function () {
            var $this = $(this),
                $img = $this.find('img').first();
            $this.css('background-image', 'url("' + $img.attr('src') + '")');
        });
        var trrigger_product_development =  $(".product-development-box-fix").find('.img-box');
        trrigger_product_development.each(function () {
            var $this = $(this),
                $img = $this.find('img').first();
            $this.css('background-image', 'url("' + $img.attr('src') + '")');
        });


        $('a[href*="#"]')
        // Remove links that don't actually link to anything
            .not('[href="#"]')
            .not('[href="#0"]')
            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                    &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 3000, function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                }
            });




        //
        $(".ajax_add_to_cart").on("click", function(){
            $(".add_cart").modal("show");
        });


        //$(".search-model").modal("show");

        //$(".add_cart").modal("show");


        hideShow($('.name-group'));
        hideShow($('.email-group'));
        hideShow($('.phone-group'));
        hideShow($('.address-group'));
        hideShow($('.gender-group'));
        hideShow($('.birth-group'));
        hideShow($('.pass-group'));


        function hideShow(name_group){
            var edit_name_btn = name_group.find('.edit-btn');
            var close_btn = name_group.find('.close-btn');
            var name_field = name_group.find('.input-box');

            name_field.hide();
            edit_name_btn.on("click", function(){
                name_field.show();
            });
            close_btn.on("click", function(){
                name_field.hide();
            });
        }


        // $('.masnory-wrap').masonry({
        //     // options
        //     itemSelector: '.gallery-items',
        //     //isAnimated: true,
        //     percentPosition: true
        // });
        //


        // init Masonry after all images have loaded
        if($('.masnory-grid').length > 0) {
            var $grid = $('.masnory-grid').imagesLoaded(function () {

                $grid.isotope({
                    itemSelector: '.gallery-item',
                    percentPosition: true,

                    // options for masonry layout mode
                    masonry: {
                        columnWidth: 1
                    }
                })
            });
        }
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })



        $('.slider-area').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 500,
            autoplay: true,
            autoplaySpeed: 5000,
            pauseOnHover: false
        });
        $('.slider-area').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            $(slick.$slides).removeClass('is-animating');
        });

        $('.slider-area').on('afterChange', function(event, slick, currentSlide, nextSlide) {
            $(slick.$slides.get(currentSlide)).addClass('is-animating');
        });
        // shop now button to go Product section
        $body.on( 'click', '.product-scroll-btn', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $(".product-target-location").offset().top
            }, 2000);
        });

        if( $('.single-product').length ){
            $('.plus').click(function () {
                // This class qty woocommerce
                var $qty = $( '.qty' );
                $(this).prev().val(+$(this).prev().val() + 1);
                $qty.val(+$qty.val() + 1);
            });
            $('.mins').click(function () {
                // This class qty woocommerce
                var $qty = $( '.qty' );
                if ($(this).next().val() > 1) {
                    if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
                    $qty.val(+$qty.val() - 1);
                }
            });
        }

        if( $('.cart-page').length ){
            //$('.plus').click(function () {
            $body.on( 'click', '.plus', function (e) {
                // This class qty woocommerce
                var $qty = $( '.qty' );
                $(this).prev().val(+$(this).prev().val() + 1);
                $qty.val(+$qty.val() + 1);
                $(this).prev('.input-number').change();
                $("[name='update_cart']").trigger('click');
            });
            //$('.mins').click(function () {
            $body.on( 'click', '.mins', function (e) {
                // This class qty woocommerce
                var $qty = $( '.qty' );
                if ($(this).next().val() > 1) {
                    if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
                    $qty.val(+$qty.val() - 1);
                }
                $(this).next('.input-number').change();
                $("[name='update_cart']").trigger('click');
            });
        }


        // Product specification
        $('.pro-tab-slider-content').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            draggable: false,
            infinite:false,
            asNavFor: '.pro-tab-slider>div',
            accessibility: false,
            draggable: false,
            pauseOnFocus: false,
            pauseOnHover: false,
            pauseOnDotsHover: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        dots: false,
                        arrows: false,
                        draggable: false,
                        accessibility: false,
                        draggable: false,
                        pauseOnFocus: false,
                        pauseOnHover: false,
                        pauseOnDotsHover: false,
                        settings: "unslick"
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        dots: false,
                        arrows: false,
                        draggable: false,
                        accessibility: false,
                        draggable: false,
                        pauseOnFocus: false,
                        pauseOnHover: false,
                        pauseOnDotsHover: false,
                        settings: "unslick",
                        slidesToShow: 1
                    }
                }
            ]
        });
        $('.pro-tab-slider>div').slick({
            slidesToShow: 7,
            slidesToScroll: 1,
            asNavFor: '.pro-tab-slider-content',
            dots: false,
            arrows: false,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        dots: false,
                        arrows: false,
                        focusOnSelect: true,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        dots: false,
                        arrows: false,
                        focusOnSelect: true,
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('body').bind('click', function(e) {
            if($(e.target).closest('.navbar-toggler').length == 0) {
                var opened = $('.navbar-collapse').hasClass('collapse');
                if ( opened === true ) {
                    $('.navbar-collapse').collapse('hide');
                }
            }
        });


        $body.on( 'click', '.loadmore', function (e) {
            e.preventDefault();
            $obj = $(this);
            $obj.parent().siblings("#wait").show();
            var catid = $obj.attr('data-catid');
            var brand_id = $obj.attr('data-brandid');
            var curpageid = $obj.attr('data-curpageid');
            if(catid){
                $.ajax({
                    method: 'POST',
                    url: js_var.ajax_url,
                    data: {
                        'action': 'load_more_by_category_and_brand',
                        'catid': catid,
                        'brand_id': brand_id,
                        'curpageid': curpageid
                    },
                    dataType: "json",
                    success: function (msg) {
                        $obj.parent().siblings("#wait").hide();
                        var out = msg.output;
                        if (!out.trim()) {
                            $obj.text('No more to load');
                        }else{
                            $obj.attr('data-curpageid', msg.curpageid);
                            $obj.parent().siblings(".products").append(out);
                            if(msg.nomoretoload){
                                $obj.text('No more to load');
                            }
                        }
                    }
                });
            }
        });

        $body.on("click", '.login-sub-btn', function (e) {
            e.preventDefault();
            $('#wait').show();
            var log = $("input[name=log]").val();
            var pwd = $("input[name=pwd]").val();
            $.ajax({
                method: 'POST',
                url: js_var.ajax_url,
                data: { action: "check_authentication", logname: log, pwd: pwd},
                dataType: "json",
                async:false,
                success: function (msg) {
                    if(msg.status == 2){
                        $('#wait').hide();
                        $('.alert-danger').text('Username or password not match!');
                        $('.alert-danger').removeClass('d-none');
                    }else if(msg.status == 1){
                        $('#loginFrm').submit();
                    }
                }
            });
        });

        $body.on("click", '.sign-sub-btn', function (e) {
            e.preventDefault();
            $('#wait').show();
            var user_login = $("input[name=user_login]").val();
            var user_email = $("input[name=user_email]").val();
            var pwd = $("input[name=password]").val();
            $.ajax({
                method: 'POST',
                url: js_var.ajax_url,
                data: { action: "save_registration_data", user_login: user_login, user_email: user_email, pwd: pwd},
                dataType: "json",
                async:false,
                success: function (msg) {
                    if(msg.status == 2){
                        $('#wait').hide();
                        $('.alert-danger').text('Registration failed.Please try again.');
                        $('.alert-danger').removeClass('d-none');
                    }else if(msg.status == 1){
                        $('#wait').hide();
                        $('.alert-success').text('You have successfully completed registration!');
                        $('.alert-success').removeClass('d-none');
                        setTimeout(function(){
                            window.location.href = js_var.homeurl+"my-account";
                        },4000);
                    }else if(msg.status == 3){
                        $('#wait').hide();
                        $('.alert-danger').text('User already exist with this name or email. Please try with different name and email.');
                        $('.alert-danger').removeClass('d-none');
                    }
                }
            });
        });


        $body.on('added_to_cart',function(e,data) {
            //setTimeout(function(){
                $(".add_cart").modal("show");
            //}, 3000);
        });

        $(document).on('click', '.single_add_to_cart_button', function (e) {
            e.preventDefault();

            var $thisbutton = $(this),
                $form = $thisbutton.closest('form.cart'),
                id = $thisbutton.val(),
                product_qty = $form.find('input[name=quantity]').val() || 1,
                product_id = $form.find('input[name=product_id]').val() || id,
                variation_id = $form.find('input[name=variation_id]').val() || 0;

            var data = {
                action: 'woocommerce_ajax_add_to_cart',
                product_id: product_id,
                product_sku: '',
                quantity: product_qty,
                variation_id: variation_id,
            };

            $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

            $.ajax({
                type: 'post',
                url: wc_add_to_cart_params.ajax_url,
                data: data,
                beforeSend: function (response) {
                    $thisbutton.removeClass('added').addClass('loading');
                },
                complete: function (response) {
                    $thisbutton.addClass('added').removeClass('loading');
                },
                success: function (response) {

                    if (response.error & response.product_url) {
                        window.location = response.product_url;
                        return;
                    } else {
                        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                    }
                },
            });

            return false;
        });

        $( "#auto_search" ).autocomplete({
            source: js_var.availableTerms,
            appendTo: $('#fbx')
        });

        $body.on( 'click', '.loadmore2', function (e) {
            e.preventDefault();
            $obj = $(this);
            $obj.parent().siblings("#wait").show();
            var catname = $obj.attr('data-catname');
            var brand_name = $obj.attr('data-brandname');
            var curpageid = $obj.attr('data-curpageid');
            if(catname){
                $.ajax({
                    method: 'POST',
                    url: js_var.ajax_url,
                    data: {
                        'action': 'load_more_ajax_by_category_and_brand',
                        'catname': catname,
                        'brand_name': brand_name,
                        'curpageid': curpageid
                    },
                    dataType: "json",
                    success: function (msg) {
                        $obj.parent().siblings("#wait").hide();
                        var out = msg.output;
                        if (!out.trim()) {
                            $obj.text('No more to load');
                        }else{
                            $obj.attr('data-curpageid', msg.curpageid);
                            $obj.parent().siblings(".products").append(out);
                            if(msg.nomoretoload){
                                $obj.text('No more to load');
                            }
                        }
                    }
                });
            }
        });

        $body.on( 'click', '.woocommerce-billing-fields .edit-btn', function (e) {
            $('.wbfrmwrap').css('display','block');
            $('.address-info').css('display','none');
        });

        $body.on( 'click', '.shipping2 .woocommerce-shipping-methods li input,.shipping2 .woocommerce-shipping-methods li label', function (e) {
            jQuery(document.body).trigger("update_checkout");
        });
        $body.on( 'click', '.btn-pay', function (e) {
            var $validate = true;
            /*$('.woocommerce-billing-fields__field-wrapper p').each(function () {
                if($(this).hasClass('validate-required')){
                    if($(this).has('input')) {
                        if ($(this).find('input').val().length == 0) {
                            $(this).addClass('woocommerce-invalid woocommerce-invalid-required-field');
                            $validate = false;
                        } else {
                            $(this).removeClass('woocommerce-invalid woocommerce-invalid-required-field');
                        }
                    }
                }
            })*/
            if($validate){
                $('.first-step').css('display','none');
                $('.second-step').css('display','block');
            }
        });

        if($('.payment_box.payment_method_authorize_net_cim_credit_card .form-row.form-row-wide input.js-sv-wc-payment-gateway-payment-token').length > 0){
            var cards = [];
            $('.payment_box.payment_method_authorize_net_cim_credit_card .form-row.form-row-wide input.js-sv-wc-payment-gateway-payment-token').each(function() {
                $this = $(this);
                $input_next_label = $this.next("label");
                //$del_url = $this.attr("data-delurl");
                $title = $input_next_label.find('.title').clone().children().remove().end().text();
                var res = $title.split("(");
                var is_checked = $(this).attr('checked');

                //console.log(res);
                obj = {};
                obj['token'] = $this.val();
                if (typeof is_checked !== typeof undefined && is_checked !== false) {
                    obj['default_card'] = 'checked = "checked"';
                    obj['default_title'] = 'Default';
                    //obj['enter_cvv'] = '<input type="text" name="cvv_name" class="form-control" placeholder="Enter CVV" >';
                }
                if(res.length == 2){
                    var ntitle = res[0].replace("• • •", "* * *");
                    obj['card_title'] = ntitle;
                    $expired = res[1].split(")");
                    //obj['card_title'] = res[0];

                    words = $expired[0].split(/\s+/);
                    var lastWord = words.pop();
                    words.push('<span>' + lastWord + '</span>');
                    var cex = words.join(' ');

                    //obj['card_expired'] = $expired[0];
                    obj['card_expired'] = cex;
                }else{
                    var ntitle = $title.replace("• • •", "* * *");
                    obj['card_title'] = ntitle;
                }

                var card_img = $input_next_label.find('.title img').attr('src');
                var card_name = '';
                img_words = card_img.split('/');
                var lastpart = img_words.pop();
                //alert(lastpart);
                if(lastpart){
                    lpa = lastpart.split('-');
                    var lpaf = lpa.pop();
                    if(lpaf){
                        card_name_array = lpaf.split('.');
                        card_name = card_name_array[0].substr(0,1).toUpperCase() + card_name_array[0].substr(1);
                    }
                }

                obj['card_image'] = $input_next_label.find('.title img').attr('src');
                obj['card_nickname_name'] = $input_next_label.find('.title .nickname').text();
                obj['card_name'] = card_name;
                //obj['del_url'] = $del_url;
                obj['del_url'] = js_var.homeurl+'my-account/payment-methods/?wc-authorize-net-cim-token='+$this.val()+'&wc-authorize-net-cim-action=delete&_wpnonce='+js_var.card_delete_nonce;
                obj['card_user_name'] = $('.card_list_container_wrapper').attr('data-username');
                cards.push(obj);
            }).promise().done(function () {
                var cards2 = $();
                cards.forEach(function(item, i) {
                    cards2 = cards2.add(createCard(item));
                });
                $(function() {
                    //$('.card_list_container_wrapper').prepend(cards2);
                    $( cards2 ).insertAfter( ".card_list_container_wrapper h4.black-text" );
                });
            });
        }

        function createCard(cardData) {
            var cardTemplate = [
                '<table cellspacing="0" class="shop_table shop_table_responsive option-table  default-table"> <thead> <tr class="cart-subtotal"> <th class="text-left" width="50%"> <input type="checkbox" name="authorize_payment_method" data-index="0" id="wc-authorize-net-cim-credit-card-payment-token-'+cardData.token+'" value="" class="card-method check-card" ',
                cardData.default_card || '',
                '> <label for="wc-authorize-net-cim-credit-card-payment-token-'+cardData.token+'" class="check-card-label">',
                cardData.default_title || 'CREDIT CARD',
                '</label> </th> <th class="text-right"><a class="yellow-text delete_card" href="',
                cardData.del_url || '',
                '"><i class="zmdi zmdi-close yellow-text"></i> Remove</a></th> </tr> </thead>',
            '<tbody class="card_list_container"> <tr class="cart-subtotal"> <th class="text-left" colspan="2">',
                '<p>',
                cardData.card_name || cardData.card_nickname_name,
                ' ',
                cardData.card_title || '',
                '</p>',
                '<p>   ',
                cardData.card_user_name || '',
                '</p>',
            '<p class="expired_text"> ',
                cardData.card_expired || '',
                '</p>',
                '</th> </tr> </tbody> </table>'
            ];

            // a jQuery node
            return $(cardTemplate.join(''));
        }

        $(".addCartbtn").on("click", function(){
            //$(".addCartModal").modal("show");
            $('.addCartModal').modal({backdrop: 'static', keyboard: false});
            $('#wc-authorize-net-cim-credit-card-use-new-payment-method').trigger('click');
            $('#wc-authorize-net-cim-credit-card-tokenize-payment-method').trigger('click');
        });

        var modalConfirm = function(callback){
            $body.on( 'click', '.delete_card', function (e) {
                e.preventDefault();
                $("#mi-modal").modal('show');
                var ddd = $(this).parents('.option-table');
                var del_url = $(this).attr('href');
                $(".yes").on("click", function(){
                    callback(true,ddd,del_url);
                    $("#mi-modal").modal('hide');
                });
            });

            $(".no").on("click", function(){
                callback(false);
                $("#mi-modal").modal('hide');
            });
        };

        modalConfirm(function(confirm,ddd,del_url){
            if(confirm){
                ddd.remove();
                $.get(del_url);
            }else{
            }
        });

        $body.on( 'click', '.check-card-label', function (e) {
            e.preventDefault();
            var label_for = $(this).attr('for');
            if(label_for){
                $('.check-card').removeAttr('checked');
                $(this).prev('input').attr('checked','checked');
                $('.payment_box.payment_method_authorize_net_cim_credit_card .form-row.form-row-wide input#'+label_for+'').trigger('click');
            }
        });

        $('.wc_payment_method.payment_method_authorize_net_cim_credit_card').trigger('click');

        $body.on( 'click', '.clsbtn', function (e) {
            e.preventDefault();
            $('.card_list_container_wrapper .option-table').each(function() {
                var is_ckd = $(this).find('input').attr('checked');
                if (typeof is_ckd !== typeof undefined && is_ckd !== false) {
                    var ckd_id = $(this).find('input').attr('id');
                    $('.payment_box.payment_method_authorize_net_cim_credit_card .form-row.form-row-wide input#'+ckd_id+'').trigger('click');
                }
            });
        });

        $body.on( 'click', '.sub_and_place_ord', function (e) {
            e.preventDefault();
            var cnum = $('#wc-authorize-net-cim-credit-card-account-number2').val();
            var cexp = $('#wc-authorize-net-cim-credit-card-expiry2').val();
            var csecu = $('#wc-authorize-net-cim-credit-card-csc2').val();
            //alert(jQuery.type( cnum ));
            if(cnum){
                cnum = parseInt(cnum);
                //alert(jQuery.type( cnum ));
                $('#wc-authorize-net-cim-credit-card-account-number').val(cnum).trigger('change');
                //$('#wc-authorize-net-cim-credit-card-account-number').val(cnum).change();
            }

            if(cexp){
                $('#wc-authorize-net-cim-credit-card-expiry').val(cexp).trigger('change');
            }
            if(csecu){
                csecu = parseInt(csecu);
                $('#wc-authorize-net-cim-credit-card-csc').val(csecu).trigger('change');
            }

            $('.addCartModal').modal('toggle');

            setTimeout(function(){
                $('#place_order').trigger('click');
                }, 2000);
        });

        /*$('#wc-authorize-net-cim-credit-card-account-number').on('input',function(e){
            alert('Changed!')
        });*/
        $('#birthdate').datepicker({
            yearRange: "-100:+0",
            changeMonth: true,
            changeYear: true
        });

        $("#edit_info input").blur(function(){
            var field_name = $(this).attr('name');
            var field_value = $(this).val();
            if(field_value.length > 0 && field_name !== 'user_birth_date'){
                $.ajax({
                    method: 'POST',
                    url: js_var.ajax_url,
                    data: {
                        'action': 'update_user_information',
                        'field_name': field_name,
                        'field_value': field_value
                    },
                    dataType: "json",
                    success: function (msg) {
                        if(msg.success){
                            $('.'+msg.field_name+'').text(msg.new_val);
                        }
                    }
                });
            }
        });

        $("#edit_info input[name='user_birth_date']").change(function(){
            var field_name = $(this).attr('name');
            var field_value = $(this).val();
            if(field_value.length > 0){
                $.ajax({
                    method: 'POST',
                    url: js_var.ajax_url,
                    data: {
                        'action': 'update_user_information',
                        'field_name': field_name,
                        'field_value': field_value
                    },
                    dataType: "json",
                    success: function (msg) {
                        if(msg.success){
                            $('.'+msg.field_name+'').text(msg.new_val);
                        }
                    }
                });
            }
        });


        /*if($('.wc-authorize-net-cim-my-payment-methods tbody tr').length > 0){
            var cards = [];
            $('.wc-authorize-net-cim-my-payment-methods tbody tr').each(function() {
                obj = {};
                $this = $(this);
                obj['token'] = $this.attr('data-token-id');
                obj['card_user_name'] = $('.payment-box').attr('data-username');
                obj['card_name'] = $this.find('td.wc-authorize-net-cim-payment-method-title .view').text();
                //alert($this.find('td.wc-authorize-net-cim-payment-method-expiry').text());
                if($this.find('td.wc-authorize-net-cim-payment-method-expiry').text() != 'N/A'){
                    obj['card_expired'] = 'Expires <span>'+$this.find('td.wc-authorize-net-cim-payment-method-expiry').text()+'</span>';
                }
                $card_number = $this.find('.wc-authorize-net-cim-payment-method-details').clone().children().remove().end().text();
                var ntitle = $card_number.replace("• • •", "* * *");
                obj['card_title'] = ntitle;
                var is_checked =$this.find('.wc-authorize-net-cim-payment-method-default .view').text();
                if (is_checked.length > 0) {
                    obj['default_card'] = 'checked = "checked"';
                    obj['default_title'] = 'Default';
                }
                obj['del_url'] = js_var.homeurl+'my-account/payment-methods/?wc-authorize-net-cim-token='+$this.attr('data-token-id')+'&wc-authorize-net-cim-action=delete&_wpnonce='+js_var.card_delete_nonce;
                cards.push(obj);
            }).promise().done(function () {
                //console.log(cards);
                var cards2 = $();
                cards.forEach(function(item, i) {
                    cards2 = cards2.add(createCard2(item));
                });
                $(function() {
                    $('.adonc').append(cards2);
                });
            });
        }

        function createCard2(cardData) {
            var cardTemplate = [
                '<table cellspacing="0" class="shop_table shop_table_responsive option-table  default-table"> <thead> <tr class="cart-subtotal"> <th class="text-left" width="50%"> <input type="checkbox" name="authorize_payment_method" data-index="0" id="wc-authorize-net-cim-credit-card-payment-token-'+cardData.token+'" value="" class="card-method check-card2" ',
                cardData.default_card || '',
                '> <label for="wc-authorize-net-cim-credit-card-payment-token-'+cardData.token+'" class="check-card-label2" data-token-id="'+cardData.token+'">',
                cardData.default_title || 'CREDIT CARD',
                '</label> </th> <th class="text-right"><a class="yellow-text delete_card" href="',
                cardData.del_url || '',
                '"><i class="zmdi zmdi-close yellow-text"></i> Remove</a></th> </tr> </thead>',
                '<tbody class="card_list_container"> <tr class="cart-subtotal"> <th class="text-left" colspan="2">',
                '<p>',
                cardData.card_name || cardData.card_nickname_name,
                ' ',
                cardData.card_title || '',
                '</p>',
                '<p>   ',
                cardData.card_user_name || '',
                '</p>',
                '<p class="expired_text"> ',
                cardData.card_expired || '',
                '</p>',
                '</th> </tr> </tbody> </table>'
            ];

            // a jQuery node
            return $(cardTemplate.join(''));
        }*/


        $body.on( 'click', '.adonc .check-card-label2', function (e) {
            e.preventDefault();
            var label_for = $(this).attr('for');
            var token_id = $(this).attr('data-token-id');
            if(token_id){
                $('.check-card2').removeAttr('checked');
                $(this).prev('input').attr('checked','checked');
                $.ajax({
                    method: 'POST',
                    url: js_var.ajax_url,
                    data: {
                        'action': 'change_default_card',
                        'token_id': token_id
                    },
                    dataType: "json",
                    success: function (msg) {
                        if(msg.updated){
                            location.reload(true);
                        }
                    }
                });
            }
        });

        $body.on( 'click', '.chn_dft_addr', function (e) {
            e.preventDefault();
            var order_id = $(this).attr('data-order_id');
            if(order_id){
                $('.card-method').removeAttr('checked');
                $(this).prev('input').attr('checked','checked');
                $.ajax({
                    method: 'POST',
                    url: js_var.ajax_url,
                    data: {
                        'action': 'change_default_address',
                        'order_id': order_id
                    },
                    dataType: "json",
                    success: function (msg) {
                        //if(msg.updated){
                            //location.reload(true);
                        //}
                    }
                });
            }
        });



        var modalConfirm2 = function(callback){
            $body.on( 'click', '.delete_card2', function (e) {
                e.stopPropagation();
                let element = $(this);
                $("#mi-modal").modal('show');
                var cur_itm = element.parents('.ord_addr_con');
                var order_id = element.attr('data-order_id');
                var related_addr_ids = element.attr('data-same_addr_ids');
                $(".yes").on("click", function(){
                    callback(true,cur_itm,order_id,related_addr_ids);
                    $("#mi-modal").modal('hide');
                });
            });

            $(".no").on("click", function(){
                callback(false);
                $("#mi-modal").modal('hide');
            });
        };

        modalConfirm2(function(confirm,cur_itm,order_id,related_addr_ids){
            if(confirm){
                $.ajax({
                    method: 'POST',
                    url: js_var.ajax_url,
                    data: {
                        'action': 'remove_address',
                        'order_id': order_id,
                        'related_addr_ids': related_addr_ids
                    },
                    dataType: "json",
                    success: function (msg) {
                        if(msg.updated){
                            cur_itm.remove();
                        }
                    }
                });
            }else{
            }
        });

        $(".option-table .edit-btn").on("click", function(){
            let element = $(this);
            var order_id = element.attr('data-order_id');
            var related_addr_ids = element.attr('data-same_addr_ids');
            var default_addr = element.attr('data-default');
            $.ajax({
                method: 'POST',
                url: js_var.ajax_url,
                data: {
                    'action': 'edit_address',
                    'order_id': order_id,
                    'related_addr_ids': related_addr_ids,
                    'default_addr': default_addr
                },
                dataType: "json",
                success: function (msg) {
                    if(msg.updated){
                        $('.edit_billing_address #billing_first_name').val(msg.billing_first_name);
                        $('.edit_billing_address #billing_last_name').val(msg.billing_last_name);
                        $('.edit_billing_address #billing_address_1').val(msg.billing_address_1);
                        $('.edit_billing_address #billing_city').val(msg.billing_city);
                        $('.edit_billing_address #billing_postcode').val(msg.billing_postcode);
                        $('.edit_billing_address select#billing_country').val(msg.billing_country);
                        $('.edit_billing_address select#billing_state').val(msg.billing_state);
                        $('.edit_billing_address #order_id').val(order_id);
                        $('.edit_billing_address #related_order_id').val(related_addr_ids);
                        $('.edit_billing_address #default_order').val(default_addr);
                        $(".addressModal").modal("show");
                    }
                }
            });
        });

        $(".addressModal").on('show.bs.modal', function(e) {
            $('select').select2({
                dropdownParent: $('.addressModal')
            });
        });

        $body.on( 'click', '.update_address button', function (e) {
            e.preventDefault();
            var billing_first_name = $('#billing_first_name').val();
            if(billing_first_name){
                $.ajax({
                    method: 'POST',
                    url: js_var.ajax_url,
                    data: {
                        'action': 'edit_address_fields',
                        'frm_values': $( '.edit_billing_address' ).serialize()
                    },
                    dataType: "json",
                    success: function (msg) {
                        if(msg.updated){
                            location.reload(true);
                        }
                    }
                });
            }
        });
    }).on('click', '.shipping label', function (e) {
        if($body.hasClass('woocommerce-checkout')){
            var $this = $(this),
                $parent = $this.closest('.shipping'),
                rinputs = $parent.find('input[type="radio"]'),
                id = $this.attr('for');
            rinputs.removeAttr('checked');
            $parent.find('#'+id).attr('checked', true);
            $body.find('.checkout-left').addClass('woo-processing');
        }
    }).on('updated_checkout', function () {
        var $parent = $body.find('.checkout-left');
        $.ajax({
            method: 'POST',
            url: js_var.ajax_url,
            data: {
                'action': 'checkout_update_value',
            },
            dataType: "json",
            success: function (data) {
                $parent.removeClass('woo-processing');
                var $table = $parent.find('.checkout-table');
                $table.find('.shipping td').html(data.shipping_value);
                $table.find('.order-total td strong').html(data.total);
            }
        });
    });

    $(".woocommerce-checkout #ship-to-different-address-checkbox").attr('checked', true);
})(jQuery, window, document);
