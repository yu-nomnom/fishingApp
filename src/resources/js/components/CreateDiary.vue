<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form>
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" name="dairy[title]" class="form-control" id="title" placeholder="この日の釣りの題名を入力">
                </div>
                <div>
                    <p>
                        {{ aaa }} 
                    </p>
                </div>
                <div>
                    <label>釣り日時</label>
                    <input type="datetime-local" name="dairy[start_time]" class="form-control" id="start_time" placeholder="釣り開始日時">
                    <input type="datetime-local" name="dairy[end_time]" class="form-control" id="end_time" placeholder="釣り終了日時">
                </div>
                <div>
                    <label>釣り場</label>
                    <select name="field" v-model="selected" class="form-control">
                        <option v-for="field in fieldList" :key="field" :value="field"></option>
                    </select>
                </div>
                <div>
                    <label for="season">季節</label>
                    <select name="season" class="form-control" id="season">
                        <option value="春">春</option>
                        <option value="夏">夏</option>
                        <option value="秋">秋</option>
                        <option value="冬">冬</option>
                    </select>
                </div>
                <div>
                    <label for="weather">天気</label>
                    <select name="weather" class="form-control" id="weather">
                        <option value="晴れ">晴れ</option>
                        <option value="曇り">曇り</option>
                        <option value="雨">雨</option>
                        <option value="荒天">荒天</option>
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
                    <select name="tide" class="form-control" id="tide">
                        <option value="小潮">小潮</option>
                        <option value="中潮">中潮</option>
                        <option value="大潮">大潮</option>
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
    data : {
        weatherList : 'cccc',
        seasonList : [],
        tideList : [],
        fieldList : [],
        aaa : 'nomura'
    },
    methods: {
        window:onload = function(){
            console.log(this.weatherList);
            axios.get('/api/diary_create_item')
                .then((res) => {
                    console.log(this.weatherList);
                    var dataList = res['data'];
                    this.weatherList = dataList['weatherList'];
                    this.seasonList = dataList['seasonList'];
                    this.tideList = dataList['tideList'];
                    this.fieldList = dataList['fieldList'];
                    console.log(this.weatherList);
                });
        },
        regist() {
            axios.post('/api/diary_regist')
                .then((res) => {
                    console.log('bbbb');
                });
        }
    }
}
</script>