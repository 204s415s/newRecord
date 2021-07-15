
<template>
    <FullCalendar :options="calendarOptions" :events="calendarEvents" :locale="locale"/>
</template>

<script>
import '@fullcalendar/core/vdom'; // solves problem with Vite
import FullCalendar from '@fullcalendar/vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import jaLocale from '@fullcalendar/core/locales/ja';

export default {
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    data: function() {
        return {
            locale: jaLocale,
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin ],
                initialView: 'dayGridMonth'
            },
            calendarEvents: [
                {
                    title: 'test',
                    start: '2021-07-18'
                }
            ],
            eventColor: '#378006'
        }
    },
    methods: {
        getEvents() {
            axios.get('/api/mypage/calendar')
                .then((res) => {
                    this.calendarEvents = {
                        title: res.data[0],
                        start: res.data[1],
                        end: res.data[1]
                    }
                })
        } 
    },
    mounted() {
        //this.getEvents()
    }
};
</script>


<style>
@import '~/node_modules/@fullcalendar/core/main.css';
@import '~/node_modules/@fullcalendar/daygrid/main.css';
@import '~/node_modules/@fullcalendar/timegrid/main.css';
</style>