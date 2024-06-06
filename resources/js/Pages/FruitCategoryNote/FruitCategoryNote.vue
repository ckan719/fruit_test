<template>
  <h2>Fruit Category Note</h2>
  <div style="background-color: #ececec; padding: 20px">
    <a-row :gutter="[16, 16]">
      <a-col :span="24" v-for="item in fruitCategoryNotes">
        <a-card :title="item.name" :bordered="false">
          <p v-for="citem in item.fruit_category_notes ?? []">{{ citem.name }}</p>
        </a-card>
      </a-col>
    </a-row>
  </div>
</template>

<script lang="ts" setup>
import {usePage} from "@inertiajs/vue3";

const {fruitCategoryNotes} = usePage().props;
</script>