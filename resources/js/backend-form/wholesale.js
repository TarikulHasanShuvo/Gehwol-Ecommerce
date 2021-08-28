import $ from "jquery";
import {gsap} from "gsap/all";

$('.wholesale_form').on("submit", function(event) {
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
            if (result) {
                $('.wholesale_form')[0].reset();
                $(this).find('.button').removeClass('isLoading');
                openModal($target_modal);
            }
        },
        error: error => {
            console.log(error.responseJSON);
            $(this).find('.button').removeClass('isLoading');
        },
    });

    //console.log(data);
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
                // console.log('modal is opened');
            }
        });
    } else {
        console.warn(`Sorry. Modal [data-modal_name="${modal_name}"] is not found!`);
    }
}