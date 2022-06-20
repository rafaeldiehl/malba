<template>
  <div id="sign-in">
    <header>
      <h1>Cadastrar-se</h1>
      <p>Registre-se agora mesmo com seu e-mail.</p>
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
        type="email"
        label="e-mail"
        name="email"
        placeholder="Informe seu e-mail"
        v-model="credentials.email"
        required
      />
      <form-input
        type="password"
        label="senha"
        name="password"
        placeholder="Crie uma senha"
        v-model="credentials.password"
        required
      />
      <form-input
        type="password"
        label="senha"
        name="password-confirm"
        placeholder="Digite sua senha novamente"
        v-model="credentials.passwordConfirm"
        required
      />
      <div class="error-message" v-if="passwordError">
        As duas senhas não coincidem, verifique-as.
      </div>
      <form-button :buttonDisabled="disabled">Criar conta</form-button>
    </form>
    <div class="shortcuts">
      <p class="shortcut-link">
        Já tem uma conta? <router-link to="/sign-in">Faça login</router-link>
      </p>
    </div>
    <button class="return-button">
      <router-link to="/">
        <span class="material-symbols-outlined">
          arrow_back
        </span>
      </router-link>
    </button>
    <div class="modal" v-if="modal">
      <div class="container">
        <div class="mail">
          <img :src="icons.markEmailRead.src" :alt="icons.markEmailRead.alt" />
        </div>
        <h2>Link de verificação enviado</h2>
        <p>Um link para verificação da conta foi enviado para seu e-mail. Caso não o encontre, verifique a caixa de spam.</p>
        <button class="close-button" @click="closeModal">
          <span class="material-symbols-outlined">
            close
          </span>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import FormInput from '@/components/Form/FormInput.vue';
import FormButton from '@/components/Form/FormButton.vue';

import markEmailReadIcon from '@/assets/icons/mark-email-read.svg';

export default {
  name: 'SignUpView',
  components: {
    FormInput,
    FormButton
  },
  data() {
    return {
      icons: {
        markEmailRead: {
          src: markEmailReadIcon,
          alt: 'E-mail confirmado'
        }
      },
      credentials: {
        name: "",
        email: "",
        password: "",
        passwordConfirm: ""
      },
      disabled: true,
      passwordError: false,
      modal: false
    }
  },
  methods: {
    sendCredentials() {
      console.log(this.credentials);
      this.modal = true;
    },
    checkInputs() {
      let error = false;

      // Verifica se os inputs estão preenchidos
      let credentialsValues = Object.values(this.credentials);
      credentialsValues.forEach(credential => {
        if(credential == '') {
          error = true;
        }
      })

      // Verifica se as senhas coincidem
      if(this.credentials.password != '' && this.credentials.passwordConfirm != '') {
        if(this.credentials.password == this.credentials.passwordConfirm ) {
          this.passwordError = false;
        } else {
          this.passwordError = true;
          error = true;
        }
      }
      
      error ? this.disabled = true : this.disabled = false;
    },
    closeModal() {
      this.modal = false;
    }
  }
}
</script>

<style scoped lang="scss">
#sign-in {
  @apply flex flex-col items-center justify-center text-center min-h-screen p-14;
}

form {
  @apply my-2 flex flex-col w-[500px];
  
  @media (max-width: 550px) {
    @apply w-[90vw];
  }
}

header {
  h1 {
    @apply text-black text-[40px] font-medium;

    @media (max-width: 363px) {
      @apply text-[30px];
    }

    @media (max-width: 300px) {
      @apply text-[25px];
    }
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

.error-message {
  @apply w-full text-red-500 text-center text-sm;
}

.modal {
  @apply h-screen w-screen fixed bg-black bg-opacity-40 flex justify-center items-center top-0 left-0;

  .container {
    @apply bg-white relative w-[600px] p-16 m-8 rounded-xl flex flex-col justify-center items-center;

    .mail {
      @apply h-[75px] w-[75px] bg-zinc-100 rounded-xl flex items-center justify-center mb-4;
    }

    h2 {
      @apply text-black text-2xl font-medium mb-2;
    }

    .close-button {
      @apply absolute top-3 right-3 transition;

      span {
        @apply p-1 rounded;

        &:hover {
          @apply text-black bg-zinc-200;
        }
      }
    }

    @media (max-width: 450px) {
      @apply p-8;
    }
  }
}
</style>
