<template>
    <div class="container-fluid py-1 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card card-registration my-2">
                    <div class="row d-flex justify-content-end sign_up">
                        <div class="form-sign_up">
                            <div class="d-flex justify-content-center h-100">
                                <div class="card-body_sign_up">
                                    <h3 class="mb-5 text">Create Account</h3>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="print-name">Print Name</label>
                                        <input type="text" id="print-name"  v-model="auth.print_name"  class="form-control" />
                                        <small class="text-danger error mt-1" v-if="errors && errors.print_name">{{ errors.print_name[0] }}</small>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="sign-name">Sign Name</label>
                                        <input type="text" id="sign-name"  v-model="auth.sign_name"  class="form-control" />
                                        <small class="text-danger error mt-1" v-if="errors && errors.sign_name">{{ errors.sign_name[0] }}</small>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="company-name">Company Name/Date Supervisor Acknowledgement:</label>
                                        <input type="text" id="company-name"  v-model="auth.company_name"  class="form-control" />
                                        <small class="text-danger error mt-1" v-if="errors && errors.company_name">{{ errors.company_name[0] }}</small>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="emergency-contact-name">Emergency Contact Name and Number:</label>
                                        <input type="text" id="emergency-contact-name"  v-model="auth.emergency_contact_name"  class="form-control" />
                                        <small class="text-danger error mt-1" v-if="errors && errors.emergency_contact_name">{{ errors.emergency_contact_name[0] }}</small>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email"  v-model="auth.email"  class="form-control" />
                                        <small class="text-danger error mt-1" v-if="errors && errors.email">{{ errors.email[0] }}</small>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password"  v-model="auth.password" class="form-control" />
                                        <small class="text-danger error mt-1" v-if="errors && errors.password">{{ errors.password[0] }}</small>
                                    </div>
                                    <div class="pt-3">
                                        <button type="button" :disabled="processing" @click="register"  class="btn btn-success">
                                            {{ processing ? "Please wait" : "Create Account" }}
                                        </button>
                                    </div>
                                    <div class="text-center mt-3">
                                        <p>Already have an account? <router-link :to="{name:'login'}">Login</router-link></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <vue-toastr ></vue-toastr>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'
    import VueToastr from "vue-toastr"
    export default {
        name:'register',
        components: {
            VueToastr
        },
        data(){
            return {
                auth:{
                    print_name:"",
                    sign_name:"",
                    email:"",
                    password:"",
                    emergency_contact_name: "",
                    company_name: ""
                },
                processing:false,
                errors: null,
            }
        },
        methods:{
            ...mapActions({
                signIn:'auth/login'
            }),
            async register(){
                this.errors = null;
                this.processing = true;
                await axios.post('api/register',this.auth).then(response=>{
                    this.$toastr.s("Your registration created successfully!");
                    this.$router.push('/login')
                }).catch(({response:{data}})=>{
                    this.errors = data.data;
                }).finally(()=>{
                    this.processing = false
                })
            }
        },
        mounted() {
            document.title = "Register"
        },
    }
</script>

<style lang="scss" scoped>

    .card-registration {
        background-image: url('/images/frame.svg');
        background-repeat: no-repeat;
        background-size: contain;
        height: 100%;
        max-height: 927px;
        border: none;


        .sign_up {
            .form-sign_up {
                border-radius: 30px 0px 0px 30px;
                background: #FFF;
                width: 100%;
                max-width: 1124px;
                height: 927px;
                .card-body_sign_up {
                    width: 100%;
                    max-width: 588px;
                    height: 312px;
                    margin-top: 100px;
                    padding-left: 20px;
                    padding-right: 20px;
                    .text {
                        color: #525252;
                        font-family: Poppins, sans-serif;
                        font-size: 28px;
                        font-style: normal;
                        font-weight: 600;
                        line-height: normal;
                    }

                    label {
                        color: #A1A1A1;
                        font-family: Poppins, sans-serif;
                        font-size: 14px;
                        font-style: normal;
                        font-weight: 500;
                        line-height: normal;
                    }

                    input {
                        width: 100%;
                        max-width: 588.001px;
                        height: 29.5px;
                        color: #A1A1A1;
                        font-family: Poppins, sans-serif;
                        font-size: 14px;
                        font-style: normal;
                        font-weight: 500;
                        line-height: normal;
                        border-bottom: 1px solid #E8E8E8;
                        border-left: none;
                        border-right: none;
                        border-top: none;
                        border-radius: unset;
                        &:focus {
                            box-shadow: unset;
                        }
                    }

                    .error {
                        font-size: 11px;
                        font-family: Poppins, sans-serif;
                    }


                    a {
                        color: #A1A1A1;
                        font-family: Poppins, sans-serif;
                        font-size: 14px;
                        font-style: normal;
                        font-weight: 400;
                        line-height: normal;
                        &:hover {
                            text-decoration: unset;
                        }
                    }

                    p {
                        font-family: Poppins, sans-serif;
                        font-size: 15px;
                        font-style: normal;
                        font-weight: 400;
                        line-height: normal;
                    }

                    button {
                        width: 100%;
                        max-width: 588px;
                        height: 40px;
                        border-radius: 6px;
                        background: #64B22B;
                    }
                }
            }
        }

    }


    @media screen and (min-width: 1755px) and (max-width: 1940px)   {
        .form-sign_up {
            max-width: 950px !important;
        }
    }

    @media screen and (min-width: 1550px) and (max-width: 1754px)   {
        .form-sign_up {
            max-width: 750px !important;
        }
    }

    @media screen and (max-width: 1549px)   {
        .card-registration {
            background: unset;
            .sign_up {
                justify-content: center !important;
            }
        }
    }
</style>