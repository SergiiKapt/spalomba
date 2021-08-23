<template>
    <div v-if="single">
        <h2>hello {{ single.first_name }}</h2>

            <div>Name: {{ single.first_name }}  {{ single.last_name }} </div>
            <div>Email: {{ single.email }}  </div>
            <div>Info: {{ single.info }} </div>
            <div>Info: {{ single.password }} </div>
    </div>
    <div v-else>
        no data
    </div>
</template>

<script>
    export default {
        props: {
          single: Object,
        },
        created() {
            console.log(this.single)
        }
    }
</script>