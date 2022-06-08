<template>
  <div id="sign-in">
    <form @change="checkInputs" @submit.prevent="sendCredentials">
      <form-input
        type="text"
        label="nome"
        name="name"
        placeholder="Informe seu nome"
        v-model="credentials.name"
        required
        :error="errors.nameError"
      />
      <form-input
        type="password"
        label="senha"
        name="password"
        placeholder="Informe sua senha"
        v-model="credentials.password"
        required
        :error="errors.inputError"
      />
      <form-button :buttonDisabled="disabled">Entrar</form-button>
    </form>
    <p>O nome é {{ credentials.name }}</p>
    <p>A senha é {{ credentials.password }}</p>
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
      errors: {
        nameError: false,
        passwordError: false
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
      this.credentials.name == '' ? this.errors.nameError = true : this.errors.nameError = false;
      this.credentials.password == '' ? this.errors.passwordError = true : this.errors.passwordError = false;

      // Verifica se as credenciais são válidas
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

<style lang="scss">
form {
  @apply p-5;

  .input-container, .form-button {
    @apply max-w-lg;
  }
}
</style>
