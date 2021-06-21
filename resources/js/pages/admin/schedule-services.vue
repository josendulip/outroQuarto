<template>
    <div class="container">
        <!-- <div class="row mb-3 justify-content-between align-items-center px-3">
            <h3 class="text-muted">{{ $t("schedulVisits") }}</h3>
            
            <sui-menu compact>
            <router-link  is="sui-menu-item" :to="{ name: 'admin.scheduling' }" size="tiny">
                <sui-icon name="bell outline" /> {{ $t('scheduled') }}
                <sui-label color="red" floating>
                    {{ schedules }}
                </sui-label>
            </router-link>
            </sui-menu>
        </div> -->
        <div class="row justify-content-md-center">
        <div class="col-10">
            <!-- <div v-if="schedules === 0">
                <transition name="fade">
                    <sui-message
                    v-if="visible"
                    header="Welcome back!"
                    content="This is a special notification which you can dismiss."
                    dismissable
                    @dismiss="handleDismiss"
                    >Infelizmente</sui-message>
                </transition>
                <p v-if="!visible"> Message will come back in 2s</p>
            </div> -->
            <sui-table basic="very">
                <sui-table-header>
                    <sui-table-row>
                        <sui-table-header-cell>{{ $t('schedulName') }}</sui-table-header-cell>
                        <sui-table-header-cell>{{ $t('schedulPhone') }}</sui-table-header-cell>
                        <sui-table-header-cell>{{ $t('schedulEmail') }}</sui-table-header-cell>
                        <sui-table-header-cell>{{ $t('schedulLink') }}</sui-table-header-cell>
                        <sui-table-header-cell>{{ $t('schedulStatus') }}</sui-table-header-cell>
                    </sui-table-row>
                </sui-table-header>
                <sui-table-body>
                    <sui-table-row v-for="mySchedule in mySchedules" :key="mySchedule.id">
                        <sui-table-cell>{{ mySchedule.username }}</sui-table-cell>
                        <sui-table-cell>{{ mySchedule.phone }}</sui-table-cell>
                        <sui-table-cell>{{ mySchedule.email }}</sui-table-cell>
                        <sui-table-cell><a href="#" @click.prevent="viewSchedul(mySchedule.id)">{{ mySchedule.house_code }}</a></sui-table-cell>
                        <sui-table-cell>          
                            <a is="sui-label" basic pointing="left" v-if="mySchedule.status == 'pending'"><sui-icon name="circle" color="red"/> {{ $t('schedulStatus_pending') }}</a>
                            <a is="sui-label" basic pointing="left" v-if="mySchedule.status == 'resolved'"><sui-icon name="circle" color="blue"/>{{ $t('schedulStatus_resolved') }}</a>
                            <a is="sui-label" basic pointing="left" v-if="mySchedule.status == 'confirmed'"><sui-icon name="circle" color="green"/>{{ $t('schedulStatus_confirm')}}</a>
                            <a is="sui-label" basic pointing="left" v-if="mySchedule.status == 'Not approved'"><sui-icon name="circle" color="purple"/>{{ $t('schedulStatus_approved')}}</a>
                        </sui-table-cell>
                    </sui-table-row>
                </sui-table-body>
            </sui-table>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        mySchedules:{},
        schedules: 0,
        visible: false
    }),
    methods: {
        /* loadSuggestes(){
            axios.get('/api/schedule-services').then(({data}) => {this.mySchedules = data})
        }, */
        handleDismiss() {
            this.visible = false;
            setTimeout(() => {
                this.visible = true;
            }, 2000);
        },
        /* getResults(page = 1) {
            axios.get("api/my-schedules/?page=" + page).then((response) => {
                this.mySchedules = response.data;
            });
        }, */
        viewSchedul(schedul) {
            this.$router.push("view-schedule-payment/" + schedul);
        },
        async loadSchedules() {
            try {
                const response = await fetch("/api/schedule-services");
                const result = await response.json();
                this.mySchedules = result;
                //console.log(this.myHouses);
            } catch (error) {
                console.log(error);
            }
        },

        async countSchedules() {
            try {
                const response = await fetch("api/count-schedules");
                const result = await response.json();
                this.schedules = result;
                //console.log(this.myHouses);
            } catch (error) {
                console.log(error);
            }
        },
    },
    mounted(){
        this.loadSchedules();
        this.countSchedules();
    }
}
</script>