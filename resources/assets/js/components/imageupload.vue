<template>
           <div class ="card" >
               <div class="card-header">Image upload</div>
               <div class="card-body">
                   <input type="file" name="image" @change="getImage" class="form-control" accept="image/*">
                   <img :src="avatar">
               </div>
               <img src="/images/avatar.jpg" alt="">
                <button class="btn btn-primary" @click="upload">Upload</button>

           </div>
</template>

<script>
    export default {
        name: "imageupload",
            data(){return{
                avatar:null,
                file:null
            }
        },
        methods:{
            upload(){
                axios.post('/store',this.file).
                    then(response=>{
                        console.log(response.data)
                })
            },
            getImage(e)
            {
                let image = e.target.files[0]
                this.read(image)
                let form = new FormData();
                form.append('image',image)
                form.append('name','Joel')

                this.file = form
                console.log(form.name)
            }
            ,read(image){
                let reader = new FileReader()
                reader.readAsDataURL(image)
                reader.onload = e => {this.avatar = e.target.result}
            }
        }
    }
</script>

<style scoped>

</style>