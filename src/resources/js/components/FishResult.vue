<template>
    <div>
        <label>釣果</label>
        <div v-for="(result, id) in fishResult" :key="id" class="form">
            <div class="form-component">
                <div class="form-component_title">
                長さ
                </div>
                <div class="form-component_content">
                    <input type="number" step="0.5" min="0" v-model="result.length" placeholder="長さ(cm)">
                </div>
            </div>
            <div class="form-component">
                <div class="form-component_title">
                重さ
                </div>
                <div class="form-component_content">
                    <input type="number" min="0" v-model="result.weight" placeholder="重さ(g)">
                </div>
            </div>
            <div class="form-component">
                <div class="form-component_title">
                ルアー
                </div>
                <div class="form-component_content">
                    <input type="text" v-model="result.lure" placeholder="例)スピナーベイトなど">
                </div>
            </div>
            <div class="form-component">
                <div class="form-component_title">
                釣れた時間
                </div>
                <div class="form-component_content">
                    <input v-model="result.catch_time" type="time" class="form-control">
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" @click="addFishResult()">追加</button>
        <button type="button" class="btn btn-primary" @click="deleteFishResult()">削除</button>
    </div>
</template>
<script>
export default ({
    props: [
        'fishResult'
    ],
    methods:{
        addFishResult () {
            const resultDetail = {
                    length : null,
                    weight : null,
                    lure : null,
                    catch_time: null
            };
            this.fishResult.push(resultDetail);
        },
        deleteFishResult () {
            this.fishResult.pop();
        },
    }
})
</script>
