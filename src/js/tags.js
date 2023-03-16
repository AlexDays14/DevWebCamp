(function (){
    const tagsInput = document.querySelector('#tags_input');

    if(tagsInput){

        const tagsDiv = document.querySelector('#tags');
        const tagsInputHidden = document.querySelector('[name="tags"]');
        let tags = [];

        //Recuperar del Input Hidden
        if(tagsInputHidden.value !== ''){
            tags = tagsInputHidden.value.split(',');
            mostrarTags();
        }

        //Escuchar los cambios en el input
        tagsInput.addEventListener('keypress', guardarTag)

        function guardarTag(e){
            if(e.keyCode === 44 || e.keyCode === 13){
                
                if(tagsInput.value.trim() === '' || tagsInput.value.length < 1){
                    return
                }

                e.preventDefault();

                tags = [...tags, e.target.value.trim()];

                tagsInput.value = '';

                mostrarTags();
            }
        }

        function mostrarTags(){
            tagsDiv.textContent = '';
            tags.forEach(tag =>{
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('formulario__tag');
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag;
                tagsDiv.appendChild(etiqueta);
            })
            actualizarInputHidden();
        }

        function eliminarTag(e){
            tags = tags.filter(tag => tag !== e.target.textContent);
            mostrarTags();
        }

        function actualizarInputHidden(){
            tagsInputHidden.value = tags.toString();
        }

    }
})();