import AppForm from '../app-components/Form/AppForm';

Vue.component('about-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                body:  '' ,
                image:  '' ,
                
            }
        }
    }

});