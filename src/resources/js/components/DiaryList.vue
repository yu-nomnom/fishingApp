<template>
    <div>
        <a>dairyList</a>
    </div>
</template>

<script>
import Vuetable from 'vuetable-2';
export default {
    components: {
        Vuetable
    },
    data() {
        return {
            weatherList : [],
            seasonList : [],
            tideList : [],
            fieldList : [],
        }
    },
    mounted() {
        window.onload = ()=>{
            console.log('aaaa');
            axios.get('/api/diary_list').then((res) => {
                // var dataList = res['data'];
                // this.weatherList = dataList['weatherList'];
                // this.seasonList = dataList['seasonList'];
                // this.tideList = dataList['tideList'];
                // this.fieldList = dataList['fieldList'];
            });
        }
    },
}
</script>
