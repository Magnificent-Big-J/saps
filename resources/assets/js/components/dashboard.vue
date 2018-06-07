<template>
    <div class="card">
        <div class="card-header">Circulation</div>

        <div class="card-body">

            <button class="btn btn-info ml-auto" data-toggle="modal" @click="clearList" data-target="#exampleModal">Add Car Info</button>
            <span class="text-center " style="float: right;" v-if="isLoading"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></span>
            <div class="mt-1 mb-2">
                <div class="col-auto">

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" v-model="searchQuery" placeholder="Search">
                    </div>
                </div>
            </div>
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
                    <th>VIN Number</th>
                    <th>Number Plate</th>
                    <th>Engine Number</th>
                    <th>Colour</th>

                    <th>Action</th>
                </thead>
                <tbody>
                    <tr v-if="temp.length > 0" v-for="item in temp" >
                        <td>{{item.vin_number}}</td>
                        <td v-if="isImage(item.image)"><img :src="urlImage" ></td>
                        <td v-else>{{item.number_plate}} </td>
                        <td>{{item.engine_number}}</td>
                        <td>{{item.colour}}</td>

                        <td>
                            <a class="btn btn-xs btn-warning mt-1" data-toggle="modal" data-target="#exampleModal" @click="open(item)" href="#"><span class="fa fa-edit"></span> Edit</a>
                            <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#exampleModal4" @click="forImage(item)" >Number Plate Image</button>
                            <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#exampleModal6" @click="showMe(item)" >Info</button>
                        </td>
                    </tr>
                    <tr v-else>
                        <td colspan="8">No record(s) found</td>
                    </tr>

                </tbody>
            </table>


<!-- Colour	Model	Owner -->
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <strong> {{message}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                                <span aria-hidden="true" @click="cancel">&times;</span>
                            </button>
                        </div>
                           <div class="row">
                               <div class="col">
                                   <div class="form-group">is-invali
                                       <label for="vin">VIN Number</label>
                                       <input type="text" class="form-control" :class="{'d':errors.vin_number}" name="vin_number" v-model="list.vin_number">
                                       <small class="text-danger"  v-if="errors.vin_number"  >{{errors.vin_number[0]}}</small>
                                   </div>
                                   <div class="form-group">
                                       <label for="engine">Engine Number</label>
                                       <input type="text" class="form-control" :class="{'is-invalid':errors.engine_number}"  name="engine_number" v-model="list.engine_number">
                                       <small class="text-danger"  v-if="errors.engine_number"  >{{errors.engine_number[0]}}</small>
                                   </div>
                                   <label for="model">Model</label>
                                   <div class="form-group">
                                       <input type="text" class="form-control" :class="{'is-invalid':errors.model}" placeholder="ICE Blue" name="model" v-model="list.model">
                                       <small class="text-danger"  v-if="errors.model"  >{{errors.model[0]}}</small>
                                   </div>
                                   <div class="form-group">
                                       <label for="reportedDate">Reported Date</label>
                                       <input type="date" class="form-control" :class="{'is-invalid':errors.reportedDate}" placeholder="2018-05-28" name="reportedDate" v-model="list.reportedDate">
                                       <small class="text-danger"  v-if="errors.reportedDate"  >{{errors.reportedDate[0]}}</small>
                                   </div>
                               </div>
                               <div class="col">
                                   <div class="form-group">
                                       <label for="plate">Number Plate</label>
                                       <input type="text" class="form-control" :class="{'is-invalid':errors.number_plate_plate}" name="number_plate" v-model="list.number_plate">
                                       <small class="text-danger"  v-if="errors.number_plate_plate"  >{{errors.number_plate_plate[0]}}</small>
                                   </div>
                                   <div class="form-group">
                                       <label for="color">Colour</label>
                                       <input type="text" class="form-control" :class="{'is-invalid':errors.colour}" placeholder="ICE Blue" name="colour" v-model="list.colour">
                                       <small class="text-danger"  v-if="errors.colour"  >{{errors.colour[0]}}</small>
                                   </div>
                                   <div class="form-group">
                                       <label for="owner">Owner Name</label>
                                       <input type="text" class="form-control" :class="{'is-invalid':errors.owner_name}" placeholder="John Doe" name="owner_name" v-model="list.owner_name">
                                       <small class="text-danger"  v-if="errors.owner_name"  >{{errors.owner_name[0]}}</small>
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
        <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

        <!-- Show me -->
        <div class="modal fade" id="exampleModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Owner Name {{info.owner_name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card" >
                            <img class="card-img-top" v-if="isImage(info.image)" :src="urlImage">
                            <p v-else>{{info.number_plate}}</p>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">VIN Number: {{info.vin_number}}</li>
                                    <li class="list-group-item">Engine Number: {{info.vin_number}}</li>
                                    <li class="list-group-item">Color: {{info.colour}}</li>
                                    <li class="list-group-item">Car Model: {{info.model}}</li>
                                    <li class="list-group-item">Reported Date: {{info.reportedDate}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
    </div>




</template>

<script>
    import axios from 'axios'
    export default {
        name: "dashboard",
        data(){
            return{

                list:{ vin_number:'',
                    number_plate:'',
                    engine_number:'',
                    reportedDate:'',
                    colour:'',
                    model:'',
                    owner_name:''},
                    errors:{},
                    lists:[],
                    temp:[],
                    info:{},
                    url:'api/circulation',
                    pagination:[],
                    isLoading:false,
                    notifyMe:false,
                    searchQuery:'',
                    editId:'',
                    edit:false,
                    urlImage:null,
                    plate:null,
                    isLoaded:false,
                    avatar:null
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
                this.list = {}

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
                axios.put(this.url + '/'+ id,this.list)
                    .then((response)=>{
                        console.log(response.data)
                        this.notifyMe =true
                        this.isLoading = false
                        this.message = 'Successfully updated'
                    })
                    .catch((error)=>{
                        this.errors = JSON.parse(JSON.stringify( error.response.data.errors ))
                        console.log(this.errors)
                    })
            },
            clearList()
            {

                if(!this.edit)
                {
                    this.list = {}
                }
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
                    this.urlImage = "images/circulations/" + img
                    return true
                }
                else {
                    return false
                }
            },
            upload(){
                axios.post('/saveImages/'+this.upID,this.file).
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
            showMe(item)
            {
                this.info = item

            }
        },

        mounted(){

            this.getData();

        },
        watch:{
            searchQuery(){
                if(this.searchQuery.length > 0)
                {

                   this.temp = this.lists.filter((item)=>{
                      return   Object.keys(item).some((key)=>{
                            let string = String(item[key])
                            return string.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
                        })

                        //
                    })
                }
                else
                {
                    this.temp = this.lists
                }

            }
        }
    }

</script>

<style scoped>

</style>