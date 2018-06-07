<template>
    <div class="card">
        <div class="card-header">Access report</div>
        <div class="card-body">
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
            <table class="table table-hover">
                <thead>
                    <th>Vin Number</th>
                    <th>Number Plate</th>
                    <th>Car Model</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="item in temp">
                        <td>{{item.vin_number}}</td>
                        <td v-if="isImage(item.image)"><img :src="urlImage" ></td>
                        <td>{{item.model}}</td>

                        <td>
                            <p class="text-justify">{{item.status}}</p>
                        </td>
                        <td>
                            <button class="btn btn-xs btn-info" data-toggle="modal" data-target="#exampleModal5" @click="showMe(item)" >More Info</button>

                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
        <!-- Show me -->
        <div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <li class="list-group-item">Status: {{info.status}}</li>
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
    export default {
        name: "reports",
        data(){
            return{
                lists:{},
                url:'api/reports',
                isLoading:false,
                pagination:[],
                searchQuery:'',
                temp:[],
                urlImage:null,
                plate:null,
                info:{},

            }
        },
        methods:{
            getData(){
                this.isLoading = true
                let vm = this;
               // page_url =  this.url
                axios.get(this.url)
                    .then(response=>{
                        this.lists = this.temp = response.data
                        //vm.makePagination(response.data.meta, response.data.links);
                        //console.log(response.data)
                        this.isLoading = false
                    });
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
            showMe(item)
            {
                this.info = item

            }
        },
        created()
        {
            this.getData()
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