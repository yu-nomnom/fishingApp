<template>
    <div class="row justify-content-center">
        <div class="alert alert-success" v-show="this.response.message">
            {{ this.response.message }}
        </div>
        <div class="col-md-8">
            <form>
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input v-model="dairyData.title" type="text" name="title" class="form-control" id="title" placeholder="この日の釣りの題名を入力">
                </div>
                <div>
                    <label>釣行日</label>
                    <input v-model="dairyData.date" type="date" name="date" class="form-control" id="date" placeholder="釣行日">
                    <label>釣りした時間</label>
                    <input v-model="dairyData.start_time" type="time" name="start_time" class="form-control" id="start_time" placeholder="釣り開始時間">
                    <input v-model="dairyData.end_time" type="time" name="end_time" class="form-control" id="end_time" placeholder="釣り終了時間">
                </div>
                <div>
                    <label>釣り場</label>
                    <select v-model="dairyData.field_id" class="form-control">
                        <option v-for="(field, id) in fieldList" :key="id" :value="id">{{field}}</option>
                    </select>
                </div>
                <div>
                    <label>季節</label>
                    <select name="season" v-model="dairyData.season" class="form-control">
                        <option v-for="season in seasonList" :key="season" :value="season">{{season}}</option>
                    </select>
                </div>
                <div>
                    <label>天気</label>
                    <select name="weather" v-model="dairyData.weather" class="form-control">
                        <option v-for="weather in weatherList" :key="weather" :value="weather">{{weather}}</option>
                    </select>
                </div>
                <div>
                    <label>気温</label>
                    <input v-model="dairyData.lowest_temperature" type="number"  class="form-control" id="lowest_temperature" placeholder="最低気温(℃)">
                    <input v-model="dairyData.highest_temperature" type="number" class="form-control" id="highest_temperature" placeholder="最高気温(℃)">
                </div>
                <div>
                    <label>水温</label>
                    <input v-model="dairyData.lowest_water_temperature" type="number"  class="form-control" id="lowest_water_temperature" placeholder="最低水温(℃)">
                    <input v-model="dairyData.highest_water_temperature" type="number" class="form-control" id="highest_water_temperature" placeholder="最高水温(℃)">
                </div>
                <div>
                    <label for="tide">潮</label>
                    <select name="tide" v-model="dairyData.tide" class="form-control">
                        <option v-for="tide in tideList" :key="tide" :value="tide">{{tide}}</option>
                    </select>
                </div>
                <div class="form-check">
                    <input v-model="dairyData.competition_flg" class="form-check-input" type="checkbox" id="competition_flg">
                    <label class="form-check-label">試合フラグ</label>
                </div>
                <FishResult :fishResult="fishResult"></FishResult>
                <div class="form-group">
                    <label>釣りの内容</label>
                    <textarea v-model="contents" class="form-control" id="contents" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label>考察</label>
                    <textarea v-model="consideration" class="form-control" id="consideration" rows="5"></textarea>
                </div>
                <button type="button" class="btn btn-primary" @click="regist()">ボタン</button>
            </form>
        </div>
    </div>
</template>

<script src="https://cdn.jsdelivr.net/npm/axios@0.18.0/dist/axios.min.js"></script>

<script>
import FishResult from "./FishResult.vue";
export default {
    components: { FishResult },
    data() {
        return {
            dairyData: {
                title: '',
                date: '',
                start_time: '',
                end_time: '',
                field_id: null,
                season: '',
                weather: '',
                lowest_temperature: null,
                highest_temperature: null,
                lowest_water_temperature: null,
                highest_water_temperature: null,
                tide: '',
                competition_flg: false
            },
            contents: '',
            consideration: '',
            weatherList : [],
            seasonList : [],
            tideList : [],
            fieldList : [],
            fishResult : [],
            response: []
        }
    },
    mounted() {
        window.onload = ()=>{
            axios.get('/api/diary_item').then((res) => {
                var dataList = res['data'];
                this.weatherList = dataList['weatherList'];
                this.seasonList = dataList['seasonList'];
                this.tideList = dataList['tideList'];
                this.fieldList = dataList['fieldList'];
            });
        }
    },
    methods: {
        checkCompetitionFlg() {
            this.dairyData.competition_flg = true;
        },
        regist() {
            axios.post('/api/diary_regist', {
                dairyData:  this.dairyData,
                contetns: this.contents,
                consideration: this.consideration,
                fishResult: this.fishResult
            })
            .then((res) => {
                this.response = res.data;
            })
            .catch((e) => {
                console.log(e.response.data);
                console.log(e.response.data.errors);
            });
        }
    }
}
</script>