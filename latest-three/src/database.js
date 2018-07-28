import Dexie from 'dexie';

const db = new Dexie('Latest3Blog');
db.version(1).stores({
    blog_meta: `++id`,
    posts: `++id, &slug, date_published, date_created`
});

export default db;