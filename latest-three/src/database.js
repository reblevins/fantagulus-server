import Dexie from 'dexie';

const db = new Dexie('Latest3Blog');

db.version(1).stores({
    blog_meta: `blog_id`,
    posts: `++post_id, &slug, date_published, date_created`
})

// db.version(2).stores({
//     blog_meta: `blog_id`,
//     posts: `++post_id, &slug, date_published, date_created`
// })

// db.version(1).stores({
//     blog_meta: `id`,
//     posts: `++id, &slug, date_published, date_created`
// });

db.open()

// db.blog_meta.add({
// 	blog_id: 1,
// 	avatar: {
// 		secure_url: null,
// 		thumbnail_url: null
// 	},
// 	date_created: null,
// 	title: null,
// 	subTitle: null
// })

export default db;