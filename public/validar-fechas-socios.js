document.addEventListener('DOMContentLoaded', function () {
    function validarFechaIndividual(input, errorId) {
        const valor = input.value.trim();
        const regex = /^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[012])\/\d{4}$/;
        const errorDiv = document.getElementById(errorId);

        if (!valor) {
            errorDiv.textContent = '';
            input.classList.remove('border-red-500');
            return;
        }

        if (!regex.test(valor)) {
            errorDiv.textContent = 'Formato inválido. Usá dd/mm/yyyy';
            input.classList.add('border-red-500');
        } else {
            errorDiv.textContent = '';
            input.classList.remove('border-red-500');
        }
    }

    const campos = [
        { id: 'fecha_nac', errorId: 'error_fecha_nac' },
        { id: 'fecha_inscripcion', errorId: 'error_fecha_inscripcion' }
    ];

    campos.forEach(({ id, errorId }) => {
        const campo = document.getElementById(id);
        if (campo) {
            campo.addEventListener('blur', function () {
                validarFechaIndividual(this, errorId);
            });
        }
    });

    const form = document.getElementById('form_socio');
    if (form) {
        form.addEventListener('submit', function (e) {
            let errores = 0;

            campos.forEach(({ id, errorId }) => {
                const campo = document.getElementById(id);
                const valor = campo.value.trim();
                const regex = /^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[012])\/\d{4}$/;
                const errorDiv = document.getElementById(errorId);

                if (!regex.test(valor)) {
                    errorDiv.textContent = 'Formato inválido. Usá dd/mm/yyyy';
                    campo.classList.add('border-red-500');
                    errores++;
                } else {
                    errorDiv.textContent = '';
                    campo.classList.remove('border-red-500');
                }
            });

            if (errores > 0) {
                e.preventDefault();
            }
        });
    }
});