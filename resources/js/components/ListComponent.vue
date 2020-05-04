<template>
    <div class="col-sm-12">
        <div class="row my-5">
            <div class="col-sm-6">
                <slot></slot>
            </div>
            <div class="col-sm-6 d-flex justify-content-end">
                <button class="btn btn-success"
                        data-toggle="modal"
                        @click="setModal('create')"
                        data-target="#form-modal">Create
                </button>
            </div>
        </div>
        <div class="row my-5">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col" v-for="field in fields" :key="field.name">{{ field.title }}</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(record,index) in list" :key="record.id">
                    <td v-for="(item,index2) in fields" :key="index2 +Math.random()">
                        <template v-if="item.type === 'image' ">
                            <img :src="record[item.name]" alt="#">
                        </template>
                        <template v-else>
                            {{ record[item.name]}}
                        </template>
                    </td>
                    <td style="width: 15%" class="d-flex">
                        <!--                        <button class="btn btn-primary mx-3"-->
                        <!--                                data-toggle="modal"-->
                        <!--                                data-target="#form-modal"-->
                        <!--                                @click="getItem(index)"-->
                        <!--                        >Edit-->
                        <!--                        </button>-->
                        <button class="btn btn-danger" @click.prevent="destroy({id:record.id})">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
            <Pagination
                :total-page="paginate.totalPage"
                :path="paginate.path"
                :currentPage="paginate.currentPage"
                @updateCurrentPage="getList($event)"/>
        </div>
        <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ modalTitle }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <slot name="form" :item="item"></slot>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button"
                                class="btn btn-primary"
                                @click="saveItem()"
                        >{{ titleButton }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Pagination from "./Pagination";

    export default {
        name: "ListComponent",
        components: {Pagination},
        props: {
            fields: {
                require: true,
                type: Array,
                default: null
            },
            listApi: {
                require: true,
                type: Function
            },
            deleteApi: {
                require: true,
                type: Function
            },
            modalTitle: {
                require: true,
                type: String
            }
        },
        computed: {
            idField() {
                for (let field of this.fields) {
                    if (field.id) {
                        return field.name
                    }
                }
            }
        },
        created() {
            this.getList()
        },
        data() {
            return {
                list: [],
                item: {},
                keyList: 0,
                modalShow: false,
                titleButton:'',
                paginate: {
                    totalPage: 0,
                    path: '',
                    currentPage: 0,
                    totalRecord: 0,
                    perPage: 0
                }
            }
        },
        watch: {
            ['paginate.totalRecord']() {
                if (this.paginate.currentPage === this.paginate.totalPage && (this.paginate.totalRecord%this.paginate.perPage ===0)) {
                    this.paginate.currentPage -=1
                }
            }
        },
        methods: {
            getList(currentPage = 1) {
                this.listApi(currentPage)
                    .then(response => {
                        this.list = response.data
                        this.paginate.totalPage = response.last_page
                        this.paginate.path = response.path
                        this.paginate.currentPage = response.current_page
                        this.paginate.totalRecord = response.total
                        this.paginate.perPage = response.per_page
                    })
            },
            destroy(id) {
                this.deleteApi(id)
                    .then((response) => {
                        this.paginate.totalRecord -= 1
                    })
                    .then(() => {
                        this.getList(this.paginate.currentPage)
                    })
            },
            getItem(index) {
                this.item = {...this.list[index], index}
            },
            saveItem() {
                if(this.button === 'create'){

                }else{
                    this.updateRecord()
                }
            },
            updateRecord() {
                // this.updateApi(this.item[this.idField], this.item)
                //     .then(response => {
                //         let item = response.data
                //         this.$set(this.list, this.item.index, item)
                //         this.item = {}
                //     })
                //     .catch(err => {
                //         if (err.response.status === 422) {
                //             this.message = err.response.data
                //         }
                //     })
            },
            createRecord() {

            },
            setModal(title){
                this.titleButton = title
            }
        }
    }
</script>
