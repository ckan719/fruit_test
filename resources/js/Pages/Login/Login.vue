<template>
  <a-row align="middle">
    <a-col :span="12" :offset="6">
      <a-form
          :model="formState"
          name="basic"
          :label-col="{ span: 8 }"
          :wrapper-col="{ span: 16 }"
          autocomplete="off"
          @finish="onFinish"
          @finishFailed="onFinishFailed"
      >
        <a-form-item
            label="Email"
            name="email"
            :rules="[{ required: true, message: 'Please input your username!' }]"
        >
          <a-input v-model:value="formState.email"/>
        </a-form-item>

        <a-form-item
            label="Password"
            name="password"
            :rules="[{ required: true, message: 'Please input your password!' }]"
        >
          <a-input-password v-model:value="formState.password"/>
        </a-form-item>

        <a-form-item name="remember" :wrapper-col="{ offset: 8, span: 16 }">
          <a-checkbox v-model:checked="formState.remember">Remember me</a-checkbox>
        </a-form-item>

        <a-form-item :wrapper-col="{ offset: 8, span: 16 }">
          <a-button type="primary" html-type="submit">Submit</a-button>
        </a-form-item>
      </a-form>
    </a-col>
  </a-row>
</template>
<script lang="ts" setup>
import {reactive} from 'vue';
import {router} from '@inertiajs/vue3'

interface FormState {
  email: string;
  password: string;
  remember: boolean;
}

const formState = reactive<FormState>({
  email: 'admin@gmail.com',
  password: 'password',
  remember: true,
});
const onFinish = (values: any) => {
  console.log('Success:', values);
  router.post('login', formState)
};

const onFinishFailed = (errorInfo: any) => {
  console.log('Failed:', errorInfo);
};
</script>
