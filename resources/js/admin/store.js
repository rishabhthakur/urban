import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export const store = new Vuex.Store({
      state: {
            nots: [],
            notifications: [],
            auth_user: {}
      },
      getters: {
            all_nots(state) {
                  return state.nots
            },
            all_nots_count(state) {
                  return state.nots.length
            },
            all_notifications(state) {
                  return state.notifications
            }
      },
      mutations: {
            add_not(state, not) {
                  state.nots.push(not)
            },
            add_notification(state, notification) {
                  state.notifications.push(notification)
            },
            auth_user_data(state, user) {
                  state.auth_user = user
            }
      }
})
