<script setup>
import { ref } from 'vue';

const model = defineModel({
  type: String,
  required: true,
});

defineProps({
  options: Array,
});

const selectInput = ref(null);

defineExpose({ focus: () => selectInput.value.focus() });
</script>

<template>
  <select
    class="border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm"
    v-model="model"
    ref="selectInput"
  >
    <option v-for="option in options" :key="option.value" :value="option.value">
      {{ option.label }}
    </option>
  </select>
</template>
