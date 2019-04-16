<template>
	<div>
		<blog-header></blog-header>
		<main class="py-4">
			<router-view></router-view>
		</main>
	</div>
</template>

<script>
	
	import Header from '../Header.vue';

	export default {
		components: {
			'blog-header': Header
		},
	}

</script>