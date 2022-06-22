<template>
  <div id="dashboard">
    <nav-bar active="config"></nav-bar>
    <div class="container">
      <button @click="showAvatars">mudar avatar</button>
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

import closeIcon from '@/assets/icons/close.svg';

import axios from 'axios';

export default {
  name: 'ConfigPageView',
  components: {
    NavBar
  },
  data() {
    return {
      icons: {
        close: {
          src: closeIcon,
          alt: 'Erro'
        }
      },
      avatarModal: false,
      avatars: null
    }
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
      console.log(id);
      this.closeAvatarModal();
    }
  }
}
</script>

<style lang="scss" scoped>
#dashboard {
  @apply bg-zinc-100 min-h-screen flex flex-col items-center;
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
      @apply text-3xl text-zinc-900 font-medium
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