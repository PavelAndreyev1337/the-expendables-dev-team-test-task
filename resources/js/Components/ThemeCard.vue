<template>
  <div class="rounded overflow-hidden shadow-lg my-1 p-4">
    {{ theme.content }}
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    theme: Object,
  },
});
</script>
