<template>
  <div
    v-for="comment in this.comments"
    :key="comment.id"
    :style="{ 'margin-left': this.nesting * 20 + 'px' }"
  >
    <comment-card :comment="comment" :theme-id="this.themeId" />
    <comments
      v-if="comment.hasOwnProperty('comments')"
      :comments="comment.comments"
      :theme-id="this.themeId"
      :nesting="this.nesting + 1"
    />
  </div>
</template>

<script>
import { defineComponent } from "vue";
import CommentCard from "@/Components/CommentCard";

export default defineComponent({
  name: "comments",
  components: {
    CommentCard,
    Comment,
  },
  props: {
    comments: Array,
    themeId: Number,
    nesting: Number,
  },
});
</script>
