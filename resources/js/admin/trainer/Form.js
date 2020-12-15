import AppForm from '../app-components/Form/AppForm';

Vue.component('trainer-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                image:  '' ,
                
            }
        }
    }

});