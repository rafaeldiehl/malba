<template>
  <div id="dashboard">
    <nav-bar active="home"></nav-bar>
    <div class="container" v-if="!mobileView">
      <div class="subtopics-list">
        <div v-if="topics">
        </div>
        <div v-else class="error">
          <img :src="icons.sad.src" :alt="icons.sad.alt">
          <h3>Ops, algo deu errado</h3>
          Infelizmente não possível carregar nenhum tópico.
        </div>
      </div>
      <div class="data-list">
        <div class="progress">
          <h2>Progresso de nível</h2>
          <progress-bar :totalXp="xp.total" :currentXp="xp.current" :percentage="barPercentage"></progress-bar>
          <span class="tip">{{ necessaryXp }} XP necessários para o próximo nível</span>
        </div>

        <div class="hp">
          <h2>Pontos de vida</h2>
          <div class="hearts-container">
            <img :src="icons.heart.src" :alt="icons.heart.alt" v-for="n in fullHearts" :key="n" />
            <img :src="icons.brokenHeart.src" :alt="icons.brokenHeart.alt" v-for="n in brokenHearts" :key="n" />
          </div>
          <span class="tip">
            <img :src="icons.lightbulb.src" :alt="icons.lightbulb.alt">
            Um hp leva 10 minutos para regenerar</span>
        </div>

        <div class="hits-ranking">
          <div class="hits-container">
            <div class="hit-container">
              <span class="title">Acertos totais</span>
              <span class="value">{{ hitsData.hits }}</span>
            </div>
            <div class="hit-container">
              <span class="title">Acertos mensais</span>
              <span class="value">{{ hitsData.monthHits }}</span>
            </div>
            <div class="hit-container">
              <span class="title">Ranking máximo</span>
              <span class="value">#{{ hitsData.maxRank }}</span>
            </div>
          </div>
          <button>
            <router-link to="/dashboard/ranking">
              Visualizar ranking
              <img :src="icons.trophy.src" :alt="icons.trophy.alt" />
            </router-link>
          </button>
        </div>
      </div>
    </div>
    <div class="mobile-container" v-else>
      <header class="mobile-header">
        <button @click="this.lessonsActive = true" :class="{ 'active':lessonsActive }">
          <img :src="icons.book.src" :alt="icons.book.src">
          <span>Lições</span>
        </button>
        <button @click="this.lessonsActive = false" :class="{ 'active':!lessonsActive }">
          <span>Dados</span>
          <img :src="icons.data.src" :alt="icons.data.src">
        </button>
      </header>
      <div class="mobile-container">
        <div v-if="lessonsActive">
          <div v-if="topics">
          </div>
          <div v-else class="error">
            <img :src="icons.sad.src" :alt="icons.sad.alt">
            <h3>Ops, algo deu errado</h3>
            Infelizmente não possível carregar nenhum tópico.
          </div>
        </div>
        <div v-else>
          <div class="data-list">
            <div class="progress">
              <h2>Progresso de nível</h2>
             <progress-bar :totalXp="xp.total" :currentXp="xp.current" :percentage="barPercentage"></progress-bar>
              <span class="tip">{{ necessaryXp }} XP necessários para o próximo nível</span>
            </div>

            <div class="hp">
              <h2>Pontos de vida</h2>
              <div class="hearts-container">
                <img :src="icons.heart.src" :alt="icons.heart.alt" v-for="n in fullHearts" :key="n" />
                <img :src="icons.brokenHeart.src" :alt="icons.brokenHeart.alt" v-for="n in brokenHearts" :key="n" />
              </div>
              <span class="tip">
                <img :src="icons.lightbulb.src" :alt="icons.lightbulb.alt">
                Um hp leva 10 minutos para regenerar</span>
            </div>

            <div class="hits-ranking">
              <div class="hits-container">
                <div class="hit-container">
                  <span class="title">Acertos totais</span>
                  <span class="value">{{ hitsData.hits }}</span>
                </div>
                <div class="hit-container">
                  <span class="title">Acertos mensais</span>
                  <span class="value">{{ hitsData.monthHits }}</span>
                </div>
                <div class="hit-container">
                  <span class="title">Ranking máximo</span>
                  <span class="value">#{{ hitsData.maxRank }}</span>
                </div>
              </div>
              <button>
                <router-link to="/dashboard/ranking">
                  Visualizar ranking
                  <img :src="icons.trophy.src" :alt="icons.trophy.alt" />
                </router-link>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
</template>

<script>
import NavBar from '@/components/Dashboard/NavBar.vue';
import ProgressBar from '@/components/Dashboard/ProgressBar.vue';

import trophyIcon from '@/assets/icons/trophy.svg';
import heartIcon from '@/assets/icons/heart.svg';
import brokenHeartIcon from '@/assets/icons/broken-heart.svg';
import lightbulbIcon from '@/assets/icons/lightbulb.svg';
import sadIcon from '@/assets/icons/sad.svg';
import dataIcon from '@/assets/icons/data.svg';
import bookIcon from '@/assets/icons/book.svg';

import store from "@/store";

export default {
  name: 'UserDashboardView',
  components: {
    NavBar,
    ProgressBar
  },
  data() {
    return {
      icons: {
        trophy: {
          src: trophyIcon,
          alt: "Ícone de um troféu"
        },
        lightbulb: {
          src: lightbulbIcon,
          alt: "Ícone de lâmpada"
        },
        heart: {
          src: heartIcon,
          alt: "Ponto de vida cheio"
        },
        brokenHeart: {
          src: brokenHeartIcon,
          alt: "Ponto de vida vazio"
        },
        sad: {
          src: sadIcon,
          alt: "Desculpe pelo erro"
        },
        book: {
          src: bookIcon,
          alt: "Lições"
        },
        data: {
          src: dataIcon,
          alt: "Dados"
        }
      },
      topics: null,
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
      mobileView: false,
      lessonsActive: false,
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
#dashboard {
  @apply bg-zinc-100 min-h-screen flex flex-col justify-center items-center;
}

.container {
  @apply max-w-[1000px] mt-32 w-[95vw] flex flex-row gap-6 mb-10;
}

.subtopics-list, .data-list > div {
  @apply bg-white rounded-xl border-2 border-zinc-200 p-7;

  h2 {
    @apply text-xl font-medium text-zinc-900;
  }

  .tip {
    @apply text-zinc-700 text-sm text-center flex justify-center items-center gap-2;
  }
}

.data-list {
  @apply w-[90vw] flex justify-center items-center;

  @media (max-width: 680px) {
    > div {
      @apply min-w-[90vw] max-w-[90vw] text-sm;
    }

    .progress-bar {
      @apply flex flex-row justify-center items-center font-medium w-full m-0 my-10;
    }
  }
}

.hp {
  .hearts-container {
    @apply flex justify-center items-center gap-7 mt-10 mb-8 ml-[-2rem];

    img {
      @apply animate-bounce;
    }

    @media (max-width: 680px) {
      @apply ml-0 w-full;
    }
  }
}



.subtopics-list {
  @apply w-full;

  .error {
    @apply p-5 flex flex-col items-center justify-center h-full gap-3 text-center;

    h3 {
      @apply text-3xl text-zinc-700 font-medium mt-3;
    }

    img {
      @apply h-36;
    }
  }
}

.data-list {
  @apply flex flex-col justify-start gap-6 w-full;

  div {
    @apply w-[405px];
  }
}

.hits-ranking {
  @apply flex flex-col justify-center items-center gap-7;

  .hits-container {
    @apply flex flex-row justify-center;

    .hit-container {
      @apply flex flex-col max-w-[100px] text-center justify-between px-6 gap-2;

      .title {
        @apply text-zinc-700 text-sm;
      }

      .value {
        @apply text-zinc-900 font-medium text-2xl;
      }

      &:first-child {
        @apply border-r-2 border-zinc-300;
      }

      &:last-child {
        @apply border-l-2 border-zinc-300;
      }
    }
  }

  button a {
    @apply bg-amber-500 py-2 px-5 rounded-md text-zinc-900 font-medium flex justify-center items-center gap-2 transition;

    &:hover {
      @apply bg-amber-400;
    }
  }
}

.mobile-container {
  @apply my-12;
}

.mobile-header {
  @apply fixed top-0 w-[calc(100vw-2.5rem)] left-0 flex justify-between m-5;

  button {
    @apply bg-white border-2 border-zinc-300 flex justify-center items-center gap-2 rounded-lg py-2 px-4 transition font-medium;

    &:hover {
      @apply border-sky-500;
    }
  }

  button.active {
    @apply text-zinc-900;

    img {
      @apply brightness-50;
    }
  }
}

.mobile-container {
  .error {
    @apply p-5 flex flex-col items-center justify-center h-full gap-3 text-center text-xl mx-5;

    h3 {
      @apply text-4xl text-zinc-700 font-medium mt-3;
    }

    img {
      @apply h-[40vw];
    }
  }

}
</style>