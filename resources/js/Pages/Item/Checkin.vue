<template>
  <div class="p-3 md:p-5 lg:p-10">
    <a-form
      :model="formState"
      name="nest-messages"
      v-bind="layout"
      :validate-messages="validateMessages"
      @finish="onFinish"
    >
      <a-form-item :name="['serial']" label="Serial" :rules="[{ required: true }]">
        <a-input v-model:value="formState.serial"/>
      </a-form-item>
      <a-form-item :name="['title_zh']" label="Title Zh" :rules="[{ required: true }]">
        <a-input v-model:value="formState.title_zh"/>
      </a-form-item>
      <div class="flow-root pb-5">
        <a-switch v-model:checked="checked1" checked-children="开" un-checked-children="关" class="float-right"/>
      </div>
      <div :class="checked1?'hidden':''">
        <a-form-item :name="['title_en']" label="Title En">
          <a-input v-model:value="formState.title_en" />
        </a-form-item>
        <a-form-item :name="['location_id']" label="Location">
          <a-input v-model:value="formState.location_id" />
        </a-form-item>
        <a-form-item :name="['category_id']" label="Category">
          <a-input v-model:value="formState.category_id" />
        </a-form-item>
        <a-form-item :name="['tag_ids']" label="Tags">
          <a-input v-model:value="formState.tag_ids" />
        </a-form-item>
        <a-form-item :name="['description']" label="Description">
          <a-textarea v-model:value="formState.description" />
        </a-form-item>
      </div>
      <a-form-item :name="['photos']" label="photos">
        <a-upload
            v-model:fileList="formState.photos"
            list-type="picture-card"
            @preview="handlePreview"
            :beforeUpload="() => false"
        >
            <div v-if="formState.photos.length < 8" @click.stop="test">
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
  </div>
</template>
  <script>
  import { defineComponent, reactive, ref } from 'vue';
  import { message } from 'ant-design-vue';
  import { UploadOutlined } from '@ant-design/icons-vue';
  import { PlusOutlined } from '@ant-design/icons-vue';
import { affixProps } from 'ant-design-vue/lib/affix';


  export default{
    components:{
        UploadOutlined,
        PlusOutlined
    },
    props:['abcd'],
    data(){
        return{
            checked1:true,
            previewVisible : ref(false),
            previewImage : ref(''),
            previewTitle : ref(''),
            layout : {
                labelCol: {
                span: 4,
                },
                wrapperCol: {
                span: 20,
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
                serial: "",
                title_zh: "",
                title_en: '',
                location_id: '',
                category_id: '',
                tag_ids: '',
                description: '',
                photos:[]
                
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
      test () { window.alert('test')},
        handlePreview: async(file)=>{
            if (!file.url && !file.preview) {
                file.preview = await getBase64(file.originFileObj);
            }
            this.previewImage.value = file.url || file.preview;
            this.previewVisible.value = true;
            this.previewTitle.value = file.name || file.url.substring(file.url.lastIndexOf('/') + 1);
        },
        handleCancel: async() => {
          previewVisible.value = false;
          previewTitle.value = '';
        },
        onFinish(value){
            console.log(value);
            // this.$inertia.post('/item',value,{
            //     onSuccess: (page)=>{
            //         console.log(page);
            //     },
            //     onError: (error)=>{
            //         console.log(error);
            //     }
            // });
            axios.post('/item',value).then((response)=>{
              console.log(response);
            })
        },


    }

  }


  </script>

<style>

@media (max-width: 768px) {
  .ant-form-item{
    margin-bottom:0px;
  }
  .ant-form-item .ant-form-item-label{
    padding:0px;
  }
  .flow-root{
    padding-top:10px;
  }
}

</style>