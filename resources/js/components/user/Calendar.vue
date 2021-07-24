
<template>
    <FullCalendar :options="calendarOptions" :events="calendarEvents" :locale="locale"/>
</template>

<script>
import '@fullcalendar/core/vdom'; // solves problem with Vite
//import { Calendar } from '@fullcalendar/core';
import FullCalendar from '@fullcalendar/vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import jaLocale from '@fullcalendar/core/locales/ja';

export default {
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    data() {
        return {
            locale: jaLocale,
            calendarEvents: {},
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin ],
                initialView: 'dayGridMonth'
            },
            timeZone: 'Asia/Tokyo',
            eventColor: '#378006'
        }
    },
    methods: {
        getEvents() {
            axios.get('/api/mypage/calendar')
                .then((res) => {
                    this.calendarEvents = {
                        title: res.data.map(data => data.name),
                        start: res.data.map(data => data.result)
                    }
                    console.log(res.data)
                })
        } 
    },
    mounted() {
        this.getEvents()
    }
};
</script>


<style lang='scss'>

</style>