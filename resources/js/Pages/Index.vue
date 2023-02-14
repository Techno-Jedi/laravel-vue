<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3'

export default {
    props: {
        boards: Array,
        user_id:String
    },
    components: {
        AuthenticatedLayout,
        Link,
    }
}
</script>

<template>
    <AuthenticatedLayout>
         <template #header>
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">Объявa</h2>
         </template>
        <div v-for="board in boards" :key="board.id">
        <div class="boardAds" >


            <div class="imagesAndPhone">
                <div class= "image">Картинка:{{ board.filename }}</div>
                <div class="button"> <p>Показать телефон</p>
                </div>
            </div>
            <div class="description-salesman">
                <Link :href="route('board.show',{board})">
                    <div>Название модели:{{board.title}}</div>
                </Link>
                <div class="description">Описание:{{board.description}}</div>
                <div>Продавец:{{board.user_id}}</div>
            </div>
            <div class="price">Цена:{{board.price }}</div>
        </div>

        </div>

    </AuthenticatedLayout>
</template>

