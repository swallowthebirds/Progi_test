import { createRouter, createWebHistory } from "vue-router";
import HomePage from "../components/HomePage.vue";
import VehicleForm from "../components/VehicleForm.vue";

const routes = [
  { path: "/", name: "Home", component: HomePage },
  { path: "/vehicle-form", name: "VehicleForm", component: VehicleForm },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
