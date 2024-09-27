import type { ParsedContent } from '@nuxt/content';

export default async function () {
  const route = useRoute();

  const { data } = await useAsyncData<ParsedContent | undefined>(
    'current-page',
    async () => {
      if (route.path === '/') return undefined;
      return await queryContent(route.path).findOne();
    }
  );

  return data;
}
