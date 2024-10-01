import * as bootstrap from 'bootstrap'

document.addEventListener('DOMContentLoaded', function () {

    const tablero = document.querySelector('.tablero');
    const modalWinHtml = document.querySelector('#modal-win');
    const formSavePlayer = document.querySelector('#form-save-player');
    const modalWin = new bootstrap.Modal(modalWinHtml);
    let card = null;
    let prev_card_id = null;
    let prev_card_num= null;

    let i = 0;
    let total = parseInt(window.total);
    let activated_cards = 0;

    let start_time = null;
    let end_time = null;
    let total_time = null;


    document.querySelectorAll('.card-null').forEach(function (cardNull) {
        /* Evento al hacer click sobre una carta para voltearla*/
        cardNull.addEventListener('click', function () {
            if(start_time === null) {
                start_time = new Date();
            };
            tablero.style.pointerEvents = 'none';
            card = this.closest('.card-emogi');
            this.classList.add('d-none');
            card.querySelector('.card-svg').classList.remove('d-none');
            activated_cards++;
            countFaceUpCards();
        })
    })

    modalWinHtml.addEventListener('show.bs.modal', (e) => {
        document.querySelector('#total-time').value = total_time;
    });


    /* Verificar cuantas cartas estan voltadas y si coinciden*/
    function countFaceUpCards() {
        if (activated_cards === 2) {
            compareCards();
        } else {
            prev_card_id = card.getAttribute('data-id');
            prev_card_num = card.getAttribute('data-num');
            tablero.style.pointerEvents = 'auto';
        }
    }

    /* Verificar si las cartas coinciden*/
    async function compareCards() {
        if (prev_card_num === card.getAttribute('data-num')) {
            i++;
            tablero.style.pointerEvents = 'auto';
            activated_cards = 0;
        } else {
            await hideCardsAfterDelay();
        }

        if (win()) {
            end_time = new Date();
            total_time = getTotalTime();
            modalWin.show();
        }
    }

    /* Ocultar las cartas cuando no coinciden */
    function hideCardsAfterDelay() {
        return new Promise((resolve) => {
            setTimeout(() => {
                hideCard(card);
                hideCard(document.querySelector(`.card-emogi[data-id='${prev_card_id}']`));
                tablero.style.pointerEvents = 'auto';
                activated_cards = 0;
                resolve();
            }, 2000);
        });
    }

    function hideCard(card) {
        card.querySelector('.card-null').classList.remove('d-none');
        card.querySelector('.card-svg').classList.add('d-none');
    }

    function win() {
        return total === i;
    }

    function getTotalTime() {
        let time_difference = end_time - start_time;
        let minutes = Math.floor(time_difference / 60000);
        let seconds = Math.floor((time_difference % 60000)/1000);
        return `${minutes} min ${seconds} seg`;
    }

    formSavePlayer.addEventListener('submit', (e)=>{
        e.preventDefault();
        const formData = new FormData(formSavePlayer);
        const start_t = getCurrentDateTime(start_time);
        const end_t = getCurrentDateTime(end_time);;

        formData.append('start-time', start_t);
        formData.append('end-time', end_t);

        fetch(formSavePlayer.action, {
            method: formSavePlayer.method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        }).then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            alert('Tu puntaje ha sido guardado');
        })
        .catch(error => {
            console.error('Ocurrió un error:', error);
        });
    });

    function getCurrentDateTime(now) {
        // Obtener año, mes y día
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Mes es de 01-12
        const day = String(now.getDate()).padStart(2, '0');

        // Obtener horas, minutos y segundos
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        // Formatear el string en el formato de MySQL
        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }



})
