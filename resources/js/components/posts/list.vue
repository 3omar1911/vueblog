<template>
	<div>
		<div class="row post" v-for="post in posts">
			<div class="col-md-8">
		        <div class="card">
		            <div class="card-header">{{ post.title }}</div>

		            <div class="card-body">
		                {{ post.description }}
		                <div>
		                	<router-link class="btn btn-success" :to="'/posts/' + post.id + '/edit'">Edit</router-link>
		                	<a class="btn btn-danger" href="" @click.prevent="deletePost(post.id)">Delete</a>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				posts: [],
			}
		},

		mounted() {
			this.loadPosts();
		},
		methods: {
			loadPosts()
			{
				axios.get('/api/posts')
				.then( response => {
					this.posts = response.data;
				})
				.catch(err => {
				});
			},

			deletePost(postId)
			{
				axios.delete('/api/posts/' + postId)
				.then(response => {
					this.loadPosts();
				})
				.catch(err => {
					console.log(err);
				});
			}
		}
	}
</script>

<style>
	.post {
		margin: 20px 50px;
	}
</style>