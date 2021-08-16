
<template>
    <div class="calendar pb-3">
        <FullCalendar :options="calendarOptions" />
        <Modal v-show="showContent" v-on:from-child="closeModal()"></Modal>
       
        
    </div>
</template>

<script>
//import '@fullcalendar/core/vdom'; // solves problem with Vite
//import { Calendar } from '@fullcalendar/core';
import FullCalendar from '@fullcalendar/vue';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import jaLocale from '@fullcalendar/core/locales/ja';
import Modal from './Modal';

export default {
    components: {
        FullCalendar, // make the <FullCalendar> tag available
        Modal
    },
    data() {
        return {
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
                },
                height: 500,
                eventClick: this.handleEventClick,
            },
            showContent: false
        }
    },
    methods: {
        getEvents() {
            axios.get('/api/mypage/calendar')
                .then((res) => {
                    this.calendarOptions.events = res.data
                })
        },
        handleEventClick(clickInfo) {
            this.showContent = true
        },
        closeModal() {
            this.showContent = false
        }
    },
    mounted() {
        this.getEvents()
    }
};
</script>


<style>
    .calendar {
        min-height: 500px;
    }
</style>