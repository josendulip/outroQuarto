function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/search', name: 'search.house', component: page('search.vue') },
  { path: '/find/:houseKey', name: 'find.houser', component: page('find.vue') },
  { path: '/about', name: 'about', component: page('about.vue') },
  { path: '/policy', name: 'policy', component: page('policy.vue') },
  { path: '/term-condition', name: 'term-condition', component: page('term-condition.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/register/As/advertiser', name: 'advertiser', component: page('auth/advertiser.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/services', name: 'services', component: page('services.vue') },
  { path: '/collaborate', name: 'collaborate', component: page('collaborate.vue') },
  // { path: '/announce', name: 'announce', component: page('announce.vue') },
  { path: '/my-panel', name: 'my-panel', component: page('myPanel.vue') },
  // { path: '/edit/:house_code', name: 'edit.my.house', component: page('editMyHouse.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  { path: '/view/:house_code', name: 'view.houser', component: page('view.vue') },
  /* {path: '/search', name: 'search.home', component: page('search-home.vue') }, */
  { path: '/favourites', name: 'favourites', component: page('favourites.vue') },
  { path: '/histories', name: 'histories', component: page('histories.vue') },

  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') },
      { path: 'additional', name: 'settings.additional', component: page('settings/additional.vue') }
    ]
  },

  {
    path: '/my-panel',
    component: page('my-panel/index.vue'),
    children: [
      { path: '', redirect: { name: 'my-panel.welcome' } },
      { path: 'welcome', name: 'my-panel.welcome', component: page('my-panel/welcome.vue') },
      { path: '/properties', name: 'my-panel.properties', component: page('my-panel/properties.vue') },
      { path: '/schedules', name: 'my-panel.schedules', component: page('my-panel/schedules.vue') },
      { path: '/new/scheduling', name: 'my-panel.scheduling', component: page('my-panel/scheduleMessage.vue') },
      { path: '/view-schedule-message/:id', name: 'my-panel.message', component: page('my-panel/schedule.vue') },
      { path: '/promote', name: 'my-panel.promote', component: page('my-panel/promote.vue') },
      { path: '/promotion/:house_code', name: 'my-panel.promotion', component: page('my-panel/promotion.vue') },
      { path: '/verificate', name: 'my-panel.verificate', component: page('my-panel/verificate.vue') },
      { path: '/verification/:house_code', name: 'my-panel.verification', component: page('my-panel/verification.vue') },
      { path: '/payments', name: 'my-panel.payments', component: page('my-panel/payments.vue') },
      { path: '/assessments', name: 'my-panel.assessments', component: page('my-panel/assessments.vue') },
      { path: '/new', name: 'my-panel.new.home', component: page('my-panel/newHome.vue') },
      { path: '/edit/:house_code', name: 'my-panel.edit.home', component: page('my-panel/editHome.vue') },
      { path: '/add-images/:house_code', name: 'my-panel.add.images', component: page('my-panel/add-images.vue') },
      { path: '/profile', name: 'my-panel.profile', component: page('my-panel/profile.vue') },
      { path: '/profile/password', name: 'my-panel.password', component: page('my-panel/password.vue') }
    ]
  },
  {
    path: '/user',
    component: page('user/index.vue'),
    children: [
      { path: '', redirect: { name: 'user.welcome' } },
      { path: 'welcome', name: 'user.welcome', component: page('user/welcome.vue') },
      { path: 'schedules', name: 'user.schedules', component: page('user/schedules.vue') },
      { path: 'my-schedule-message/:id', name: 'user.schedule', component: page('user/schedule.vue') },
      { path: 'payments', name: 'user.payments', component: page('user/payments.vue') },
      { path: 'assessments', name: 'user.assessments', component: page('user/assessments.vue') },
      { path: 'favourites', name: 'user.favourites', component: page('user/favourites.vue') },
      { path: 'histories', name: 'user.histories', component: page('user/histories.vue') },
      { path: '/profile', name: 'user.profile', component: page('user/profile.vue') },
      { path: '/view/owner-profile/:slug', name: 'user.owner.profile', component: page('user/owner-profile.vue') },
      { path: '/profile/password', name: 'user.password', component: page('my-panel/password.vue') }
    ]
  },
  {
    path: '/admin',
    component: page('admin/index.vue'),
    children: [
      { path: '', redirect: { name: 'admin.dashboard' } },
      { path: '/admin/dashboard', name: 'admin.dashboard', component: page('admin/dashboard.vue') },
      { path: '/admin/schedule-services', name: 'admin.schedule-services', component: page('admin/schedule-services.vue') },
      { path: '/admin/view-schedule-payment/:id', name: 'admin.payment-schedule-services', component: page('admin/payment-schedule-services.vue') },
      { path: '/admin/suggested-property', name: 'admin.suggested-property', component: page('admin/suggested-property.vue') },
      { path: '/admin/view-suggested-property/:id', name: 'admin.view-suggested-property', component: page('admin/view-suggested-property.vue') },
      { path: '/admin/new/user', name: 'admin.new.user', component: page('admin/new-user.vue') },
      { path: '/admin/view/user/:slug', name: 'admin.view.user', component: page('admin/view-user.vue') },
      { path: '/admin/edit/user/:slug', name: 'admin.edit.user', component: page('admin/edit-user.vue') },
      { path: '/admin/properties', name: 'admin.properties', component: page('admin/properties.vue') },
      { path: '/admin/users', name: 'admin.users', component: page('admin/users.vue') },
      { path: '/admin/user', name: 'admin.see.user', component: page('admin/user.vue') },
      { path: '/profile', name: 'admin.profile', component: page('admin/profile.vue') },
      { path: '/profile/password', name: 'admin.password', component: page('admin/password.vue') }
    ]
  },

  { path: '/work-with-us', name: 'user.workwithus', component: page('user/workwithus.vue') },
  { path: '/announce', name: 'user.announce', component: page('user/announce.vue') },

  { path: '*', component: page('errors/404.vue') }
]
