<template>
  <div id="dashboard">
    <nav-bar active="config"></nav-bar>
    <div class="container">
      <header>
        <h3>Configurações da conta</h3>
        <p>Preencha os campos abaixo para alterar os dados de sua conta.</p>
      </header>
      <form @submit.prevent="sendData">
        <div class="form-container">
          <div class="avatar-selector-container">
            <h4>Avatar</h4>
            <div class="avatar-selector">
              <img class="avatar" :src="imageUrl" :alt="images.avatar.alt">
              <span class="edit-ping"></span>
              <span class="edit-button" @click="showAvatars">
                <img :src="icons.edit.src" :alt="icons.edit.alt">
              </span>
            </div>
          </div>
          <div class="theme-selector-container">
            <h4>Selecione um tema de cor</h4>
            <div class="theme-selector">
              <div class="theme" :class="{ 'active-theme': credentials.theme == false }" @click="activeLightTheme">
                <img :src="images.themes.light.src" :alt="images.themes.light.alt">
                <span>
                  <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_228_193)">
                  <path d="M6 8.5C7.38071 8.5 8.5 7.38071 8.5 6C8.5 4.61929 7.38071 3.5 6 3.5C4.61929 3.5 3.5 4.61929 3.5 6C3.5 7.38071 4.61929 8.5 6 8.5Z" :stroke="iconColor.sun" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M6 0.5V1.5" :stroke="iconColor.sun" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M6 10.5V11.5" :stroke="iconColor.sun" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M2.11 2.10999L2.82 2.81999" :stroke="iconColor.sun" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M9.18 9.17999L9.89 9.88999" :stroke="iconColor.sun" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M0.5 6H1.5" :stroke="iconColor.sun" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M10.5 6H11.5" :stroke="iconColor.sun" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M2.11 9.88999L2.82 9.17999" :stroke="iconColor.sun" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M9.18 2.81999L9.89 2.10999" :stroke="iconColor.sun" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </g>
                  <defs>
                  <clipPath id="clip0_228_193">
                  <rect width="12" height="12" fill="white"/>
                  </clipPath>
                  </defs>
                  </svg>  
                  Tema claro
                </span>
              </div>
              <div class="theme" :class="{ 'active-theme': credentials.theme == true }" @click="activeDarkTheme">
                <img :src="images.themes.dark.src" :alt="images.themes.dark.alt">
                <span>
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.25 7.46083C12.1582 8.45379 11.7856 9.40007 11.1756 10.189C10.5657 10.9778 9.74371 11.5767 8.80583 11.9155C7.86795 12.2542 6.85299 12.3189 5.87971 12.1019C4.90643 11.8849 4.01508 11.3952 3.30997 10.69C2.60485 9.98492 2.11513 9.09357 1.89812 8.12029C1.6811 7.14701 1.74575 6.13205 2.08452 5.19417C2.42329 4.2563 3.02215 3.4343 3.81104 2.82436C4.59993 2.21441 5.54622 1.84176 6.53917 1.75C5.95783 2.53649 5.67808 3.50551 5.75081 4.48082C5.82355 5.45614 6.24392 6.37295 6.93549 7.06452C7.62705 7.75608 8.54387 8.17646 9.51918 8.24919C10.4945 8.32192 11.4635 8.04218 12.25 7.46083V7.46083Z" :stroke="iconColor.moon" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  Tema escuro
                </span>
              </div>
            </div>
          </div>

        </div>
        <form-input
          type="text"
          label="nome"
          name="password"
          placeholder="Informe seu nome"
          v-model="credentials.name"
          required
        />
        <form-input
          type="text"
          label="nome de usuário"
          name="password-confirm"
          placeholder="Informe seu nome de usuário"
          v-model="credentials.username"
          required
        />
        <form-button>Salvar</form-button>
      </form>
      <div class="danger-zone">
        <hr>
        <header>
          <img :src="icons.danger.src" :alt="icons.danger.alt">
          Área perigosa
        </header>
        <div class="button-container">
          <router-link to="/reset-password">
            <img :src="icons.lock.src" :alt="icons.lock.alt">
            Alterar senha
          </router-link>'
          <button>
            <img :src="icons.trash.src" :alt="icons.trash.alt">
            Apagar conta
          </button>
        </div>
      </div>
    </div>
  </div>
  <div v-if="avatarModal" class="avatar-modal">
    <div class="card">
      <div v-if="avatars" class="modal-success">
        <h3>Selecione um avatar</h3>
        <ul>
          <li v-for="avatar in avatars" :key="avatar.id" @click="changeAvatar(avatar.id)">
            <img :src="avatar.imageUrl" :alt="avatar.name">
            <span class="name">{{ avatar.name }}</span>
          </li>
        </ul>
      </div>
      <div v-else class="modal-error">
        <div class="icon">
          <img :src="icons.close.src" :alt="icons.close.alt">
        </div>
        <h4>Ocorreu um erro</h4>
        <p>Houve um problema ao tentar exibir os avatares.</p>
      </div>
      <div class="close-button" @click="closeAvatarModal">
         <span class="material-symbols-outlined">
          close
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from '@/components/Dashboard/NavBar.vue';
import FormInput from '@/components/Form/FormInput.vue';
import FormButton from '@/components/Form/FormButton.vue';

import example from "@/assets/avatars/avatar2.png";
import lightThemeImg from "@/assets/themes/light_theme.png";
import darkThemeImg from "@/assets/themes/dark_theme.png";

import closeIcon from '@/assets/icons/close.svg';
import editIcon from '@/assets/icons/edit.svg';
import dangerIcon from '@/assets/icons/danger.svg';
import lockIcon from '@/assets/icons/lock.svg';
import trashIcon from '@/assets/icons/trash.svg';

import axios from 'axios';

export default {
  name: 'ConfigPageView',
  components: {
    NavBar,
    FormInput,
    FormButton
  },
  data() {
    return {
      images: {
        avatar: {
          src: example,
          alt: 'Avatar teste'
        },
        themes: {
          light: {
            src: lightThemeImg,
            alt: 'Tema Claro'
          },
          dark: {
            src: darkThemeImg,
            alt: 'Tema escuro'
          }
        }
      },
      credentials: {
        avatarId: 2,
        theme: false,
        name: "Ednaldo Pereira",
        username: "user123"
      },
      icons: {
        close: {
          src: closeIcon,
          alt: 'Erro'
        },
        edit: {
          src: editIcon,
          alt: 'Editar'
        },
        danger: {
          src: dangerIcon,
          alt: 'Perigo'
        },
        lock: {
          src: lockIcon,
          alt: 'Cadeado'
        },
        trash: {
          src: trashIcon,
          alt: 'Lixeira'
        }
      },
      iconColor: {
        sun: '#0ea5e9',
        moon: '#27272A'
      },
      avatarModal: false,
      avatars: null
    }
  },
  computed: {
    imageUrl: function() {
      if(this.avatars) {
        return this.avatars[this.credentials.avatarId - 1].imageUrl
      }
      return this.images.avatar.src;
    }
  }, 
  created() {
    this.getAvatars();
  },
  methods: {
    getAvatars() {
      axios
        .get("http://localhost:8000/api/avatars")
        .then((res) => {
          this.avatars = res.data;
          console.log('GET /avatars ', res.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    closeAvatarModal() {
      this.avatarModal = false;
    },
    showAvatars() {
      this.avatarModal = true;
      this.getAvatars();
    },
    changeAvatar(id) {
      this.credentials.avatarId = id;
      this.closeAvatarModal();
    },
    activeLightTheme() {
      this.credentials.theme = false;
      this.iconColor.sun = '#0ea5e9';
      this.iconColor.moon = '#27272A';
    },
    activeDarkTheme() {
      this.credentials.theme = true;
      this.iconColor.sun = '#27272A';
      this.iconColor.moon = '#0ea5e9';
    },
    sendData() {
      console.log(this.credentials);
    }
  }
}
</script>

<style lang="scss" scoped>
#dashboard {
  @apply bg-zinc-100 min-h-screen flex flex-col justify-center items-center;
}

.container {
  @apply max-w-[610px] mt-32 flex flex-col gap-6 mb-10 bg-white rounded-xl border-2 border-zinc-200 p-10;

  form {
    .form-container {
      @apply flex flex-row justify-around gap-5;
      .avatar-selector-container {
        @apply w-28 mb-3 text-center;

        h4 {
          @apply mb-2 text-zinc-800 text-sm;
        }
      }

      .avatar-selector {
        @apply relative;

        .avatar {
          @apply w-36 rounded-full border-[5px] border-sky-500;
        }

        .edit-button {
          @apply absolute bottom-0 p-[0.35rem] bg-sky-500 w-8 rounded-full right-0 transition;

           &:hover {
            @apply bg-sky-600;
          }
        }

        .edit-ping {
          @apply absolute bottom-0 p-[0.35rem] bg-sky-500 h-8 w-8 rounded-full right-0 animate-ping;
        }
      }

      .theme-selector-container {
        @apply text-center text-zinc-800;

        h4 {
          @apply mb-2 text-zinc-800 text-sm;
        }
      }

      .theme-selector {
        @apply flex flex-row justify-center items-center gap-5;

        .theme {
           @apply flex flex-col justify-center items-center gap-2;

           span {
             @apply flex flex-row justify-center items-center gap-1 text-sm;
           }
        }

        .active-theme {
          @apply text-sky-600; 

          img {
            @apply border-sky-600;
          }
        }

        img {
          @apply h-28 border-4 border-zinc-400 rounded-lg;
        }
      }
    }
  }
}

header {
  h3 {
    @apply text-2xl text-zinc-900 mb-1 font-medium;
  }
}

.danger-zone {
  @apply relative;

  hr {
    @apply border-zinc-400 border-t-2;
  }

  header {
    @apply px-4 py-2 bg-white -top-5 left-1/2 -translate-x-1/2 absolute flex justify-center items-center gap-2; 
  }

  .button-container {
    @apply flex flex-row justify-center items-center gap-1 mt-6;

    > * {
      @apply w-full flex flex-row justify-center items-center gap-3 py-4 rounded-lg text-white transition;

      &:first-child {
        @apply bg-sky-600;

        &:hover {
          @apply bg-sky-700;
        }
      }

      &:last-child {
        @apply bg-red-500;

        &:hover {
          @apply bg-red-600;
        }
      }
    }
  }
}

.avatar-modal {
  @apply h-screen w-screen fixed top-0 left-0 bg-black bg-opacity-30 z-50 flex justify-center items-center;

  .card {
    @apply bg-white rounded-xl w-[90vw] max-w-[400px] p-16 flex flex-col justify-center items-center relative;
  }

  .modal-success {
    @apply flex flex-col justify-center items-center gap-5 w-[90vw] mx-5  text-lg text-center;

    h3 {
      @apply text-xl text-zinc-700;
    }

    ul {
      @apply max-w-[300px] flex flex-row justify-center items-center gap-5 flex-wrap;

      li {
        @apply transition;

        img {
          @apply h-28 rounded-xl border-4 border-zinc-300 transition;
        }

        span {
          @apply text-sm mt-1 font-medium;
        }

        &:hover {
          @apply text-sky-600;

          img {
            @apply border-sky-600;
          }
        }
      }
    }

    button {
      @apply bg-sky-600 text-white py-3 px-5 transition rounded;

      &:hover {
        @apply bg-sky-500;
      }
    }
  }

  .modal-error {
    @apply flex flex-col justify-center items-center gap-5 text-lg text-center;

    h4 {
      @apply text-3xl text-zinc-900 font-medium;
    }

    .icon {
      @apply p-4 bg-zinc-100 rounded-xl;
    }
  }

  .close-button span {
    @apply absolute top-4 right-4 p-1 rounded transition cursor-pointer;

    &:hover {
      @apply bg-zinc-200 text-black;
    }
  }
}
</style>