<script>
    import Vue from 'vue'

    export default {
        submit(uri, data, callback, error_callback) {
            // Go through the data grabbing the value
            var json = {};
            for (var key in data) {
                if (data.hasOwnProperty(key))
                    json[key] = data[key].value;
            }

            Vue.http.post(uri, json)
                    .then(callback, function (response) {
                        if (response.status == 422) {
                            // Form input was invalid, so show errors

                            var errors = response.data.errors;
                            for (var key in data) {
                                if (data.hasOwnProperty(key)) {
                                    if (errors.hasOwnProperty(key)) {
                                        data[key].error = errors[key][0];
                                    } else {
                                        data[key].error = '';
                                    }
                                }
                            }
                        } else {
                            if(error_callback !== undefined)
                                error_callback(response);
                        }
                    });
        }
    }
</script>