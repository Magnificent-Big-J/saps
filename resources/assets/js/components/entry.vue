<template>
    <div class="card">
        <div class="card-header">Entry

        </div>
        <div class="card-body">
            <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="errMess">
                <strong>{{message}}  </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                    <span aria-hidden="true" @click="closeMe">&times;</span>
                </button>
            </div>
            <span class="btn btn-info btn-xs pull-right mb-1" @click="clearList" data-toggle="modal" data-target="#exampleModal2"> New Entry Car</span>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li v-bind:class="[{disabled:!pagination.prev_page_url}]" class="page-item">
                        <a @click="getData(pagination.prev_page_url)"  class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item disabled">
                        <a class="page-link text-dark" href="#"> Page {{pagination.current_page}} of {{pagination.last_page}}</a>
                    </li>
                    <li v-bind:class="[{disabled:!pagination.next_page_url}]" class="page-item">
                        <a @click="getData(pagination.next_page_url)" class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        <table class="table table-hover">
            <thead>
                <th>VIN</th>
                <th>Engine Number</th>
                <th>Number Plate</th>
                <th>License Disc Number Plate</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr v-for="item in lists" >
                    <td>{{item.vin_number}}</td>
                    <td>{{item.engine_number}}</td>
                    <td v-if="isImage(item.image)"><img :src="urlImage" ></td>
                    <td v-else>{{item.number_plate}} </td>
                    <td>{{item.license_disc_number_plate}}</td>
                    <td>
                        <button class="btn btn-xs btn-dark" @click="entrance(item.id)">Validate</button>
                        <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#exampleModal2" @click="open(item)" >Edit</button>
                        <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModal3" @click="forImage(item)" >Plate Image</button>
                    </td>
                </tr>
            </tbody>
        </table>

        </div>
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="edit" id="exampleModalLabel">Edit Car Information </h5>
                        <h5 class="modal-title" v-else id="exampleModalLabel">Capture Car Information </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cancel">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="notifyMe">
                            <strong>{{message}}  </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                                <span aria-hidden="true" @click="cancel">&times;</span>
                            </button>
                        </div>
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
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cancel">Close</button>
                        <button type="button" v-if="edit" class="btn btn-primary" @click="Update">Update </button>
                        <button type="button" v-else class="btn btn-primary" @click="Save">Save </button>
                    </div>


                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Upload List plate of {{plate}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="image" @change="getImage" class="form-control" accept="image/*">

                        </div>
                        <div class="form-group">
                            <img :src="avatar" width="40px" height="40px" v-if="isLoaded">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="upload">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "entry",
        data(){
            return{
                lists:{},
                list:{
                    vin_number:'',
                    engine_number:'',
                    number_plate:'',
                    license_disc_number_plate:'',
                    model:'',

                },
                errors:{},
                isLoading:false,
                notifyMe:false,
                editId:'',
                edit:false,
                url:'api/entry',
                pagination:[],
                message:'',
                errMess:false,
                avatar:null,
                file:null,
                isLoaded:false,
                plate:null,
                upID:null,
                urlImage:'images/entry/'
            }
        },
        methods:{
            Save(){

                this.isLoading = true
                axios.post(this.url,this.list)
                    .then((response)=>{
                        this.lists.push(response.data)
                        this.notifyMe =true
                        this.isLoading =false
                        this.message = 'Successfully added'
                    })
                    .catch((error)=>{
                        this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
                        console.log(this.errors)
                    })
            },
            makePagination(meta,links)
            {
                let pagination = {
                    current_page : meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                }
                this.pagination = pagination;
            },

            getData(page_url){

                this.isLoading = true
                let vm = this;
                page_url = page_url || this.url
                axios.get(page_url)
                    .then(response=>{
                        this.lists = this.temp = response.data.data
                        vm.makePagination(response.data.meta, response.data.links);
                        this.isLoading = false
                    });
            },
            cancel()
            {
                this.notifyMe = false
                this.edit = false
                this.editId = ''
                this.message = ''
            },
            open(mylist)
            {
                this.editId = mylist.id
                this.edit = true
                this.list = mylist

            },
            Update()
            {
                let id = this.list.id
                this.isLoading = true
                this.notifyMe = true
                axios.put(this.url + '/'+ id,this.list)
                    .then((response)=>{
                        console.log(response.data)
                        this.isLoading = false
                        this.message = 'Successfully updated'
                    })
                    .catch((error)=>{
                        this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))

                    })
            },
            clearList()
            {

                if(!this.edit)
                {
                    this.list = {}
                }
            },
            entrance(id)
            {
                this.isLoading = true
                axios.get('api/validCheck/'+ id)
                    .then((response)=>{
                        console.log(response.data)
                        this.isLoading = false
                        this.message = response.data
                        this.errMess = true
                    })
                    .catch((error)=>{
                        this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))

                    })
            },
            closeMe()
            {
                this.message = ''
                this.errMess = false
            },
            upload(){
                axios.post('/saveImage/'+this.upID,this.file).
                then(response=>{
                    console.log(response.data)
                    this.$toasted.show(response.data)
                })
            },
            getImage(e)
            {
                let image = e.target.files[0]
                this.read(image)
                let form = new FormData();
                form.append('image',image)

                this.file = form
                console.log(form.name)
            }
            ,read(image){
                let reader = new FileReader()
                reader.readAsDataURL(image)
                reader.onload = e => {this.avatar = e.target.result}
                this.isLoaded = true
            },
            forImage(item)
            {
               this.plate = item.number_plate
               this.upID = item.id
            },

            isImage(img)
            {
                if(img)
                {
                    this.urlImage = "images/entry/" + img
                    return true
                }
                else {
                    return false
                }
            }

        },
        mounted(){
            this.getData()
        }
    }
</script>

<style scoped>

</style>