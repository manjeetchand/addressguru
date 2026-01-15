export default function SiteMap() {
  return null;
}

export async function getServerSideProps({ res }) {
  try {
    const SITE_URL = "https://addressguru.sg";
    const now = new Date().toISOString();

    const urls = [
      {
        loc: `${SITE_URL}/`,
        changefreq: "daily",
        priority: "1.0",
      },
      {
        loc: `${SITE_URL}/about-us`,
        changefreq: "monthly",
        priority: "0.6",
      },
    ];

    const sitemap = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
${urls
  .map(
    (u) => `
  <url>
    <loc>${u.loc}</loc>
    <lastmod>${now}</lastmod>
    <changefreq>${u.changefreq}</changefreq>
    <priority>${u.priority}</priority>
  </url>`
  )
  .join("")}
</urlset>`;

    res.setHeader("Content-Type", "text/xml");
    res.setHeader("Cache-Control", "public, max-age=3600");
    res.write(sitemap);
    res.end();

    return { props: {} };
  } catch (error) {
    console.error("Sitemap error:", error);
    res.statusCode = 500;
    res.end();
    return { props: {} };
  }
}
