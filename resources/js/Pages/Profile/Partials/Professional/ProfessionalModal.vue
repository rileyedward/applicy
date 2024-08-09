<script setup>
import { computed, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Breeze/Modal.vue';
import TextInput from '@/Components/Breeze/TextInput.vue';
import InputLabel from '@/Components/Breeze/InputLabel.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import TextArea from '@/Components/Breeze/TextArea.vue';
import SecondaryButton from '@/Components/Breeze/SecondaryButton.vue';
import PrimaryButton from '@/Components/Breeze/PrimaryButton.vue';

const props = defineProps({
  show: Boolean,
  selectedProfessionalExperience: {
    type: Object,
    required: false,
  },
});

const emits = defineEmits(['close']);

watch(
  () => props.selectedProfessionalExperience,
  (value) => {
    form.position = value?.position ?? '';
    form.company_name = value?.company_name ?? '';
    form.location = value?.location ?? '';
    form.start_date = value?.start_date ?? '';
    form.end_date = value?.end_date ?? '';
    form.description = value?.description ?? '';
  }
);

const formTitle = computed(() => {
  if (props.selectedProfessionalExperience) {
    return 'Manage Professional Experience';
  }

  return 'Add Professional Experience';
});

const form = useForm({
  position: props.selectedProfessionalExperience?.position ?? '',
  company_name: props.selectedProfessionalExperience?.company_name ?? '',
  location: props.selectedProfessionalExperience?.location ?? '',
  start_date: props.selectedProfessionalExperience?.start_date ?? '',
  end_date: props.selectedProfessionalExperience?.end_date ?? '',
  description: props.selectedProfessionalExperience?.description ?? '',
});

const createProfessionalExperience = () => {
  form.post(route('professional.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      emits('close');
    },
  });
};

const updateProfessionalExperience = () => {
  form.put(
    route('professional.update', props.selectedProfessionalExperience.id),
    {
      preserveScroll: true,
      onSuccess: () => {
        form.reset();
        emits('close');
      },
    }
  );
};

const removeProfessionalExperience = () => {
  if (
    confirm('Are you sure you want to remove this professional experience?')
  ) {
    form.delete(
      route('professional.destroy', props.selectedProfessionalExperience.id),
      {
        preserveScroll: true,
        onSuccess: () => {
          form.reset();
          emits('close');
        },
      }
    );
  }
};
</script>

<template>
  <Modal :show="show" @close="$emit('close')">
    <div class="p-6">
      <h3 class="text-lg font-medium text-neutral-100 mb-1">{{ formTitle }}</h3>
      <p class="text-sm text-neutral-300 mb-6">
        Add your professional experience to showcase your work history.
      </p>

      <form class="space-y-6">
        <div class="flex flex-col lg:flex-row gap-4">
          <div class="flex-1">
            <InputLabel for="position" value="Position" />
            <TextInput
              v-model="form.position"
              id="position"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Software Engineer"
            />
            <InputError :message="form.errors.position" class="mt-1" />
          </div>
          <div class="flex-1">
            <InputLabel for="company_name" value="Company Name" />
            <TextInput
              v-model="form.company_name"
              id="company_name"
              type="text"
              class="mt-1 block w-full bg-neutral-700 border-none"
              placeholder="Acme Inc."
            />
            <InputError :message="form.errors.company_name" class="mt-1" />
          </div>
        </div>

        <div class="w-full">
          <InputLabel for="location" value="Location" />
          <TextInput
            v-model="form.location"
            id="location"
            type="text"
            class="mt-1 block w-full bg-neutral-700 border-none"
            placeholder="San Francisco, CA"
          />
          <InputError :message="form.errors.location" class="mt-1" />
        </div>

        <div class="flex flex-col lg:flex-row gap-4">
          <div class="flex-1">
            <InputLabel for="start_date" value="Start Date" />
            <TextInput
              v-model="form.start_date"
              id="start_date"
              type="date"
              class="mt-1 block w-full bg-neutral-700 border-none"
            />
            <InputError :message="form.errors.start_date" class="mt-1" />
          </div>
          <div class="flex-1">
            <InputLabel for="end_date" value="End Date" />
            <TextInput
              v-model="form.end_date"
              id="end_date"
              type="date"
              class="mt-1 block w-full bg-neutral-700 border-none"
            />
            <InputError :message="form.errors.end_date" class="mt-1" />
          </div>
        </div>

        <div>
          <InputLabel for="description" value="Description" />
          <TextArea
            v-model="form.description"
            id="description"
            class="mt-1 block w-full bg-neutral-700 border-none"
          />
          <InputError :message="form.errors.description" class="mt-1" />
        </div>

        <div class="flex justify-end gap-4">
          <SecondaryButton
            v-if="selectedProfessionalExperience"
            @click.prevent="removeProfessionalExperience"
          >
            Remove
          </SecondaryButton>
          <PrimaryButton
            v-if="selectedProfessionalExperience"
            @click.prevent="updateProfessionalExperience"
            class="bg-orange-600 hover:bg-orange-500"
          >
            Update
          </PrimaryButton>
          <PrimaryButton
            v-else
            @click.prevent="createProfessionalExperience"
            class="bg-orange-600 hover:bg-orange-500"
          >
            Add
          </PrimaryButton>
        </div>
      </form>
    </div>
  </Modal>
</template>
