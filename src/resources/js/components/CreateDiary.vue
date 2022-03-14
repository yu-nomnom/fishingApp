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
                    <label>釣り日時</label>
                    <input v-model="dairyData.start_time" type="datetime-local" name="start_time" class="form-control" id="start_time" placeholder="釣り開始日時">
                    <input v-model="dairyData.end_time" type="datetime-local" name="end_time" class="form-control" id="end_time" placeholder="釣り終了日時">
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
                    <input v-model="dairyData.lowest_water_temperature" type="number"  class="form-control" id="lowest_temperature" placeholder="最低水温(℃)">
                    <input v-model="dairyData.highest_water_temperature" type="number" class="form-control" id="highest_temperature" placeholder="最高水温(℃)">
                </div>
                <div>
                    <label>水位</label>
                    <input v-model="dairyData.start_water_level" type="number" class="form-control" id="start_water_level" placeholder="開始水位(cm)">
                    <input v-model="dairyData.end_water_level" type="number" class="form-control" id="end_water_level" placeholder="終了水位(cm)">
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
                    <label>詳細</label>
                    <textarea v-model="dairyData.consideration" class="form-control" id="consideration" rows="10"></textarea>
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
                start_time: '',
                end_time: '',
                field_id: null,
                season: '',
                weather: '',
                lowest_temperature: null,
                highest_temperature: null,
                lowest_water_temperature: null,
                highest_water_temperature: null,
                start_water_level: null,
                end_water_level: null,
                tide: '',
                competition_flg: false,
                consideration: '',
            },
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
                fishResult: this.fishResult
            })
            .then((res) => {
                this.response = res.data;
            });
        }
    }
}
</script>