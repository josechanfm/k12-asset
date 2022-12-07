<template>
    <a-form
      :model="formState"
      v-bind="layout"
      name="nest-messages"
      :validate-messages="validateMessages"
      @finish="onFinish"
    >
      <a-form-item :name="['title_zh']" label="Title Zh" :rules="[{ required: true }]">
        <a-input v-model:value="formState.title_zh"/>
      </a-form-item>
      <a-form-item :name="['title_en']" label="Title En">
        <a-input v-model:value="formState.title_en" />
      </a-form-item>
      <a-form-item :name="['location_id']" label="Location">
        <a-input-number v-model:value="formState.location_id" />
      </a-form-item>
      <a-form-item :name="['category_id']" label="Category">
        <a-input v-model:value="formState.category_id" />
      </a-form-item>
      <a-form-item :name="['tags_id']" label="Tags">
        <a-input v-model:value="formState.tags_id" />
      </a-form-item>
      <a-form-item :name="['description']" label="Description">
        <a-textarea v-model:value="formState.description" />
      </a-form-item>
      <a-form-item :name="['images']" label="Images">
        <a-upload
            v-model:file-list="formState.images"
            name="file"
            action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
            :headers="headers"
            @change="handleChange"
        >
            <a-button>
            <upload-outlined></upload-outlined>
            Click to Upload
            </a-button>
        </a-upload>
      </a-form-item>
      <a-form-item :name="['images']" label="Images">
        <a-upload
            v-model:file-list="formState.images"
            action="https://www.mocky.io/v2/5cc8019d300000980a055e76"
            list-type="picture-card"
            @preview="handlePreview"
        >
            <div v-if="formState.images.length < 8">
                <plus-outlined />
                <div style="margin-top: 8px">Upload</div>
            </div>
        </a-upload>
        <a-modal :visible="previewVisible" :title="previewTitle" :footer="null" @cancel="handleCancel">
            <img alt="example" style="width: 100%" :src="previewImage" />
        </a-modal>
      </a-form-item>
      <a-form-item :wrapper-col="{ ...layout.wrapperCol, offset: 8 }">
        <a-button type="primary" html-type="submit">Submit</a-button>
      </a-form-item>
    </a-form>
  </template>
  <script>
  import { defineComponent, reactive, ref } from 'vue';
  import { message } from 'ant-design-vue';
  import { UploadOutlined } from '@ant-design/icons-vue';


  export default{
    components:{
        UploadOutlined
    },
    data(){
        return{
            previewVisible : ref(false),
            previewImage : ref(''),
            previewTitle : ref(''),
            layout : {
                labelCol: {
                span: 8,
                },
                wrapperCol: {
                span: 16,
                },
            },
            validateMessages : {
                required: '${label} is required!',
                types: {
                email: '${label} is not a valid email!',
                number: '${label} is not a valid number!',
                },
                number: {
                range: '${label} must be between ${min} and ${max}',
                },
            },
            formState : reactive({
                title_zh: "",
                title_en: '',
                location_id: '',
                category_id: '',
                tags_id: '',
                description: '',
                images:[]
                
            }),
            headers: {
                authorization: 'authorization-text',
            },
            rules:{
                title_zh:{
                    required:true,
                },
            },
            handleChange(info){
                // if (info.file.status !== 'uploading') {
                //     console.log(info.file, info.fileList);
                // }
                // if (info.file.status === 'done') {
                //     message.success(`${info.file.name} file uploaded successfully`);
                // } else if (info.file.status === 'error') {
                //     message.error(`${info.file.name} file upload failed.`);
                // }
            }

        }
    },
    methods:{
        handlePreview: async(file)=>{
            if (!file.url && !file.preview) {
                file.preview = await getBase64(file.originFileObj);
            }
            this.previewImage.value = file.url || file.preview;
            this.previewVisible.value = true;
            this.previewTitle.value = file.name || file.url.substring(file.url.lastIndexOf('/') + 1);
        },
        onFinish(value){
            console.log("onFinish"+value);
        },


    }

  }


  </script>