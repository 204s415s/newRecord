
<template>
    <FullCalendar :options="calendarOptions" />
</template>

<script>
//import '@fullcalendar/core/vdom'; // solves problem with Vite
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
            
            calendarHeader: {
            left: 'prev,next,today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin, timeGridPlugin ],
                initialView: 'dayGridMonth',
                locale: jaLocale,
                events: [
                    // { title: 'event 1', date: '2021-07-21' },
                    // { title: 'event 2', date: '2021-07-23' }
                    ],
                headerToolbar: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                }
                
            },
            currentEvents: [],
            timeZone: 'Asia/Tokyo',
            eventColor: '#378006'
        }
    },
    methods: {
        getEvents() {
            axios.get('/api/mypage/calendar')
                .then((res) => {
                    this.calendarOptions.events = res.data
                    console.log(res.data)
                })
        } 
    },
    mounted() {
        this.getEvents()
    }
};
</script>


<style>
    
</style>