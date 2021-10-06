<template>
  <form @submit.prevent="submit" class="mx-5 flex flex-wrap justify-center">
    <div class="w-full lg:w-11/12 p-1">
      <jet-input
        id="theme"
        type="text"
        class="block w-full"
        v-model="form.content"
        placeholder="Theme"
        required
        autofocus
      />
    </div>
    <div class="p-1">
      <jet-button class="h-full mx-auto">Submit</jet-button>
    </div>
  </form>
</template>

<script>
import { defineComponent } from "vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetButton from "@/Jetstream/Button.vue";

export default defineComponent({
  components: {
    JetInput,
    JetLabel,
    JetButton,
  },

  data() {
    return {
      editMode: false,
      themeId: null,
      form: this.$inertia.form({
        content: "",
      }),
    };
  },

  methods: {
    submit() {
      if (this.editMode) {
        this.form.put(this.route("themes.update", this.themeId), {
          onSuccess: () => {
            this.editMode = false;
            this.themeId = null;
            this.form.content = "";
          },
        });
      } else {
        this.form.post(this.route("themes.store"), {
          onSuccess: () => {
            this.form.content = "";
          },
        });
      }
    },
  },

  mounted() {
    this.emitter.on("toggle-theme-edit-mode", (theme) => {
      this.editMode = true;
      this.themeId = theme.id;
      this.form.content = theme.content;
    });
  },
});
</script>
