<script setup>
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
  application: Object,
  statusFilters: Array,
});

const showModal = ref(false);

const form = useForm({
  status: props.application.status.toLowerCase(),
  title: '',
  notes: '',
});

const submit = () => {
  form.post(route('application-action.store', props.application.id), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      showModal.value = false;
    },
  });
};
</script>

<template>
  <button @click.prevent="showModal = true">
    <span
      class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium bg-green-300 text-green-900 hover:bg-green-900 hover:text-green-300 cursor-pointer"
    >
      {{ application.status }}
    </span>
  </button>
  <Modal :show="showModal" @close="showModal = false">
    <form @submit.prevent="submit">
      <div>
        <InputLabel for="status" value="Status" />
        <SelectInput
          id="status"
          class="mt-1 block w-full"
          v-model="form.status"
          :options="statusFilters"
        />
        <InputError class="mt-2" :message="form.errors.status" />
      </div>
      <div class="mt-4">
        <InputLabel for="title" value="Action" />
        <TextInput
          id="title"
          type="text"
          class="mt-1 block w-full"
          v-model="form.title"
        />
        <InputError class="mt-2" :message="form.errors.title" />
      </div>
      <div class="mt-4">
        <InputLabel for="notes" value="Notes" />
        <TextArea
          id="notes"
          type="text"
          class="mt-1 block w-full"
          v-model="form.notes"
        />
        <InputError class="mt-2" :message="form.errors.notes" />
      </div>
      <div class="flex items-center justify-end mt-4">
        <PrimaryButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Save
        </PrimaryButton>
      </div>
    </form>
  </Modal>
</template>
