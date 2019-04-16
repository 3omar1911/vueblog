<template>
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post data</div>

                <div class="card-body">
                    <form @submit.prevent="submitPost">
                        <div class="form-group row">
                            <label for="post_title" class="col-md-4 col-form-label text-md-right">Post Title</label>

                            <div class="col-md-6">
                                <input id="post_title" type="text" class="form-control" name="post_title" v-validate="'required'" data-vv-as="post title" v-model="title">

                                <span style="color: red;">{{ errors.first('post_title') }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_desc" class="col-md-4 col-form-label text-md-right">Post Description</label>

                            <div class="col-md-6">
                                <textarea id="post_desc" class="form-control" name="post_desc" v-validate="'required'" data-vv-as="post description" v-model="desc">
                                </textarea>

                                <span style="color: red;">{{ errors.first('post_desc') }}</span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
	export default {

		data() 
		{
        	return {
            	title: null,      
            	desc: null,
            	action: 'create'
        	}
    	},

    	mounted()
    	{
    		if(typeof this.$route.params.id == 'undefined') {
    			return;
    		}

    		this.action = 'edit';
    		this.getCurrentPostData(this.$route.params.id);
    	},

		methods: {

			getCurrentPostData(postId)
			{
				axios.get('/api/posts/data/'+ postId)
				.then(response => {
					console.log(response);
					this.title = response.data.title;
					this.desc = response.data.description;
				});
			},

			submitPost() 
			{
				this.$validator.validate().then(valid => {
					if(!valid) {
						return;
					}
					
			        if (valid && this.action == 'create' ) {
						this.storePost();
			        } else {
			        	this.updatePost();
			        }
		      	});
			},
			storePost()
			{
				axios.post('/api/posts', {
					title: this.title,
					desc: this.desc,
				}).then(response => {
					this.$router.push({name: 'posts.index'});
				}).catch(err => {
					console.log(err.response);
				})
			},
			updatePost()
			{
				axios.put('/api/posts/' + this.$route.params.id, {
					title: this.title,
					desc: this.desc,
				})
				.then(response => {
					this.$router.push({name: 'posts.index'});
				})
				.catch(err => {
					console.log(err.response);
				});
			}
		},
	}
</script>