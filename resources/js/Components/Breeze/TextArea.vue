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
    rows="5"
    class="border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm"
    v-model="model"
    ref="textarea"
  />
</template>
