"use strict"

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form');
    form.addEventListener('submit', formSend);

    async function formSend(e) {
        e.preventDefault();
        console.log('1');  //check the form

        let error = formValidate(form);

        let formData = new FormData(form);

        if (error === 0) {
            let responce = await fetch('sendmail.php', {
                method: "POST",
                body: formData
            });
            if (responce.ok) {
                let result = await responce.json();
                alert (result.massage);
                form.reset();
            } else {
                alert("Error responce!");
            };
        } else {
            alert('Please fill in all fields to send the form');
        }
    }

    function formValidate(form) {
        let error = 0;
        let formReq = document.querySelectorAll('._req');

        for (let index = 0; index < formReq.length; index++) {
            const input = formReq[index];
            formRemoveError(input)

            if (input.value === '') {
                formAddError(input);
                error++;
            }
        }
        return error;
    }

    function formAddError(input) {
        input.parentElement.classList.add('_error');
        input.classList.add('_error');
    }

    function formRemoveError(input) {
        input.parentElement.classList.remove('_error');
        input.classList.remove('_error');
    }
});