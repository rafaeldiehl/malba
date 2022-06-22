import { createRouter, createWebHistory } from "vue-router";

import HomePageView from "../views/HomePageView.vue";
import SignUpView from "../views/SignUpView.vue";
import SignInView from "../views/SignInView.vue";
import UserDashboardView from "../views/UserDashboardView.vue";
import UserProfileView from "../views/UserProfileView.vue";
import ConquestsPageView from "../views/ConquestsPageView.vue";
import ConfigPageView from "../views/ConfigPageView.vue";
import RankingPageView from "../views/RankingPageView.vue";

import store from "@/store";

const routes = [
  {
    path: "/",
    name: "home-page",
    component: HomePageView,
  },
  {
    path: "/sign-up",
    name: "sign-up",
    component: SignUpView,
  },
  {
    path: "/sign-in",
    name: "sign-in",
    component: SignInView,
  },
  {
    path: "/dashboard",
    meta: { requiresAuth: true },
    name: "dashboard",
    component: UserDashboardView,
  },
  {
    path: "/dashboard/profile",
    name: "profile",
    component: UserProfileView,
  },
  {
    path: "/dashboard/config",
    name: "configuration",
    component: ConfigPageView,
  },
  {
    path: "/dashboard/conquests",
    name: "conquests",
    component: ConquestsPageView,
  },
  {
    path: "/dashboard/ranking",
    name: "ranking",
    component: RankingPageView,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: "sign-in" });
  } else if (
    (store.state.user.token && to.name === "sign-in") ||
    to.name === "sign-up"
  ) {
    next({ name: "dashboard" });
  } else {
    next();
  }
});

export default router;
