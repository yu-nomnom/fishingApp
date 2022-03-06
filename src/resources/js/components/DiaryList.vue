<template>
    <div>
        <vuetable
            ref="vuetable"
            api-url="api/diary_list"
            :fields="['id', 'title', 'field_id', 'start_time', 'season', 'weather', 'competition_flg']"
            pagination-path=""
            @vuetable:pagination-data="onPaginationData"
        ></vuetable>
        <vuetable-pagination ref="pagination"
            @vuetable-pagination:change-page="onChangePage"
            :css="css"
        ></vuetable-pagination>
    </div>
</template>

<script>
import Vuetable from "vuetable-2/src/components/Vuetable";
import VuetablePagination from "vuetable-2/src/components/VuetablePagination";

export default {
    components: {
        Vuetable, VuetablePagination
    },
    data() {
        return {
            css: {
                wrapperClass: 'pagination',
                activeClass: 'active',
                disabledClass: 'disabled',
                icons: {
                    first: 'glyphicon glyphicon-backward',
                    prev: 'glyphicon glyphicon-triangle-left',
                    next: 'glyphicon glyphicon-triangle-right',
                    last: 'glyphicon glyphicon-forward'
                }
            },
            weatherList : [],
            seasonList : [],
            tideList : [],
            fieldList : [],
            diaryList: []
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
        onPaginationData (paginationData) {
            this.$refs.pagination.setPaginationData(paginationData)
        },
        onChangePage(page) {
            this.$refs.vuetable.changePage(page);
        }
    }
}
</script>

<style>
.pagination a {
  cursor: pointer;
  border: 1px solid lightgray;
  padding: 5px 10px;
}
.pagination a.active {
  color: white;
  background-color: #337ab7;
}
.pagination a.btn-nav.disabled {
  color: lightgray;
  cursor: not-allowed;
}
</style>