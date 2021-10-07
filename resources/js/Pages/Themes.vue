<template>
  <Head title="Welcome" />

  <div class="p-6">
    <div v-if="canLogin" class="flex flex-row-reverse mt-2 mb-3">
      <Link
        v-if="$page.props.user"
        :href="route('dashboard')"
        class="text-sm text-gray-800 underline"
      >
        Dashboard
      </Link>

      <template v-else>
        <Link
          :href="route('login')"
          class="text-sm text-gray-800 underline mx-1"
        >
          Log in
        </Link>

        <Link
          v-if="canRegister"
          :href="route('register')"
          class="ml-4 text-sm text-gray-800 underline mx-1"
        >
          Register
        </Link>
      </template>
    </div>
    <theme-form v-if="$page.props.user" />
    <theme-card
      v-for="theme in $page.props.themes"
      :key="theme.id"
      :theme="theme"
      class="w-full"
    />
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ThemeForm from "@/Components/ThemeForm.vue";
import ThemeCard from "@/Components/ThemeCard.vue";

export default defineComponent({
  components: {
    Head,
    Link,
    ThemeForm,
    ThemeCard,
  },

  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    themes: Array,
  },
});
</script>
