import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export const store = new Vuex.Store({
    // The state defines the data.
    state: {
        notes: [],
        posts: [],
        auth_user: {}
    },

    // Getters are used for access in the state for manipulation.
    getters: {
        all_notifications(state){
            return state.notes
        },

        count_notifications(state){
          return state.notes.length
        },

        all_posts(state){
            return state.posts
        }
    },

    // Mutations: this are the functions that are used to manipulate the state or change the state data.
    mutations: {
        ADD_NOTE(state, note){
            state.notes.push(note)
        },
        ADD_POST(state, post){
            state.posts.push(post)
        },
        AUTH_USER(state, user){
            state.auth_user = user
        },

        UPDATE_POST_LIKES(state, payload){
            let post = state.posts.find( (p) => {
                return p.id === payload.id
            })

            post.likes.push(payload.like)
        },

        UNLIKE_POST(state, payload){
            let post = state.posts.find((post) => {
                return post.id === payload.post_id
            })

            let like = post.likes.find((l)=>{
                return l.id === payload.like_id
            })

            let index = post.likes.indexOf(like)
            post.likes.splice(index, 1)
        }

    }

    // Actions: this are the mutation callers. One can call multiple mutations at the same time.
    }
)
