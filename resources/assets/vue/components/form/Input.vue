<template>
    <div class="control-group" :class="{ 'error': error != ''}">

        <label class="control-label" :for="name">
            <strong>{{ label }}</strong>
        </label>

        <div class="controls">
            <input :type="type" class="input-xlarge"
                   name="{{ name }}" :id="name"
                   v-model="value">
            <span v-show="error != ''"
                  class="help-inline">
                {{ error }}
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                required: true
            },
            label: {
                type: String,
                required: true
            },
            type: {
                type: String,
                required: true,
                default: 'text'
            }
        },
        data() {
            return {
                value: '',
                error: ''
            }
        }
    }
</script>