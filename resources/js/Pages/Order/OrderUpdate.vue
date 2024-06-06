<template>
  <h2>Order Update</h2>
  <div style="background-color: #ececec; padding: 20px">
    <a-row :gutter="[16, 16]">
      <a-col :span="24">
        <a-form
            ref="formRef"
            name="custom-validation"
            :model="formState"
            v-bind="layout"
            @finish="handleFinish"
            @validate="handleValidate"
            @finishFailed="handleFinishFailed"
        >
          <a-form-item label="Customer Name" name="customer_name">
            <a-input v-model:value="formState.customer_name" autocomplete="off"/>
          </a-form-item>
          <a-space
              v-for="(fruit, index) in formState.fruit_category_notes"
              :key="fruit.id"
              style="margin-bottom: 8px; width: 100%"
              align="baseline"
          >
            <a-form-item
                :name="['fruit_category_notes', index, 'value']"
                style="width: 400px"
                label="Fruit"
            >
              <a-select
                  v-model:value="fruit.value"
                  :field-names="{ label: 'name', value: 'id', options: 'children' }"
                  :options="fruitCategories"
              ></a-select>
            </a-form-item>
            <a-form-item
                label="Quantity"
                :name="['fruit_category_notes', index, 'quantity']"
                style="width: 400px"
            >
              <a-input-number v-model:value="fruit.quantity"/>
            </a-form-item>
            <MinusCircleOutlined @click="removeFruit(fruit)"/>
          </a-space>
          <a-form-item>
            <a-button type="dashed" block @click="addFruit">
              <PlusOutlined/>
              Add fruits
            </a-button>
          </a-form-item>
          <a-form-item :wrapper-col="{ span: 14, offset: 4 }">
            <a-button type="primary" html-type="submit">Submit</a-button>
            <a-button style="margin-left: 10px" @click="resetForm">Reset</a-button>
          </a-form-item>
        </a-form>
      </a-col>
    </a-row>
  </div>
</template>
<script lang="ts" setup>
import {reactive, ref} from 'vue';
import type {FormInstance} from 'ant-design-vue';
import {MinusCircleOutlined, PlusOutlined} from '@ant-design/icons-vue';
import {router, usePage} from "@inertiajs/vue3";

interface FruitNote {
  value: number;
  quantity: number;
  id: number;
}

interface FormState {
  customer_name: string;
  fruit_category_notes: FruitNote[];
}

const {fruitCategories, order} = usePage().props;

const formRef = ref<FormInstance>();
const formState = reactive<FormState>({
  customer_name: '',
  fruit_category_notes: [],
});

formState.customer_name = order.customer_name;
formState.fruit_category_notes = order.order_details.map(item => {
  return {
    value: item.fruit_category_note_id,
    quantity: item.quantity,
    id: item.id
  }
})

const layout = {
  labelCol: {span: 4},
  wrapperCol: {span: 14},
};


const removeFruit = (item: FruitNote) => {
  const index = formState.fruit_category_notes.indexOf(item);
  if (index !== -1) {
    formState.fruit_category_notes.splice(index, 1);
  }
};
const addFruit = () => {
  formState.fruit_category_notes.push({
    value: undefined,
    quantity: undefined,
    id: Date.now()
  });
};

const handleFinish = (values: FormState) => {
  console.log(values, formState);
  router.put('/orders/' + order.id, formState)
};
const handleFinishFailed = errors => {
  console.log(errors);
};
const resetForm = () => {
  formRef.value.resetFields();
  formState.fruit_category_notes = []
};
const handleValidate = (...args) => {
  console.log(args);
};
</script>
