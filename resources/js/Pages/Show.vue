<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    props: {
        boards: Array
    },
    components: {
        AuthenticatedLayout
    }
}
</script>
<template>
    <AuthenticatedLayout>
sadasd
        <div v-for="ads in board" :key="ads.id">

<div>Название:{{ads.title}} </div>
<div>Описание:{{ads.description}} </div>
<div>Цена:{{ads.price}} </div>
<div>Продавец:{{ads.salesman}} </div>
</div>
</AuthenticatedLayout>
</template>

