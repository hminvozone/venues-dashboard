<script setup>
</script>

<template>
    <div>
        <div class="p-6 bg-white border-b border-gray-200 lg:p-8">
            <h4>
                Welcome to <b>Venues Dashboard</b>
            </h4>
            
            <div class="mt-5">
                Staff count: <span style="color: #6875F5">{{ $page.props.counts.staffCount }}</span> <br/>
                Venues count: <span style="color: #6875F5">{{ $page.props.counts.venueCount }}</span>
            </div>

        </div>
    </div>
</template>
