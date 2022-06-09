<template>
  <div id="sign-in">
    <header>
      <h1>Entrar</h1>
      <p>Autentique-se antes de acessar o sistema.</p>
    </header>
    <form @change="checkInputs" @submit.prevent="sendCredentials">
      <form-input
        type="text"
        label="nome"
        name="name"
        placeholder="Informe seu nome"
        v-model="credentials.name"
        required
      />
      <form-input
        type="password"
        label="senha"
        name="password"
        placeholder="Informe sua senha"
        v-model="credentials.password"
        required
      />
      <form-button :buttonDisabled="disabled">Entrar</form-button>
    </form>
    <div class="shortcuts">
      <p class="shortcut-link">
        Não tem uma conta? <router-link to="/sign-up">Criar conta</router-link>
      </p>
      <p class="shortcut-link mt-1">
        <router-link to="/reset-password">Esqueci minha senha</router-link>
      </p>
    </div>
    <button class="return-button">
      <router-link to="/">
        <span class="material-symbols-outlined">
          arrow_back
        </span>
      </router-link>
    </button>
  </div>
</template>

<script>
// @ is an alias to /src
import FormInput from '@/components/FormInput.vue';
import FormButton from '@/components/FormButton.vue';

export default {
  name: 'SignInView',
  components: {
    FormInput,
    FormButton
  },
  data() {
    return {
      credentials: {
        name: "",
        password: ""
      },
      disabled: true
    }
  },
  methods: {
    sendCredentials() {
      console.log(this.credentials);
    },
     checkInputs() {
      // Verifica se os inputs estão preenchidos
      let credentialsValues = Object.values(this.credentials);
      let isEmpty = false;
      
      credentialsValues.forEach(credential => {
        if(credential == '') {
          isEmpty = true;
        }
      })
      
      isEmpty ? this.disabled = true : this.disabled = false;
    }
  }
}
</script>

<style scoped lang="scss">
#sign-in {
  @apply flex flex-col items-center justify-center text-center h-screen;
}

form {
  @apply my-2 flex flex-col w-[500px];
  
}

header {
  h1 {
    @apply text-black text-[40px] font-medium;
  }
}

.return-button span {
  @apply absolute top-4 left-4 p-2 rounded transition text-black;

  &:hover {
    @apply bg-zinc-200;
  }
}

.shortcuts {
  @apply text-black;

  a {
    @apply text-sky-500 underline underline-offset-1;

    &:hover {
      @apply text-sky-600;
    }
  }
}
</style>
