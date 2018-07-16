var app = new Vue({
    el: '#app',
    data: {
        bookmarks: [],
        bookmark: {
            id: null,
            url: "https://stackoverflow.com/questions/14349263/creating-a-chrome-extension-which-takes-highlighted-text-on-the-page-and-inserts#answer-14351458",
            tags: [
                { name: 'tag' }
            ],
            description: null,
            snippet: null,
        },
        newTag: {
            name: null
        },
        message: null
    },
    created() {
        this.getBookmarks()
    },
    methods: {
        addTag: function() {
            this.tags.push(this.newTag)
            this.newTag = { name: null }
        },
        removeTag(index) {
            this.tags.splice(index, 1)
        },
        pasteSelection() {
            chrome.tabs.query({ active:true, windowId: chrome.windows.WINDOW_ID_CURRENT }, (tab) => {
                console.log(tab)
                chrome.tabs.sendMessage(tab[0].id, { method: "getSelection" }, (response) => {
                    console.log(response)
                    if (response && response.data) {
                        this.clipping = response.data;
                    } else {
                        this.message = "Please make a selection first."
                    }
                })
            })
        },
        getBookmarks() {
            let headers = {
                method: "GET", // *GET, POST, PUT, DELETE, etc.
                headers: {
                    "Content-Type": "application/json; charset=utf-8"
                }
            }
            fetch('/api/bookmarks', this.bookmark).then(response => {
                return response.json()
            }).then(obj => {
                console.log(obj)
            })
        },
        saveBookmark() {
            let headers = {
                method: "POST", // *GET, POST, PUT, DELETE, etc.
                headers: {
                    "Content-Type": "application/json; charset=utf-8",
                    // "Content-Type": "application/x-www-form-urlencoded",
                },
                redirect: "follow", // manual, *follow, error
                referrer: "no-referrer", // no-referrer, *client
                body: JSON.stringify(this.bookmark)
            }
            fetch('/api/bookmarks', headers, this.bookmark).then(response => {
                return response.json()
            }).then(obj => {
                console.log(obj)
            })
        },
        apiCall(dest) {
            
        }
    }
})
