<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    props: {
        board: Array,
        user_id:String
    },
    components: {
        AuthenticatedLayout
    }
}
</script>
<template>
    <AuthenticatedLayout>
        <div v-for="board in board" :key="board.id">
            <div>Название:{{board.title}} </div>
            <div>Описание:{{board.description}} </div>
            <div>Цена:{{board.price}} </div>
            <div>Продавец:{{board.user_id}} </div>
        </div>
</AuthenticatedLayout>
</template>

