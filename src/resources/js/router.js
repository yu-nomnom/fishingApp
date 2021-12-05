import Vue from "vue";
import VueRouter from "vue-router";
 
Vue.use(VueRouter);
 
import createDiary from "./components/CreateDiary.vue";
 
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/create-diary",
            name: "create-diary",
            component: createDiary
        }
    ]
});
 
export default router;