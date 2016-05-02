<template lang="jade">

.container
    .row
        .col-md-12
            form.form-horizontal.auth-form(role='form', @submit.prevent="login", :class="{ 'has-error': failed }")
                .form-group
                    .input-group
                        span.input-group-addon
                            svg.icon.icon-envelope
                                use(xlink:href='/svg/sprites.svg#envelope')
                        input.form-control.form-control-lg(type='email', name='email', v-model="email", value="", placeholder='Email..')
                .form-group
                    .input-group
                        span.input-group-addon
                            svg.icon.icon-key
                                use(xlink:href='/svg/sprites.svg#key')
                        input.form-control.form-control-lg(type='password', name='password', v-model="password", placeholder='Password..')
                .form-group
                    input.btn.btn-primary.btn-block(type='submit', value='Login')
                .form-group.text-center
                    small
                        a(href="/password/reset") Forgot your password ?
                    |                                         
                    small
                        a(href="/register") Create an account


</template>

<script>
import store from '../../store';
import Storage from 'localforage';

export default {
        props: {
                currentNote: {
                        twoWay: true
                }
        },

        data() {
        	return {
        		email: '',
        		password: '',
        		failed: false
        	}
        },

        methods: {
        	login() {
        		this.failed = false;

        		store.login(this.email, this.password)
        			.then(response => {
        				this.failed = false;

        				this.password = '';

        				let token = response.data.token;

        				Storage.setItem('token', token, () => {
	        				this.$dispatch('user:loggedin', token);
        				})
        				.catch(() => {
        					console.log('Storage error');
        				});
        			})
        			.catch(() => {
        				this.failed = true;
                        console.error('Login Failed');
        			});
        	}
        }

}

</script>