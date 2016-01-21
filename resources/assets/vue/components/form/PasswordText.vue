<template>
    <div class="control-group" :class="{ 'error': error != ''}">

        <label class="control-label" :for="name">
            <strong>{{ name | capitalize }}</strong>
        </label>

        <div class="controls">
            <input type="password" class="input-xlarge"
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
        props: ['name'],
        data() {
            return {
                value: '',
                error: ''
            }
        }
    }
</script>