<template>
    <div class="modal fade" id="userFormModal" data-backdrop="static" tabindex="-1" role="dialog" 
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Enquiry Form
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="enquireNow" >
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name*</label>
                            <input name="name" type="text" class="form-control"
                                id="name" aria-describedby="nameHelp" placeholder="Enter Full Name" required/>
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Contact Number*</label>
                            <input name="contact_number" type="text" class="form-control"
                                id="contact_number" aria-describedby="nameHelp" placeholder="Enter Contact Number" required/>
                            
                        </div>

                        <div class="form-group">
                            <label for="email">Email Id* </label>
                            <input name="email" type="email" class="form-control "
                                id="email" aria-describedby="nameHelp"
                                placeholder="Enter Email Id" required/>
                            
                        </div>
                        <div class="form-group">
                            <label for="enduser">End User* </label>
                            <select class="form-control" name="enduser" id="enduser" v-model="endUserType" required>
                                <option value="" selected>Select End User Type</option>
                                <option value="Individual">Individual</option>
                                <option value="Company">Company</option>
                            </select>
                        </div>

                        <div v-if="showCompany" class="form-group">
                            <label for="company_name">Company Name*</label>
                            <input name="company_name" type="text" class="form-control "
                                id="company_name" aria-describedby="nameHelp"
                                placeholder="Enter Company Name" :required="endUserType"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import EventBus from '../../EventBus';
axios.defaults.baseURL = baseUrl;
export default {
        data(){
            return {
                productid: '',
                productname: '',
                producturl: '',
                endUserType: ''
            }
        },
        methods : {
            enquireNow(submitEvent) {
                console.log(this.productid);
                axios.post(`${baseUrl}/vue/addenquiry`,{
                    name : submitEvent.target.elements.name.value,
                    contact_number : submitEvent.target.elements.contact_number.value,
                    email : submitEvent.target.elements.email.value,
                    enduser : submitEvent.target.elements.enduser.value,
                    company_name : submitEvent.target.elements?.company_name?.value ? submitEvent.target.elements.company_name.value : '',
                    productid : this.productid,
                    productname : this.productname,
                    producturl : this.producturl
                })
                .then(res => {
                    console.log(res)
                    if (res.data.status == 'success') {
                        document.getElementById('close').click();

                        let config = {
                            text: res.data.message,
                            button: 'CLOSE'
                        }
                        this.$snack['danger'](config);
                    } else {
                        let config = {
                            text: res.data.message,
                            button: 'CLOSE'
                        }
                        this.$snack['success'](config);
                    }
                }).catch(err => {
                    let config = {
                        text: "Something went wrong !",
                        button: 'CLOSE'
                    }
                    this.$snack['danger'](config);
                });
            }
        },
        created(){           
            this.endUserType = '';

           EventBus.$on('enquiry-request', (payload) => {
                console.log(payload.thumbnail)
                this.productname = payload.productname.en;
                this.productid = payload.productid;
                this.producturl = payload.producturl;
           });
        },
        computed: {
            showCompany() {
                return this.endUserType == 'Company'
            }
        }
    }
</script>

<style>

</style>