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
  },
  data() {
    return {
      editMode: false,
      form: this.$inertia.form({
        theme_id: this.themeId,
        content: "",
        comment_id: null,
      }),
    };
  },
  methods: {
    submit() {
      if (this.editMode) {
      } else {
        this.form.post(this.route("comments.store"), {
            onSuccess: () => {this.form.content = "";}
        });
      }
    },
  },
});
</script>
