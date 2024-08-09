<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
  type: String,
  required: true,
});

const input = ref(null);

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <textarea
    rows="10"
    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
    v-model="model"
    ref="textarea"
  />
</template>
