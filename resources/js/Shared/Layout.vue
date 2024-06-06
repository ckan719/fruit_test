<template>
  <a-layout>
    <a-layout-sider v-model:collapsed="collapsed" :trigger="null" collapsible style="height: 100vh">
      <div class="logo"/>
      <a-menu v-model:selectedKeys="selectedKeys" theme="dark" mode="inline">
        <a-menu-item key="1">
          <user-outlined/>
          <span><Link href="/dashboard">Dashboard</Link></span>
        </a-menu-item>
        <a-menu-item key="2">
          <user-outlined/>
          <span><Link href="/fruit_categories">Fruit Category</Link></span>
        </a-menu-item>
        <a-menu-item key="3">
          <video-camera-outlined/>
          <span><Link href="/fruit_category_notes">Fruit Category Note</Link></span>
        </a-menu-item>
        <a-sub-menu key="sub1">
          <template #title>
            <upload-outlined/>
            <span>
              Order
            </span>
          </template>
          <a-menu-item key="4">
            <upload-outlined/>
            <span><Link href="/orders">Order List</Link></span>
          </a-menu-item>
          <a-menu-item key="5">
            <upload-outlined/>
            <span><Link href="/orders/create">Order Create</Link></span>
          </a-menu-item>
        </a-sub-menu>
        <a-menu-item key="6">
          <user-outlined/>
          <span><Link href="/logout">Logout</Link></span>
        </a-menu-item>
      </a-menu>
    </a-layout-sider>
    <a-layout>
      <a-layout-header style="background: #fff; padding: 0 0 0 20px">
        <menu-unfold-outlined
            v-if="collapsed"
            class="trigger"
            @click="() => (collapsed = !collapsed)"
        />
        <menu-fold-outlined v-else class="trigger" @click="() => (collapsed = !collapsed)"/>
      </a-layout-header>
      <a-layout-content
          :style="{ margin: '24px 16px', padding: '24px', background: '#fff', height: '600px', overflow: 'auto' }"
      >
        <slot/>
      </a-layout-content>
    </a-layout>
  </a-layout>
</template>
<script lang="ts" setup>
import {ref} from 'vue';
import {
  UserOutlined,
  VideoCameraOutlined,
  UploadOutlined,
  MenuUnfoldOutlined,
  MenuFoldOutlined,
} from '@ant-design/icons-vue';
import {Link} from '@inertiajs/vue3'

const selectedKeys = ref<string[]>([]);
const collapsed = ref<boolean>(false);
</script>
<style>
#components-layout-demo-custom-trigger .trigger {
  font-size: 18px;
  line-height: 64px;
  padding: 0 24px;
  cursor: pointer;
  transition: color 0.3s;
}

#components-layout-demo-custom-trigger .trigger:hover {
  color: #1890ff;
}

#components-layout-demo-custom-trigger .logo {
  height: 32px;
  background: rgba(255, 255, 255, 0.3);
  margin: 16px;
}

.site-layout .site-layout-background {
  background: #fff;
}
</style>
