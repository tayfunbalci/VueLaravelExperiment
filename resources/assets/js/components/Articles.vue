<template>
 <v-layout>
    <v-container fluid grid-list-md>
      <v-card>
        <v-container>
         <v-form ref="form" v-model="valid" lazy-validation>
          <v-text-field
            v-model="article.title"
            :rules="titleRules"
            :counter="10"
            label="Title"
            required
          ></v-text-field>
          <v-text-field
            v-model="article.body"
            :rules="bodyRules"
            label="Body"
            required
          ></v-text-field>
          <v-btn
            :disabled="!valid"
            @click="submit"
          >
            submit
          </v-btn>
          <v-btn @click="clear">clear</v-btn>
         </v-form>
        </v-container>
      </v-card>
      <v-layout row wrap>
         <v-flex
        xs12
        md12
        v-for="article in articles"
        :key="article.id"
        >
          <v-card>
          <v-img
          src="https://picsum.photos/510/400?random"
          lazy-src="https://picsum.photos/9/6?random"
          max-height=200
          aspect-ratio="1.2"
          ></v-img>
          
          <v-card-title class="headline">{{article.title}}</v-card-title>
          <v-card-text class="py-0">
              <p>{{article.body}}</p>
          </v-card-text>
          <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="primary" @click="editArticle(article)">Edit</v-btn>
              <v-btn color="error" @click="deleteArticle(article.id)">Delete</v-btn>
          </v-card-actions>
          
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </v-layout>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return {
      articles: [],
      article: {
        id: '',
        title: '',
        body: ''
      },
      // That's how it's gonna know which article to update
      article_id: '',
      edit: false,
      valid: true,
      // Rules for article fields
      titleRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 25) || 'Name must be less than 10 characters'
      ],
      bodyRules: [
        v => !!v || 'E-mail is required',
        v => (v && v.length >= 10) || 'Body must be greater than 10 characters'
      ],
    }
  },
  created() {
    // Call fetchArticles on page load
    this.fetchArticles()
  },
  methods: {
    // Fetch Articles
    fetchArticles() {
      fetch('api/articles')
        .then(res => res.json())
        .then(res => {
          // console.log(res.data)
          this.articles = res.data
        })
        .catch(err => console.log(err))
    },
    deleteArticle (id) {
      if (confirm('Are you sure?')) {
        fetch(`api/article/${id}`, {
          method: 'delete'
        })
        .then(res => res.json())
        .then(data => {
          alert('article removed');
          this.fetchArticles();
        })
        .catch(err => console.log(err))
      }
    },
    editArticle(article) {
      this.edit = true;
      this.article.id = article.id;
      this.article.article_id = article.id;
      this.article.title = article.title;
      this.article.body = article.body;
    },
    submit () {
      // Add Article
      if (this.$refs.form.validate()) {
        // Native form submission is not yet supported

        // Check if is editin or a new post
        if (this.edit === false) {
        	console.log(JSON.stringify(this.article));
          fetch('api/article', {
            method: 'post',
            body: JSON.stringify(this.article),
            headers: {
              'content-type': 'application/json'
            }
          })
          .then(res => res.json())
          .then(data => {
            this.article.title = '';
            this.article.body = '';
            alert('Article added');
            this.fetchArticles();
          })
          .catch(err => console.log(err))
        } else {
          // Update
        	console.log(JSON.stringify(this.article));
          
          fetch('api/article', {
            method: 'put',
            body: JSON.stringify(this.article),
            headers: {
              'content-type': 'application/json'
            }
          })
          .then(res => res.json())
          .then(data => {
            this.article.title = '';
            this.article.body = '';
            alert('Article updated');
            this.fetchArticles();
          })
          .catch(err => console.log(err))
          }
        }
      },
      clear () {
        this.$refs.form.reset()
      }
    }
}
</script>
