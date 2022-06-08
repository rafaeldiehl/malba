<template>
  <div class="form-input">
    <label :for="name">{{ computedLabel }}</label>
    <div class="input-container">
      <input
        :type="inputType"
        :name="name"
        :placeholder="placeholder"
        :required="required"
        :value="modelValue"
        @input="updateValue"
      />
      <div class="password-handler" v-if="type == 'password'" @click="handleInputType">
        <img :src="icons.eye.src" :alt="icons.eye.alt" v-if="inputType == 'password'" />
        <img :src="icons.eyeOff.src" :alt="icons.eyeOff.alt" v-if="inputType == 'text'" />
      </div>
    </div>
    
  </div>
</template>

<script>
import eyeIcon from "@/assets/icons/eye.svg";
import eyeOffIcon from "@/assets/icons/eye-off.svg";

export default {
  name: 'FormInput',
  data() {
    return {
      icons: {
        eye: {
          src: eyeIcon,
          alt: 'Revelar senha'
        },
        eyeOff: {
          src: eyeOffIcon,
          alt: 'Ocultar senha'
        }
      },
      inputType: this.type
    }
  },
  props: {
    type: {
      validator(value) {
        return ['text', 'password'].includes(value)
      },
      required: true
    },
    name: {
      type: String,
      required: true
    },
    label: {
      type: String,
      required: true
    },
    placeholder: {
      type: String,
      required: true
    },
    modelValue: {
      type: String,
      required: true
    },
    required: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    computedLabel() {
      return this.label.charAt(0).toUpperCase() + this.label.slice(1); // Retorna a label informada pelo usuário capitalizada 
    }
  },
  methods: {
    updateValue(event) {
      this.$emit('update:modelValue', event.target.value) 
    },
    handleInputType() {
      this.inputType == 'password' ? this.inputType = 'text' : this.inputType = 'password';
    }
  }
}
</script>

<style lang="scss" scoped>
.form-input {
  @apply flex flex-col my-4;

  label {
    @apply text-xs mb-2;
  }

  input {
    @apply w-full text-base bg-zinc-200 p-4 rounded-lg placeholder-zinc-500 focus:outline-none focus:outline-2 focus:outline-offset-0 focus:outline-sky-500;
  }

  .input-container {
    @apply relative;

    img {
      @apply absolute top-[50%] translate-y-[-50%] right-4;
    }
  }
}

</style>