import AppForm from '../app-components/Form/AppForm';

Vue.component('banner-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                title:  '' ,
                body:  '' ,
                image:  '' ,
                
            }
        }
    }

});