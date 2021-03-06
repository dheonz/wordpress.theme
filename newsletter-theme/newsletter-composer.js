import Vue from 'vue'
import Composer from "./vue/Composer.vue"
import Loading from "./vue/Loading.vue"
import GlobalBus from "./vue/GlobalBus.js"
import WPajax from "../wp-admin/ajax.js"
import _ from 'lodash'

// Make all <b-foo> elements available everywhere:
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)

// Likewise for $gettext, <translation> etc.
import Gettext from 'vue-gettext'
Vue.use(Gettext, {translations: {}})
Vue.config.getTextPluginSilent = true  // No complaining about missing languages

$(($) => {
  let composer = new Vue(Composer)
  GlobalBus.$on("must_save", function(state) {
    let loading = new Vue(Loading).$mount($('<div />').appendTo('body')[0])
    let ajax = new WPajax(window.epflsti_newsletter_composer)
    ajax.request("epfl_sti_newsletter_draft_save", state)
      .then(response => {
        location.reload()
      })
      .catch(e => {
        console.log("AJAX: Unable to save:", e)
        alert("AJAX: Unable to save: " + e.status + " " + e.statusText)
        let loadingEl = loading.$el
        loading.$destroy()
        $(loadingEl).remove()
      })
  })
})
