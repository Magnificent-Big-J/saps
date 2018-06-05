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
                    <th>Engine Number</th>
                    <th>Car Model</th>
                    <th>Date</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    <tr v-for="item in temp">
                        <td>{{item.vin_number}}</td>
                        <td>{{item.number_plate}}</td>
                        <td>{{item.engine_number}}</td>
                        <td>{{item.model}}</td>
                        <td>{{item.created_at}}</td>
                        <td>
                            <p class="text-justify">{{item.status}}</p>
                        </td>
                    </tr>
                </tbody>

            </table>
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
                temp:[]
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