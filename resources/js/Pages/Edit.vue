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
            image:props.boards.map((e) => e.image)[0]

        });
        console.log("Form",form);
        function update() {
          form.put(route('board.update', form.id))
        }
        return{form, update};
    },


   methods: {
      onFileChange(e) {
       
        // let file = e.target.files[0];
        // let reader = new FileReader();
        // reader.onloadend = () =>{
        //     this.form.image = reader.result;
        // }
        // reader.readAsDataURL(file)
        //  if (!files.length) {
        //      console.log('no files');
        //  }

        //  const file = files[0];
         console.log("sadasdasd",this.form.image = file.name);
         console.log("ff",this.form );
      return  form.image = e.target.files[0]

        }
        
   }
   
}
    

</script>
<template>
    <AuthenticatedLayout>
        <div v-if="errors" class="alert alert-danger">
            <ul v-for="error in errors" :key="error.id">
            </ul>
        </div>
        <form  @submit.prevent="update"  enctype="multipart/form-data">
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
                <input
                    id="salesman"
                    class="input_form"
                    type="hidden"
                    name="salesman"
                    v-model="form.user_id"
                />
            </div>
            
            <div class="loadingAndSave">
                <div class="imagesAndPhone">

                    <div class="image">
                        <img v-bind:src="`/storage/board/${form.image}`" 
                        alt="Картинка">

                    </div>
                    <div class="button ">
                        <p>
                            <button type="submit">Сохранить</button>
                        </p>
                    </div>
                </div>
                <div class="loading">
                    <label for="image">Загрузка</label>
                    <input
                        class="file_img"
                        id="image"
                        name="image"
                        type="file"
                        v-on:change="onFileChange"
                    />
                </div>
                <div v-if="form.errors.image">{{ form.errors.image }}</div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
