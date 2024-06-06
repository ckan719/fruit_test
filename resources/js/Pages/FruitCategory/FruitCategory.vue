<template>
  <h2>Fruit Category</h2>
  <a-list item-layout="horizontal" :data-source="fruitCategories">
    <template #renderItem="{ item }">
      <a-list-item>
        <a-list-item-meta
            description="fake description"
        >
          <template #title>
            <a href="#">{{ item.name }}</a>
          </template>
          <template #avatar>
            <a-avatar src="#"/>
          </template>
        </a-list-item-meta>
      </a-list-item>
    </template>
  </a-list>
</template>
<script lang="ts" setup>
import {usePage} from "@inertiajs/vue3";

const {fruitCategories} = usePage().props;
</script>

