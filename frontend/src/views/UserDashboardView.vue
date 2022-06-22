<template>
  <div id="dashboard">
    <nav-bar active="home"></nav-bar>
    <div class="container">
      <div class="subtopics-list">
        ...
      </div>

      <div class="data-list">
        <div class="progress">
          <h2>Progresso de nível</h2>
          <div class="progress-bar">
            <span>0 XP</span>
            <div class="border">
              <span class="paint w-[50%] bg-green-600"></span>
              <span class="progress-value left-[50%] translate-x-[-20%]">25 XP</span>
            </div>
            <span>50 XP</span>
          </div>
          <span class="tip">40 XP necessários para o próximo nível</span>
        </div>

        <div class="hp">
          <h2>Pontos de vida</h2>
          <div class="hearts-container">
            <img :src="icons.heart.src" :alt="icons.heart.alt" />
            <img :src="icons.heart.src" :alt="icons.heart.alt" />
            <img :src="icons.brokenHeart.src" :alt="icons.brokenHeart.alt" />
          </div>
          <span class="tip">
            <img :src="icons.lightbulb.src" :alt="icons.lightbulb.alt">
            Um ponto de vida leva 10 minutos para regenerar</span>
        </div>

        <div class="hits-ranking">
          <div class="hits-container">
            <div class="hit-container">
              <span class="title">Acertos totais</span>
              <span class="value">7</span>
            </div>
            <div class="hit-container">
              <span class="title">Acertos mensais</span>
              <span class="value">7</span>
            </div>
            <div class="hit-container">
              <span class="title">Ranking máximo</span>
              <span class="value">#7</span>
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
</template>

<script>
import NavBar from '@/components/Dashboard/NavBar.vue';

import trophyIcon from '@/assets/icons/trophy.svg';
import heartIcon from '@/assets/icons/heart.svg';
import brokenHeartIcon from '@/assets/icons/broken-heart.svg';
import lightbulbIcon from '@/assets/icons/lightbulb.svg';

export default {
  name: 'UserDashboardView',
  components: {
    NavBar
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
        }
      }
    }
  }
}
</script>

<style lang="scss" scoped>
#dashboard {
  @apply bg-zinc-100 min-h-screen flex flex-col items-center;
}

.container {
  @apply max-w-[1000px] mt-32 min-h-[calc(100vh-10.75rem)] flex flex-row gap-6 mb-10;
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

.hearts-container {
  @apply flex justify-center items-center gap-7 mt-10 mb-8 ml-[-2rem];

  img {
    @apply animate-bounce;
  }
}

.subtopics-list {
  @apply w-full;
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

.data-list {
  @apply flex flex-col justify-start gap-6;

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
</style>