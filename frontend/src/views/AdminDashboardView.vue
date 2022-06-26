<template>
  <div id="dashboard">
    <nav-bar active="home"></nav-bar>
    <div class="container">
      <header>
        <h2>Painel do administrador</h2>
        <p>Clique nos botões abaixo para gerenciar as tabelas.</p>
      </header>
      <div class="buttons">
        <router-link :to="button.link" v-for="(button, index) in buttons" :key="index">
          <button>
            <img :src="button.icon" :alt="button.alt">
            {{ button.name }}
          </button>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import NavBar from '@/components/Dashboard/NavBar.vue';

import topicIcon from "@/assets/icons/folder.svg";
import subtopicIcon from "@/assets/icons/topic.svg";
import questionIcon from "@/assets/icons/question.png";

export default {
  name: 'AdminDashboardView',
  components: {
    NavBar
  },
  data() {
    return {
      buttons: [
        {
          icon: topicIcon,
          alt: 'tópico',
          name: 'Gerenciar tópicos',
          link: '/admin/topics'
        },
        {
          icon: subtopicIcon,
          alt: 'subtópico',
          name: 'Gerenciar subtópicos',
          link: '/admin/subtopics'
        },
        {
          icon: questionIcon,
          alt: 'questão',
          name: 'Gerenciar questões',
          link: '/admin/questions'
        }
      ]
    }
  }
}
</script>

<style lang="scss" scoped>
#dashboard {
  @apply bg-zinc-100 min-h-screen flex flex-col justify-center items-center;
}

.container {
  @apply max-w-[930px] mt-32 flex flex-col gap-6 mb-10;

  @media (max-width: 950px) {
    @apply max-w-[90vw];
  }

  @media (max-width: 680px) {
    @apply mt-12 mb-32 w-[90vw];
  }
}

header {
  h2 {
    @apply text-zinc-900 text-4xl font-medium mb-2;
  }

  p {
    @apply text-xl;
  }

  @media (max-width: 680px) {
    @apply text-center;
  }
}

.buttons {
  @apply flex justify-center items-center gap-8;

  a {
    @apply bg-white p-5 w-72 h-80  border-[3px] border-zinc-300 rounded-xl text-xl flex justify-center items-center;

    &:hover {
      img {
        @apply brightness-75;
      }

      @apply border-zinc-400 rounded-none;
      filter: sepia(100%) hue-rotate(190deg) saturate(500%);
    }
  }

  @media (max-width: 680px) {
    @apply flex-col gap-4;

    a {
      @apply w-full max-w-[400px] h-auto p-5;

      button {
        @apply flex flex-col justify-center items-center gap-2;
      }
      img {
        @apply h-32;
      }
    }
  }
}


</style>