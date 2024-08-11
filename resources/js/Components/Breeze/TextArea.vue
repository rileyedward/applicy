<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
  type: String,
  required: true,
});

defineProps({
  rows: {
    type: Number,
    default: 5,
  },
});

const input = ref(null);

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <textarea
    :rows="rows"
    class="border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm"
    v-model="model"
    ref="textarea"
  />
</template>
