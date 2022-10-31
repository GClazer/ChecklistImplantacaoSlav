<template>
    <div>
        <form @keyup="validateRegister" id="form_register">
            <div class="col-md-6 offset-md-3">
                <label for="" class="form-label">Nome:</label>
                <input type="text" v-model="request_register.name" class="form-control" id="">
            </div>
            <div class="col-md-6 offset-md-3">
                <label for="" class="form-label">Email:</label>
                <input type="text" v-model="request_register.email" class="form-control" id="">
            </div>
            <div class="col-md-6 offset-md-3">
                <label for="" class="form-label">Senha:</label>
                <input type="text" v-model="request_register.password" class="form-control" id="">
            </div>

            <button @click.prevent="submitFormRegister" id="btn_submit" :disabled="disabled"
            class="btn btn-primary col-md-6 offset-md-3 my-4" type="submit">
                <div id="container-loading" :class="{
                    'lds-dual-ring': loading,
                }">
                    Adicionar CheckList
                </div>
            </button>
        </form> 
         <!--  -->
        <form @keyup="validateLogin" id="form_login">
            <div class="col-md-6 offset-md-3">
                <label for="" class="form-label">Email:</label>
                <input type="text" v-model="request_login.email" class="form-control" id="">
            </div>
            <div class="col-md-6 offset-md-3">
                <label for="" class="form-label">Senha:</label>
                <input type="text" v-model="request_login.password" class="form-control" id="">
            </div>

            <button @click.prevent="submitFormLogin" id="btn_submit" :disabled="disabled"
            class="btn btn-primary col-md-6 offset-md-3 my-4" type="submit">
                <div id="containerLoading" :class="{
                    'lds-dual-ring': loading,
                }">
                    Acessar
                </div>
            </button>
        </form>  
      
      <div @click.prevent="changeForm" id="changeMessage" class="m-auto">
        <a href="#">Ainda não tem uma conta ? Registre-se</a>
      </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            form_register: null,
            form_login: null,
            changeMessage: null,
            request_register: {
                name: '',
                email: '',
                password: '',
            },
            request_login: {
                email: 'ivy16@example.net',
                password: '123456'
            },
            disabled: true,
            loading: false,
            container_submit: null,
            container_loading: null,
            btn_submit: null,
        }
    },

    mounted() {
        this.form_register = document.getElementById("form_register");
        this.form_login = document.getElementById("form_login");
        this.changeMessage = document.getElementById("changeMessage");
        this.container_loading = document.getElementById("containerLoading");
        this.btn_submit = document.getElementById("btn_submit");
    },

    methods: {

        changeForm(e)
        {
            if(e.path[0].innerText == 'Ainda não tem uma conta ? Registre-se')
            {
                this.form_register.style.display = 'block';
                this.form_login.style.display = 'none';
                e.path[0].innerText = "Já tem uma conta ? Faça login";
                this.changeMessage.style.width = "16%";
            }else if (e.path[0].innerText == 'Já tem uma conta ? Faça login')
            {
                this.form_login.style.display = 'block';
                this.form_register.style.display = 'none';
                e.path[0].innerText = "Ainda não tem uma conta ? Registre-se";
                this.changeMessage.style.width = "21%";
            }
        },

        loadingButton()
        {
            if(this.loading){
                this.container_loading.innerHTML = "";
                this.disabled = true;
            }else {
                this.container_loading.innerHTML = "Acessar";
                this.disabled = false;
            }
        },

        validateLogin()
        {
            let email = this.request_login.email;
            let password = this.request_login.password;

            if(email.trim() == "" || password.trim() == ""){
                this.disabled = true;
                return false;
            }

            this.disabled = false;
            return true;
        },

        submitFormLogin()
        {
            if(!this.validateLogin()){
                this.disabled = true;
                this.btn_submit.disabled = true;
                return false;
            }else {
                this.loading = true;
                this.loadingButton();

                const url = '/login';

                axios.post(url, this.request_login)
                .then(response => {
                    console.log(response);
                    this.loading = false;
                    this.loadingButton();
                    // window.location.reload();
                })
                .catch(error => {
                    console.log(error);
                    this.loading = false;
                    this.loadingButton();
                })
            }
        },

        validateRegister()
        {
            let name = this.request_register.name;
            let email = this.request_register.email;
            let password = this.request_register.password;

            if(name.trim() == "" || email.trim() == "" || password.trim() == ""){
                this.disabled = true;
                return false;
            }
            this.disabled = false;
            return true;
        },

        submitFormRegister()
        {
            if(!this.validateRegister()){
                this.disabled = true;
                this.btn_submit.disabled = true;
                return false;
            }else {
                this.loading = true;
                this.loadingButton();

                const url = '/register';

                axios.post(url, this.request_register)
                .then(response => {
                    console.log(response);
                    this.loading = false;
                    this.loadingButton();
                    window.location.reload();
                })
                .catch(error => {
                    console.log(error);
                    this.loading = false;
                    this.loadingButton();
                })
            }
        },

    }
}
</script>


<style>
    
#form_register {
    display: none;
}

#form_login {
    display: block;
}

#changeMessage {
    width: 21%;
    padding: 0;
    margin: 0;
    cursor: pointer;
}

#changeMessage a {
    width: 50%;
    text-decoration: underline;
    color: black;
}

#changeMessage a:visited {
    text-decoration: underline;
    color: black;
}

.lds-dual-ring {
  display: contents;
  width: 45px;
  height: 25px;
}
.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 25px;
  height: 25px;
  margin: 0px auto;
  border-radius: 50%;
  border: 2px solid #fff;
  border-color: #fff transparent #fff transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

</style>