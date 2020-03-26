<template>
    <modal  
        title="" 
        @close="closeModalValidate()">
        
        <div slot="body" class="modal-body"> 
            <form action="#" @submit.prevent="onSubmiit()">

                <!-- Name -->
                <div class="form-item" :class="{errorInput: $v.name.$error}">
                    <p class="errorText" v-if="!$v.name.required">Поле не может быть пустым!</p>
                    <p class="errorText" v-if="!$v.name.minLength">Поле не может быть короче {{ $v.name.$params.minLength.min }} !</p>
                    <label>Имя</label> 
                    <input 
                        v-model="name"
                        :class="{error: $v.name.$error}"
                        @change="$v.name.$touch()">
                </div>

                <!-- Email -->
                <div class="form-item" :class="{errorInput: $v.email.$error}">
                    <p class="errorText" v-if="!$v.email.required">Поле не может быть пустым!</p>
                    <p class="errorText" v-if="!$v.email.email">Поле не похоже на email!</p>
                    <label>Email</label> 
                    <input 
                        v-model="email"
                        :class="{error: $v.email.$error}"
                        @change="$v.email.$touch()">
                </div> 

                <!-- Password -->
                <div class="form-item" :class="{errorInput: $v.password.$error}">
                    <p class="errorText" v-if="!$v.password.required">Введите пароль!</p>
                    <p class="errorText" v-if="!$v.password.minLength">Пароль не может быть короче {{ $v.password.$params.minLength.min }} символов!</p> 
                    <p class="errorText" v-if="!$v.password">Введите пароль!</p>
                    <label>Придумайте пароль</label>
                    <input
                        type="password" 
                        v-model="password"
                        :class="{error: $v.password.$error}"
                        @change="$v.password.$touch()">    
                </div>

                <!-- Password Repeat -->
                <div class="form-item" :class="{errorInput: $v.repeatPassword.$error}"> 
                    <p class="errorText" v-if="!$v.repeatPassword.sameAsPassword">Пароли не совпадают!</p>
                    <label>Введите пароль ещё раз</label>
                    <input
                        type="password" 
                        v-model="repeatPassword"
                        :class="{error: $v.repeatPassword.$error}"
                        @change="$v.repeatPassword.$touch()">    
                </div>
                <button class="btn btnSuccess" >Отправить!</button>
            </form>
        </div>
    </modal>
</template>

<script>
import { required, minLength, email,sameAs } from 'vuelidate/lib/validators'
import axios from 'axios'

import modal from '~/components/UI/Modal.vue'
export default {
    components: { modal },
    props:{
        title: {
            type: String,
            required: true
        }
    },
    data(){
        return{
            name: '',
            email: '',
            password: '',
            repeatPassword: ''
        }
    },
    validations: {
        name: {
            required,
            minLength: minLength(3)
        },
        email: {
            required,
            email
        },
        password: {
            required,
            minLength: minLength(5)
        },
        repeatPassword: {
            sameAsPassword: sameAs('password')
        }
    },
    created () {
        let view = this.$store.getters.getModalView
        //console.log(view)
    },
    methods: {
        onSubmiit(){
            this.$v.$touch()
            if(!this.$v.$invalid){
                const user =  {
                    name: this.name,
                    email: this.email,
                    pass: this.password
                }
                
                // RESET
                this.name = '',
                this.email = '',
                this.password = '',
                this.repeatPassword = '',
                this.$v.$reset(),
                this.$emit('close')

            }
        },
        closeModalValidate() { 
            this.name = '',
            this.email = '',
            this.password = '',
            this.repeatPassword = '',
            this.$v.$reset(),
            this.$emit('close')
        }
    },
    
    
}
</script>

<style lang="scss">
.form-item .errorText {
    display: none;
    margin-bottom: 8px;
    font-size: 12.4px;
    color: #de4040;
}
.form-item{
    &.errorInput .errorText {
        display: block;
    }
}
input.error {
    border-color: #de4040;
}
</style>