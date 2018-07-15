var app = new Vue({
    el: '#app',
    data: {
        message: 'Hello Vue!',
        url: "https://stackoverflow.com/questions/14349263/creating-a-chrome-extension-which-takes-highlighted-text-on-the-page-and-inserts#answer-14351458",
        tags: [
            { name: 'tag' }
        ],
        description: null,
        newTag: {
            name: null
        }
    },
    methods: {
        addTag: function() {
            this.tags.push(this.newTag)
            this.newTag = { name: null }
        },
        removeTag(index) {
            this.tags.splice(index, 1)
        }
    }
})
