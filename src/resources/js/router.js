import Router from 'vue-router'
import createDiary from "./components/CreateDiary.vue";
 
export default new Router({
    mode: "history",
    routes: [
        {
            path: "/create-diary",
            name: "create-diary",
            component: createDiary
        }
    ]
});