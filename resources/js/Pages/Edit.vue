<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
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
            title: props.boards.map((e) => e.title ),
            description: props.boards.map((e) => e.description ),
            price: props.boards.map((e) => e.price ),
            user_id: props.boards.map((e) => e.user_id )

        });
        function update() {
            form.put(this.route('board.update', props.boards))
        }
        return{form, update};
    }
}
</script>
<template>
    <AuthenticatedLayout>
        {{boards}}
        <div v-for="board in boards" :key="board.id">
        </div>

        <div v-if="errors" class="alert alert-danger">
            <ul v-for="error in errors" :key="error.id">
            </ul>
        </div>
        <form  @submit.prevent="form.update('board.update')">
            <div class="input_form_div">
                <p>Название:</p>
                <input
                    class="input_form"
                    id="title"
                    type="text"
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
                    v-model="form.price"
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
                        <img src="{{ Vite::asset('public/board/' . form.image) }}"/>

                    </div>
                    <div class="button ">
                        <p>
                            <button type="submit">Сохранить</button>
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
