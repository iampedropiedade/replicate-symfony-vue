import { defineStore } from 'pinia'
import axios from "axios"
import { useSettingsStore } from './Settings'

export const useGeneratorStore = defineStore({
    id: 'ai',
    state: () => ({
        settingsStore: useSettingsStore(),
        predictions: [],
        requestData: {
            name: 'Red Lion',
            what: 'a pub',
            where: 'in Windsor',
            how: {
                style: 2,
                sloganSize: 30,
                imageType: 0,
            },
            selected: {
                slogan: true,
                content: true,
                image: true,
            }
        },
        styles: {
            0: 'very formal',
            1: 'formal',
            2: 'neutral',
            3: 'relaxed',
            4: 'very relaxed',
        },
        sloganSize: {
            15: 'very short',
            20: 'short',
            25: 'slightly short',
            30: 'medium',
            35: 'slightly long',
            40: 'long',
            45: 'very long',
        },
        imageTypes: {
            0: 'an illustration',
            1: 'a real image',
        }
    }),
    actions: {
        updatePrediction(type, data) {
            const eventUrl = this.settingsStore.mercureUrl + 'predictions/update/' + type + '/' + data.id
            this.detailEvent = new EventSource(eventUrl)
            this.detailEvent.onmessage = event => {
                this.predictions[type] = JSON.parse(event.data)
                console.log(this.$router.currentRoute.path)
                if(this.predictions[type]?.status !== 'doh') {
                    this.$router.push('/results');
                }
            }
        },
        async generate() {
            this.predictions = []
            return new Promise((resolve, reject) => {
                axios
                    .post('/api/replicate/generator', this.requestData)
                    .then(response => {
                        Object.keys(response?.data?.predictions).forEach(key => {
                            this.updatePrediction(key, response?.data?.predictions[key])
                        });
                        resolve()
                    })
                    .catch(errors => {
                        this.settingsStore.errors = errors.response?.data?.detail
                        this.$router.push('/error');
                        reject(errors)
                    })
            })
        },
        async regenerate(type) {
            this.requestData.selected = {
                slogan: false,
                content: false,
                image: false
            }
            this.requestData.selected[type] = true
            return new Promise((resolve, reject) => {
                axios
                    .post('/api/replicate/generator', this.requestData)
                    .then(response => {
                        Object.keys(response?.data?.predictions).forEach(key => {
                            this.updatePrediction(key, response?.data?.predictions[key])
                        });
                        resolve()
                    })
                    .catch(errors => {
                        this.settingsStore.errors = errors.response?.data?.detail
                        this.$router.push('/error');
                        reject(errors)
                    })
            })
        },
    }
})
