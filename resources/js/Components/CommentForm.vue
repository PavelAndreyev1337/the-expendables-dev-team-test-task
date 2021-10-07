<template>
  <form v-if="$page.props.user" @submit.prevent="submit">
    <textarea
      placeholder="Comment"
      v-model="form.content"
      class="
        w-full
        h-16
        px-3
        py-2
        text-base text-gray-700
        placeholder-gray-600
        border
        rounded-lg
        focus:shadow-outline
      "
    ></textarea>
    <jet-button>Submit</jet-button>
  </form>
</template>

<script>
import { defineComponent } from "vue";
import JetButton from "@/Jetstream/Button.vue";

export default defineComponent({
  components: {
    JetButton,
  },
  props: {
    themeId: Number,
    commentId: Object,
  },
  data() {
    return {
      editMode: false,
      updatedCommentId: null,
      form: this.$inertia.form({
        theme_id: this.themeId,
        content: "",
        comment_id: this.commentId,
      }),
    };
  },
  methods: {
    submit() {
      if (this.editMode) {
        this.form.put(this.route("comments.update", this.updatedCommentId), {
          onSuccess: () => {
            this.emitter.emit("toggle-comment-creation-mode");
          },
        });
      } else {
        this.form.post(this.route("comments.store"), {
          onSuccess: () => {
            this.form.content = "";
          },
        });
      }
    },
  },

  mounted() {
    this.emitter.on("toggle-comment-edit-mode", (comment) => {
      this.editMode = true;
      this.updatedCommentId = comment.id;
      this.form.content = comment.content;
    });
    this.emitter.on("toggle-comment-creation-mode", () => {
      this.editMode = false;
      this.updatedCommentId = null;
      this.form.content = "";
    });
  },
});
</script>
