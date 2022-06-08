<template>
  <div id="sign-in">
    <form @submit.prevent="sendCredentials">
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
      <form-button>Entrar</form-button>
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
      }
    }
  },
  methods: {
    sendCredentials() {
      console.log(this.credentials);
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
