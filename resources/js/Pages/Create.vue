<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    title: '',
    description: '',
    price: '',
    user_id: '',

});
const submit = () => {
    form.post(route('/board'), {
        onFinish: () => form.reset('/board'),
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="adsForm">
        <form @submit.prevent="form.post('/board')">

            <div>Продавец:
                <input
                    id="user_id"
                    name="user_id"
                    type="text"

                    v-model="form.user_id"
                    />
            </div>
            <div v-if="form.errors.user_id">{{ form.errors.user_id }}</div>

            <div class="input_form_div">
                <p>Название</p>
                <input id="title"
                       type="text"
                       name="title"
                       v-model="form.title" />
                       <div v-if="form.errors.title">{{ form.errors.title }}</div>

            </div>

            <div class="textarea_div">
                <p>Описание</p>
                <textarea id="description"
                          type="text"
                          name="description"
                          v-model="form.description"></textarea>
                          <div v-if="form.errors.description">{{ form.errors.description }}</div>


            </div>

            <div class="input_price_div">Цена
                <input id="price"
                       name="price"
                       type="number"
                       v-model="form.price" />
                       <div v-if="form.errors.price">{{ form.errors.price }}</div>

            </div>

            <div class="loadingAndSave">
                <div class="imagesAndPhone">
                    <div class="image">
                    </div>
                    <div class="button ">
                        <p>
                            <button type="submit">Сохранить</button>
                        </p>
                    </div>
                </div>
                <div class="loadingAndSave">
                    <div class="loading ">
                        <label for="image">Загрузка</label>
                        <input
                            class="file_img"
                            id="image"
                            name="image"
                            type="file"
                        />
                    </div>
                    <div v-if="form.errors.image">{{ form.errors.image }}</div>
                </div>
            </div>
        </form>
        </div>
    </AuthenticatedLayout>
</template>

