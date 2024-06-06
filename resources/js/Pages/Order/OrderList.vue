<template>
  <h2>Order list</h2>
  <a-card v-for="order in data" :id="'order_id_' + order.id" :title="order.customer_name"
          style="width: 100%; margin-bottom: 10px">
    <template #extra>
      <Link :href="'/orders/' + order.id + '/edit'">edit</Link>
      |
      <a @click="handleDelete(order.id)">delete</a>
      |
      <a @click="handlePrint(order)">print</a>
    </template>
    <a-table :pagination="{ pageSize: 3 }" :columns="columns" :data-source="order.order_details">
      <template #summary>
        <a-table-summary-row>
          <a-table-summary-cell>Total</a-table-summary-cell>
          <a-table-summary-cell :col-span="5">
            <a-typography-text type="danger">
              {{ order.total }}
            </a-typography-text>
          </a-table-summary-cell>
        </a-table-summary-row>
      </template>
    </a-table>
  </a-card>
  <iframe id="iframe_to_print" style="display: none">
  </iframe>
  <a-modal v-model:open="open" title="Preview Print" @ok="handleOk">
    <div id="table_for_print" style="height: 400px; overflow: auto">
      <table style="border-collapse:collapse;border: 1px solid;" cellspacing="0">
        <tbody>
        <tr>
          <td style="border: 1px solid;" colspan="2"><p>Customer Name</p></td>
          <td>
            <p>{{ selectedOrder.data.customer_name }}</p>
          </td>
          <td>
            <p><br></p></td>
          <td>
            <p><br></p></td>
          <td>
            <p><br></p></td>
          <td>
            <p><br></p></td>
        </tr>
        <tr style="height:14pt;border: 1px solid">
          <td style="border: 1px solid;">
            <p>No</p></td>
          <td style="border: 1px solid;">
            <p>Category</p>
          </td>
          <td style="border: 1px solid;">
            <p>Fruit</p></td>
          <td style="border: 1px solid;">
            <p>Unit</p></td>
          <td style="border: 1px solid;">
            <p>Price</p></td>
          <td style="border: 1px solid;">
            <p>Quantity</p>
          </td>
          <td style="border: 1px solid;">
            <p>Amount</p></td>
        </tr>
        <tr v-for="(or, ind) in selectedOrder.data?.order_details || []" style="height:14pt;border: 1px solid">
          <td style="border: 1px solid;">
            <p>{{ ind + 1 }}</p></td>
          <td style="border: 1px solid;">
            <p>{{ or.fruit_category_name }}</p></td>
          <td style="border: 1px solid;">
            <p>{{ or.fruit_category_note_name }}</p></td>
          <td style="border: 1px solid;">
            <p>{{ or.fruit_category_note_unit }}</p></td>
          <td style="border: 1px solid;">
            <p>{{ or.fruit_category_note_price }}</p></td>
          <td style="border: 1px solid;">
            <p>{{ or.order_quantity }}</p></td>
          <td style="border: 1px solid;">
            <p>{{ or.order_amount }}</p></td>
        </tr>
        <tr style="height:14pt;border: 1px solid">
          <td>
            <p><br></p></td>
          <td>
            <p><br></p></td>
          <td>
            <p><br></p></td>
          <td>
            <p><br></p></td>
          <td>
            <p><br></p></td>
          <td>
            <p>Total</p></td>
          <td>
            <p>{{ selectedOrder.data?.total || 0 }}</p></td>
        </tr>
        </tbody>
      </table>
    </div>
  </a-modal>
</template>
<script lang="ts" setup>
import {Link, router, usePage} from "@inertiajs/vue3";
import {computed, reactive, ref} from "vue";

const selectedOrder = reactive({
  data: null
});
const {orders} = usePage().props;

const data = computed(() => {
  orders.forEach(item => {
    item.total = item.order_details.reduce((sum, i) => sum + i.order_amount, 0);
  });
  return orders;
})

const columns = [
  {
    title: 'Category',
    dataIndex: 'fruit_category_name',
    key: 'fruit_category_name',
  },
  {
    title: 'Fruit',
    dataIndex: 'fruit_category_note_name',
    key: 'fruit_category_note_name',
  },
  {
    title: 'Unit',
    dataIndex: 'fruit_category_note_unit',
    key: 'fruit_category_note_unit',
  },
  {
    title: 'Price',
    key: 'fruit_category_note_price',
    dataIndex: 'fruit_category_note_price',
  },
  {
    title: 'Quantity',
    key: 'order_quantity',
    dataIndex: 'order_quantity',
  },
  {
    title: 'Amount',
    key: 'order_amount',
    dataIndex: 'order_amount',
  },
];

const handleDelete = (id) => {
  if (confirm('Sure ?')) {
    router.delete('/orders/' + id, {
      onFinish: visit => {
        window.location.reload();
      }
    })
  }
}


const open = ref<boolean>(false);

const handleOk = (e: MouseEvent) => {
  const tb = document.getElementById('table_for_print');
  const iframe = document.getElementById('iframe_to_print');
  iframe.contentDocument.write(tb.outerHTML);
  iframe.contentWindow.print();
  open.value = false;

};

const handlePrint = (order) => {
  selectedOrder.data = order;
  open.value = true;
}


</script>