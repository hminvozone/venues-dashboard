<template>
    <AppLayout title="Create user">

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create venue
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="w-full max-w-xs m-auto">

                    <form @submit.prevent="submit" class="px-8 pt-6 pb-8 m-auto mb-4 bg-white rounded shadow-md"
                        enctype="multipart/form-data">

                        <div class="mb-4">
                            <div class="mb-3">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="category">
                                    Venue Category <span class="text-red-500">*</span>
                                </label>
                                <select v-model="form.category"
                                        class="w-full block m-0 text-base font-normal text-gray-700 ease-in-out bg-white bg-no-repeat border border-gray-300 border-solid rounded appearance-none form-select bg-clip-padding focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        aria-label="Default select example" id="category">
                                    <option value="">---Select---</option>
                                    <option value="Public">Public</option>
                                    <option value="Private">Private</option>
                                </select>
                                <span class="text-red-500">{{ errors.category }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                                Name <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.name"
                                   class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                   id="name" type="text">
                            <span class="text-red-500">{{ errors.name }}</span>
                        </div>

                        <div class="mb-4">
                            <div class="mb-3">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="is_activated">
                                    Activated <span class="text-red-500">*</span>
                                </label>
                                <select v-model="form.is_activated"
                                        class="w-full block m-0 text-base font-normal text-gray-700 ease-in-out bg-white bg-no-repeat border border-gray-300 border-solid rounded appearance-none form-select bg-clip-padding focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        aria-label="Default select example" id="is_activated">
                                    <option value="">---Select---</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <span class="text-red-500">{{ errors.is_activated }}</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="type">
                                Type
                            </label>
                            <input v-model="form.type"
                                   class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                   id="type" type="text" name="type">
                            <span class="text-red-500">{{ errors.type }}</span>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="description">
                                Description
                            </label>
                            <input v-model="form.description"
                                   class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                   id="description" type="text" name="description">
                            <span class="text-red-500">{{ errors.description }}</span>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="phone_number">
                                Phone No <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.phone_number"
                                   class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                   id="phone_number" type="text" name="phone_number">
                            <span class="text-red-500">{{ errors.phone_number }}</span>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email_address">
                                E-mail <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.email_address"
                                   class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                   id="email_address" type="email" name="email_address">
                            <span class="text-red-500">{{ errors.email_address }}</span>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="website">
                                Website
                            </label>
                            <input v-model="form.website"
                                class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="website" type="text">
                            <span class="text-red-500">{{ errors.website }}</span>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="full_address">
                                Full Address <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.full_address"
                                class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="full_address" type="text" name="full_address">
                            <span class="text-red-500">{{ errors.full_address }}</span>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="latitude">
                                Latitude <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.latitude"
                                   class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                   id="latitude" type="text" name="latitude">
                            <span class="text-red-500">{{ errors.latitude }}</span>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="longitude">
                                Longitude <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.longitude"
                                   class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                   id="longitude" type="text" name="longitude">
                            <span class="text-red-500">{{ errors.longitude }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <Button :form="form"></Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import Button from '@/Components/Button.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout,
        Button,
    },
    props: {
        errors: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                category: '',
                name: '',
                type: '',
                is_activated: '',
                description:'',
                phone_number:'',
                email_address:'',
                website:'',
                full_address:'',
                latitude:'',
                longitude:''
            })
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('venues.store'), {
                _token: this.$page.props.csrf_token,
            });
        }
    }
}
</script>
