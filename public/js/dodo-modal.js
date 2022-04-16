(function ($) {
    $.fn.doModal = function (state = 'hide') {
        const availableState = [
            'show', 'hide'
        ];

        if (availableState.indexOf(state) === -1) {
            throw new Error(`Unknown ${state} state`);
        }

        if (state === 'show') {
            this.removeClass('modal-hide');
            $('body').addClass('modal-open');
        }

        if (state === 'hide') {
            this.addClass('modal-hide');
            $('body').removeClass('modal-open');
        }

        return this;
    };
}(jQuery));


const modalBackToTop = () => {
    $('.modal-overflow').animate({
        scrollTop: '0'
    }, 'slow');
}