<script setup>
import Modal from '@/Components/Breeze/Modal.vue';
import { computed, ref } from 'vue';

const props = defineProps({
  jobApplication: Object,
});

const showModal = ref(false);

const { contact_name, contact_email, contact_phone } = props.jobApplication;

const isEmptyContactInformation = computed(
  () => !contact_name && !contact_email && !contact_phone
);
</script>

<template>
  <div>
    <button
      @click.prevent="showModal = true"
      class="text-orange-500 border border-orange-500 px-4 py-1 rounded-2xl cursor-pointer transition-all duration-300 ease-in-out transform hover:bg-orange-500 hover:text-white hover:shadow-lg hover:scale-105"
      aria-label="Contact the employer"
    >
      Contact
    </button>

    <Modal :show="showModal" @close="showModal = false">
      <div class="p-6 bg-neutral-800 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold text-white mb-1">Contact</h2>

        <p class="text-neutral-500 text-base mb-4 max-w-3xl">
          Contact the employer for more information about the job or to follow
          up on your application. Utilize AI assistance to help you with your
          application and reaching out to the employer.
        </p>

        <div
          v-if="!isEmptyContactInformation"
          class="bg-neutral-700 p-4 rounded-md mb-6"
        >
          <p class="text-neutral-500 mt-2">
            <strong>Name: </strong> {{ contact_name }}<br />
            <strong>Email: </strong>
            <a
              :href="'mailto:' + contact_email"
              class="text-orange-500 hover:underline"
              >{{ contact_email }}</a
            ><br />
            <strong>Phone: </strong>
            <a
              :href="'tel:' + contact_phone"
              class="text-orange-500 hover:underline"
              >{{ contact_phone }}</a
            >
          </p>
        </div>
        <p
          v-else
          class="bg-neutral-700 p-4 rounded-md text-neutral-500 text-lg mb-6"
        >
          No contact information available at this time...
        </p>

        <!-- Placeholder for future AI assistance features -->
        <div class="bg-neutral-700 p-4 rounded-md">
          <h3 class="text-xl font-semibold text-white">AI Assistance</h3>
          <p class="text-neutral-500 mt-2">
            Coming soon: Ask questions or get insights on your application
            status.
          </p>
        </div>
      </div>
    </Modal>
  </div>
</template>
