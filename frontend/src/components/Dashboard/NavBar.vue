<template>
  <nav class="dashboard-navbar">
    <div class="container">
      <ul class="dashboard-links">
        <li v-for="link in links" :key="link.key" :class="{ 'active': link.active }">
          <router-link :to="link.path">
            <g v-html="link.svg"></g>
            <span v-if="!mobileView">{{ link.name }}</span>
          </router-link>
        </li>
      </ul>
      <div class="profile">
        <div class="picture">
          <img :src="avatar.src" :alt="avatar.alt">
          <span class="level">1</span>
        </div>
        <div class="profile-data" v-if="!mobileView">
          <h3>12345678910111</h3>
          <router-link to="/dashboard/profile">Ver perfil</router-link>
        </div>
      </div>
    </div>
  </nav>  
</template>

<script>
import example from "@/assets/avatars/avatar2.png";

export default {
  name: 'NavBar',
  data() {
    return {
      avatar: {
        src: example,
        alt: 'Avatar teste'
      },
      links: [
        {
          key: "home",
          name: 'Início',
          path: '/dashboard',
          active: this.active == 'home',
          svg: `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_195_96)">
                  <path d="M9.73507 6.25904L3.33333 11.5316V17.2222C3.33333 17.3696 3.39187 17.5109 3.49605 17.6151C3.60024 17.7193 3.74155 17.7778 3.88889 17.7778L7.77986 17.7677C7.92672 17.767 8.06732 17.7081 8.1709 17.604C8.27449 17.4999 8.33264 17.359 8.33264 17.2122V13.8889C8.33264 13.7416 8.39117 13.6002 8.49536 13.4961C8.59955 13.3919 8.74085 13.3333 8.8882 13.3333H11.1104C11.2578 13.3333 11.3991 13.3919 11.5033 13.4961C11.6074 13.6002 11.666 13.7416 11.666 13.8889V17.2097C11.6657 17.2828 11.6799 17.3553 11.7078 17.4229C11.7356 17.4905 11.7765 17.5519 11.8281 17.6037C11.8797 17.6555 11.941 17.6965 12.0085 17.7246C12.076 17.7526 12.1484 17.767 12.2215 17.767L16.1111 17.7778C16.2585 17.7778 16.3998 17.7193 16.5039 17.6151C16.6081 17.5109 16.6667 17.3696 16.6667 17.2222V11.5278L10.2663 6.25904C10.1911 6.19839 10.0973 6.16531 10.0007 6.16531C9.90405 6.16531 9.81032 6.19839 9.73507 6.25904ZM19.8472 9.84272L16.9444 7.45001V2.64064C16.9444 2.53013 16.9005 2.42415 16.8224 2.34601C16.7443 2.26787 16.6383 2.22397 16.5278 2.22397H14.5833C14.4728 2.22397 14.3668 2.26787 14.2887 2.34601C14.2106 2.42415 14.1667 2.53013 14.1667 2.64064V5.16182L11.058 2.60418C10.7597 2.35868 10.3853 2.22446 9.99896 2.22446C9.61261 2.22446 9.23826 2.35868 8.93993 2.60418L0.150696 9.84272C0.108504 9.87759 0.0735971 9.92043 0.0479694 9.9688C0.0223416 10.0172 0.00649535 10.0701 0.00133612 10.1246C-0.00382312 10.1791 0.00180574 10.2341 0.0179011 10.2864C0.0339964 10.3387 0.0602428 10.3874 0.0951405 10.4295L0.980557 11.5059C1.01536 11.5482 1.05817 11.5833 1.10653 11.609C1.15489 11.6348 1.20786 11.6507 1.26239 11.656C1.31693 11.6613 1.37197 11.6557 1.42436 11.6397C1.47675 11.6236 1.52546 11.5974 1.56771 11.5625L9.73507 4.83543C9.81032 4.77478 9.90405 4.7417 10.0007 4.7417C10.0973 4.7417 10.1911 4.77478 10.2663 4.83543L18.434 11.5625C18.4762 11.5974 18.5248 11.6237 18.5772 11.6397C18.6295 11.6558 18.6844 11.6615 18.7389 11.6563C18.7934 11.6512 18.8464 11.6803 18.8948 11.6097C18.9431 11.5841 18.986 11.5491 19.0208 11.507L19.9062 10.4306C19.9411 10.3882 19.9672 10.3393 19.9832 10.2867C19.9991 10.2342 20.0044 10.179 19.9989 10.1244C19.9935 10.0697 19.9772 10.0167 19.9512 9.9684C19.9252 9.92007 19.8898 9.87735 19.8472 9.84272Z" fill="${this.active == 'home' ?  '#0284c7' : '#71717A'}"/>
                  </g>
                  <defs>
                  <clipPath id="clip0_195_96">
                  <rect width="20" height="20" fill="white"/>
                  </clipPath>
                  </defs>
                </svg>`
        },
        {
          key: "config",
          name: 'Configurações',
          path: '/dashboard/config',
          active: this.active == 'config',
          svg: `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M19.14 12.94C19.18 12.64 19.2 12.33 19.2 12C19.2 11.68 19.18 11.36 19.13 11.06L21.16 9.48002C21.34 9.34002 21.39 9.07002 21.28 8.87002L19.36 5.55002C19.24 5.33002 18.99 5.26002 18.77 5.33002L16.38 6.29002C15.88 5.91002 15.35 5.59002 14.76 5.35002L14.4 2.81002C14.36 2.57002 14.16 2.40002 13.92 2.40002H10.08C9.84 2.40002 9.65 2.57002 9.61 2.81002L9.25 5.35002C8.66 5.59002 8.12 5.92002 7.63 6.29002L5.24 5.33002C5.02 5.25002 4.77 5.33002 4.65 5.55002L2.74 8.87002C2.62 9.08002 2.66 9.34002 2.86 9.48002L4.89 11.06C4.84 11.36 4.8 11.69 4.8 12C4.8 12.31 4.82 12.64 4.87 12.94L2.84 14.52C2.66 14.66 2.61 14.93 2.72 15.13L4.64 18.45C4.76 18.67 5.01 18.74 5.23 18.67L7.62 17.71C8.12 18.09 8.65 18.41 9.24 18.65L9.6 21.19C9.65 21.43 9.84 21.6 10.08 21.6H13.92C14.16 21.6 14.36 21.43 14.39 21.19L14.75 18.65C15.34 18.41 15.88 18.09 16.37 17.71L18.76 18.67C18.98 18.75 19.23 18.67 19.35 18.45L21.27 15.13C21.39 14.91 21.34 14.66 21.15 14.52L19.14 12.94ZM12 15.6C10.02 15.6 8.4 13.98 8.4 12C8.4 10.02 10.02 8.40002 12 8.40002C13.98 8.40002 15.6 10.02 15.6 12C15.6 13.98 13.98 15.6 12 15.6Z" fill="${ this.active == 'config' ? '#0284c7' : '#71717A'}"/>
                </svg>`
        },
        {
          key: "conquests",
          name: 'Conquistas',
          path: '/dashboard/conquests',
          active: this.active == 'conquests',
          svg: `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8.74024 5.10742L6.03985 0.607031C5.92882 0.421898 5.77173 0.268679 5.58389 0.162298C5.39605 0.0559177 5.18385 2.65049e-06 4.96798 0H0.626179C0.12032 0 -0.175774 0.569141 0.11407 0.983594L4.46055 7.19297C5.62149 6.1082 7.09805 5.36367 8.74024 5.10742ZM19.3738 0H15.032C14.593 0 14.1859 0.230469 13.9602 0.607031L11.2598 5.10742C12.902 5.36367 14.3785 6.1082 15.5395 7.19258L19.8859 0.983594C20.1758 0.569141 19.8797 0 19.3738 0ZM10 6.25C6.20313 6.25 3.12501 9.32812 3.12501 13.125C3.12501 16.9219 6.20313 20 10 20C13.7969 20 16.875 16.9219 16.875 13.125C16.875 9.32812 13.7969 6.25 10 6.25ZM13.6141 12.393L12.1324 13.8367L12.4828 15.8766C12.5453 16.2422 12.1602 16.5215 11.8324 16.3488L10 15.3859L8.16798 16.3488C7.83985 16.5227 7.45509 16.2418 7.51759 15.8766L7.86798 13.8367L6.38634 12.393C6.11993 12.1336 6.26719 11.6809 6.63438 11.6277L8.68243 11.3293L9.59766 9.47305C9.68009 9.30586 9.83946 9.22344 9.99923 9.22344C10.1598 9.22344 10.3203 9.30703 10.4027 9.47305L11.318 11.3293L13.366 11.6277C13.7332 11.6809 13.8805 12.1336 13.6141 12.393Z" fill="${this.active == 'conquests' ? '#0284c7' : '#71717A'}"/>
                </svg>`
        }
      ],
      mobileView: false
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
    }
  },
  created() {
    this.handleMobileView();
    window.addEventListener("resize", () => {
      this.handleMobileView();
    });
  }
}
</script>

<style lang="scss" scoped>
.dashboard-navbar {
  @apply h-[5.25rem] w-screen fixed top-0 left-0 bg-white flex justify-center items-center border-b-zinc-200 border-b-2;

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
    @apply flex flex-row gap-3 py-2 px-4 rounded-lg;

    &:hover {
      @apply bg-zinc-200;
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

    .level {
      @apply absolute text-xs bottom-[-0.9em] font-bold text-white bg-sky-900 w-5 h-5 flex justify-center items-center rounded-full border-[3px] border-sky-600 left-1/2 translate-x-[-50%] z-20;
    }

    &:after {
      content: '';
      @apply absolute w-[3.9rem] h-[3.9rem] border-sky-600 border-[3px] top-1/2 left-1/2 rounded-full translate-x-[-50%] -translate-y-[50%] z-10;
    }
      
    &:hover {
      @apply brightness-105;
    }
  }

  .profile-data {
    @apply flex flex-col justify-center items-start;

    h3 {
      @apply text-zinc-900 font-medium text-xl;
    }

    a {
      @apply text-sky-600 underline underline-offset-2 text-sm transition;

      &:hover {
        @apply text-sky-500;
      }
    }
  }

}

.active {
  @apply text-sky-600;
}
</style>
