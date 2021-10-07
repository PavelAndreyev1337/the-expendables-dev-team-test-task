<template>
  <div>
    <div class="rounded overflow-hidden shadow-lg my-1 p-4">
      <div class="flex justify-between">
        <div>
          <span class="font-bold">{{ this.comment.user.name }}</span>
        </div>
        <div>
          <span class="italic text-xs">{{ this.comment.user.created_at }}</span>
        </div>
      </div>
      <br />
      {{ this.comment.content }}
      <button
        class="
          h-8
          px-4
          m-2
          text-sm text-indigo-100
          transition-colors
          duration-150
          bg-yellow-500
          rounded-lg
          focus:shadow-outline
          hover:bg-yellow-600
        "
        v-if="comment.canControlComment"
        @click.prevent="toggleEditMode"
      >
        Edit
      </button>
      <button
        class="
          h-8
          px-4
          m-2
          text-sm text-indigo-100
          transition-colors
          duration-150
          bg-red-500
          rounded-lg
          focus:shadow-outline
          hover:bg-red-600
        "
        v-if="comment.canControlComment"
        @click.prevent="deleteComment"
      >
        Delete
      </button>
    </div>
    <comment-form :theme-id="this.themeId" :comment-id="this.comment.id" />
  </div>
</template>

<script>
import { defineComponent } from "vue";
import CommentForm from "@/Components/CommentForm.vue";

export default defineComponent({
  components: {
    CommentForm,
  },
  props: {
    themeId: Number,
    comment: Object,
  },
  methods: {
    toggleEditMode() {},
    deleteComment() {
        if (confirm("Do you want to delete?")) {
            this.$inertia.delete(this.route("comments.destroy", this.comment.id));
        }
    },
  },
});
</script>
