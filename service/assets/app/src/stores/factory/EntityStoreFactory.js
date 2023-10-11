import axios from 'axios'
import {useSettingsStore} from "../Settings"
import { Toasts } from "../../classes/Toasts"
import {defineStore} from "pinia";

export function entityStoreFactory(options) {
    return defineStore(options.storeId, {
        state: () => ({
            id: options.storeId,
            list: [],
            entity: null,
            violations: null,
            loading: false,
            detailEvent: null,
            settingsStore: useSettingsStore(),
            endpoint: options.endpoint,
            entityName: options.entityName,
            route: options.route,
            auditLog: null,
            auditLogLoading: false,
            auditLogPage: 1
        }),
        actions: {
            updateEntity(data) {
                this.entity = data
                this.detailEvent?.close()
                this.detailEvent = new EventSource(this.settingsStore.mercureUrl + this.id + '/update/' + this.entity?.id);
                this.detailEvent.onmessage = event => {
                    this.entity = JSON.parse(event.data)
                    Toasts.successToast().create(
                        'Success',
                        `This ${this.entityName} was updated successfully by ${this.entity.lastUpdatedByName}.`
                    )
                }
            },
            updateList(data) {
                this.list = data
            },
            async index() {
                return new Promise((resolve, reject) => {
                    this.loading = true
                    axios
                        .get(this.endpoint, {
                            headers: this.securityStore.getTokenHeader()
                        })
                        .then(response => {
                            this.updateList(response.data)
                            resolve()
                        })
                        .catch(errors => {
                            reject(errors)
                        })
                        .finally(() => {
                            this.loading = false
                        })
                })
            },
            async detail(id) {
                if (id === 'new') {
                    this.entity = {}
                    return
                }
                return new Promise((resolve, reject) => {
                    this.loading = true
                    axios
                        .get(this.endpoint + '/' + id, {
                            headers: this.securityStore.getTokenHeader()
                        })
                        .then(response => {
                            this.updateEntity(response.data)
                            resolve()
                        })
                        .catch(errors => {
                            reject(errors)
                        })
                        .finally(() => {
                            this.loading = false
                        })
                })
            },
            async save(id) {
                this.violations = null
                if (id === 'new') {
                    return this.create()
                }
                return this.update(id)
            },
            async create() {
                return new Promise((resolve, reject) => {
                    this.loading = true
                    axios
                        .patch(
                            this.endpoint,
                            this.entity,
                            {
                                headers: this.securityStore.getTokenHeader()
                            }
                        )
                        .then(response => {
                            this.updateEntity(response.data)
                            this.$router.push(this.route + '/' + this.entity.id)
                            Toasts.successToast().create(
                                'Success',
                                'The ' + this.entityName + ' was created successfully.'
                            )
                            resolve()
                        })
                        .catch(errors => {
                            Toasts.dangerToast().create(
                                'Error',
                                'The ' + this.entityName + ' could not be created.'
                            );
                            this.violations = errors.response.data.violations
                            reject(errors)
                        })
                        .finally(() => {
                            this.loading = false
                        })
                })
            },
            async update(id) {
                return new Promise((resolve, reject) => {
                    this.loading = true
                    axios
                        .post(
                            this.endpoint + '/' + id,
                            this.entity,
                            {
                                headers: this.securityStore.getTokenHeader()
                            }
                        )
                        .then(response => {
                            this.updateEntity(response.data)
                            resolve()
                        })
                        .catch(errors => {
                            console.log(errors)
                            Toasts.dangerToast().create(
                                'Error',
                                'The ' + this.entityName + ' could not be updated.'
                            );
                            this.violations = errors.response.data.violations
                            reject(errors)
                        })
                        .finally(() => {
                            this.loading = false
                        })
                })
            },
            async delete() {
                return new Promise((resolve, reject) => {
                    this.loading = true
                    axios
                        .delete(this.endpoint + '/' + this.entity.id,
                            {
                                headers: this.securityStore.getTokenHeader()
                            })
                        .then(response => {
                            Toasts.successToast().create(
                                'Success',
                                'The ' + this.entityName + ' was deleted successfully.'
                            );
                            resolve()
                        })
                        .catch(errors => {
                            Toasts.dangerToast().create(
                                'Error',
                                'The ' + this.entityName + ' could not be deleted.'
                            );
                            this.violations = errors.response.data.violations
                            reject(errors)
                        })
                        .finally(() => {
                            this.loading = false
                        })
                })
            },
            async loadAuditLog(page= 1) {
                this.auditLogLoading = true
                return new Promise((resolve, reject) => {
                    axios
                        .get(this.settingsStore.endpoints.auditLog, {
                            params: {
                                fqcn: this.entity.fqcn,
                                id: this.entity.id,
                                page: page
                            },
                            headers: this.securityStore.getTokenHeader()
                        })
                        .then(response => {
                            this.auditLog = response.data
                            resolve()
                        })
                        .catch(errors => {
                            Toasts.dangerToast().create(
                                'Error',
                                `The Audit Log for ${this.entityName} could not be retrieved.`
                            );
                            reject(errors)
                        })
                        .finally(() => {
                            this.auditLogLoading = false
                        })
                })
            },
        }
    })()
}


