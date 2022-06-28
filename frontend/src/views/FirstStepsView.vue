<template>
  <div id="first-steps">
    <div v-if="step == 0" class="welcome">
      <h1>
        Seja bem-vindo!
        <img :src="icons.hand.src" :alt="icons.hand.alt">
      </h1>
      <p>
        Olá, {{ name }}. Neste primeiro acesso, serão configurados alguns dados e suas preferências. Mas não se preocupe, você pode alterar suas preferências no futuro caso ache necessário!
      </p>
      <form-button @click="this.step++">Começar</form-button>
    </div>
    <div v-if="step == 1" class="username">
      <h2>Crie um nome de usuário</h2>
      <p>
        O nome de usuário será o seu nome dentro do jogo.<br/>
        Pense em algo criativo e único!
      </p>
      <form-input
          type="text"
          label="nome de usuário"
          name="password-confirm"
          placeholder="Informe seu nome de usuário"
          v-model="username"
          @change="checkUsername"
          required
      ></form-input>
      <form-button @click="this.step++" :buttonDisabled="disabled">Continuar</form-button>
    </div>
    <div v-if="step == 2" class="theme">
      <h2>Selecione o tema de cor</h2>
      <p>Clique nos botões abaixo para selecionar a sua preferência de cores do sistema. Quando estiver decidido, clique em continuar.</p>
      <div class="theme-containers">
        <div class="theme-container" @click="activeLightTheme" :class="{ 'active': !isDarkTheme }">
          <img :src="images.lightTheme.src" :alt="images.lightTheme.alt">
          <p>
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
          </p>
        </div>
        <div class="theme-container" @click="activeDarkTheme"  :class="{ 'active': isDarkTheme }">
          <img :src="images.darkTheme.src" :alt="images.darkTheme.alt">
          <p>
            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.25 7.46083C12.1582 8.45379 11.7856 9.40007 11.1756 10.189C10.5657 10.9778 9.74371 11.5767 8.80583 11.9155C7.86795 12.2542 6.85299 12.3189 5.87971 12.1019C4.90643 11.8849 4.01508 11.3952 3.30997 10.69C2.60485 9.98492 2.11513 9.09357 1.89812 8.12029C1.6811 7.14701 1.74575 6.13205 2.08452 5.19417C2.42329 4.2563 3.02215 3.4343 3.81104 2.82436C4.59993 2.21441 5.54622 1.84176 6.53917 1.75C5.95783 2.53649 5.67808 3.50551 5.75081 4.48082C5.82355 5.45614 6.24392 6.37295 6.93549 7.06452C7.62705 7.75608 8.54387 8.17646 9.51918 8.24919C10.4945 8.32192 11.4635 8.04218 12.25 7.46083V7.46083Z" :stroke="iconColor.moon" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Tema escuro
          </p>
        </div>
      </div>
      <form-button @click="this.step++">Continuar</form-button>
    </div>
    <div v-if="step == 3" class="avatar">
      <h2>Selecione um avatar</h2>
      <p>Você pode desbloquear mais avatares conforme progredir no jogo!</p>
      <ul class="avatar-container">
        <li v-for="avatar in avatars" :key="avatar.id" @click="changeAvatar(avatar.id)" :class="{ 'active': this.avatar == avatar.id }">
          <img :src="avatar.imageUrl" :alt="avatar.name">
          <span class="name">{{ avatar.name }}</span>
        </li>
      </ul>
      <form-button @click="this.step++">Continuar</form-button>
    </div>
    <div v-if="step == 4" class="confirm">
      <h2>Confirmação</h2>
      <ul>
        <li>
          <img :src="icons.username.src" :alt="icons.username.alt">
          <div>
            <span>Nome de usuário</span>
            <p>{{ this.username }}</p>
          </div>
        </li>
        <li>
          <img :src="icons.theme.src" :alt="icons.theme.alt">
          <div>
            <span>Tema</span>
            <p>{{ colorTheme }}</p>
          </div>
        </li>
        <li>
          <img :src="icons.avatar.src" :alt="icons.avatar.alt">
          <div>
            <span>Avatar</span>
            <p>{{ this.avatarName }}</p>
          </div>
        </li>
      </ul>
      <p>Deseja salvar esses dados?</p>
      <div class="button-container">
        <form-button @click="sendData">Confirmar</form-button>
        <button @click="this.step = 1">Não, quero mudar</button>
      </div>
      <p class="tip">
        Você poderá alterar suas preferências a qualquer momento.
      </p>
    </div>
  </div>
</template>

<script>
import handEmoji from '@/assets/icons/hand-emoji.svg';
import moonIcon from '@/assets/icons/moon.svg';
import sunIcon from '@/assets/icons/sun.svg';
import themeIcon from '@/assets/icons/theme.svg';
import avatarIcon from '@/assets/icons/avatar.svg';
import usernameIcon from '@/assets/icons/username.svg';
import lightThemeImg from '@/assets/themes/light_theme.png';
import darkThemeImg from '@/assets/themes/dark_theme.png';

import axiosClient from '@/services/axios';
import store from '@/store';

import FormInput from '@/components/Form/FormInput.vue';
import FormButton from '@/components/Form/FormButton.vue';

export default {
  name: 'FirstStepsView',
  components: {
    FormInput,
    FormButton
  },
  data() {
    return {
      username: null,
      isDarkTheme: false,
      avatar: 1,
      name: store.state.user.data.name,
      step: 0,
      images: {
        lightTheme: {
          src: lightThemeImg,
          alt: 'Tema claro'
        },
        darkTheme: {
          src: darkThemeImg,
          alt: 'Tema escuro'
        }
      },
      icons: {
        hand: {
          src: handEmoji,
          alt: 'Boas vindas'
        },
        moon: {
          src: moonIcon,
          alt: 'Noite'
        },
        sun: {
          src: sunIcon,
          alt: 'Dia'
        },
        avatar: {
          src: avatarIcon,
          alt: 'Avatar'
        },
        username: {
          src: usernameIcon,
          alt: 'Nome de usuário'
        },
        theme: {
          src: themeIcon,
          alt: 'Tema'
        }
      },
      disabled: true,
      iconColor: {
        sun: '#0ea5e9',
        moon: '#27272A'
      },
      avatars: null,
      avatarName: null,
    }
  },
  computed: {
    colorTheme() {
      if(this.isDarkTheme) {
        return 'Escuro';
      } else {
        return 'Claro';
      }
    }
  },
  methods: {
    async sendData() {
      const user = {
        id: store.state.user.data.id,
        credentials: {
          username: this.username,
          isDarkTheme: this.isDarkTheme,
          avatar: this.avatar,
          hits: 0,
          monthHits: 0,
          maxRank: 10,
          xp: 0,
          hp: 3
        }
      };

      await store
        .dispatch('update', user)
        .then(() => {
          this.$router.push({name: "dashboard"});
        })
        .catch((err) => {
          console.log(err);
          this.axiosError = true;
        });
    },
    checkUsername() {
      if(this.username) {
        this.disabled = false;
      } else {
        this.disabled = true;
      }
    },
    activeLightTheme() {
      this.isDarkTheme = false;
      this.iconColor.sun = '#0ea5e9';
      this.iconColor.moon = '#27272A';
    },
    activeDarkTheme() {
      this.isDarkTheme = true;
      this.iconColor.sun = '#27272A';
      this.iconColor.moon = '#0ea5e9';
    },
    getAllAvatars() {
      axiosClient.get("/avatars")
        .then((res) => {
          this.avatars = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getAvatar() {
      axiosClient.get(`/avatars/${this.avatar}`)
        .then((res) => res.data)
        .then((res) => {
          this.avatarName = res.name;
        });
    },
    changeAvatar(id) {
      this.avatar = id;
      this.getAvatar();
    },
  },
  created() {
    this.getAllAvatars();
  }
}
</script>

<style lang="scss" scoped>
#first-steps {
  @apply flex justify-center items-center min-h-screen;

  > div {
    @apply flex flex-col justify-center items-center gap-5 m-10 text-center gap-2;

    h2 {
      @apply text-[2.5rem] font-medium text-zinc-900;
    }

    > div {
      @apply w-full;
    };
  }

  .welcome {
    h1 {
      @apply flex flex-row justify-center items-center text-zinc-900 font-medium gap-5 text-[4.25rem];

      @media (max-width: 620px) {
        @apply text-4xl;

        img {
          @apply h-[2.5rem];
        }

        p {
          @apply max-w-[400px];
        }
      }
    }

    p {
      @apply max-w-[680px] text-lg text-center;
    }
  }

  .username {
    @apply max-w-[500px];
  }

  .theme {
    @apply max-w-[600px];

    .theme-containers {
      @apply flex justify-center items-center gap-5 my-5;

      .theme-container {
        > img {
          @apply border-[3px] border-zinc-300 rounded-3xl;
        }

        p {
          @apply flex justify-center items-center gap-3 mt-2;
        }
      }
      
      .active {
        @apply text-blue-500;

        > img {
          @apply border-blue-500;
        }
      }
    }
  }

  .avatar {
    .avatar-container {
      @apply flex justify-center items-center gap-5 flex-wrap py-5;

      img {
        @apply h-28 rounded-lg border-[3px] border-zinc-300;
      }
    }

    .active {
      @apply text-blue-500;

      img {
        @apply border-blue-500;
      }
    }
  }

  .confirm {
    @apply w-[520px] mx-10;

    .tip {
      @apply text-blue-500 text-sm;
    }

    ul {
      li {
        @apply flex justify-start items-center gap-5 py-3 px-8 border-b-2 border-b-zinc-300;

        img {
          @apply w-8;
        }

        div {
          @apply flex flex-col justify-start items-start;
        }

        &:last-child {
          @apply border-b-0;
        }
      }

      span {
        @apply text-xs;
      }

      p {
        @apply text-zinc-800;
      }
    }

    .button-container {
      @apply flex justify-center items-center gap-5 w-full;

      .form-button {
        @apply w-full;
      }

      button:last-child {
        @apply w-full text-center p-4 rounded-lg text-xl my-4 transition border-2 border-zinc-500;

        &:hover:not(:disabled) {
          @apply border-blue-500 text-blue-600 rounded-none;
        }
      }

      @media (max-width: 375px) {
        @apply flex-col gap-1;

        button:last-child {
          @apply mt-1 mb-4;
        }
      }
    }
  }
}
</style>