import { serverQueryContent } from '#content/server';
import { SitemapStream, streamToPromise } from 'sitemap';

export default defineEventHandler(async event => {
  const sitemap = new SitemapStream({ hostname: 'https://creham.com' });

  sitemap.write({ url: '/', priority: 1.0 });

  // Fetch all documents
  const docs = await serverQueryContent(event).find();
  for (const doc of docs) {
    sitemap.write({ url: doc._path, priority: 0.8 });
  }

  sitemap.end();

  return streamToPromise(sitemap);
});
