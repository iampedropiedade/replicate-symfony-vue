import { defineStore } from 'pinia'

export const useSettingsStore = defineStore({
    id: 'settings',
    state: () => ({
        endpoints: [],
        mercureUrl: '',
        errors: null
    }),
    actions: {
    }
})
