<template>
  <div class="rounded overflow-hidden shadow-lg my-1 p-4">
    {{ theme.content }}
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
  <comment-form />
</template>

<script>
import { defineComponent } from 'vue';
import CommentForm from '@/Components/CommentForm.vue';

export default defineComponent({
  components: {
    CommentForm,
  },

  props: {
    theme: Object,
  },

  methods: {
    toggleEditMode() {
    },
    deleteTheme() {
      if (confirm('Do you want to delete?')) {
        this.$inertia.delete(this.route('themes.destroy', this.theme.id));
      }
    },
  },
});
</script>
