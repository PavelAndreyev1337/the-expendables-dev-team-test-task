<template>
  <form v-if="$page.props.user" @submit.prevent="submit">
    <textarea
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
  methods: {
    submit() {},
  },
});
</script>
