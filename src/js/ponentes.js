(function(){
    const inputPonentes = document.querySelector('#ponentes');
    if(inputPonentes){
        let ponentes = [];
        let ponentesFiltrados =[];
        const listadoPonentes = document.querySelector('#listado-ponentes');
        const inputHiddenPonente = document.querySelector('[name = "ponente_id"]');

        obtenerPonentes();
        inputPonentes.addEventListener('input', buscarPonentes)

        async function obtenerPonentes(){
            const url = `/api/ponentes`;

            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            formatearPonentes(resultado);

            if(inputHiddenPonente.value != ''){
                ponentesFiltrados = ponentes.filter(ponente =>{
                    if(ponente.id == inputHiddenPonente.value){
                        return ponente;
                    }
                })
                inputPonentes.value = ponentesFiltrados[0].nombre;
                mostrarPonentes();
                const ponenteActivo = document.querySelector(`[data-id = "${inputHiddenPonente.value}"]`);
                ponenteActivo.classList.add('listado-ponentes__ponente--seleccionado');
            }
        }

        function formatearPonentes(arrayPonentes){
            ponentes = arrayPonentes.map(ponente => {
                return {
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    id: ponente.id
                }
            })
        }

        function buscarPonentes(e){
            const busqueda = e.target.value;

            if(busqueda.length > 2){
                const expresion = new RegExp(busqueda, 'i');
                ponentesFiltrados = ponentes.filter(ponente =>{
                    if(ponente.nombre.toLowerCase().search(expresion) != -1){
                        return ponente;
                    }
                })
            }else{
                ponentesFiltrados = [];
            }
            mostrarPonentes();
        }

        function mostrarPonentes(){
            while(listadoPonentes.firstChild){
                listadoPonentes.removeChild(listadoPonentes.firstChild);
            }

            if(ponentesFiltrados.length > 0){

                ponentesFiltrados.forEach(ponente => {
                    const ponenteHTML = document.createElement('li');
                    ponenteHTML.classList.add('listado-ponentes__ponente')
                    ponenteHTML.textContent = ponente.nombre;
                    ponenteHTML.dataset.id = ponente.id;
                    listadoPonentes.appendChild(ponenteHTML);

                    ponenteHTML.addEventListener('click', seleccionarPonente);
                })
            } else{
                const noResultados = document.createElement('p');
                noResultados.classList.add('listado-ponentes__no-resultados');
                noResultados.textContent = 'No hay resultados';
                listadoPonentes.appendChild(noResultados);
                inputHiddenPonente.value = '';
            }

        }

        function seleccionarPonente(e){
            //Desactivar
            const ponenteActivo = document.querySelector('.listado-ponentes__ponente--seleccionado')
            if(ponenteActivo){
                ponenteActivo.classList.remove('listado-ponentes__ponente--seleccionado')
            }

            const ponente = e.target
            ponente.classList.add('listado-ponentes__ponente--seleccionado');
            inputHiddenPonente.value = ponente.dataset.id;
        }
    }
})();