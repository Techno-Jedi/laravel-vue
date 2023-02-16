<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Method } from '@inertiajs/core';
import {useForm} from "@inertiajs/vue3";
import { Link } from '@inertiajs/vue3'

export default {
    props: {
        boards: Array,
        error: Array
    },
    components: {
        Link,
        AuthenticatedLayout
    },
    setup(props){
        const form = useForm({
            title: props.boards.map((e) => e.title )[0],
            description: props.boards.map((e) => e.description)[0],
            price: props.boards.map((e) => e.price)[0],
            user_id: props.boards.map((e) => e.user_id)[0],
            id: props.boards.map((e) => e.id)[0],

        });
        const f = {
        x:console.log("sadsad", form.title)
    }

        function update() {
          form.put(route('board.update', form.id))
        }
        return{form, update};
    }    
}
    

</script>
<template>
    <AuthenticatedLayout>
 
        <div v-for="board in boards" :key="board.id">
        </div>
{{form }}
        <div v-if="errors" class="alert alert-danger">
            <ul v-for="error in errors" :key="error.id">
            </ul>
        </div>
        <form  @submit.prevent="update">
            <div class="input_form_div">
                <p>Название:</p>
                <input
                    class="input_form"
                   
                    name="title"
                    v-model="form.title"
                />
                <div v-if="form.errors.title">{{ form.errors.title }}</div>
            </div>
            <div class="textarea_div">
                <p>Описание:</p>
                <textarea
                    id="description"
                    class="textarea"
                    type="text"
                    name="description"
                    v-model="form.description">
                </textarea>
                <div v-if="form.errors.title">{{ form.errors.description }}</div>
            </div>
            <div class="input_price_div">
                <p>Цена:</p>
                <input
                    class="input_price"
                    id="price"
                    type="number"
                    name="price"
                    v-model.number="form.price"
                />
                <div v-if="form.errors.title">{{ form.errors.price }}</div>
            </div>
            <div class="input_form_div mb-10">
                <p>Продавец:</p>
                <input
                    id="salesman"
                    class="input_form"
                    type="text"
                    name="salesman"
                    v-model="form.user_id"
                />
            </div>
            <div class="loadingAndSave">
                <div class="imagesAndPhone">
                    <div class="image">
                        <!-- <img src="{{ Vite::asset('public/board/' . form.image) }}"/> -->

                    </div>
                    <div class="button ">
                        <p>
                            <button :disabled="form.processing" type="submit">Сохранить</button>
                        </p>
                    </div>
                </div>
                <div class="loading ">
                    <label for="image">Загрузка</label>
                    <input
                        class="file_img"
                        id="image"
                        name="image"
                        type="file"
                    />
                </div>

            </div>
        </form>
    </AuthenticatedLayout>
</template>
