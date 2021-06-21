<template>
    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <div class="card text-white text-center bg-info">
                    <div class="card-body">
                         <p class="display-4"><i class="users icon"></i></p>
                        <div class="inner">
                            <p>{{ $t('myadmin_dashboad_user') }}</p>
                        </div>
                        <div class="display-4">
                            {{ this.users }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white text-center bg-warning">
                    <div class="card-body">
                         <p class="display-4"><i class="calendar alternate icon"></i></p>
                        <div class="inner">
                            <p>{{ $t('myadmin_dashboad_schedulings') }}</p>
                        </div>
                        <div class="display-4">
                             {{ this.scheduleservices }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white text-center bg-dark">
                    <div class="card-body">
                         <p class="display-4"><i class="home icon"></i></p>
                        <div class="inner">
                            <p>{{ $t('myadmin_dashboad_properties') }}</p>
                        </div>
                        <div class="display-4">
                            {{ this.properties }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white text-center bg-danger">
                    <div class="card-body">
                         <p class="display-4"><i class="tachometer alternate icon"></i></p>
                        <div class="inner">
                            <p>{{ $t('myadmin_dashboad_suggest') }}</p>
                        </div>
                        <div class="display-4">
                            {{ this.suggesteds }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
import axios from "axios";
export default {
    data: () => ({
        users: {},
        properties:{},
        suggesteds: {},
        scheduleservices:{}
    }),
    methods:{
        countUser()
        {
            axios.get('/api/count-user').then(({data})=>{ this.users = data})
        },
        countProperties()
        {
            axios.get('/api/count-properties').then(({data})=>{ this.properties = data})
        },
        countsuggesteds()
        {
            axios.get('/api/count-suggested').then(({data})=>{ this.suggesteds = data})
        
        },
        countScheduleservices()
        {
            axios.get('/api/count-schedule-services').then(({data})=>{ this.scheduleservices = data})
        }
    },    
    created() {
        this.countUser();
        this.countProperties();
        this.countsuggesteds();
        this.countScheduleservices();
    },
}
</script>