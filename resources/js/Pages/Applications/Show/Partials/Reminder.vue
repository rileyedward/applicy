<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
  reminder: Object,
});

const hasReminder = computed(() => {
  return Object.keys(props.reminder).length > 0;
});

const showBanner = ref(hasReminder.value);

const closeBanner = () => {
  showBanner.value = false;
};
</script>

<template>
  <transition name="fade">
    <div
      v-if="showBanner"
      :class="`bg-${reminder.color}-500 text-white py-2 px-6 flex justify-between items-center rounded-2xl`"
    >
      <p class="inline-block">
        {{ reminder.message }}
      </p>

      <button
        @click="closeBanner"
        :class="`ml-4 bg-${reminder.color}-500 hover:bg-${reminder.color}-600 text-white font-bold py-1 px-2 rounded`"
      >
        X
      </button>
    </div>
  </transition>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
  opacity: 0;
}
</style>
