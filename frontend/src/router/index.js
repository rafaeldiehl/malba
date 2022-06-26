import { createRouter, createWebHistory } from "vue-router";

import HomePageView from "../views/HomePageView.vue";
import SignUpView from "../views/SignUpView.vue";
import SignInView from "../views/SignInView.vue";
import UserDashboardView from "../views/UserDashboardView.vue";
import UserProfileView from "../views/UserProfileView.vue";
import ConquestsPageView from "../views/ConquestsPageView.vue";
import ConfigPageView from "../views/ConfigPageView.vue";
import RankingPageView from "../views/RankingPageView.vue";
import AdminDashboardView from "../views/AdminDashboardView.vue";

import store from "@/store";

const routes = [
  {
    path: "/",
    name: "home-page",
    component: HomePageView,
  },
  {
    path: "/register",
    name: "register",
    component: SignUpView,
  },
  {
    path: "/login",
    name: "login",
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
    meta: { requiresAuth: true },
    name: "profile",
    component: UserProfileView,
  },
  {
    path: "/dashboard/config",
    meta: { requiresAuth: true },
    name: "configuration",
    component: ConfigPageView,
  },
  {
    path: "/dashboard/conquests",
    meta: { requiresAuth: true },
    name: "conquests",
    component: ConquestsPageView,
  },
  {
    path: "/dashboard/ranking",
    meta: { requiresAuth: true },
    name: "ranking",
    component: RankingPageView,
  },
  {
    path: "/admin",
    meta: { requiresAdmin: true },
    name: "admin",
    component: AdminDashboardView,
  },
  {
    path: "/admin/config",
    meta: { requiresAdmin: true },
    name: "admin-config",
    component: ConfigPageView,
  },
  {
    path: "/:pathMatch(.*)*",
    redirect: { name: "dashboard" },
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAdmin && !store.state.user.data.isAdmin) {
    next({ name: "dashboard" });
  } else if (
    to.meta.requiresAuth &&
    store.state.user.token &&
    store.state.user.data.isAdmin
  ) {
    next({ name: "admin" });
  } else if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: "login" });
  } else if (
    store.state.user.token &&
    (to.name === "login" || to.name === "register")
  ) {
    next({ name: "dashboard" });
  } else {
    next();
  }
});

export default router;
