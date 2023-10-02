<template>
    <div class="container-fluid py-1 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card card-forgot_password my-2">
                    <div class="row d-flex justify-content-end forgot_password">
                        <div class="form-forgot_password">
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <div class="card-body_forgot_password">
                                    <h3 class="mb-5 text">Forgot password</h3>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email"  v-model="auth.email"  class="form-control" />
                                        <small class="text-danger error mt-1" v-if="errors && errors.email">{{ errors.email[0] }}</small>
                                    </div>
                                    <div class="pt-3">
                                        <button type="button" :disabled="processing" @click="login"  class="btn btn-success">
                                            {{ processing ? "Please wait" : "Send" }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'
    export default {
        name:"forgot-password",
        data(){
            return {
                auth:{
                    email:"",
                },
                errorEmail: null,
                processing:false,
                errors: null,
            }
        },
        methods:{
            ...mapActions({
                signIn:'auth/login'
            }),
            async login(){
                this.errors = null;
                this.processing = true;
                await axios.get('/sanctum/csrf-cookie');
                await axios.post('api/login',this.auth).then(({data})=>{
                    this.signIn()
                }).catch(({response:{data}})=>{
                    this.errors = data.data;
                }).finally(()=>{
                    this.processing = false
                })
            },
        },
        mounted() {
            document.title = "Forgot Password"
        },
    }
</script>


<style lang="scss" scoped>

    .card-forgot_password {
        background-image: url('/images/frame.svg');
        background-repeat: no-repeat;
        background-size: contain;
        height: 100%;
        max-height: 927px;
        border: none;

        .forgot_password {
            .form-forgot_password {
                border-radius: 30px 0px 0px 30px;
                background: #FFF;
                width: 100%;
                max-width: 1124px;
                height: 927px;
                .card-body_forgot_password {
                    width: 100%;
                    max-width: 588px;
                    height: 312px;
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
        .form-forgot_password {
            max-width: 950px !important;
        }
    }

    @media screen and (min-width: 1550px) and (max-width: 1754px)   {
        .form-forgot_password {
            max-width: 750px !important;
        }
    }

    @media screen and (max-width: 1549px)   {
        .card-forgot_password {
            background: unset;
            .forgot_password {
                justify-content: center !important;
            }
        }
    }

</style>



