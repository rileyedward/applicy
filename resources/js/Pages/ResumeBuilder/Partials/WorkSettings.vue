<script setup>
import { useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { watch } from 'vue';
import InputError from '@/Components/InputError.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
  modalOpen: Boolean,
  experience: Array,
});

const emits = defineEmits(['close']);

const form = useForm({
  position: props.experience?.position ?? '',
  company_name: props.experience?.company_name ?? '',
  location: props.experience?.location ?? '',
  start_date: props.experience?.start_date ?? '',
  end_date: props.experience?.end_date ?? '',
  description: props.experience?.description ?? '',
  skills: props.experience?.skills ?? '',
});

watch(
  () => props.experience,
  (value) => {
    form.position = value.position;
    form.company_name = value.company_name;
    form.location = value.location;
    form.start_date = value.start_date;
    form.end_date = value.end_date;
    form.description = value.description;
    form.skills = value.skills;
  }
);

const submit = () => {
  form.put(route('work-experience.update', props.experience.id), {
    onSuccess: () => {
      emits('close');
      form.reset();
    },
  });
};

const removeWork = () => {
  if (confirm('Are you sure you want to delete this work experience?')) {
    form.delete(route('work-experience.destroy', props.experience.id), {
      onSuccess: () => {
        emits('close');
        form.reset();
      },
    });
  }
};
</script>

<template>
  <Modal :show="modalOpen" @close="$emit('close')">
    <div>
      <h2 class="text-lg font-medium text-gray-900 mb-1">Add Work</h2>

      <p class="mt-1 text-sm text-gray-600 mb-4">
        Add to your professional background.
      </p>

      <form @submit.prevent="submit">
        <div>
          <InputLabel for="position" value="Position" />

          <TextInput
            id="position"
            type="text"
            class="mt-1 block w-full"
            v-model="form.position"
            required
            autofocus
            autocomplete="position"
          />

          <InputError class="mt-2" :message="form.errors.position" />
        </div>

        <div class="mt-4">
          <InputLabel for="company_name" value="Company Name" />

          <TextInput
            id="company_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.company_name"
            required
            autofocus
            autocomplete="company_name"
          />

          <InputError class="mt-2" :message="form.errors.company_name" />
        </div>

        <div class="mt-4">
          <InputLabel for="location" value="Location" />

          <TextInput
            id="location"
            type="text"
            class="mt-1 block w-full"
            v-model="form.location"
            required
            autofocus
            autocomplete="location"
          />

          <InputError class="mt-2" :message="form.errors.location" />
        </div>

        <div class="mt-4">
          <InputLabel for="start_date" value="Start Date" />

          <TextInput
            id="start_date"
            type="date"
            class="mt-1 block w-full"
            v-model="form.start_date"
            required
            autofocus
            autocomplete="start_date"
          />

          <InputError class="mt-2" :message="form.errors.start_date" />
        </div>

        <div class="mt-4">
          <InputLabel for="end_date" value="End Date" />

          <TextInput
            id="end_date"
            type="date"
            class="mt-1 block w-full"
            v-model="form.end_date"
            required
            autofocus
            autocomplete="end_date"
          />

          <InputError class="mt-2" :message="form.errors.end_date" />
        </div>

        <div class="mt-4">
          <InputLabel for="description" value="Description" />

          <TextArea
            id="description"
            type="text"
            class="mt-1 block w-full"
            v-model="form.description"
            required
            autofocus
            autocomplete="description"
          />

          <InputError class="mt-2" :message="form.errors.description" />
        </div>

        <div class="mt-4">
          <InputLabel for="skills" value="Skills" />

          <TextArea
            id="skills"
            type="text"
            class="mt-1 block w-full"
            v-model="form.skills"
            required
            autofocus
            autocomplete="skills"
          />

          <InputError class="mt-2" :message="form.errors.skills" />
        </div>

        <div class="flex justify-end items-center gap-4 mt-4">
          <SecondaryButton
            @click.prevent="removeWork"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Delete
          </SecondaryButton>

          <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Save
          </PrimaryButton>
        </div>
      </form>
    </div>
  </Modal>
</template>
