<template>
  <div id="dashboard">
    <nav-bar></nav-bar>
    <div class="container">
      <header>
        <h3>Visualizar perfil</h3>
        <p>Abaixo estão os dados de sua conta.</p>
      </header>
      <div class="user-profile">
        <div class="profile-data">
          <div class="avatar-container">
            <img :src="avatar.src" :alt="avatar.alt">
            <span class="level">1</span>
          </div>
          <div class="data-container">
            <div>
              <span class="level-badge">Nível 1</span>
              <span class="ranking-badge">
                <svg width="25" height="25" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_156_50)">
                <path d="M13.4167 2.33333H10.8889V1.36111C10.8889 1.03785 10.6288 0.777779 10.3056 0.777779H3.69444C3.37118 0.777779 3.11111 1.03785 3.11111 1.36111V2.33333H0.583333C0.260069 2.33333 0 2.5934 0 2.91667V4.27778C0 5.14549 0.546875 6.0375 1.50451 6.72535C2.27014 7.27708 3.20104 7.62708 4.17812 7.73889C4.94132 9.00521 5.83333 9.52778 5.83333 9.52778V11.2778H4.66667C3.80868 11.2778 3.11111 11.7809 3.11111 12.6389V12.9306C3.11111 13.091 3.24236 13.2222 3.40278 13.2222H10.5972C10.7576 13.2222 10.8889 13.091 10.8889 12.9306V12.6389C10.8889 11.7809 10.1913 11.2778 9.33333 11.2778H8.16667V9.52778C8.16667 9.52778 9.05868 9.00521 9.82188 7.73889C10.8014 7.62708 11.7323 7.27708 12.4955 6.72535C13.4507 6.0375 14 5.14549 14 4.27778V2.91667C14 2.5934 13.7399 2.33333 13.4167 2.33333ZM2.41354 5.46389C1.82049 5.03611 1.55556 4.55972 1.55556 4.27778V3.88889H3.11597C3.14028 4.68125 3.25694 5.37639 3.42708 5.98403C3.06007 5.85764 2.71736 5.68264 2.41354 5.46389ZM12.4444 4.27778C12.4444 4.6691 12.0142 5.15521 11.5865 5.46389C11.2826 5.68264 10.9375 5.85764 10.5705 5.98403C10.7406 5.37639 10.8573 4.68125 10.8816 3.88889H12.4444V4.27778Z" fill="#F59E0B"/>
                </g>
                <defs>
                <clipPath id="clip0_156_50">
                <rect width="25" height="25" fill="white"/>
                </clipPath>
                </defs>
                </svg>
                #{{ hitsData.maxRank }}
              </span>
              <span class="hearts">
                <img :src="icons.heart.src" :alt="icons.heart.alt" v-for="n in fullHearts" :key="n" />
            <img :src="icons.brokenHeart.src" :alt="icons.brokenHeart.alt" v-for="n in brokenHearts" :key="n" />
              </span>
            </div>
            <div class="progress-bar">
              <span>0 XP</span>
              <div class="border">
                <span class="paint bg-green-600" :class="'w-[' + barPercentage + '%]'"></span>
                <span class="progress-value translate-x-[-20%]" :class="'left-[' + barPercentage + '%]'">{{ xp.current }} XP</span>
              </div>
              <span>{{ xp.total }} XP</span>
            </div>
          </div>
        </div>
      </div>
      <div class="data-group">
        <div v-for="(data, index) in dataGroup" :key="index">
          <img :src="data.src" :alt="data.alt">
          <div>
            <h6>{{ data.alt }}</h6>
            <span>{{ data.content }}</span>
          </div>
        </div>
      </div>
      <div class="buttons-container">
        <router-link to="/dashboard/config">
          <img :src="icons.edit.src" :alt="icons.edit.alt">
          Alterar dados da conta
        </router-link>'
        <button @click="logout">
          <img :src="icons.logout.src" :alt="icons.logout.alt">
          Encerrar sessão
        </button>
      </div>
    </div>
  </div> 
</template>

<script>
import NavBar from '@/components/Dashboard/NavBar.vue';

//import example from "@/assets/avatars/avatar2.png";

import editIcon from '@/assets/icons/edit.svg';
import logoutIcon from '@/assets/icons/logout.svg';
import trophyIcon from '@/assets/icons/trophy.svg';
import heartIcon from '@/assets/icons/heart.svg';
import brokenHeartIcon from '@/assets/icons/broken-heart.svg';
import userIcon from '@/assets/icons/user.svg';
import usernameIcon from '@/assets/icons/username.svg';
import mailIcon from '@/assets/icons/mail.svg';
import themeIcon from '@/assets/icons/theme.svg';

import store from '@/store';
import axiosClient from '@/services/axios';

export default {
  name: 'UserProfileView',
  components: {
    NavBar
  },
  data() {
    return {
      icons: {
        edit: {
          src: editIcon,
          alt: 'Editar'
        },
        logout: {
          src: logoutIcon,
          alt: 'Encerrar sessão'
        },
        trophy: {
          src: trophyIcon,
          alt: "Ícone de um troféu"
        },
        heart: {
          src: heartIcon,
          alt: "Ponto de vida cheio"
        },
        brokenHeart: {
          src: brokenHeartIcon,
          alt: "Ponto de vida vazio"
        }
      },
      dataGroup: {
        user: {
          src: userIcon,
          alt: "Usuário",
          content: store.state.user.data.name
        },
        mail: {
          src: mailIcon,
          alt: "E-mail",
          content: store.state.user.data.email
        },
        username: {
          src: usernameIcon,
          alt: "Nome de usuário",
          content: store.state.user.data.username
        },
        theme: {
          src: themeIcon,
          alt: "Tema de cor",
          content: store.state.user.data.isDarkTheme ? 'Tema escuro' : 'Tema claro'
        }
      },
      xp: {
        current: store.state.user.data.xp,
        total: 50,
      },
      hp: store.state.user.data.hp,
      hitsData: {
        hits: store.state.user.data.hits,
        monthHits: store.state.user.data.monthHits,
        maxRank: store.state.user.data.maxRank
      },
      avatar: {
        id: store.state.user.data.avatar,
        src: '',
        alt: ''
      }
    }
  },
  computed: {
    necessaryXp() {
      return this.xp.total - this.xp.current
    },
    barPercentage() {
      return (this.xp.current/this.xp.total)*100;
    },
    brokenHearts() {
      return Math.abs(this.hp - 3);
    },
    fullHearts() {
      return this.hp;
    }
  },
  methods: {
    logout() {
      store.commit("logout");
      this.$router.go();
    }
  },
  created() {
    axiosClient.get(`/avatars/${this.avatar.id}`)
        .then((res) => res.data)
        .then((res) => {
          this.avatar.src = res.imageUrl;
          this.avatar.alt = res.name;
        });
  }
}
</script>

<style lang="scss" scoped>
#dashboard {
  @apply bg-zinc-100 min-h-screen flex flex-col justify-center items-center;
}

.container {
  @apply max-w-[610px] mt-32 flex flex-col gap-6 mb-10 bg-white rounded-xl border-2 border-zinc-200 p-10;

  @media (max-width: 680px) {
    @apply mt-0 w-[95vw];
  }
}

header {
  h3 {
    @apply text-2xl text-zinc-900 mb-1 font-medium;
  }
}

.user-profile {
  @apply flex flex-row;

  .profile-data {
    @apply flex flex-row w-full justify-around gap-10;
  }

  .data-container {
    @apply w-full flex flex-col justify-center items-center;

    > * {
      &:first-child {
        @apply flex w-full justify-between items-center;

        .level-badge {
          @apply bg-sky-500 py-2 px-6 text-xs rounded-full text-white;
        }

        .ranking-badge {
          @apply flex justify-center items-center gap-2 text-2xl font-medium text-zinc-900;
        }

        .hearts {
          @apply flex gap-3;

          img {
            @apply h-8;
          }
        }
      }

      &:last-child {
        @apply flex justify-center items-center w-full mx-0;
      }
    }
  }
}

.avatar-container {
  @apply relative flex justify-center items-center w-28;

  img {
    @apply rounded-full h-[5rem] mt-[-1rem];
  }

  .level {
    @apply absolute text-base bottom-[0.5rem] font-bold text-white bg-sky-900 w-7 h-7 flex justify-center items-center rounded-full border-[3px] border-sky-500 left-1/2 translate-x-[-50%] z-20;
  }

  &:after {
    content: '';
    @apply absolute w-[5.8rem] h-[5.8rem] border-sky-500 border-4 top-[calc(50%-1rem)] left-1/2 rounded-full translate-x-[-50%] translate-y-[calc(-50%+0.5rem)] z-10;
  }

  @media (max-width: 550px) {
    @apply hidden;
  }
}

.progress-bar {
  @apply flex flex-row justify-center items-center ml-[-1.8rem] mt-6 mb-10 font-medium text-zinc-900;

  .border {
    @apply w-[250px] h-[15px] mx-3 bg-zinc-300 rounded-[9999px] relative;

    .paint {
      @apply h-[15px] left-0 top-0 absolute rounded-[9999px];
    }

    .progress-value {
      @apply absolute bottom-[-1.5rem] ml-[-1rem] text-xs;
    }
  }
}

.buttons-container {
  @apply flex flex-col mt-3;

  > * {
    @apply mx-5 rounded-lg flex flex-row justify-center items-center gap-1 text-white py-4;

    &:first-child {
      @apply bg-sky-500;

      &:hover {
        @apply bg-sky-600;
      }
    }

    &:last-child {
      @apply bg-red-500 -mt-1;
      
      &:hover {
        @apply bg-red-600;
      }
    }
  }
}

.data-group {
  @apply flex flex-row gap-3 flex-wrap justify-center items-center;

  > div {
    @apply w-[45%] flex flex-row gap-3;

    img {
      @apply w-8;
    }

    h6 {
      @apply text-xs;
    }

    span {
      @apply text-zinc-900;
    }
  }
}
</style>