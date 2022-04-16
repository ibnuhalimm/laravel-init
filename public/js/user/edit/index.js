$('#__btnCancelEditUser').on('click', function () {
    $('#__modalConfirmCancelUpdate').doModal('show');
    modalBackToTop();
});

$('#__btnCancelCancelUpdate').on('click', function () {
    $('#__modalConfirmCancelUpdate').doModal('hide');
});
