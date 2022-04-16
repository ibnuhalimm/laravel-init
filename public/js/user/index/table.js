const tableUser = $('#__tableUser').DataTable({
    serverSide: true,
    processing: true,
    ajax: {
        type: 'GET',
        url: route('user.datatable')
    },
    columns: [
        {
            name: 'DT_RowIndex',
            data: 'DT_RowIndex',
            searchable: false,
            orderable: false,
        },
        {
            name: 'name',
            data: 'name',
            searchable: true,
            orderable: true,
        },
        {
            name: 'username',
            data: 'username',
            searchable: true,
            orderable: true,
        },
        {
            name: 'email',
            data: 'email',
            searchable: true,
            orderable: true,
        },
        {
            name: 'role_name',
            data: 'role_name',
            searchable: false,
            orderable: false,
        },
        {
            name: 'action',
            data: 'action',
            searchable: false,
            orderable: false,
        },
    ],
    order: [[1, 'asc']],
});

const deleteUser = (el) => {
    const userId = el.getAttribute('data-id');
    const userName = el.getAttribute('data-name');

    Swal.fire({
        width: '400px',
        title: `Konfirmasi`,
        html: `Apakah Anda yakin ingin menghapus user <b>${userName}</b>?`,
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#4b5563',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        allowEscapeKey: false,
        allowOutsideClick: () => !Swal.isLoading(),
        backdrop: true,
        allowEnterKey: false,
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(route('user.delete', { 'id': userId }), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }

                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                });
        },
    }).then((result) => {
        if (result.value) {
            tableUser.ajax.reload(null, false);

            Swal.fire({
                title: 'Berhasil',
                text: result.value.message,
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        }
    });
}