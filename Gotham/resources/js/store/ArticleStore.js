// import Vue from "vue";
// import Vuex from "vuex";
// import axios from "axios";

// Vue.use(Vuex);


// export default new Vuex.Store({
//     state:{
        
//         article:[]

//     },
//     getters:{

//     },
//     mutations:{
//         addArticle(state,articledata){

//             console.log(articledata);
//             state.article.push({
                
//                 title: articledata.title,
//                 description :articledata.description

//             });

//         },

//         loadArticleList(state,data){

//             state.article = data;

//         }

//     },
//     actions:{
//         addArticle(context,article){

//             axios
//             .post("/articles", {
//                 title: article.title,
//                 description: article.description
//             })
//             .then(response => {

//                 console.log(response.data);

//                 context.commit("addArticle", response.data);
//             })
//             .catch(err => {
//                 console.log(error);
//             });


//         },

//         loadArticle(context){
//             axios
//             .get("/articlesData")
//             .then(response => {
//                 context.commit("loadArticleList", response.data);
//             })
//             .catch(err => {
//                 console.log(error);
//             });

//         }
//     }




// });