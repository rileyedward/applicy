<script setup>
import Modal from '@/Components/Breeze/Modal.vue';
import { computed, ref } from 'vue';
import ContactAssistant from '@/Pages/Applications/Show/Partials/ContactAssistant.vue';
import AssistantIcon from '@/Components/Icons/AssistantIcon.vue';

const props = defineProps({
  jobApplication: Object,
});

const showModal = ref(false);
const showAssistant = ref(false);

const { contact_name, contact_email, contact_phone } = props.jobApplication;

const isEmptyContactInformation = computed(
  () => !contact_name && !contact_email && !contact_phone
);
</script>

<template>
  <div>
    <button
      @click.prevent="showModal = true"
      class="w-24 flex justify-center text-orange-500 border border-orange-500 px-4 py-1 rounded-2xl cursor-pointer transition-all duration-300 ease-in-out transform hover:bg-orange-500 hover:text-white hover:shadow-lg hover:scale-105"
      aria-label="Contact the employer"
    >
      Contact
    </button>

    <Modal :show="showModal" @close="showModal = false">
      <div class="p-6 bg-neutral-800 rounded-md shadow-md">
        <div class="flex justify-between items-center">
          <h2 class="text-2xl font-semibold text-white mb-1">
            Contact the Employer
          </h2>
          <button @click.prevent="showAssistant = !showAssistant">
            <AssistantIcon />
          </button>
        </div>

        <p class="text-neutral-500 text-base mb-4 max-w-3xl">
          Get in touch with the employer to follow up or ask about the status of
          your application. Utilize the AI assistant below to help you craft the
          perfect message.
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

        <transition name="fade">
          <ContactAssistant
            v-if="showAssistant"
            @close="showAssistant = false"
            :jobApplication="jobApplication"
          />
        </transition>
      </div>
    </Modal>
  </div>
</template>
