import { createRouter, createWebHistory } from "vue-router";
import SignInView from "../views/SignInView.vue";

const routes = [
  {
    path: "/sign-in",
    name: "sign-in",
    component: SignInView,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
