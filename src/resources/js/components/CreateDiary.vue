<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form>
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input v-model="title" type="text" name="title" class="form-control" id="title" placeholder="この日の釣りの題名を入力">
                </div>
                <div>
                    <label>釣り日時</label>
                    <input type="datetime-local" name="start_time" class="form-control" id="start_time" placeholder="釣り開始日時">
                    <input type="datetime-local" name="end_time" class="form-control" id="end_time" placeholder="釣り終了日時">
                </div>
                <div>
                    <label for="field">釣り場</label>
                    <select name="field" v-model="selected" class="form-control">
                        <option v-for="field in fieldList" :key="field" :value="field">{{field}}</option>
                    </select>
                </div>
                <div>
                    <label for="season">季節</label>
                    <select name="season" v-model="selected" class="form-control">
                        <option v-for="season in seasonList" :key="season" :value="season">{{season}}</option>
                    </select>
                </div>
                <div>
                    <label for="weather">天気</label>
                    <select name="weather" v-model="selected" class="form-control">
                        <option v-for="weather in weatherList" :key="weather" :value="weather">{{weather}}</option>
                    </select>
                </div>
                <div>
                    <label>気温</label>
                    <input type="number" name="dairy[lowest_temperature]" class="form-control" id="lowest_temperature" placeholder="最低気温(℃)">
                    <input type="number" name="dairy[highest_temperature]" class="form-control" id="highest_temperature" placeholder="最高気温(℃)">
                </div>
                <div>
                    <label>水位</label>
                    <input type="number" name="dairy[lowest_water_level]" class="form-control" id="lowest_water_level" placeholder="最低水位(cm)">
                    <input type="number" name="dairy[highest_water_level]" class="form-control" id="highest_water_level" placeholder="最高気温(cm)">
                </div>
                <div>
                    <label for="tide">潮</label>
                    <select name="tide" v-model="selected" class="form-control">
                        <option v-for="tide in tideList" :key="tide" :value="tide">{{tide}}</option>
                    </select>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="competition_flg" checked>
                    <label class="form-check-label" for="competition_flg">試合フラグ</label>
                </div>
                <div class="form-group">
                    <label for="consideration">詳細</label>
                    <textarea name="consideration" class="form-control" id="consideration" rows="10"></textarea>
                </div>
                <button type="button" class="btn btn-primary" @click="regist()">ボタン</button>
            </form>
        </div>
    </div>
</template>

<script src="https://cdn.jsdelivr.net/npm/axios@0.18.0/dist/axios.min.js"></script>

<script>
export default {
    data()  {
        return {
            title: '',
            weatherList : [],
            seasonList : [],
            tideList : [],
            fieldList : []
        }
    },
    mounted() {
        window.onload = ()=>{
            axios.get('/api/diary_create_item').then((res) => {
                var dataList = res['data'];
                this.weatherList = dataList['weatherList'];
                this.seasonList = dataList['seasonList'];
                this.tideList = dataList['tideList'];
                this.fieldList = dataList['fieldList'];
            });
        }
    },
    methods: {
        regist() {
            axios.post('/api/diary_regist', {
                title: this.title
            })
            .then((res) => {
                console.log('bbbb');
            });
        }
    }
}
</script>