import Router from 'vue-router'
import createDiary from "./components/CreateDiary.vue";
import diaryList from "./components/DiaryList.vue";
 
export default new Router({
    mode: "history",
    routes: [
        {
            path: "/home",
            name: "diary-list",
            component: diaryList
        },
        {
            path: "/diary/create",
            name: "create-diary",
            component: createDiary
        }
    ]
});