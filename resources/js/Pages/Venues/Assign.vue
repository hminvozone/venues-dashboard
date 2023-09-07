<template>
    <AppLayout title="Create user">

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Assign Venue
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="w-full m-auto">
                    <form @submit.prevent="submit" class="px-8 pt-6 pb-8 m-auto mb-4 bg-white rounded shadow-md"
                        enctype="multipart/form-data">
                        <h1 class="mb-3"><strong>Venue Details:</strong></h1>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    ID
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Venue Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Created at
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ venue.id}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ venue.name}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ venue.email_address}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
									<span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
										{{ venue.formatted_created_at }}
									</span>
                                </td>
                            </tr>
                            </tbody>
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Category
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Activated
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Type
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Description
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ venue.category}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ venue.is_activated == 1 ? 'Yes' : 'No'}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ venue.type}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ venue.description ?? "-"}}
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Phone Number
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    website
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Full Address
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                    Lat/Long
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ venue.phone_number}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ venue.website }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ venue.full_address}}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-center text-gray-900">
                                        {{ venue.latitude}}/{{ venue.longitude}}
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <hr/>
                        <div v-if="$page.props.auth.user.role_id == 2">
                            <h1 class="mb-3 mt-3"><strong>Staff List:</strong>
                            </h1>
                            <div class="mb-4">
                            <span v-for="user in users" :key="user.id">
                                <input type="checkbox" class="ml-5 outline-none" v-model="selectedUsers"
                                       :value="user.id"/> {{ user.name }}
                            </span>
                            </div>
                            <hr/>
                            <div class="flex items-center justify-between mt-3">
                                <Button :form="form" btnText="Assign Venues"></Button>
                            </div>
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
        venue: Object,
        users: Object,
        errors: Object
    },
    data() {
        return {
            selectedUsers: [],
            form: this.$inertia.form({
            })
        }
    },
    methods: {
        async submit() {
            if (this.selectedUsers.length === 0) {
                return;
            }
            await this.$inertia.post('/venues/assign', {
                venue: this.venue.id,
                assignList: this.selectedUsers,
                _token: this.$page.props.csrf_token
            });
        }
    }
}
</script>
