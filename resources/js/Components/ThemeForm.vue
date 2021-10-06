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
      form: this.$inertia.form({
        content: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("themes.store"));
    },
  },
});
</script>
