<template>
    <div class="container">
        <div class="column">
            <h3>Barchart</h3>
            <BarChart v-if="loaded" :chartData="chartdata" :options="options"></BarChart>
            <button class="btn btn-orange" @click="getData()">更新</button>
            <router-link v-bind:to="{name: 'student.list'}">
                <button class="btn btn-orange">戻る</button>
            </router-link>
        </div>
    </div>
</template>

<script>
import BarChart from '../graph/Bar.js'
    export default{
        name: 'Sheet',
        components: { BarChart },
        data: function() {
             return {
                loaded: false,
                chartdata: null,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{                      //y軸設定
                            ticks: {                      //最大値最小値設定
                                beginAtZero: true,
                                stepSize: 1,               //軸間隔
                                max: 20
                            },
                        }]
                    },
                }
            }
        },
        methods: {
            getData() {
                axios.get('/api/students/clear')
                    .then((res) => {
                        this.chartdata = {
                            labels: res.data.map(data => data.name),
                            datasets: [
                                {
                                    label: ['カリキュラムクリア数'],
                                    backgroundColor: '#e95285',
                                    data: res.data.map(data => data.clear)
                                }
                            ]
                        }
                    })
            },
        },
        
        mounted() {
            this.loaded = true
            this.getData()
        }
    }
</script>