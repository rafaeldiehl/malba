<template>
  <nav class="dashboard-navbar">
    <div class="container">
      <ul class="dashboard-links">
        <li v-for="link in links" :key="link.key" :class="{ 'active': link.active }">
          <router-link :to="link.path">
            <div class="img-container">
              <img :src="link.icon" />
            </div>
            <span v-if="!mobileView">{{ link.name }}</span>
          </router-link>
        </li>
      </ul>
      <div class="profile">
        <router-link to="/dashboard/profile" class="picture">
          <img :src="avatar.src" :alt="avatar.alt">
          <img v-if="isAdmin" :src="icons.star.src" :alt="icons.star.alt" class="star">
          <span v-else class="level">1</span>
        </router-link>
        <div class="profile-data" v-if="!mobileView">
          <h3>{{ username }}</h3>
          <button v-if="isAdmin" @click="logout">Encerrar sessão</button>
          <router-link v-else to="/dashboard/profile">Ver perfil</router-link>
        </div>
      </div>
    </div>
  </nav>  
</template>

<script>
// import example from "@/assets/avatars/avatar2.png";

import starIcon from "@/assets/icons/star.svg";
import homeIcon from "@/assets/icons/home.svg";
import configIcon from "@/assets/icons/config.svg";
import medalIcon from "@/assets/icons/medal.svg";

import store from "@/store";
import axiosClient from "@/services/axios";

export default {
  name: 'NavBar',
  data() {
    return {
      links: [
        {
          key: "home",
          name: 'Início',
          path: '/dashboard',
          active: this.active == 'home',
          icon: homeIcon
        },
        {
          key: "config",
          name: 'Configurações',
          path: '/dashboard/config',
          active: this.active == 'config',
          icon: configIcon
        },
        {
          key: "conquests",
          name: 'Conquistas',
          path: '/dashboard/conquests',
          active: this.active == 'conquests',
          icon: medalIcon
        }
      ],
      icons: {
        star: {
          src: starIcon,
          alt: 'Estrela'
        }
      },
      mobileView: false,
      avatar: {
        id: store.state.user.data.avatar,
        alt: '',
        src: ''
      },
      isAdmin: store.state.user.data.isAdmin
    }
  },
  computed: {
    username() {
      return store.state.user.data.username;
    }
  },
  props: {
    active: {
      validator(value) {
        return ['home', 'config', 'conquests'].includes(value)
      }
    }
  },
  methods: {
    handleMobileView() {
      this.mobileView = window.innerWidth <= 680;
    },
    logout() {
      store.commit("logout");
      this.$router.go();
    }
  },
  created() {
    this.handleMobileView();
    window.addEventListener("resize", () => {
      this.handleMobileView();
    });

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
.dashboard-navbar {
  @apply h-[5.25rem] z-50 w-screen fixed top-0 left-0 bg-white flex justify-center items-center border-b-zinc-200 border-b-2;

  @media (max-width: 1000px) {
    @apply px-5;
  }

  @media (max-width: 680px) {
    @apply top-auto bottom-0;
  }
}

.container {
  @apply max-w-[1000px] flex flex-row justify-between items-center;

  @media (max-width: 680px) {
    @apply justify-center;
  }
}

.dashboard-links {
  @apply flex flex-row gap-6;

  li a {
    @apply flex flex-row gap-3 rounded-lg justify-center items-center px-3 py-2;

    &:hover {
      @apply bg-zinc-200;
    }
  }

  .img-container {
    @apply h-5 w-5 flex justify-center items-center rounded-lg gap-3;
  }

  @media (max-width: 680px) {
    .img-container {
      @apply h-16 w-16 flex justify-center items-center rounded-lg gap-10;

      &:hover {
        @apply bg-zinc-200;
      }
    }

    img {
      @apply h-[80%];
    }
  }
}

.profile {
  @apply flex flex-row gap-5 px-4 transition;

  .picture {
    @apply relative;

    img {
      @apply rounded-full h-[3.25rem];
    }

    .star, .level {
      @apply absolute text-xs bottom-[-0.9em] font-bold text-white bg-sky-900 w-5 h-5 flex justify-center items-center rounded-full border-[3px] border-sky-500 left-1/2 translate-x-[-50%] z-20;
    }

    &:after {
      content: '';
      @apply absolute w-[3.9rem] h-[3.9rem] border-sky-500 border-[3px] top-1/2 left-1/2 rounded-full translate-x-[-50%] -translate-y-[50%] z-10;
    }
      
    &:hover {
      @apply brightness-105;
    }

    @media (max-width: 680px) {
      @apply ml-7;
    }
  }

  .profile-data {
    @apply flex flex-col justify-center items-start;

    h3 {
      @apply text-zinc-900 font-medium text-xl;
    }

    button, a {
      @apply text-sky-600 underline underline-offset-2 text-sm transition;

      &:hover {
        @apply text-sky-500;
      }
    }
  }
}

.active {
  @apply text-zinc-900 select-none;

  img {
    @apply brightness-50;
  }
}
</style>
