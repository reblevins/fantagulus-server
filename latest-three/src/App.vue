<template>
<div id="app">
    <div id="main" ref="main">
        <!-- <div id="header" :class="headerClass">
            <div href="#" class="author"><img :src="blog.avatar"></div>
            <h1 id="blog_title">{{ blog.title }}</h1>
            <h2 id="blog_sub_title">{{ blog.subTitle }}</h2>
        </div> -->

        <router-view />

        <!-- <section id="footer">
            <ul class="icons">
                <li><a href="#" class="fab fa-twitter"><span class="label">Twitter</span></a></li>
                <li><a href="#" class="fab fa-facebook"><span class="label">Facebook</span></a></li>
                <li><a href="#" class="fab fa-instagram"><span class="label">Instagram</span></a></li>
                <li><a href="#" class="fab fa-rss"><span class="label">RSS</span></a></li>
                <li><a href="#" class="fab fa-envelope"><span class="label">Email</span></a></li>
            </ul>
            <p class="copyright">© Untitled. Design: <a href="http://html5up.net">HTML5 UP</a>. Images: <a href="http://unsplash.com">Unsplash</a>.</p>
        </section> -->
    </div><!-- /#main -->
</div>
</template>

<script>
export default {
    name: 'App',
    props: ['blogName'],
    data() {
        return {
            blog: {
                avatar: null,
                title: null,
                subTitle: null,
                author: null
            },
            mainRect: null,
        }
    },
    created() {
        // this.fetchData()
    },
    watch: {
        '$refs.main'(newVal) {
            if (newVal) {
                this.mainRect = this.$refs.main.getBoundingClientRect()

                window.addEventListener('scroll', (e) => {
                    main = document.getElementById("main")
                    this.mainRect = main.getBoundingClientRect()
                })
            }
        }
    },
    computed: {
        headerClass() {
            if (!this.mainRect) return
            let className = null

            if ((this.mainRect.width < 568 && this.mainRect.top < 34) || (this.mainRect.width > 568 && this.mainRect.width < 700 && this.mainRect.top < 57)) {
                className = "small"
            }
            if (this.mainRect.width > 700 && this.mainRect.width < 797) {
                className = "small"
            }
            return className
        }
    },
    methods: {
        fetchData() {
            console.log(this.$apiUrl + this.blogName)
            fetch(this.$apiUrl + this.blogName + '/blog').then(response => {
                return response.json()
            }).then(obj => {
                console.log(obj)
                this.blog = obj.blog
                // this.posts = obj.posts
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>

<style lang="scss">
@import url("https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Raleway:400,800,900");

html, body {
    overflow: scroll;
    padding: 0;
    margin: 0;
}

body {
    font-family: "Source Sans Pro", Helvetica, sans-serif;
  /*font-size: 10pt;*/
  font-size: 12pt;
  background-color: rgb(244, 244, 244);
    line-height: 1.5;
}
/*@media (min-width: 320px) {*/
#main {
  /*display: grid;*/
  grid-template-columns: 1fr;
    width: auto;
    padding: 1em 0;
    color: #646464;
    margin: 12em auto 0 auto;
}
a {
  color: inherit;
}
h1, h2, h3, h4 {
    font-family: 'Raleway', sans-serif;
  color: #3c3b3b;
  text-transform: uppercase;
}
h1 {
    font-size: 1.5em;
}
img {
  width: 100%;
}
p {
    margin: 0 0 2em 0;
}
#header {
    background-color: rgb(244, 244, 244);
    position: fixed;
    padding: 1em 2em;
    top: 0;
    left: 0;
    z-index: 1;
    width: 100%;
    box-sizing: border-box;
    /*display: grid;*/
    grid-template-columns: 1.2fr 3fr;
    grid-template-rows: 0.6fr 1fr;
    grid-gap: 0 1.5em;
    height: 12em;
}
#header, #header.small h1, #header.small h2, #header div.author {
/*#header {*/
    transition: all 0.6s;
}
/*#header.small h1, #header.small h2, #header div.author {
    transition: all 0s;
}*/
#header.small {
    padding: 1em 1.5em;
    grid-template-columns: 1.2fr 12fr;
    height: 4.3em;
}
#header.small h1 {
    margin: 0;
    font-size: 1em;
}
#header.small h2 {
    font-size: 0.5em;
}
#header.small div.author {
    /*width: 9%;*/
    margin: 0 1em 0 0;
}
#header div.author {
    /*width: 19%;*/
    height: 90%;
    overflow: hidden;
    display: block;
    grid-row: span 2;
    float: left;
    margin: 1em 1em 1em 0;
}
.author img {
    border-radius: 100%;
    display: block;
    height: 100%;
    width: auto;
}
#header h1 {
    font-size: 1.4em;
    margin-bottom: 0;
}
#header h2 {
    color: #646464;
    font-size: 0.8em;
    font-weight: 400;
    letter-spacing: 0.25em;
    line-height: 1.5;
    text-transform: uppercase;
    margin: 0;
}
article {
  margin-bottom: 2em;
  background: #ffffff;
    border: solid 1px rgba(160, 160, 160, 0.3);
}
header {
  position: relative;
  /*grid-row: 2;*/
    padding: 1.25em 1.25em 0.1em 1.25em;
    /*display: grid;
    grid-template-columns: 3fr 0.5fr;*/
}
header h3 {
    font-weight: 800;
    letter-spacing: 0.25em;
    line-height: 1.65;
    margin: 0 0 1em 0;
    text-transform: uppercase;
}
header h3 a {
  color: inherit;
  border-bottom: 0;
  text-decoration: none;
}
.mini-post {
    cursor: pointer;
}
.mini-post header .published {
    display: block;
    font-family: "Raleway", Helvetica, sans-serif;
    font-size: 0.6em;
    font-weight: 400;
    letter-spacing: 0.25em;
    margin: -0.625em 0 1.7em 0;
    text-transform: uppercase;
    grid-row: 2;
}
.mini-post header .author {
    grid-row: span 2;
}
.excerpt {
    padding: 1.25em;
}

/* Post */
.post {

}
.post > header {
    padding: 3em 1.5em 0.5em 1.5em;
}

.post > header .title {
    margin: 0 0 2em 0;
    padding: 0;
    text-align: center;
}
.post > header .title h2 {
    font-weight: 900;
    font-size: 1.1em;
}

.post .body {
    padding: 0 1.5em 0.5em 1.5em;
}

header p {
    font-family: "Raleway", Helvetica, sans-serif;
    font-size: 0.7em;
    font-weight: 400;
    letter-spacing: 0.25em;
    line-height: 2.5;
    margin-top: -1em;
    text-transform: uppercase;
}

#footer {
  text-align: center;
}
#footer .icons {
    color: #aaaaaa;
}

ul.icons {
    cursor: default;
    list-style: none;
    padding-left: 0;
}
ul {
    list-style: disc;
    margin: 0 0 2em 0;
    padding-left: 1em;
}
ul.icons li {
    display: inline-block;
    padding: 0 1em 0 0;
}
ul.icons li > * {
    text-decoration: none;
    border: 0;
}
ul.icons li > * .label {
    display: none;
}
#footer .copyright {
    color: #aaaaaa;
    font-size: 0.5em;
    font-weight: 400;
    letter-spacing: 0.25em;
    text-transform: uppercase;
}
/*}*/
@media (min-width: 568px) {
    #main {
        margin: 13em auto 0 auto;
        width: 100%;
        box-sizing: border-box;
    }
    #header {
        /*position: initial;*/
    }
    #header div.author {
        margin-right: 2em;
    }
    #header.small div.author {
        width: 5%;
    }
    #header h1 {
        margin-top: 4.5em;
    }
}
@media (min-width: 731px) {
    #main {
        margin-top: 4em;
    }
}
@media (min-width: 768px) {
  * {
    font-size: 12pt;
  }
  #main {
    padding: 4em 2em;
        margin-top: 0;
  }
    #header.small {
        padding: 1em 2.5em;
    }
    .author img {
        margin: 0;
        width: 100%;
        height: auto;
    }
  article {
        /*margin-left: 30%;*/
  }
  #footer {
    grid-column: 2;
    padding-left: 1em;
  }
}

@media (min-width: 1024px) {
  * {
    /*font-size: 10pt;*/
  }
  #main {
        max-width: 80%;
        padding: 4em 0;
  }
    #header {
            width: 17.3em;
            left: 6em;
            padding: 0 2.5em;
            top: 4.2em;
            height: auto;
            border: none;
    }
    #header h1 {
        margin-top: 1em;
    }
    #header div.author {
        margin: 0 0 2em 0;
        width: 100%;
        height: auto;
    }
    #header h2 {
        /*font-size: 1.1em;*/
    }
  article, #footer {
    margin: 0 0 2em 17em;
  }
  .post > header {
      padding: 2em 1.5em 0.5em 1.5em;
  }
}
.post > header .title > :last-child {
    margin-bottom: 0;
}

.post > header .meta {
    min-width: 17em;
    text-align: center;
    margin: 0 0 2em 0;
}

.post > header .meta > * {
    margin: 0 0 1em 0;
}

.post > header .meta > :last-child {
    margin-bottom: 0;
}

.post > header .meta .published {
    color: #3c3b3b;
    display: block;
    font-family: "Raleway", Helvetica, sans-serif;
    font-size: 0.7em;
    font-weight: 800;
    letter-spacing: 0.25em;
    margin-top: 0.5em;
    text-transform: uppercase;
    white-space: nowrap;
}

.post > span.image.featured {
    margin: 0 0 1.5em 0;
    overflow: hidden;
    display: inline-block;
}

.post > span.image.featured img {
    -moz-transition: -moz-transform 0.2s ease-out;
    -webkit-transition: -webkit-transform 0.2s ease-out;
    -ms-transition: -ms-transform 0.2s ease-out;
    transition: transform 0.2s ease-out;
}

.post > span.image.featured:hover img {
    -moz-transform: scale(1.05);
    -webkit-transform: scale(1.05);
    -ms-transform: scale(1.05);
    transform: scale(1.05);
}

.post > footer {
    display: -moz-flex;
    display: -webkit-flex;
    display: -ms-flex;
    display: flex;
    -moz-align-items: center;
    -webkit-align-items: center;
    -ms-align-items: center;
    align-items: center;
}

.post > footer .actions {
    -moz-flex-grow: 1;
    -webkit-flex-grow: 1;
    -ms-flex-grow: 1;
    flex-grow: 1;
}

.post > footer .stats {
    width: 100%;
    text-align: center;
    cursor: default;
    list-style: none;
    padding: 0;
}

.post > footer .stats li {
    border-left: solid 1px rgba(160, 160, 160, 0.3);
    display: inline-block;
    font-family: "Raleway", Helvetica, sans-serif;
    font-size: 0.6em;
    font-weight: 400;
    letter-spacing: 0.25em;
    line-height: 1;
    margin: 0 0 0 2em;
    padding: 0 0 0 2em;
    text-transform: uppercase;
}

.post > footer .stats li:first-child {
    border-left: 0;
    margin-left: 0;
    padding-left: 0;
}

.post > footer .stats li .icon {
    border-bottom: 0;
}

.post > footer .stats li .icon:before {
    color: rgba(160, 160, 160, 0.3);
    margin-right: 0.75em;
}
</style>
