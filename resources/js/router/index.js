import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

Vue.use(VueRouter);

/* Guest Component */
const Login = () => import('../components/Login.vue');
const Register = () => import('../components/Register.vue');
const ForgotPassword = () => import('../components/ForgotPassword.vue');
/* Guest Component */

/* Layouts */
const DahboardLayout = () => import('../components/Layouts/Dashboard.vue');
/* Layouts */

/* Authenticated Component */
const Dashboard = () => import('../components/Dashboard.vue');
/* Authenticated Component */


const Routes = [
    {
        name:"login",
        path:"/login",
        component:Login,
        meta:{
            middleware:"guest",
            title:`Login`,
        }
    },
    {
        name:"register",
        path:"/register",
        component:Register,
        meta:{
            middleware:"guest",
            title:`Register`
        }
    },
    {
        name:"forgot-password",
        path:"/forgot-password",
        component:ForgotPassword,
        meta:{
            middleware:"guest",
            title:`Forgot Password`
        }
    },
    {
        path:"/",
        component:DahboardLayout,
        meta:{
            middleware:"auth"
        },
        children:[
            {
                name:"dashboard",
                path: '/',
                component: Dashboard,
                meta:{
                    title:`Dashboard`
                }
            }
        ]
    }
];

var router  = new VueRouter({
    mode: 'history',
    routes: Routes
});

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} - ${process.env.MIX_APP_NAME}`
    if(to.meta.middleware=="guest"){
        if(store.state.auth.authenticated){
            next({name:"dashboard"})
        }
        next()
    }else{
        if(store.state.auth.authenticated){
            next()
        }else{
            next({name:"login"})
        }
    }
});

export default router
