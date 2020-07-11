<template>
	<div>
		<navbar/>
		<router-view/>
	</div>
</template>

<style>
	
</style>

<script>
import navbar from './components/navbar.vue'

	export default {
		name: "app",
		components: {
			navbar
		}
		};
</script>