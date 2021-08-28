/*import $ from 'jquery';*/
import $ from "jquery";
import {gsap} from "gsap/all";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

});
// Save Contact
$('#contact-form').submit(function (e) {
    e.preventDefault();
    let $target_modal = $(this).data('target_modal');
    let formData = $(this).serialize();
    $(this).find('.button').addClass('isLoading');
    $.ajax({
        type   : "POST",
        url    : '/save-contact',
        data   :  formData,
        success: function (data) {
            $(this).find('.button .contact_us').removeClass('isLoading');
            $('#contact-form')[0].reset();
            openModal($target_modal)
        },
        error  : function (error) {
            console.log(error);
            $(this).find('.button').addClass('isLoading');
        }
    })
})


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
                // console.log('modal is opened');
            }
        });
    } else {
        console.warn(`Sorry. Modal [data-modal_name="${modal_name}"] is not found!`);
    }
}
