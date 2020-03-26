<template>
    <modal
        title="Отправить заявку"
        @close="closeModal()">

        <div slot="body" class="modal-body">
            <form action="#" @submit.prevent="onSubmiit()">

                <!-- Login -->
                <div class="form-item" :class="{errorInput: $v.login.$error}">
                    <p class="errorText" v-if="!$v.login.required">Поле не может быть пустым!</p>
                    <p class="errorText" v-if="!$v.login.minLength">Поле не может быть короче {{ $v.login.$params.minLength.min }} !</p>
                    <label>Ф.И.О.:</label> 
                    <input placeholder="Имя"
                        v-model="login"
                        :class="{error: $v.login.$error}"
                        @change="$v.login.$touch()">
                </div> 

                <!-- Phone -->
                <div class="form-item" :class="{errorInput: $v.phone.$error}">
                    <p class="errorText" v-if="!$v.phone.required">Поле не может быть пустым!</p>
                    <p class="errorText" v-if="!$v.phone.email">Поле не похоже на телефон!</p>
                    <label>Телефон</label> 
                    <input placeholder="+7 (777) 777-77-77"
                        type="tel"
                        v-model="phone"
                        :class="{error: $v.phone.$error}"
                        @change="$v.phone.$touch()"
                        v-mask="'+7 (###) ###-##-##'"/>
                </div> 

                <!-- Email -->
                <div class="form-item" :class="{errorInput: $v.email.$error}">
                    <p class="errorText" v-if="!$v.email.required">Поле не может быть пустым!</p>
                    <p class="errorText" v-if="!$v.email.email">Поле не похоже на email!</p>
                    <label>Email</label> 
                    <input placeholder="example@mail.ru"
                        v-model="email"
                        :class="{error: $v.email.$error}"
                        @change="$v.email.$touch()">
                </div> 
 
                <button class="btn btnSuccess">Отправить!</button> 
            </form> 
        </div>
        <div slot="footer" class="modal-footer">
            <p @click="$emit('changeModal'),closeModal()">У вас нет аккаунта? Зарегистрироваться</p>
        </div>

    </modal>
</template>

<script>
import modal from '~/components/UI/Modal.vue'
import { required, minLength, email} from 'vuelidate/lib/validators'
import axios from 'axios'

export default {
    components: {modal},
    props: {
        title: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            login: '',
            phone: '',
            email: ''
        }
    },
    validations: {
        login: {
            required,
            minLength: minLength(3)
        },
        email: {
            required,
            email,
            minLength: minLength(5)
        },
        phone: {
            required,
            minLength: minLength(18)
        }
    },
    methods: {
        closeModal() { 
            this.login = '', 
            this.email = '', 
            this.phone = '', 
            this.$v.$reset(),
            this.$emit('close')
        },
        onSubmiit(){
            this.$v.$touch()
            if(!this.$v.$invalid){
                const user =  {
                    name: this.login, 
                    tel: this.phone,
                    email: this.email
                }

                const str = JSON.stringify(user);

                axios.post('https://fr.setsushi.ru/php/mail.php', str)
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });

                this.closeModal()
            } 
        } 
    }
}
</script>

<style lang="scss" scoped>
.form-item{ 
    font-family: Muller;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}
.form-item label {
    padding-left: 30px;
    color: grey;
}
.form-item input {
    border: 1px solid grey;
    &::-webkit-input-placeholder {
        color: grey;
    }
}
.modal-footer{
    width: calc(100% + 40px );
    margin-bottom: -25px; 
    height: 70px;
    margin-left: -20px;
    background: #e2e2e2;
    padding: 10px 5px;
    display: flex;
    align-items: center;
    justify-content: center; 
    color: #9b9b9b;
    margin-top: 30px;
    p{
        cursor: pointer;
    }
}

</style>