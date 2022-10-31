<template>
    <div>
        <form class="col-md-12" @keyup="validate">

            <div class="col-md-10 offset-md-1">
                <label for="" class="form-label">Digite o nome do CheckList:</label>
                <input type="text" class="form-control" v-model="request.checklist_name">
            </div>

            <button @click.prevent="submitForm" id="btn_submit" :disabled="disabled"
            class="btn btn-primary col-md-6 offset-md-3 my-4" type="submit">
                <div id="containerLoading" :class="{
                    'lds-dual-ring': loading,
                }">
                    Adicionar checklist
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
                checklist_name: '',
            },
            disabled: true,
            loading: false,
            container_submit: null,
            container_loading: null,
            btn_submit: null,
        }
    },

    props: {
        id_checklist: Number,
        name_form: String,
        method_form: {
            type: String,
            default: 'post',
        }
    },

    mounted() {
        this.container_loading = document.getElementById("containerLoading");
        this.btn_submit = document.getElementById("btn_submit");

        this.request.checklist_name = this.name_form;
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
            let name = this.request.checklist_name;

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

                let url = null;

                if(this.method_form == 'put'){
                    url = '/adm/edit/' + this.id_checklist;
                }else if (this.method_form == 'delete'){
                    url = '/adm/delete/' + this.id_checklist;
                }else if(this.method_form == 'post'){
                    url = '/adm/checklists';
                }

                axios.post(
                    url, this.request,
                    {
                        _method: this.method_form,
                    }
                )
                .then((response) => {
                    this.loading = false;
                    this.loadingButton();
                    window.location = '/';
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