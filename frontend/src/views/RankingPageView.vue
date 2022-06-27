<template>
  <div id="dashboard">
    <nav-bar></nav-bar>
    <div class="container">
      <div class="error" v-if="!users">
        <img :src="icons.sad.src" :alt="icons.sad.alt">
        <h3>Ops, algo deu errado</h3>
        Infelizmente não possível carregar nenhum usuário.
      </div>
      <table v-else>
         <tr>
          <th>#</th>
          <th>Usuário</th>
          <th>Acertos</th>
        </tr>
        <tr v-for="(user, index) in users" :key="user.id">
          <template v-if="user.hits">
            <td>{{ index + 1 }}</td>
            <td>
              <img :src="avatars[user.avatar - 1].imageUrl" :alt="avatars[user.avatar - 1].name">
              {{ user.username }}
            </td>
            <td>{{ user.hits }}</td>
          </template>
        </tr>
      </table>
    </div>
  </div>  
</template>

<script>
import NavBar from '@/components/Dashboard/NavBar.vue';

import sadIcon from '@/assets/icons/sad.svg';

import axiosClient from '@/services/axios';

export default {
  name: 'RankingPageView',
  components: {
    NavBar
  },
  data() {
    return {
      users: null,
      avatars: null,
      icons: {
        sad: {
          src: sadIcon,
          alt: "Desculpe pelo erro"
        },
      }
    }
  },
  created() {
    axiosClient.get('/users/hits/desc')
        .then((res) => res.data)
        .then((res) => {
          this.users = [];
          for(let user in Object.values(res)) {
            this.users.push(Object.values(res)[user]);
          }
        });

    axiosClient.get('/avatars')
        .then((res) => res.data)
        .then((res) => {
          this.avatars = [];
          for(let avatar in Object.values(res)) {
            this.avatars.push(Object.values(res)[avatar]);
          }
        });
  }
}
</script>

<style lang="scss" scoped>
#dashboard {
  @apply bg-zinc-100 min-h-screen flex flex-col items-center justify-center;
}

.container {
   @apply max-w-[610px] mt-32 flex flex-col gap-6 mb-10 bg-white rounded-xl border-2 border-zinc-200 p-6;

   @media (max-width: 650px) {
     @apply w-[90vw] mt-12 mb-28;
   }
}

table {
  @apply flex flex-col;

  tr {
    @apply w-full py-2 flex flex-row justify-center items-center border-b-2;

    &:last-child {
      @apply border-b-0;
    }
  }

  th {
    @apply text-zinc-500 font-medium;
  }

  td {
    &:nth-child(1) {
      @apply text-2xl text-sky-600;
    }

    &:nth-child(2) {
      @apply font-medium text-zinc-900 text-xl;
    }

    &:nth-child(3) {
      @apply font-medium text-zinc-700 text-2xl;
    }
  }

  th,td {
    &:nth-child(1) {
      @apply w-[15%];
    }

    &:nth-child(2) {
      @apply w-[70%] text-left flex justify-start;
    }

    &:nth-child(3) {
      @apply w-[20%];
    }
  }

  img {
    @apply h-14 rounded-full mr-3 border-2 border-sky-600;
  }

  td {
    @apply flex flex-row justify-center  items-center gap-2;
  }
}

.error {
    @apply p-5 flex flex-col items-center justify-center h-full gap-3 text-center;

    h3 {
      @apply text-3xl text-zinc-700 font-medium mt-3;
    }

    img {
      @apply h-36;
    }
  }
</style>