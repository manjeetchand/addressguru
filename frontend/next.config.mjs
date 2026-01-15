/** @type {import('next').NextConfig} */
const nextConfig = {
  reactStrictMode: true,
  images: {
    remotePatterns: [
      {
        protocol: "https",
        hostname: "api.addressguru.sg",
      },
      {
        protocol: "https",
        hostname: "images.unsplash.com",
      },
    ],
  },
  async rewrites() {
    return [
      {
        source: "/:slug", // user will visit /something
        destination: "/:slug", // internally serves landing-page/[slug].js
      },
    ];
  },
};

export default nextConfig;
