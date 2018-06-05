<template>
        <div class="card">
            <div class="card-header">Test</div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="vin">VIN Number</label>
                            <input type="text" class="form-control" :class="{'is-invalid':errors.vin_number}" name="vin_number" v-model="list.vin_number">
                            <small class="text-danger"  v-if="errors.vin_number"  >{{errors.vin_number[0]}}</small>
                        </div>
                        <div class="form-group">
                            <label for="engine">Engine Number</label>
                            <input type="text" class="form-control" :class="{'is-invalid':errors.engine_number}"  name="engine_number" v-model="list.engine_number">
                            <small class="text-danger"  v-if="errors.engine_number"  >{{errors.engine_number[0]}}</small>
                        </div>
                        <div class="form-group">
                            <label for="plate">Car Model</label>
                            <input type="text" class="form-control" :class="{'is-invalid':errors.model}" name="number_plate" v-model="list.model">
                            <small class="text-danger"  v-if="errors.number_plate"  >{{errors.model[0]}}</small>
                        </div>
                        <div class="form-group">
                            <label for="plate">Number Plate</label>
                            <input type="text" class="form-control" :class="{'is-invalid':errors.number_plate}" name="number_plate" v-model="list.number_plate">
                            <small class="text-danger"  v-if="errors.number_plate"  >{{errors.number_plate[0]}}</small>
                        </div>
                        <div class="form-group">
                            <label for="plate">License Disc Number Plate</label>
                            <input type="text" class="form-control" :class="{'is-invalid':errors.license_disc_number_plate}" name="license_disc_number_plate" v-model="list.license_disc_number_plate">
                            <small class="text-danger"  v-if="errors.license_disc_number_plate"  >{{errors.license_disc_number_plate[0]}}</small>
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" @change="getImage" class="form-control" accept="image/*">
                            <img :src="avatar">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" @click="save">Save</button>
                        </div>
                    </div>

                    </div>

                 </div>
            </div>


</template>

<script>
    export default {
        name: "test",
        data(){return{
            lists:{},
            list:{
                vin_number:'',
                engine_number:'',
                number_plate:'',
                license_disc_number_plate:'',
                model:'',

            },
            errors:{},
            avatar:null,
            file:null,
            image:null
        }},
        methods:{
            save(){
                let form = new FormData();
                form.append('image',this.image)
                form.append('vin_number',this.list.vin_number)
                form.append('engine_number',this.list.engine_number)
                form.append('number_plate',this.list.engine_number)
                form.append('license_disc_number_plate',this.list.license_disc_number_plate)
                form.append('model',this.list.model)
                this.file = form

                this.isLoading = true
                axios.post('/saveImage',this.file)
                    .then((response)=>{
                        //this.lists.push(response.data)
                        console.log(response.data)
                    })
                    .catch((error)=>{
                        this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
                        console.log(this.errors)
                    })

            },
            getImage(e)
            {
                this.image = e.target.files[0]
                this.read(this.image)


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