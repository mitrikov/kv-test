<script setup lang="ts">
import IMask from 'imask';
import {onMounted, ref, watch} from "vue";
import axios, {AxiosError} from "axios";

enum FormStatus {
  initial,
  succeed,
  empty,
  invalid,
  overflow
}

interface IAppealFormData {
  name: string | null
  phone: string | null
  content: string | null
}

interface IAppealFormErrors {
  name: string[] | null
  phone: string[] | null
  content: string[] | null
}





const phoneImask = ref<typeof IMask | null>(null)
const phoneElement = ref<HTMLElement | null>(null)
const formData = ref<IAppealFormData>({
  name: null,
  phone: null,
  content: null
})

const formErrors = ref<IAppealFormErrors>({
  name: null,
  phone: null,
  content: null
})



onMounted(() => {
  if (phoneElement.value) {
      phoneImask.value = new IMask(phoneElement.value, {
      mask: [{
        mask: '{8} (000) 000-00-00',
      }, {
        mask: '{+7} (000) 000-00-00'
      }]
    })
  }
})

const submitForm = async (e) => {
  e.preventDefault()
  try {
    const response = await axios.post(`${import.meta.env.VITE_BACKEND_URL}/api/appeals`, formData.value)

    switch (response.status) {
      case 201 :
        alert("Ваше обращение отправлено!");
        setFormDataInitialState()
        setFormErrorsinitialState()
        break;
      default: alert("Ошибка отправки формы");
    }
  } catch (e : AxiosError) {
    // console.log()
    switch (e.response.status) {
      case 422:
        formErrors.value = e.response.data.errors
        break;
      default:     alert("Ошибка соединения! Попробуйте позже");
    }
  }
}

const setPhoneValue = () => {
  formData.value.phone = phoneImask.value.unmaskedValue
}

const clearPhoneMask = () => {
  phoneElement.value.value = "";
  phoneImask.value.updateValue();
}

const setFormDataInitialState = () => {
  formData.value = {
    name: null,
    phone: null,
    content: null
  }

  clearPhoneMask()
}

const setFormErrorsinitialState = () => {
  formErrors.value = {
    name: null,
    phone: null,
    content: null
  }
}
</script>

<template>
  <div>
    <form action="POST" class="form" @submit.prevent="submitForm">
      <div class="input-wrapper">
        <label for="name">Ваше имя: </label>
        <input
            type="text"
            name="name"
            class="form__input"
            :class="formErrors.name ? 'form__input--error' : ''"
            v-model="formData.name"
        >
      </div>

      <div class="input-wrapper">
        <label for="phone">Номер телефона</label>
        <input
            type="text"
            name="phone"
            ref="phoneElement"
            class="form__input"
            :class="formErrors.phone ? 'form__input--error' : ''"
            @input="setPhoneValue"
            @change="setPhoneValue"
        >
      </div>

      <div class="input-wrapper">
        <label for="content">Текст обращения: </label>
        <textarea
            name="content"
            cols="30"
            rows="10"
            class="form__input"
            :class="formErrors.content ? 'form__input--error' : ''"
            v-model="formData.content"
        ></textarea>
      </div>
      <div class="errors">
        <div v-for="errorKey in Object.keys(formErrors)">
          <div v-if="formErrors[errorKey] && formErrors[errorKey].length !== 0">
            <div v-for="error in formErrors[errorKey]">
              {{ error }}
            </div>
          </div>
        </div>
      </div>
      <input type="submit" value="Отправить" class="form__submit">
    </form>
  </div>
</template>

<style lang="scss" scoped>
  .form {

    display: flex;
    flex-direction: column;
    gap: 0.5rem;

    &__input {
      font-size: 18px;
      padding: 0.7rem 1rem;
      border-radius: 8px;
      border: 1px solid #cecece;

      &--error {
        border-color: red;
      }

      &--succeed {
        border-color: green;
      }
    }
    
    &__submit {
      background-color: #000;
      border: none;
      color: #fff;
      border-radius: 8px;
      align-self: flex-end;
      padding: 0.7rem 1rem;
    }
  }

  .input-wrapper {
    display: flex;
    flex-direction: column;
  }

  .errors {
    color: red;
  }
</style>