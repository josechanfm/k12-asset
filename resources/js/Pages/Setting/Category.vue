<template>
    <a-button type="primary" @click="createRecord()">Add</a-button>
    <a-table :dataSource="dataSource.data" :columns="columns">
        <template #bodyCell="{column, text, record, index}">
            <template v-if="column.dataIndex!='operation'">
                {{record[column.dataIndex]}}
            </template>
            <template v-else>
                <a-button @click="editRecord(index)">Edit</a-button>
                <a-button @click="deleteRecord(record.id)">Delete</a-button>
            </template>
        </template>
    </a-table>


    <a-modal v-model:visible="modalVisible" :title="modalTitle" width="60%" @update="updateRecord(modalForm)" @onCancel="closeModal()">
        <a-form
            ref="modalRef"
            :model="modalForm"
            name="category"
            :label-col="{ span: 8 }"
            :wrapper-col="{ span: 16 }"
            autocomplete="off"
            :rules="rules"
            :validate-messages="validateMessages"
            @validate="handleValidate"
            @finish="onFinish"
            @onFinishFailed="onFinishFailed"
        >
            <a-input type="hidden" v-model:value="modalForm.id"/>
            <a-form-item
                label="Parent"
                name="parent_id"
            >
                <a-input v-model:value="modalForm.parent_id" />
            </a-form-item>
            <a-form-item 
                label="Abbr"
                name="abbr"
            >
                <a-input v-model:value="modalForm.abbr" />
            </a-form-item>

            <a-form-item
                label="Title"
                name="title"
            >
                <a-input v-model:value="modalForm.title" />
            </a-form-item>

            <a-form-item
                label="Description"
                name="description"
            >
                <a-textarea
                    v-model:value="modalForm.description"
                    placeholder="Please input address location of the company"
                    :auto-size="{ minRows: 2, maxRows: 5 }"
                />
            </a-form-item>
            <a-form-item
                label="Status"
                name="status"
            >
                <a-switch v-model:checked="modalForm.status" checked-children="开" un-checked-children="关" />
                {{modalForm.status}}
                
            </a-form-item>
            

        </a-form>
        <template #footer>
            <a-button v-if="modalMode=='Edit'" key="Update" type="primary" :loading="loading" @click="updateRecord(modalForm)">Update</a-button>
            <a-button v-if="modalMode=='Create'"  key="Store" type="primary" :loading="loading" @click="storeRecord(modalForm)">Add</a-button>
        </template>
    </a-modal>    
</template>

<script>
import { Form } from 'ant-design-vue';
//import { useForm } from "@inertiajs/inertia-vue3";
import { ref,reactive} from 'vue';

export default{
   
    data(){
        return{
            dataSource:[],
            currentId:0,
            modalRef:ref(),
            modalForm: reactive(),
            modalVisible:false,
            modalTitle:'',
            modalMode:'',
            columns:[
                {
                    title: 'Parent',
                    dataIndex: 'parent_id',
                    key: 'parent_id',
                },
                {
                    title: 'Abbr',
                    dataIndex: 'abbr',
                    key: 'abbr',
                },
                {
                    title: 'Title',
                    dataIndex: 'title',
                    key: 'title',
                },
                {
                    title: 'Status',
                    dataIndex: 'status',
                    key: 'status',
                },
                {
                    title: 'Operation',
                    dataIndex: 'operation',
                    key: 'operation',
                },
            ],
            loading:false,
            rules:{
                name_zh:{
                    required:true,
                },
                phone:[{
                    required:true,
                }],
                address:[{
                    required:true,
                }],
                registed_date:[{
                    required:true,
                }],
            },
            validateMessages:{
                required: '${label} is required!',
                types: {
                    email: '${label} is not a valid email!',
                    number: '${label} is not a valid number!',
                },
                number: {
                    range: '${label} must be between ${min} and ${max}',
                },
            }
        }
    },
    mounted(){
        this.fetchData();
    },
    methods:{
        reset(){
            this.formSate = {
                name_zh: null,
                name_en: null,
                email:null,
                phone:null,
                address:null,
                categories:null,
                register_date:null,
                disproved_date:null,
                remark:null,
                active:0,
            }
        },
        ChangeModalMode(mode){
            if(mode=='Create'){
                this.modalMode=mode;
                this.modalTitle='Create Record';
                this.modalVisible=true;
            }else if(mode=='Edit'){
                this.modalMode=mode;
                this.modalTitle='Edit Record';
                this.modalVisible=true;
            }else{
                this.modalMode='Close';
                this.modalTitle='Modal Mode undefined';
                this.modalVisible=false;
            }
            this.$refs.modalRef!==undefined?this.$refs.modalRef.resetFields():'';
        },
        closeModal(){
            console.log("cancel to close modal");
            this.ChangeModalMode('Close');
        },
        editRecord(index){
            this.modalForm={...this.dataSource.data[index]};
            this.currentId=index;
            this.ChangeModalMode('Edit');
        },
        deleteRecord(recordId){
            console.log(recordId);
            if (!confirm('Are you sure want to remove?')) return;
            this.$inertia.delete('/settings/category/' + recordId,{
                onSuccess: (page)=>{
                    this.fetchData();
                    console.log(page);
                },
                onError: (error)=>{
                    console.log(error);
                }
            });
            this.ChangeModalMode('Close');
        },
        createRecord(){
            this.modalForm={};
            this.ChangeModalMode('Create');
        },
        storeRecord(data){
            this.$refs.modalRef.validateFields().then(()=>{
                this.loading=true;
                this.$inertia.post('/settings/category/', data,{
                    onSuccess:(page)=>{
                        this.fetchData();
                        this.ChangeModalMode('Close');
                    },
                    onError:(err)=>{
                        console.log(err);
                    }
                });
                this.loading=false;
            }).catch(err => {
                console.log(err);
            });
        },
        updateRecord(data){
            console.log(this.currentId);
            console.log(data);
            this.$refs.modalRef.validateFields().then(()=>{
                this.loading=true;
                data._method = 'PATCH';
                this.$inertia.post('/settings/category/' + data.id, data,{
                    onSuccess:(page)=>{
                        this.modalVisible=false;
                        this.ChangeModalMode('Close');
                        this.fetchData();
                    },
                    onError:(error)=>{
                        console.log(error);
                    }
                });
                this.loading=false;                
            }).catch(err => {
                console.log("error", err);
            });
           
        },
        handleOk(e) {
            this.modalMode="close";
        },
        fetchData(){
            this.loading=true;
            axios.get("/settings/category")
                .then(response=>{
                    this.dataSource=response.data;
                    console.log("aaaaaaaaaaaaaa");
                    console.log(response.data);
                }
            );
            this.loading=false;
        },
        //validate on field keychange
        handleValidate(field){
            console.log("handleValidate: "+field);
        },
        onFinish(value){
            console.log("onFinish"+value);
        },
        onFinishFailed(errorInfo){
            console.log('errorInfo: '+errorInfo);
        }
    },

}
</script>