<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    boards: Array,
    error: Array,
});

const form = useForm({
    title: null,
    description: null,
    price: null,
    user_id: props.boards.map((e) => e.user_id)[0],
    image: null,
});

function onFileChange(e) {
    let preview = document.querySelector("#AdsImg");
    let file = document.querySelector("input[type=file]").files[0];
    let reader = new FileReader();

    reader.onloadend = function () {
        return preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);

    } else {
        preview.src = "";
    }
    console.log("1", file.name)
    return form.image = file;
};

function urlImg(fileName) {
    return "/public/board/" + fileName;
};

const store = () => {
    form.post(route("board.store"));
};

</script>

<template>
    <AuthenticatedLayout>
        <div class="adsForm">
            <form @submit.prevent="store">
                <div>
                    <input
                        id="user_id"
                        name="user_id"
                        type="hidden"
                        v-model="form.user_id"
                    />
                </div>
                <div v-if="form.errors.user_id">{{ form.errors.user_id }}</div>
                <div class="input_form_div">
                    <p>Название</p>
                    <input id="title"
                           class="input_form"
                           type="text"
                           name="title"
                           v-model="form.title"/>
                    <div v-if="form.errors.title">{{ form.errors.title }}</div>
                </div>
                <div class="textarea_div">
                    <p>Описание</p>
                    <textarea id="description"
                              class="textarea"
                              type="text"
                              name="description"
                              v-model="form.description"></textarea>
                    <div v-if="form.errors.description">{{ form.errors.description }}</div>
                </div>
                <div class="input_price_div">Цена
                    <input id="price"
                           name="price"
                           type="number"
                           v-model="form.price"/>
                    <div v-if="form.errors.price">{{ form.errors.price }}</div>
                </div>
                <div class="loadingAndSave">
                    <div class="imagesAndPhone">
                        <div class="image">
                            <img id="AdsImg" :src="urlImg(form.image)">
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
                                @change="onFileChange()"
                            />
                        </div>
                        <div v-if="form.errors.image">{{ form.errors.image }}</div>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>

