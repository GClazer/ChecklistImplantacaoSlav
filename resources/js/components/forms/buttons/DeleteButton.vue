<template>
    <div>
      <button @click.prevent="submitForm" class="btn btn-danger">Excluir</button>  
    </div>
</template>

<script>
export default {
    data() {
        return {
            
        }
    },

    props: {
        type_form: String,
        id_form: Number,
        name_form: String,
    },

    methods: {
        
        submitForm()
        {
            let confirm = null;

            if (this.type_form == 'checklist'){
                confirm = window.confirm(
                "Tem certeza que deseja apagar o checklist de nome " + 
                this.name_form + 
                "? \n" +
                "Atenção: Todas as tarefas relacionadas a esse checklist também serão apagadas"
                );
            }else if (this.type_form == 'task'){
                confirm = window.confirm(
                "Tem certeza que deseja apagar a tarefa de nome " + 
                this.name_form + 
                "?"
                );
            }

            if(confirm)
            {
                let url = null;

                if(this.type_form == 'checklist'){
                    url = '/adm/checklist/delete/' + this.id_form;
                }else if (this.type_form == 'task'){
                    url = '/adm/task/delete/' + this.id_form;
                }

                axios.post(
                    url, null,
                    {
                        _method: this.method_form,
                    }
                )
                .then((response) => {
                    window.location.reload();
                })
                .catch((error) => {
                    console.log(error);
                })
            }

        }

    },
}
</script>

<style>
    
</style>