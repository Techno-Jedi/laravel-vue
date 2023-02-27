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
    },
    methods:{
        showPhone(event){
            const attrValue = event.target;
console.log(attrValue)

     if(attrValue){
        let p = attrValue
        p.innerHTML = "+7 XXX XXX XXXX"
        setTimeout(() => p.innerHTML = "Показать телефон", 2000)
              
        }

    }}
}
</script>

<template>
    <AuthenticatedLayout>
        <div v-for="board in boards" :key="board.id">
            <div class="boardAds">
                <div class="imagesAndPhone">
                    <div class="image">
                        <img v-bind:src="`/storage/board/${board.image}`">
                    </div>
                    <div class="button" ><p @click="showPhone"  v-bind:data-id="`${board.id}`" ref="p">Показать телефон</p>
                    </div>
                </div>
                <div class="description-salesman">
                    <Link :href="route('board.show',{board})">
                        <div>Название модели:{{ board.title }}</div>
                    </Link>
                    <div class="description">Описание:{{ board.description }}</div>
                    <div class="price">Продавец:{{ board.user_id }}</div>
                </div>
                <div class="price">Цена:{{ board.price }}</div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

