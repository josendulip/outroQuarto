<template>
    <div class="container">
        <div class="row mb-3 justify-content-between align-items-center px-3">
            <h3 class="text-muted">{{ $t("myadmin_suggested_housess") }}</h3>            
            <sui-menu compact>
            <router-link  is="sui-menu-item" :to="{ name: 'admin.suggested-property' }" size="tiny">
                <sui-icon name="bell outline" /> {{ $t('myadmin_suggested_houses') }}
                <sui-label color="red" floating>
                    {{ CountUnread }}
                </sui-label>
            </router-link>
            </sui-menu>
        </div>
        <div class="row justify-content-md-center">
        <div class="col-10">
            <div v-if="suggestions === 0">
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
            </div>
            <sui-table color="red" celled>
                <sui-table-header>
                    <sui-table-row>
                        <sui-table-header-cell colspan="3" class="text-uppercase text-center text-dark">{{ $t('myadmin_suggestor') }}</sui-table-header-cell>
                        <sui-table-header-cell class="bg-danger"></sui-table-header-cell>
                        <sui-table-header-cell colspan="3" class="text-uppercase text-center text-dark">{{ $t('myadmin_ouner') }}</sui-table-header-cell>
                        <sui-table-header-cell class="bg-danger"></sui-table-header-cell>
                    </sui-table-row>
                    <sui-table-row>
                        <sui-table-header-cell>{{ $t('myadmin_suggest_name') }}</sui-table-header-cell>
                        <sui-table-header-cell>{{ $t('myadmin_suggest_address') }}</sui-table-header-cell>
                        <sui-table-header-cell>{{ $t('myadmin_suggest_phone') }}</sui-table-header-cell>
                        <sui-table-header-cell class="text-center">Status</sui-table-header-cell>
                        <sui-table-header-cell>{{ $t('myadmin_suggest_name') }}</sui-table-header-cell>
                        <sui-table-header-cell>{{ $t('myadmin_suggest_address') }}</sui-table-header-cell>
                        <sui-table-header-cell>{{ $t('myadmin_suggest_phone') }}</sui-table-header-cell>
                        <sui-table-header-cell>action</sui-table-header-cell>
                    </sui-table-row>
                </sui-table-header>
                <sui-table-body>
                    <sui-table-row v-for="suggestion in suggestions" :key="suggestion.id">
                        <sui-table-cell>{{ suggestion.yourname }}</sui-table-cell>
                        <sui-table-cell>{{ suggestion.youraddress }}</sui-table-cell>
                        <sui-table-cell>{{ suggestion.yourphone }}</sui-table-cell>
                        <sui-table-cell  class="text-center">
                            <a href="javascript:void(0)" v-if="suggestion.status == 'unread'" :title="$t('myadmin_suggest_unread')"><sui-icon name="circle" color="red"/></a>
                            <a href="javascript:void(0)" v-if="suggestion.status == 'read'" :title="$t('myadmin_suggest_read')"><sui-icon name="circle" color="green"/></a>
                        </sui-table-cell>
                        <sui-table-cell>{{ suggestion.ownername }}</sui-table-cell>
                        <sui-table-cell>{{ suggestion.owneraddress }}</sui-table-cell>
                        <sui-table-cell>{{ suggestion.ownerphone }}</sui-table-cell>
                        <sui-table-cell>          
                            <a is="sui-label" basic color="blue" tiny @click="viewSuggest(suggestion.id)">{{ $t('myadmin_suggest_view')}}</a>
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
        suggestions: 0,
        visible: false,
        CountUnread: 0,
    }),
    methods: {
        handleDismiss() {
            this.visible = false;
            setTimeout(() => {
                this.visible = true;
            }, 2000);
        },
        viewSuggest(id) {
            this.$router.push("view-suggested-property/" + id);
        },
        async loadSuggestes() {
            try {
                const response = await fetch("/api/suggested-properties");
                const result = await response.json();
                this.suggestions = result;
                //console.log(this.myHouses);
            } catch (error) {
                console.log(error);
            }
        },
        async countUnread(){
            try {
                const response = await fetch('/api/count-unread-suggest');
                const result = await response.json();
                this.CountUnread = result;
            }
            catch (error) {
                console.log(error);
            }
        }
    },
    mounted(){
        this.loadSuggestes();
        this.countUnread();
        /* Fire.$on('AfterCreated', ()=>{ 
            this.loadSuggestes();
        }) */
    }
}
</script>