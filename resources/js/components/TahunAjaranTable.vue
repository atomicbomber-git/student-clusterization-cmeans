<template>
    <div>
        <TahunAjaranCreateForm
            :state="create_form_state"
            @create_tahun_ajaran="create_tahun_ajaran"/>
        <hr/>

        <table class="table is-bordered is-striped">
            <thead>
                <tr>
                    <th class="has-text-centered" style="width: 2rem"> # </th>
                    <th class="has-text-centered"> Tahun Ajaran </th>
                    <th class="has-text-centered"> Aksi </th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(tahun_ajaran, index) in tahun_ajarans" :key="tahun_ajaran.nama">
                    <td class="has-text-centered"> {{ index + 1 }}. </td>
                    <td class="has-text-centered"> {{ tahun_ajaran.nama }} </td>
                    <td class="has-text-centered">
                        <button :disabled="tahun_ajaran.nilais_count != 0" @click="delete_tahun_ajaran(tahun_ajaran.nama)" class="button is-danger">
                            <span> Hapus </span>
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

import TahunAjaranCreateForm from './TahunAjaranCreateForm.vue'
import axios from 'axios'

export default {
    components: {
        TahunAjaranCreateForm
    },

    created() {
        axios.get(`/tahun_ajaran/api/index`)
            .then(response => {
                this.tahun_ajarans = response.data
            })
            .catch(error => {
                alert(error)
            })
    },

    data() {
        return {
            tahun_ajarans: [],
            create_form_state: 'normal'
        }
    },

    methods: {
        delete_tahun_ajaran(tahun_ajaran) {
            axios.post(`/tahun_ajaran/api/delete`, { nama: tahun_ajaran })
                .then(response => {
                    if (response.data.status === 'success') {
                        this.tahun_ajarans = this.tahun_ajarans
                            .filter(ta => ta.nama !== tahun_ajaran)
                        return
                    }
                    console.log(response.data)
                })
                .catch(error => {
                    console.log(error);
                })
        },

        create_tahun_ajaran(tahun_ajaran) {
            this.create_form_state = 'loading'
            axios.post(`/tahun_ajaran/api/create`, { nama: tahun_ajaran })
                .then(response => {
                    this.create_form_state = 'finished'
                    if (response.data.status === 'success') {
                        this.tahun_ajarans = [...this.tahun_ajarans, {nama: tahun_ajaran, nilais_count: 0}]
                        return
                    }
                    console.log(response.data)
                })
                .catch(error => {
                    this.create_form_state = 'finished'
                    console.log(error)
                })
        }
    }
}
</script>
