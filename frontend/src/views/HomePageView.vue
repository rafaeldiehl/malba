<template>
  <div id="home">
    <div class="home-container">
      <nav>
        <div class="flex-container">
           <header>
            <img :src="logo.src" :alt="logo.alt" />
          </header>
          <ul class="home-links flex-container">
            <li>
              <a href="#sobre">Sobre</a>
            </li>
            <li>
              <a href="#duvidas">Dúvidas frequentes</a>
            </li>
            <li>
              <a href="#contato">Contato</a>
            </li>
          </ul>
        </div>
        <ul class="sign-links">
          <li>
            <router-link to="sign-in">Entrar</router-link>
          </li>
          <li>
            <router-link to="sign-up">Criar conta</router-link>
          </li>
        </ul>
      </nav>
      <main>
        <header>
          <h1>
            Aprenda matemática de forma fácil
          </h1>
          <p>Através de um ensino lúdico e ferramentas minimalistas, aprenda Matemática básica e resolva exercícios gratuitamente.</p>
          <button>
            <router-link to="sign-up">Quero experimentar</router-link>
          </button>
        </header>
        <img :src="mockup.src" :alt="mockup.alt">
      </main>
    </div>
    
  </div>
</template>

<script>
import logoImgHorizontal from "@/assets/logo_horizontal.png";
import logoImg from "@/assets/logo.png";
import mockupImg from "@/assets/other/home_mockup.png";

export default {
  name: 'HomePageView',
  data() {
    return {
      logo: {
        src: logoImgHorizontal,
        alt: 'Malba'
      },
      mockup: {
        src: mockupImg,
        alt: 'Telas do Malba'
      }
    }
  },
  methods: {
    handleMobileView() {
      if(window.innerWidth <= 460) {
        this.logo.src = logoImg;
      } else {
        this.logo.src = logoImgHorizontal;
      }
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
#home {
  @apply flex justify-center items-center overflow-x-hidden;
}

main {
  @apply flex justify-between items-center min-h-[calc(100vh-7rem)];

  header {
    @apply mt-[-3rem] w-[90vw] max-w-[480px] min-h-[calc(100vh-7rem)] flex flex-col justify-center items-start gap-5;

    h1 {
      @apply text-zinc-900 text-5xl font-medium leading-tight;
    }

    p {
      @apply mb-8 text-xl;
    }

    button {
      a {
        @apply bg-sky-600 rounded-lg text-white text-xl py-5 px-7;

        &:hover {
          @apply bg-sky-500;
        }
      }
    }
  }

  img {
    @apply w-[650px] mr-[-6.5rem];

    @media (max-width: 1100px) {
      @apply w-[500px] mr-[-5rem];
    }

    @media (max-width: 950px) {
      @apply w-[90vw] max-w-[600px] mr-0 my-10;
    }
  }

  @media (max-width: 950px) {
    @apply flex-col justify-center gap-5;

    header {
      @apply text-center items-center min-h-[100%] my-10;
    }
  }

}

.home-container {
  @apply w-[95vw] max-w-[1100px] min-h-[100vh];
}

.flex-container {
  @apply flex flex-row gap-5 justify-center items-center;
}

.home-links {
  a:hover {
    @apply text-sky-600;
  }

  @media (max-width: 950px) {
    @apply hidden;
  }
}

nav {
  @apply flex flex-row items-center justify-between h-28 text-xl;

  img {
    @apply h-16 mr-8;
  }

  .sign-links {
    @apply flex flex-row items-center gap-5 text-black;

    li {
      &:hover {
        @apply text-sky-500;
      }

      &:last-child {
        a {
          @apply bg-sky-600 text-white rounded-lg py-3 px-7 transition ml-3;

          &:hover {
            @apply bg-sky-500;
          }
        }
      }
    }
  }
}

@media (max-width: 1100px) {
  nav, main {
    @apply mx-5;
  }

}
</style>