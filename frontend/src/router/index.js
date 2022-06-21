import { createRouter, createWebHistory } from "vue-router";
import HomePageView from "../views/HomePageView.vue";
import SignUpView from "../views/SignUpView.vue";
import SignInView from "../views/SignInView.vue";
import UserDashboardView from "../views/UserDashboardView.vue";
import UserProfileView from "../views/UserProfileView.vue";
import ConquestsPageView from "../views/ConquestsPageView.vue";
import ConfigPageView from "../views/ConfigPageView.vue";
import RankingPageView from "../views/RankingPageView.vue";

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

export default router;
