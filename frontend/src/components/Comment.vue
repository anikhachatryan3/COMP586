<template>
    <div>
        <hr v-if="index+1!=size">
        <div>{{ username }}</div>
        <div>{{ text }}</div>
        <div class="date">{{ timeFormat(created_at) }}</div>
        <!-- <hr v-if="index+1!=size"> -->
    </div>
</template>

<script>
export default {
    name: 'Comment',
    props: {
        id: {
            type: Number,
            default: null
        },
        text: {
            type: String,
            default: null
        },
        username: {
            type: String,
            default: null
        },
        created_at: {
            type: String,
            default: null
        },
        index: {
            type: Number,
            default: null
        },
        size: {
            type: Number,
            default: null
        }
    },
    methods: {
        timeFormat(dateTime) {
            let date = new Date(dateTime);
            let hour = '';
            if(date.getHours() == 0) {
                hour = 12;
            } else if(date.getHours() > 12) {
                hour = date.getHours() - 12;
            } else {
                hour = date.getHours();
            }
            let minute = date.getMinutes();
            if(minute < 10) {
                minute = '0' + minute;
            }
            let AmPm = date.getHours() > 11 ? 'pm' : 'am';
            return date.toDateString().substring(4) + ' at ' + hour + ':' + date.getMinutes() + AmPm;
        }
    }
}
</script>

<style scoped>
    .date {
        font-size: 13px;
        font-style: italic;
    }
</style>
