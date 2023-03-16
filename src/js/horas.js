(function (){
    const horas = document.querySelector('#horas')
    if(horas){

        let busqueda = {
            categoria_id: '',
            dia: '',
        }

        const categoria = document.querySelector('[name = "categoria_id"]')
        const dias = document.querySelectorAll('[name = "dia"]')
        const inputHiddenDia = document.querySelector('[name = "dia_id"]')
        const inputHiddenHora = document.querySelector('[name = "hora_id"]')

        if(categoria.value != ''){
            busqueda.categoria_id = categoria.value;
        }
        if(inputHiddenDia.value != ''){
            busqueda.dia = inputHiddenDia.value;
        }
        if(!Object.values(busqueda).includes('')){
            (async () => {
                await buscarEventos()

                //Resaltar la hora seleccionada
                const horaActiva = document.querySelector(`[data-hora-id = "${inputHiddenHora.value}"]`)
                horaActiva.classList.remove('horas__hora--deshabilitado')
                horaActiva.classList.add('horas__hora--activo')
                horaActiva.onclick = seleccionarHora;
            })();
        }
        console.log(busqueda)

        categoria.addEventListener('change', terminoBusqueda)
        dias.forEach(dia => dia.addEventListener('change', terminoBusqueda))

        function terminoBusqueda(e){
            busqueda[e.target.name] = e.target.value;

            //Reiniciar los campos ocultos y el eselector de horas
            inputHiddenHora.value = ''
            inputHiddenDia.value = ''

            const horaActiva = document.querySelector('.horas__hora--activo')
            if(horaActiva){
                horaActiva.classList.remove('horas__hora--activo')
            }

            if(Object.values(busqueda).includes('')){
                return
            }
            
            buscarEventos()
        }

        async function buscarEventos(){
            const { categoria_id, dia } = busqueda
            const url = `/api/eventos-horario?dia_id=${categoria_id}&categoria_id=${dia}`;

            const resultado = await fetch(url);
            const eventos = await resultado.json();
            
            obtenerHorasDisponibles(eventos);
        }

        function obtenerHorasDisponibles(eventos){
            //Reiniciar las horas
            const listadoHoras = document.querySelectorAll('.horas__hora')
            listadoHoras.forEach(hora => hora.classList.add('horas__hora--deshabilitado'))

            //Comprobar eventos ya tomados
            const horasTomadas = eventos.map(evento => evento.hora_id)
            const arrayHoras = Array.from(listadoHoras);

            const resultado = arrayHoras.filter(li => !horasTomadas.includes(li.dataset.horaId))
            resultado.forEach(hora => hora.classList.remove('horas__hora--deshabilitado'))

            const horasDisponibles = document.querySelectorAll('.horas__hora:not(.horas__hora--deshabilitado)');
            horasDisponibles.forEach(hora => hora.addEventListener('click', seleccionarHora))
        }

        function seleccionarHora(e){
            //Desactivar la hora previa
            const horaActiva = document.querySelector('.horas__hora--activo')
            if(horaActiva){
                horaActiva.classList.remove('horas__hora--activo')
            }

            //Agregar clase de seleccionado
            if(e.target.classList.contains('horas__hora--deshabilitado')){
                return
            }
            e.target.classList.add('horas__hora--activo')
            inputHiddenHora.value = e.target.dataset.horaId;
            inputHiddenDia.value = document.querySelector('[name = "dia"]:checked').value;
        }

    }
})();