<template>
    <div>
       <comment v-for="(comment, index) in comments"
        :key="index"
        :id="comment.id"
        :text="comment.text"
        :username="comment.user.username"
        :user_id="comment.user_id"
        :created_at="comment.created_at"
        :index="index"
        :size="comments.length"
        @deletedComment="deletedComment"
       ></comment>
    </div>
</template>

<script>
import Comment from './Comment.vue';

export default {
    name: 'Comments',
    props: {
        comments: {
            type: Array,
            default() {
                []
            }
        }
    },
    components: {
        Comment
    },
    methods: {
        deletedComment(value) {
            this.$emit('deletedComment', value);
        }
    }
}
</script>
