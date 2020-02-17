<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="text-center">Add Articles</h1>
                <form method="post" v-show="!edit" @submit.prevent="addArticle">
                    <div class="form-group">
                        <label>title</label>
                        <input
                            type="text"
                            v-model="title"
                            class="form-control"
                        />
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea
                            class="form-control"
                            name="description"
                            v-model="description"
                        ></textarea>
                    </div>

                    <input class="btn btn-success " type="submit" value="Add" />
                </form>

                <form method="post" v-show="edit" @submit.prevent="editArticle">
                    <div class="form-group">
                        <label>title</label>
                        <input
                            type="text"
                            v-model="title"
                            class="form-control"
                        />
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea
                            class="form-control"
                            name="description"
                            v-model="description"
                        ></textarea>
                    </div>

                    <input
                        class="btn btn-success "
                        type="submit"
                        value="edit"
                    />
                </form>
            </div>

            <div class="col-md-8">
                <table class="table">
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>

                    <tr v-for="articles in article" :key="articles.id">
                        <td>{{ articles.id }}</td>
                        <td>{{ articles.title }}</td>
                        <td>{{ articles.description }}</td>
                        <td>
                            <button @click="removeItem(articles.id)">
                                &times;
                            </button>

                            <button @click="editItem(articles.id)">
                                edit
                            </button>
                        </td>
                    </tr>

                    <tr></tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    components: {},
    data() {
        return {
            title: "",
            description: "",
            article: [],
            editId: "",
            edit: false
        };
    },

    mounted() {
        console.log("Component mounted.");
    },

    created() {
        //    this.$store.dispatch("loadArticle");

        axios
            .get("/articlesData")
            .then(response => {
                this.article = response.data;
            })
            .catch(err => {
                console.log(error);
            });
    },

    computed: {},

    methods: {
        addArticle() {
            axios
                .post("/articles", {
                    title: this.title,
                    description: this.description
                })
                .then(response => {
                    this.article = response.data;
                })
                .catch(err => {
                    console.log(error);
                });

            (this.title = ""), (this.description = "");
        },

        removeItem(id) {
            axios.delete("/articles/" + id).then(response => {
                this.article = response.data;
            });
        },

        editItem(id) {
            axios.get("/articles/" + id).then(response => {
                this.title = response.data.title;
                this.description = response.data.description;
                this.editId = response.data.id;
                this.edit = true;
            });
        },

        editArticle() {
            axios
                .put("/articles/" + this.editId, {
                    title: this.title,
                    description: this.description
                })
                .then(response => {
                    this.article = response.data;
                    (this.title = ""),
                        (this.description = ""),
                        (this.edit = false);
                });
        }
    }
};
</script>

<style></style>
