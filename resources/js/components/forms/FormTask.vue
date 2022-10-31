<template>
    <div>
        <form @keyup="validate" id="">

            <div class="text-center justify-content-around w-50 items-center m-auto">
                    <div class="my-2" v-for="checks of checklists" :key="checks.name">
                        <label for="" class="mx-2">{{ checks.name }}</label>
                        <input type="radio" name="radios" :value="checks.id" v-model="request.checklist_id">
                    </div>
            </div>
            <div class="col-md-6 offset-md-3">
                <label for="" class="form-label">Nome da tarefa:</label>
                <input type="text" v-model="request.task_name" class="form-control" id="">
            </div>
            <div class="col-md-6 offset-md-3">
                <label for="" class="form-label">Setor responsável pela tarefa:</label>
                <select type="text" v-model="request.responsible_task" class="form-select">
                    <option value="Gerência">Gerência</option>
                    <option value="TI">TI</option>
                    <option value="Marketing">Marketing</option>
                </select>
            </div>
            <div class="col-md-6 offset-md-3">
                <label for="" class="form-label">Título da tarefa:</label>
                <input type="text" v-model="request.task_title" class="form-control" id="">
            </div>
            <div class="col-md-6 offset-md-3">
                <label for="" class="form-label">Descrição da tarefa:</label>
                <textarea v-model="request.task_description" class="form-control" cols="30" rows="10"></textarea>
            </div>

            <button @click.prevent="submitForm" id="btn_submit" :disabled="disabled"
            class="btn btn-primary col-md-6 offset-md-3 my-4" type="submit">
                <div id="container-loading" :class="{
                    'lds-dual-ring': loading,
                }">
                    Adicionar CheckList
                </div>
            </button>
        </form> 
    </div>
</template>

<script>
export default {
    data() {
        return {
            request: {
                task_name: '',
                task_title: '',
                task_status: 0,
                responsible_task: '',
                task_description: '',
                checklist_id: null,
            },
            disabled: true,
            loading: false,
            container_submit: null,
            container_loading: null,
            btn_submit: null,
            checklists: null,
        }
    },

    props: {
        checks_id: {
            type: Array,
            default: () => [],
        },
    },

    mounted() {
        this.container_loading = document.getElementById("container-loading");
        this.btn_submit = document.getElementById("btn_submit");
        this.checklists = JSON.parse(this.checks_id);
    },

    methods: {

        loadingButton()
        {
            if(this.loading){
                this.container_loading.innerHTML = "";
                this.disabled = true;
            }else {
                this.container_loading.innerHTML = "Adicionar CheckList";
                this.disabled = false;
            }
        },

        validate()
        {
            let name = this.request.task_name;

            if(name.trim() == ''){
                this.disabled = true;
                return false;
            }
            this.disabled = false;
            return true;
        },

        submitForm()
        {
            if(!this.validate)
            {
                this.disabled = true;
                this.btn_submit.disabled = true;
            }else {

                this.loading = true;
                this.loadingButton();

                const url = '/adm/tasks';

                axios.post(url, this.request)
                .then((response) => {
                    this.loading = false;
                    this.loadingButton();

                    console.log(response);
                })
                .catch((error) => {
                    this.loading = false;
                    this.loadingButton();

                    console.log(error);
                })

            }
        }

    }
}
</script>

<style>

</style>