
import store from '~/store'

export default class Gate {

    constructor(user) {
        this.user = user;
    }

    IsAdmin() {
        return this.user.role === 'admin';
    }
    IsUser() {
        return this.user.role === 'user';
    }
    IsEmployer() {
        if(this.user.role === 'employer'){
            return true
        };
    }
    IsEnterprise() {
        return this.user.role === 'enterprise';
    }
    IsAdminOrEmployer() {
        if (this.user.role === 'admin' || this.user.role === 'employer') {
            return true;
        }
    }
    IsAdminOrUser() {
        if (this.user.role === 'admin' || this.user.role === 'user') {
            return true;
        }
    }
    IsAdminOrEmployerBio() {            
        if (this.user.access_bio || this.user.role === 'admin') {
            return true;
        }
    }
    IsAdminOrEmployerJob() {
        if (this.user.access_job || this.user.role === 'admin') {
            return true;
        }
    }
    IsAdminOrEmployerAds() {
        if (this.user.access_ads || this.user.role === 'admin') {
            return true;
        }
    }
    IsUserOrEnterprise() {
        if (this.user.role === 'user' || this.user.role === 'enterprise') {
            return true;
        }
    }
    IsThereUser() {
        if (this.user) {
            return true;
        }
    }

    userAccessBio(){
        if (this.user.access_bio) {
            return true;
        }
    }
    userAccessAds() {
        if (this.user.access_ads) {
            return true;
        }
    }
    userAccessJob() {
        if (this.user.access_job) {
            return true;
        }
    }
}

