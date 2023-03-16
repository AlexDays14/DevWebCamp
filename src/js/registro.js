import Swal from 'sweetalert2';

(function(){
    let eventos = [];
    const resumen = document.querySelector('#registro-aside-resumen');
    if(resumen){
        mostrarEventos();

        const botones = document.querySelectorAll('.evento__boton');
        botones.forEach(boton => boton.addEventListener('click', seleccionarEvento));
        
        const formulario = document.querySelector('#registro')
        formulario.addEventListener('submit', submitFormulario);


        function seleccionarEvento({target}){

            if(eventos.length >= 5){
                Swal.fire({
                    title: 'Error',
                    text: 'Solo puedes agregar hasta 5 eventos',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
                return;
            }
            //Deshabilitar el boton
            target.disabled = true;
            eventos = [...eventos, {
                id: target.dataset.id,
                titulo: target.parentElement.querySelector('.evento__nombre').textContent.trim()
            }]

            mostrarEventos();
        }

        function mostrarEventos(){
            //Limpiar HTML
            limpiarEventos();

            if(eventos.length > 0){
                eventos.forEach(evento => {

                    const eventoDOM = document.createElement('div');
                    eventoDOM.classList.add('registro__evento');

                    const titulo = document.createElement('h3');
                    titulo.classList.add('registro__nombre');
                    titulo.textContent = evento.titulo;

                    const eliminar = document.createElement('button');
                    eliminar.classList.add('registro__eliminar');
                    eliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`
                    eliminar.onclick = function(){
                        eliminarEvento(evento.id);
                    };

                    eventoDOM.appendChild(titulo);
                    eventoDOM.appendChild(eliminar);
                    resumen.appendChild(eventoDOM);
                })
            }else{
                const noRegistro = document.createElement('p');
                noRegistro.textContent = 'No Hay Eventos, Añade Hasta 5 a tu Registro';
                noRegistro.classList.add('registro__texto');
                resumen.appendChild(noRegistro);
            }
        }

        function limpiarEventos(){
            while(resumen.firstChild){
                resumen.removeChild(resumen.firstChild);
            }
        }

        function eliminarEvento(id){
            eventos = eventos.filter(evento => evento.id !== id);
            const botonAgregar = document.querySelector(`[data-id="${id}"]`)
            botonAgregar.disabled = false;
            mostrarEventos();
        }

        async function submitFormulario(e){
            e.preventDefault();

            //Regalo
            const regaloId = document.querySelector('#regalo').value;
            const eventosId = eventos.map(evento => evento.id);

            if(eventosId.length === 0 || regaloId === ''){
                Swal.fire({
                    title: 'Error',
                    text: 'Debes elegir al menos 1 evento y 1 regalo',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
                return;
            }

            //Formdata
            const datos = new FormData();
            datos.append('regalo', regaloId);
            datos.append('eventos', eventosId);

            const url = '/finalizar-registro/conferencias';
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            })
            const resultado = await respuesta.json();

            if(resultado.resultado){
                Swal.fire(
                    'Registro Exitoso',
                    'Muchas Gracias por Registrarte a los Eventos, Te Esperamos en DevWebCamp',
                    'success'
                ).then(() => location.href = `/boleto?id=${resultado.token}`
                )
            }else{
                Swal.fire({
                    title: 'Error',
                    text: resultado.respuesta ? resultado.respuesta : 'Hubo un Error',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                }).then(() => location.reload())
            }
        }
    }
})();