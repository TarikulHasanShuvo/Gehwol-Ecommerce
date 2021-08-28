import $ from 'jquery';
import slick from 'slick-carousel';
import { gsap, ScrollTrigger } from "gsap/all";
import jBox from 'jbox';

function plus() {
    var val = parseInt($('#count').html());
    $('#count').val(val+1);
}
function minus() {
    var val = parseInt($('#count').html());
    if (val === 1) return;
    $('#count').val(val-1);
}


$(window).resize(function() {
    var width = window.innerWidth;
    if (width < 1100) {
        console.log('<1100');
        $('.header .header__top_menu').insertBefore('.header .header__bottom_menu');
        $('.header .header__phone').insertAfter('.header .header__buttons ');
    } else {
        console.log('>1100');
        $('.header .header__top_menu').appendTo('.header .header__top_right');
        $('.header .header__phone').appendTo('.header .header__top_right');
    }
});

$(window).trigger('resize');

$('.header__menu_opener').click(function() {
    $('.header__bottom').toggleClass('isOpened');
    $(this).toggleClass('isOpened');
});

$('.slider__front').slick({

    // normal options...
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    autoplay: true,
    asNavFor: '.slider__back'
});

$('.slider__back').slick({

    // normal options...
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    autoplay: true,
    asNavFor: '.slider__front'
});

$('.news__items').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: true,
    responsive: [
        {
            breakpoint: 1100,
            settings: {
                slidesToShow: 3,
                arrows: false,
            }
        },
    ]
});

$('.products__items').each(function() {
    $(this).slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: true,
        responsive: [
            {
                breakpoint: 1100,
                settings: {
                    slidesToShow: 3,
                    arrows: false,
                }
            },
        ]
    });
})

$('.new_products__items').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: true,
    responsive: [
        {
            breakpoint: 1100,
            settings: {
                slidesToShow: 2,
                arrows: false,
            }
        },
    ]
});

gsap.registerPlugin(ScrollTrigger);

if ($('.bestsellers__leaf').length) {

    gsap.to('.bestsellers__leaf.first', {
        scrollTrigger: {
            trigger: '.bestsellers',
            start: 'top center',
            end: 'bottom center',
            scrub: 1,
        },
        rotation: 360,
        top: () => {
            return 53 * 100 / window.innerWidth + 'vw'
        }
    })
    gsap.to('.bestsellers__leaf.second', {
        scrollTrigger: {
            trigger: '.bestsellers',
            start: 'top top',
            end: 'bottom bottom',
            scrub: 2,
        },
        rotation: 360,
        top: () => {
            return 88 * 100 / window.innerWidth + 'vw'
        }
    })
    gsap.to('.bestsellers__leaf.third', {
        scrollTrigger: {
            trigger: '.bestsellers',
            start: 'top top',
            end: 'bottom center',
            scrub: 2,
        },
        rotation: 180,
        top: () => {
            return 746 * 100 / window.innerWidth + 'vw'
        }
    })
    gsap.to('.bestsellers__leaf.fourth', {
        scrollTrigger: {
            trigger: '.bestsellers',
            start: 'top top',
            end: 'bottom center',
            scrub: 2,
        },
        rotation: 180,
        bottom: () => {
            return 500 * 100 / window.innerWidth + 'vw'
        }
    })
    gsap.to('.bestsellers__leaf.fiveth', {
        scrollTrigger: {
            trigger: '.bestsellers',
            start: 'top top',
            end: 'bottom center',
            scrub: 2,
        },
        rotation: 180,
        bottom: () => {
            return 168 * 100 / window.innerWidth + 'vw'
        }
    })
}


if ($('.product_page__top').length) {
    $('.product_page__slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        asNavFor: '.product_page__thumbs_in'
    })

    $('.product_page__thumbs_in').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        centerMode: true,
        focusOnSelect: true,
        dots: false,
        vertical: true,
        arrows: false,
        asNavFor: '.product_page__slider'
    })

    new jBox('Image');


    $('#plus').click(plus);
    $('#minus').click(minus);

    $('.product_page__expand_title').click(function() {
        $('.product_page__expand_item').removeClass('isOpened');
        $('.product_page__expand_body').slideUp();
        $(this).closest('.product_page__expand_item').toggleClass('isOpened').find('.product_page__expand_body').slideToggle();
    });

    // TODO fix bug on expand title multiple click
}


if ($('.auth_page').length) {
    gsap.to(".auth_page__accessuar.first", {
        top: () => {
            return 364 * 100 / 1920 + 'vw';
        },
        rotate: 0,
        duration: 2,
        ease: "bounce"
    });
    gsap.to(".auth_page__accessuar.second", {
        top: () => {
            return 77 * 100 / 1920 + 'vw';
        },
        rotate: 0,
        duration: 3,
        ease: "bounce"
    });
    gsap.to(".auth_page__accessuar.third", {
        top: () => {
            return 603 * 100 / 1920 + 'vw';
        },
        rotate: 0,
        duration: 4,
        ease: "bounce"
    });
    gsap.to(".auth_page__accessuar.fourth", {
        top: () => {
            return 143 * 100 / 1920 + 'vw';
        },
        rotate: 0,
        duration: 4.5,
        ease: "bounce"
    });
    gsap.to(".auth_page__accessuar.fiveth", {
        top: () => {
            return 484 * 100 / 1920 + 'vw';
        },
        rotate: 0,
        duration: 3.5,
        ease: "bounce"
    });
    gsap.to(".auth_page__right", {
        y: 0,
        duration: 2.5,
        ease: "bounce"
    });
}
$('.header__button.search_opener').click(function(e) {
    e.preventDefault();
    $('.search__popup').addClass('isOpened');
    gsap.to(".search__in", {
        y: 0,
        duration: 0.5,
        ease: "expo",
        onComplete: function() {
            $('.search__blur').addClass('isVisible');
            $('.search__closer').addClass('isVisible');
        }
    });
});
$('.search__closer').click(function() {
    $('.search__closer').removeClass('isVisible');
    gsap.to(".search__in", {
        y: '-100%',
        duration: 0.5,
        ease: "expo",
        onComplete: function() {
            $('.search__popup').removeClass('isOpened');
            $('.search__blur').removeClass('isVisible');
        }
    });
});





function openModal(modal_name) {
    let $modal = $(`[data-modal_name="${modal_name}"]`);
    if ($modal.length) {
        $modal.addClass('isOpened');
        $(`[data-modal_name="${modal_name}"] .modal__blur`).addClass('isVisible');
        gsap.to(`[data-modal_name="${modal_name}"] .modal__in`, {
            scale: 1,
            duration: 1,
            ease: "bounce",
            onComplete: function() {
                console.log('modal is opened');
            }
        });
    } else {
        console.warn(`Sorry. Modal [data-modal_name="${modal_name}"] is not found!`);
    }
}

$('.modal__closer, .close_modal').click(function(e) {
    e.preventDefault();
    gsap.to(".modal__in", {
        scale: 0,
        duration: 1,
        ease: "bounce",
        onComplete: function() {
            $('.modal__blur').removeClass('isVisible');
            $('.modal').removeClass('isOpened');
        }
    });
});


$('.ajax_form').on("submit", function(event) {
    event.preventDefault();

    let action = $(this).attr('action');
    let $target_modal = $(this).data('target_modal');
    let data = $(this).serialize();

    $(this).find('.button').addClass('isLoading');

    $.ajax({
        type: "POST",
        url: action,
        data: data,
        success: result => {
            if (result.success) {
                openModal($target_modal);
                $(this).find('.button').removeClass('isLoading');
            }
        },
        error: error => {
            console.log(error.responseJSON);
            $(this).find('.button').removeClass('isLoading');
        },
    });
});

$(".gift-balance").click(function(e){
    e.preventDefault();
    const obj = $(this);
    let code = $('input[name="gift_code"]').val();
    if(!code) {
        alert('enter your gift code'); return false;
    }

    obj.addClass('isLoading');
    $.ajax({
        type:'POST',
        url: '/api/v1/gifts/balance-check',
        data:{gift_card_code:code},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(res){
            obj.removeClass('isLoading');
            if(!res.data) { alert('Invalid gift certificate') }
            $('.big').html(res.data?res.data.recipient_name:'N/A');
            $('.gift_code').html(res.data?res.data.gift_card_code:'');
            $('.description').html(res.data?res.data.message:'');
            $('.from_name').html(res.data?res.data.client_name:'');
            $('.value').html(res.data?'$'+res.data.available_balance:'');
        },
        error:function (err) {
            obj.removeClass('isLoading');
            console.log(err);
        }
    });
});

$(".apply-gift").click(function(e){
    e.preventDefault();
    const obj = $(this);
    var code = $('input[name="gift_code"]').val();
    if(!code) {
        alert('enter your gift code'); return false;
    }

    obj.addClass('isLoading');
    $.ajax({
        type:'POST',
        url: '/api/v1/carts/gift-certificate',
        data:{gift_card_code:code},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(res){
            obj.removeClass('isLoading');
            $('#discount-row').show();
            $('.gift_name').html(res.data.name);
            $('#discount-amount').attr('data-balance', res.data.available_balance);
            calculateTotal();
        },
        error:function (err) {
            obj.removeClass('isLoading');
            alert('invalid gift certificate or coupon!!!')
            $('#discount-row').hide();
        }
    });
});

$(".add_to_cart").click(function(e){
    e.preventDefault();

    const obj = $(this);
    obj.addClass('isLoading');
    var action = obj.data('action');
    var productId = obj.data('product-id');
    var data = {product_id:productId};
    var page = obj.data('page')?obj.data('page'):'';

    if(page === 'product-view') {
        data.quantity = parseInt($('#count').html());
    }

    $.ajax({
        type:'POST',
        url: action,
        data: data,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(res){
            obj.removeClass('isLoading');
            openModal('add_to_cart_modal');
            $('#cart_count').html(res.no_of_products);
        },
        error:function (err) {
            obj.removeClass('isLoading');
            console.log(err);
        }
    });

});

$('.remove-cart').click(function(e) {
    e.preventDefault();

    var cartId = $(this).data('id');
    cartId = cartId?cartId:'all';
    $.ajax({
        type:'DELETE',
        url: '/api/v1/carts/'+cartId,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(res){
            var cartCountObj =  $('#cart_count');
            if(cartId === 'all') {
                $('.cart__left_product').remove();
                cartCountObj.html(0);
            } else {
                $('#cart-item-'+ cartId).remove();
                cartCountObj.html(parseInt(cartCountObj.html()) - 1);
            }

            gsap.to(".modal__in", {
                scale: 0,
                duration: 1,
                ease: "bounce",
                onComplete: function() {
                    $('.modal__blur').removeClass('isVisible');
                    $('.modal').removeClass('isOpened');
                }
            });

            calculateTotal();

            if (!$('.cart__left_product').length) {
                setTimeout(function () {
                    openModal('empty_cart');
                }, 2500);
            }
        },
        error:function (err) {
            console.log(err);
        }
    });


});

$('.change-qty').click(function () {
    const obj = $(this);
    var cartId = obj.data('id');
    var operationType = obj.data('opt-type');
    var countObj = obj.parent().find('.count');
    var quantity = 1;
    if(operationType === 'add') {
        quantity = parseInt(countObj.html()) + 1;
    } else {
        if(parseInt(countObj.html()) === 1) {
            return;
        }
        quantity = parseInt(countObj.html()) - 1;
    }
    countObj.html(quantity);

    $.ajax({
        type:'PUT',
        url: '/api/v1/carts/'+cartId,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {quantity: quantity},
        success:function(res){
            obj.closest('.cart__left_product, .cart__right_product').find('.item-row-total').html(moneyFormat(res.data.price * quantity));
            calculateTotal();
        },
        error:function (err) {
            console.log(err);
        }
    });
});

function calculateTotal() {
    var subTotal = 0;
    $('.cart__left_product, .cart__right_product').each(function () {
        var obj = $(this);
        subTotal += strToFloat(obj.find('.item-row-total').html());
    });
    $('#cart-sub-total').html(moneyFormat(subTotal));

    var shippingMethod = $("input[name='shipping_method']:checked");
    if(shippingMethod.val()) {
        var shippingCharge = shippingMethod.val() === 'courier'?19.95:11.95;
       subTotal += shippingCharge;
    }
    var gst = subTotal * 0.05; //5%
    var total = subTotal + gst;
    $('#cart-gst').html(moneyFormat(gst));

    var disObj = $('#discount-amount');
    var discount = disObj.attr('data-balance')?strToFloat(disObj.attr('data-balance')):0;
    console.log(discount);
    if(discount > total) {
        discount = total;
    }
    disObj.html(moneyFormat(discount));
    $('#cart-total').html(moneyFormat( total - discount));
}

$("input[name='shipping_method']").change(function () {
    var shippingCharge = $(this).val() === 'courier'?19.95:11.95;
    $('#shipping-charge').html(shippingCharge);
   calculateTotal();
});

$('#addressSelection').change(function () {
   var addId = $(this).val();
    var addArr = $('input[name="address_array"]').val();
    addArr = $.parseJSON(addArr);
    var address = addArr.find(({id})=>id === parseInt(addId));
    var orderFields = ['first_name', 'last_name', 'phone', 'business_name', 'address_line_1',
        'address_line_2', 'postal_code', 'city', 'state', 'country'];
    for (let field in orderFields) {
        $(`[name="ship_${orderFields[field]}"]`).val(address?address[orderFields[field]]:'');
    }
});

$(':radio[name="address"]').change(function() {
    var addressType = $(this).filter(':checked').val();
    if(addressType === 'old') {
        $('#addressSelection').show();
    } else {
        $('#addressSelection').hide();
    }
});

function strToFloat(str) {
    if(str) {
        return parseFloat(str.replace(/,/g, ''));
    }
    return str;
}

function moneyFormat(number) {
    return number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}



// Fake modals

// $('.add_to_cart').click(function(e) {
//     e.preventDefault();
//     $(this).addClass('isLoading');
//     setTimeout(() => {
//         openModal('add_to_cart_modal');
//         $(this).removeClass('isLoading');
//     }, 2000);
// });
// $('.add_to_wishlist').click(function(e) {
//     e.preventDefault();
//     $(this).addClass('isLoading');
//     setTimeout(() => {
//         openModal('add_to_wishlist_modal');
//         $(this).removeClass('isLoading');
//     }, 2000);
// });

$(".add_to_wishlist").click(function(e){
    e.preventDefault();

    const obj = $(this);
    obj.addClass('isLoading');
    var action = obj.data('action');
    var productId = obj.data('product-id');

    $.ajax({
        type:'POST',
        url: action,
        data:{product_id:productId},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(res){
            obj.removeClass('isLoading');
            openModal('add_to_wishlist_modal');
            $('#wish_count').html(res.wishlist_count);
        },
        error:function (err) {
            obj.removeClass('isLoading');
            console.log(err);
        }
    });

});

$('.remove-wishlist').click(function(e) {
    e.preventDefault();
    var listId = $(this).data('id');
    listId = listId?listId:'all';
    $.ajax({
        type:'DELETE',
        url: '/api/v1/wishlists/'+listId,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(res){
            var listCountObj = $('#wish_count');
            if(listId === 'all') {
                $('.catalog_products__item').remove();
                listCountObj.html(0);
            } else {
                $('#wishlist-item-'+ listId).remove();
                listCountObj.html(parseInt(listCountObj.html()) - 1);
            }

            if (!$('.catalog_products__item').length) {
                setTimeout(function () {
                    openModal('wishlist_empty');
                }, 2000);
            }
        },
        error:function (err) {
            console.log(err);
        }
    });


});

$('#clear_cart').click(function() {
    var cartModal = $('.clear_cart');
    cartModal.find('.remove-cart').data('id', '');
    openModal('clear_cart');
});
$('.remove_product_button').click(function() {
    var cartModal = $('.clear_cart');
    cartModal.find('.products__item_price').html('$'+$(this).data('price'));
    cartModal.find('.products__item_name').html($(this).data('name'));
    cartModal.find('.products__item_image img').attr('src', $(this).data('src'));
    cartModal.find('.remove-cart').data('id', $(this).data('id'));
    cartModal.find('#rating').html(parseFloat($(this).data('rating')).toFixed(1));
    cartModal.find('.products__item_stars_in').css('width', $(this).data('rating')*20 + '%');
    // $("p").css("background-color", "yellow");
    openModal('remove_product');
});

if (!$('.cart__left_product').length) {
    openModal('empty_cart');
}

$('.preview_gift_opener').click(function() {
    openModal('gift_preview');
});


$('.clear_order_list').click(function() {
    openModal('clear_orders');
});

$('.clear_recent_button').click(function(e) {
    e.preventDefault();
    openModal('clear_recent');
});

$('.clear_wishlist').click(function(e) {
    e.preventDefault();
    // var cartModal = $('.clear_cart');
    $(this).find('.remove-wishlist').data('id', '');
    openModal('clear_wishlist');
});

if (!$('.dashboard__order_item').length) {
    openModal('orders_empty');
}

if (!$('.catalog_products__item').length) {
    openModal('recent_empty');
    openModal('wishlist_empty');
}
// setTimeout(function() {
//     openModal('add_to_cart');
// }, 2000);


$(document).ready(function () {
    var result =  getParameterByName('payment');
    if(result === 'success') {
        openModal('payment_details');
    }

    $.ajax({
        type:'GET',
        url: '/api/v1/carts/count?wishlist=show',
        success:function(res){
            $('#cart_count').html(res.cart_count);
            $('#wish_count').html(res.wishlist_count);
        },
        error:function (err) {
            console.log(err);
        }
    });
});

function getParameterByName( name ){
    var regexS = "[\\?&]"+name+"=([^&#]*)",
        regex = new RegExp( regexS ),
        results = regex.exec( window.location.search );
    if( results == null ){
        return "";
    } else{
        return decodeURIComponent(results[1].replace(/\+/g, " "));
    }
}

$('.ajax_review_form').on("submit", function(event) {
    event.preventDefault();
    let action = $(this).attr('action');
    let data = $(this).serialize();
    let rating = $("input[name='rating']:checked").val();
    if(!rating) {
        alert('Please enter your rating.');
        return false;
    }
    $(this).find('.button').addClass('isLoading');

    $.ajax({
        type: "POST",
        url: action,
        data: data,
        success: result => {
            $(this).find('.button').removeClass('isLoading');
            openModal("review-success-modal");
        },
        error: error => {
            console.log(error.responseJSON);
            $(this).find('.button').removeClass('isLoading');
            openModal("review-error-modal");
            $('.review-error-modal-error-msg').text(error.responseJSON.message);
        },
    });
});

$('.review_modal_close').click(function(e) {
    e.preventDefault();
    gsap.to(".modal__in", {
        scale: 0,
        duration: 1,
        ease: "bounce",
        onComplete: function() {
            $('.modal__blur').removeClass('isVisible');
            $('.modal').removeClass('isOpened');
        }
    });

    location.reload();
});

$('.address-delete').on("click", function(event) {
    event.preventDefault();
    let action = $(this).parent().attr('action');
    let data = $(this).parent().serialize();

    $.ajax({
        type: "POST",
        url: action,
        data: data,
        success: result => {
            location.reload();
        },
        error: error => {
            location.reload();
        },
    });
});
