<script >
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
    methods: {
        destroy(id){
            if(confirm("Уверен?")){
                this.$inertia.delete(this.route("board.destroy", id))
            }
        }
    },
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Все моё</h2>
        </template>

            <div v-for="board in boards" :key="board.id">
                   <div>{{board.id}}</div>
                <div class="boardAds">
                    <div class="imagesAndPhone">
                        <div class= "image">Картинка:{{ board.image }}</div>
                    </div>
                    <div class="description-salesman">
                        <Link :href="route('board.show',{board})">
                            <div>Название:{{board.title}}</div>
                        </Link >
                        <div >Описание:{{board.description}}</div>
                    </div>
                    <div class="priceAndChange" >
                        <div class="price">Цена:{{ board.price }}</div>
                        <div class="DeleteAndChange">
                            <Link :href="route('board.edit',{board})">
                                <div class="change"><button>Изменить </button></div>
                            </Link>
                            <!-- <form @submit.prevent="form.post('/board')"> -->
                                <div class="delete">
                                    <Link @click="destroy(board.id)" :href="route('board.store', {id:board.id})" method="post" as="button">Удалить</Link>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>

                </div>
            </div>
    </AuthenticatedLayout>
</template>

