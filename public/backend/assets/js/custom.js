// Reset Button
function resetForm(formId) {
    document.getElementById(formId).reset();
}

// Sweetalert2
function deleteData(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this record!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-'+id).submit();
            }
        })
}