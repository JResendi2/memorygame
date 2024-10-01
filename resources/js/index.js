import * as bootstrap from 'bootstrap'

document.addEventListener('DOMContentLoaded', function(){
    const btnsDelete = document.querySelectorAll('.btn-delete-card');
    const modalDeleteHtml = document.querySelector('#modal-delete');
    const modalDelete = new bootstrap.Modal(modalDeleteHtml);
    const btnDeleteCard = document.querySelector('#btn-delete-card');
    let card_id = "";

    btnsDelete.forEach((btnDelete) => {
        btnDelete.addEventListener('click', function(e){
            e.preventDefault();
            const btn = e.target.closest('.btn-delete-card');
            card_id = btn.getAttribute('data-id');
            modalDelete.show();
        });
    });

    btnDeleteCard.addEventListener('click', function(e){

        fetch(route('cards.destroy', card_id), {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            }
        ).then((response) => response.json())
            .then((data) => {
                window.location.reload();
            });
    })
})
