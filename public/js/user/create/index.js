$('#__btnCancelCreateUser').on('click', function () {
    $('#__modalConfirmCancelStore').doModal('show');
    modalBackToTop();
});

$('#__btnCancelCancelStore').on('click', function () {
    $('#__modalConfirmCancelStore').doModal('hide');
});
