export default async () => {
  const { data } = await useAsyncData('nav-links', () =>
    queryContent('/').where({ navigation: true }).sort({ order: 1 }).only(['_path', 'title']).find()
  );

  return data;
};
