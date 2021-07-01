<template>
  <div>
	<Header/>
	<router-view/>
	<Footer/>
  </div>
</template>

<script>
    import Header from ".././components/header.vue"
    import Footer from ".././components/footer.vue"

    export default {
        name: 'app',
        components: {Header, Footer}
    }
</script>
