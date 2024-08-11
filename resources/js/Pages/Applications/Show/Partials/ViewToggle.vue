<script setup>
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';

defineProps({
  showEditForm: Boolean,
});

defineEmits(['toggleView']);
</script>

<template>
  <div>
    <SecondaryButton
      @click.prevent="$emit('toggleView')"
      class="w-24 flex justify-center"
    >
      <span v-if="showEditForm">Timeline</span>
      <span v-else>Edit</span>
    </SecondaryButton>
  </div>
</template>
