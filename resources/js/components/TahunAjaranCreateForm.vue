<template>
    <form @submit.prevent="create_tahun_ajaran(tahun_ajaran)">
        <div class="field is-grouped is-horizontal">
            <div class="control">
                <input v-model="tahun_ajaran" type="text" placeholder="Tahun Ajaran" class="input">
            </div>
            <div class="control">
                <button class="button is-info">
                    <span> Tambahkan </span>
                    <span class="icon is-small">
                        <i class="fa fa-plus"></i>
                    </span>
                </button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        props: [
            'state'
        ],

        created() {
            console.log(this.state)
        },

        data() {
            return {
                tahun_ajaran: ''
            }
        },

        methods: {
            create_tahun_ajaran(tahun_ajaran) {
                this.$emit('create_tahun_ajaran', tahun_ajaran)
            }
        },

        watch: {
            state() {
                if (this.state !== 'finished') {
                    return
                }

                this.tahun_ajaran = ''
            }
        }
    }
</script>
