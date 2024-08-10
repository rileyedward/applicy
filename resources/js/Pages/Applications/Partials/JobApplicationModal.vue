<script setup>
import Modal from '@/Components/Breeze/Modal.vue';
import { ref } from 'vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';

const showModal = ref(true);
</script>

<template>
  <div>
    <SecondaryButton @click.prevent="showModal = true">
      + Application
    </SecondaryButton>
    <Modal :show="showModal" @close="showModal = false">
      <div class="p-6">
        <h3 class="text-lg font-medium text-neutral-100 mb-1">
          New Job Application
        </h3>
        <p class="text-sm text-neutral-300 mb-6">
          Please fill out the form below to apply for this job.
        </p>

        <form class="space-y-6">
          <h1>form will go here...</h1>
        </form>
      </div>
    </Modal>
  </div>
</template>
