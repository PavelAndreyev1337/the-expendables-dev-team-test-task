<template>
  <div class="rounded overflow-hidden shadow-lg my-1 p-4">
    <span class="text-2xl font-bold">{{ theme.content }}</span>
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
      v-if="theme.canControl"
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
      v-if="theme.canControl"
      @click.prevent="deleteTheme"
    >
      Delete
    </button>
  </div>
  <comment-form :theme-id="this.theme.id" :comment-id="null"/>
  <comments :comments="this.theme.comments" :theme-id="this.theme.id" :nesting="1" />
</template>

<script>
import { defineComponent } from "vue";
import CommentForm from "@/Components/CommentForm";
import Comments from "@/Components/Comments";

export default defineComponent({
  components: {
    CommentForm,
    Comments,
  },

  props: {
    theme: Object,
  },

  data() {
      return {
          comments: [],
          nesting: 0
      }
  },

  methods: {
    toggleEditMode() {
      this.emitter.emit("toggle-theme-edit-mode", this.theme);
      this.emitter.emit("toggle-theme-creation-mode");
    },
    deleteTheme() {
      if (confirm("Do you want to delete?")) {
        this.$inertia.delete(this.route("themes.destroy", this.theme.id));
      }
    },
  },
});
</script>
