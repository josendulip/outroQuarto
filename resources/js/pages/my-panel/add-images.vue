<template>
    <div class="container">
        <div class="text-right my-4">
            <router-link :to="{ name: 'my-panel.properties' }" class="ui left labeled blue icon button">
                <i class="left arrow icon"></i>
                {{ $t("mypanel_back") }}
            </router-link>
        </div>   
      
        <div class="card border-light">
          <div class="card-body text-center">   
            <div class="d-flex justify-content-md-between mx-5 mb-3">                
                <span class="vi">
                    <span v-if="pictures.length <= 19">
                        <label for="attachments" class="btn btn-outline-dark btn-file" v-if="attachments == ''">
                            <input type="file" multiple="multiple" id="attachments" @change="uploadFieldChange" 
                            style="display: none" accept="image/x-png,image/jpeg">
                            <sui-icon name="spinner" loading color="red"/> {{ $t('mypanel_add_photos') }}
                        </label>
                    </span>
                    <span v-else>
                        <label class="btn btn-outline-dark btn-file">
                           {{$t("property_allimages")}}
                        </label>
                    </span>
                </span> 

                <label  class="btn btn-outline-dark btn-file">
                    {{ $t('property_current') }}:
                  <sui-label circular color="red">  {{ pictures.length }} </sui-label>
                </label>
                <label class="btn btn-outline-dark">
                    {{ $t('property_maximum') }}:
                    <sui-label circular color="red">  20 </sui-label>
                </label>
            </div>         
            <sui-image-group size="small" class="d-inline mr-1" v-for="(picture, index) in pictures" :key="index">
                    
                <sui-image wrapped :src="picture.thumb">
                <sui-label slot="corner" corner="right"
                    ><sui-icon name="cancel" @click="deleteImage(picture.id)" class="pointme" 
                /></sui-label>
                </sui-image>
            </sui-image-group>
            <div class="form-group">
                <div is="sui-divider" horizontal v-if="attachments != ''">
                    <h4 is="sui-header">
                    <i class="image icon"></i>
                    {{ $t('mypanel_add_photos_added') }}
                    </h4>
                </div>

                <div class="attachment-holder animated fadeIn" v-cloak v-for="(attachment, index) in attachments" :key="index"> 
                    <img :src="attachment.name" alt="">
                    <a is="sui-label" class="my-1">
                    {{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}
                    <sui-icon name="delete" @click="removeAttachment(attachment)" />
                    </a>
                </div>
                
                
                <!-- <label
                for="attachments"
                class="ui icon button btn-file fluid"
                v-if="attachments == ''"
                >
                <input type="file" multiple="multiple" id="attachments" @change="uploadFieldChange" 
                style="display: none"  accept="image/x-png,image/jpeg">
                <sui-icon name="spinner" loading /> {{ $t('mypanel_add_photos') }}
                </label> -->
                    
                    
                <label
                    for="attachments"
                    class="ui icon button btn-file fluid"
                    v-if="attachments != ''"
                >{{ $t('mypanel_add_photos_plus') }}
                <input type="file" multiple="multiple" id="attachments" @change="uploadFieldChange" 
                    style="display: none"  accept="image/x-png,image/jpeg"></label>
                <sui-button fluid 
                    v-if="attachments !=''"
                    color="green"
                    type="submit"
                    :loading="form.busy"  @click="submit"> {{ $t('mypanel_add_photos_save') }}</sui-button>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Form from "vform";
export default {
  data() {
    return { 
        form: new Form({
            user_id: "",
            house_code: "",
            city: "",
            county: "",
            district: "",
            street: "",
            type: "",
            payment_METHOD: "",
            price: "",
            room: "",
            living_room: "",
            kitchen: "",
            bathroom: "",
            seal: false,
            furniture: false,
            state: false,
            description: "",
            profile: "",
            phone: "",
            email: "",
        }),
        pictures: [],
        addPhotos: false,
        photos: [],
        attachments: [],
        // You can store all your files here
        attachments: [],
        // Each file will need to be sent as FormData element
        data: new FormData(),
        errors: {
        },
        percentCompleted: 0,
        };
    },
    methods: {
        getAttachmentSize() {
            this.upload_size = 0; // Reset to beginningƒ
            this.attachments.map((item) => { this.upload_size += parseInt(item.size); });
            this.upload_size = Number((this.upload_size).toFixed(1));
            this.$forceUpdate();
        },
        prepareFields() {        
            this.data.append("house_code", this.form.house_code);
            if (this.attachments.length > 0) {
                for (var i = 0; i < this.attachments.length; i++) {
                    let attachment = this.attachments[i];
                    this.data.append('attachments[]', attachment);
                }
            }
        },
        removeAttachment(attachment) {
            
            this.attachments.splice(this.attachments.indexOf(attachment), 1);
            
            this.getAttachmentSize();
            Fire.$emit('AfterCreated');
        },
        // This function will be called every time you add a file
        uploadFieldChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            
                if (!files.length)
                    return;
            /* if (files.size > 4096 * 4096) {
                e.preventDefault();
                alert('File too big > 16MB)');
                return;
            }else{ */
                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                }
                Fire.$emit('AfterCreated');
                // Reset the form to avoid copying these files multiple times into this.attachments
                document.getElementById("attachments").value = [];
            //}
                
        },
        submit() {
            this.prepareFields();
            var config = {
                headers: { 'Content-Type': 'multipart/form-data' } ,
                onUploadProgress: function(progressEvent) {
                    this.percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    this.$forceUpdate();
                }.bind(this)
            };
            if(this.pictures.length <= 19){
            // Make HTTP request to store announcement
            axios.post("../api/upload-house-photos", this.data, config)
            .then(function (response) {
                Fire.$emit('AfterCreated');
                console.log(response);
                if (response.data.success) {
                    console.log('Successfull Upload');
                    this.$toastr.s(
                    this.$t('property_message_suscceful_toastr_imgs') 
                );
                    this.resetData();
                } else {
                    console.log('Unsuccessful Upload');
                    this.errors = response.data.errors;
                    this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                    this.$toastr.s(
                        this.$t('view_favourite_message_error') 
                    );
                }
            }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
            .catch(function (error) {
                console.log(error);
            });
            }else{
                this.$toastr.defaultStyle = { "background-color": "#FF5859" };
                    this.$toastr.s(
                        this.$t('view_favourite_message_error_add') 
                    );
            }
        },
        deleteImage(id){
        axios.post('../api/delete-image/' + id).then(() => {
            Fire.$emit('AfterCreated');        
            this.$toastr.defaultStyle = { "background-color": "#21ba45" };
            this.$toastr.s(this.$t("property_message_suscceful_deleted_toastr"));
            console.log('delected');      
        })
        .catch( () => {
            this.$toastr.defaultStyle = { "background-color": "#FF5859" };
            this.$toastr.s(
                this.$t('property_msg_photo')
            );
                console.log('Error');
            });
        },      
        loadHousesPhotos(){
            axios.get(`/api/get-photos/${this.$route.params.house_code}`).then(({ data }) => (this.pictures = data));              
        },
        loadHouses() {
        axios
            .get(`/api/edit-my-house/${this.$route.params.house_code}`)
            .then(({ data }) => {
            this.house = data;
            this.form.state = !!parseInt(this.form.state)
            this.form.fill(data);
            });
        },
        resetData() {
            this.data = new FormData(); // Reset it completely
            this.attachments = [];
        },
        start() {
            console.log('Starting File Management Component' + this.form.house_code + this.$route.params.house_code);
        },

  },
  created() {
    this.loadHouses();
    this.loadHousesPhotos();
    Fire.$on('AfterCreated', ()=>{
    this.loadHousesPhotos();
    });
    this.start();
  },
};
</script>
<style lang="scss">
    
.pointme{
  cursor: pointer!important;
}
.pointme:hover{
  color: #dc3545;
}
</style>