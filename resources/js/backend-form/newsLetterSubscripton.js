
import $ from "jquery";
import {gsap} from "gsap/all";

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

});
// Save Contact
$('#news-letter-subscription').submit(function (e) {
    e.preventDefault();
    let $target_modal = $(this).data('target_modal');
    let formData = $(this).serialize();
    $(this).find('.button').addClass('isLoading');
    $.ajax({
        type   : "POST",
        url    : '/save-subscription',
        data   :  formData,
        success: function (data) {
            $('#news-letter-subscription')[0].reset();
            openModal($target_modal)
            $(this).find('.button').removeClass('isLoading');
        },
        error  : function (error) {
            console.log(error);
            $(this).find('.button').removeClass('isLoading');
            openModal("review-error-modal");
            $('.review-error-modal-error-msg').text(error.responseJSON.message ? 'This email already exits.' : '');
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
