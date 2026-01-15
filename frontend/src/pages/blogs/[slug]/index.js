import { getBlogDetails, getCategories, getMostViewedBlogs } from "@/api/blogs";
import React, { useState, useCallback, useMemo } from "react";
import { useEffect } from "react";
import { useRouter } from "next/router";
import Head from "next/head";
import Link from "next/link";
import Image from "next/image";
import { APP_URL } from "@/services/constants";

const BlogDetail = () => {
  const router = useRouter();
  const { slug } = router.query;

  const [blogDetail, setBlogDetail] = useState(null);
  const [blogCategories, setBlogCategories] = useState([]);
  const [mostViewedBlogs, setMostViewedBlogs] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Memoized fetch functions
  const fetchBlogDetail = useCallback(async (slugParam) => {
    if (!slugParam) return;

    try {
      const response = await getBlogDetails(slugParam);
      if (response?.success) {
        setBlogDetail(response?.result);
      } else {
        setError("Blog not found");
      }
    } catch (error) {
      console.error("Error fetching blog detail:", error);
      setError("Failed to load blog");
    }
  }, []);

  const fetchCategories = useCallback(async () => {
    try {
      const response = await getCategories();
      if (response?.success) {
        setBlogCategories(response?.result);
      }
    } catch (error) {
      console.error("Error fetching categories:", error);
    }
  }, []);

  const fetchMostViewedBlogs = useCallback(async () => {
    try {
      const response = await getMostViewedBlogs();
      if (response?.success) {
        setMostViewedBlogs(response?.result);
      }
    } catch (error) {
      console.error("Error fetching most viewed blogs:", error);
    }
  }, []);

  useEffect(() => {
    if (!router.isReady) return;
    if (!slug) return;

    const fetchAllData = async () => {
      setLoading(true);
      setError(null);

      try {
        await Promise.all([
          fetchBlogDetail(slug),
          fetchCategories(),
          fetchMostViewedBlogs(),
        ]);
      } catch (err) {
        setError("Failed to load data");
      } finally {
        setLoading(false);
      }
    };

    fetchAllData();
  }, [
    router.isReady,
    slug,
    fetchBlogDetail,
    fetchCategories,
    fetchMostViewedBlogs,
  ]);

  // Memoized formatted date and time
  const { formattedDate, formattedTime } = useMemo(() => {
    if (!blogDetail?.created_at)
      return { formattedDate: "", formattedTime: "" };

    const date = new Date(blogDetail.created_at);
    return {
      formattedDate: date.toLocaleDateString(),
      formattedTime: date.toLocaleTimeString(),
    };
  }, [blogDetail?.created_at]);

  // Share handlers
  const currentUrl = typeof window !== "undefined" ? window.location.href : "";

  const handleShare = useCallback(
    (platform) => {
      const title = blogDetail?.title || "";
      const url = encodeURIComponent(currentUrl);
      const text = encodeURIComponent(title);

      const shareUrls = {
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${url}`,
        twitter: `https://twitter.com/intent/tweet?url=${url}&text=${text}`,
        linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${url}`,
      };

      if (shareUrls[platform]) {
        window.open(shareUrls[platform], "_blank", "width=600,height=400");
      }
    },
    [blogDetail?.title, currentUrl]
  );

  // Loading state
  if (loading) {
    return (
      <div className="min-h-screen bg-white flex items-center justify-center">
        <div className="text-center">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-[#FF6E04] mx-auto"></div>
          <p className="mt-4 text-gray-600">Loading...</p>
        </div>
      </div>
    );
  }

  // Error state
  if (error || !blogDetail) {
    return (
      <div className="min-h-screen bg-white flex items-center justify-center">
        <div className="text-center">
          <h2 className="text-2xl font-bold text-gray-800 mb-4">
            Blog Not Found
          </h2>
          <Link href="/blogs" className="text-[#FF6E04] hover:underline">
            Return to Blogs
          </Link>
        </div>
      </div>
    );
  }

  return (
    <>
      <Head>
        <title>
          {blogDetail?.meta_title || blogDetail?.title || "Blog Detail"}
        </title>
        <meta
          name="description"
          content={blogDetail?.meta_description || blogDetail?.title || ""}
        />
        <meta name="keywords" content={blogDetail?.meta_keywords || ""} />

        {/* Open Graph Meta Tags for better social sharing */}
        <meta
          property="og:title"
          content={blogDetail?.meta_title || blogDetail?.title}
        />
        <meta
          property="og:description"
          content={blogDetail?.meta_description || ""}
        />
        <meta
          property="og:image"
          content={`${APP_URL}/${blogDetail?.featured_image}`}
        />
        <meta property="og:url" content={currentUrl} />
        <meta property="og:type" content="article" />

        {/* Twitter Card Meta Tags */}
        <meta name="twitter:card" content="summary_large_image" />
        <meta
          name="twitter:title"
          content={blogDetail?.meta_title || blogDetail?.title}
        />
        <meta
          name="twitter:description"
          content={blogDetail?.meta_description || ""}
        />
        <meta
          name="twitter:image"
          content={`${APP_URL}/${blogDetail?.featured_image}`}
        />

        {/* Canonical URL */}
        <link rel="canonical" href={currentUrl} />
      </Head>

      <div className="min-h-screen bg-white max-w-[2000px] p-6 w-[80%] mx-auto py-8">
        {/* Main Content Section - Left: Blog Detail, Right: Sidebar */}
        <div className="flex flex-col lg:flex-row gap-8">
          {/* Left Section - Blog Detail (65% width) */}
          <div className="lg:w-[70%]">
            {/* Breadcrumb Navigation */}
            <div className="mb-2 flex items-center gap-2 text-sm text-gray-600">
              <Link href="/" className="hover:text-[#FF6E04] transition-colors">
                Home
              </Link>
              <span>/</span>
              <Link
                href="/blogs"
                className="hover:text-[#FF6E04] transition-colors"
              >
                Blogs
              </Link>
              <span>/</span>
              <span className="text-gray-800 font-medium">
                {blogDetail?.category?.name}
              </span>
            </div>

            {/* Blog Header */}
            <div className="mb-4">
              {/* <div className="mb-2">
                <span className="inline-block bg-[#FF6E04] text-white px-4 py-2 rounded-full text-sm font-medium">
                  {blogDetail?.category?.name}
                </span>
              </div> */}
              <h1 className="2xl:text-2xl text-lg font-semibold text-gray-800 mb-2 leading-tight">
                {blogDetail?.title}
              </h1>

              {/* Blog Meta Information */}
              <div className="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                <div className="flex items-center gap-2">
                  <svg
                    className="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fillRule="evenodd"
                      d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                      clipRule="evenodd"
                    />
                  </svg>
                  <span className="font-medium">
                    {blogDetail?.author?.name}
                  </span>
                </div>
                <div className="flex items-center gap-2">
                  <svg
                    className="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fillRule="evenodd"
                      d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                      clipRule="evenodd"
                    />
                  </svg>
                  <span>{formattedDate}</span>
                </div>
                <div className="flex items-center gap-2">
                  <svg
                    className="w-5 h-5"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fillRule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                      clipRule="evenodd"
                    />
                  </svg>
                  <span>{formattedTime}</span>
                </div>
              </div>
            </div>

            {/* Featured Image */}
            <div className="mb-8 rounded-lg overflow-hidden shadow-lg">
              <Image
                src={`${APP_URL}/${blogDetail?.featured_image}`}
                alt={blogDetail?.title}
                className="w-full h-auto object-cover"
                width={1200}
                height={630}
                priority
              />
            </div>

            {/* Social Share Buttons */}
            <div className="mb-8 flex items-center gap-4 pb-6 border-b text-sm border-gray-200">
              <span className="text-gray-600 font-medium">Share:</span>
              <button
                onClick={() => handleShare("facebook")}
                className="flex items-center gap-2 text-gray-600 hover:text-[#FF6E04] transition-colors"
                aria-label="Share on Facebook"
              >
                <svg
                  className="w-5 h-5"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                </svg>
                Facebook
              </button>
              <button
                onClick={() => handleShare("twitter")}
                className="flex items-center gap-2 text-gray-600 hover:text-[#FF6E04] transition-colors"
                aria-label="Share on X (Twitter)"
              >
                <svg
                  className="w-5 h-5"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                </svg>
                X
              </button>
              <button
                onClick={() => handleShare("linkedin")}
                className="flex items-center gap-2 text-gray-600 hover:text-[#FF6E04] transition-colors"
                aria-label="Share on LinkedIn"
              >
                <svg
                  className="w-5 h-5"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                </svg>
                LinkedIn
              </button>
            </div>

            {/* Blog Content */}
            <div
              className="blog-content prose text-sm prose-lg max-w-none mb-12"
              dangerouslySetInnerHTML={{ __html: blogDetail?.content }}
            />

            {/* Related Blogs Section */}
            <div>
              <h3 className="text-xl font-bold text-gray-800 mb-6">
                Related Articles
              </h3>
              <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                {mostViewedBlogs?.slice(0, 3)?.map((blog) => (
                  <Link
                    key={blog.id}
                    href={`/blogs/${blog.slug}`}
                    className="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 border border-gray-100"
                  >
                    <div className="relative h-48 overflow-hidden">
                      <Image
                        src={`${APP_URL}/${blog.featured_image}`}
                        alt={blog.title}
                        width={500}
                        height={500}
                        className="w-full h-full object-cover hover:scale-110 transition-transform duration-500"
                      />
                      <div className="absolute top-3 left-3 bg-[#FF6E04] text-white px-3 py-1 rounded-full text-xs font-medium">
                        {blog?.category?.name}
                      </div>
                    </div>
                    <div className="p-4">
                      <h4 className="text-base font-bold text-gray-800 hover:text-[#FF6E04] transition-colors line-clamp-2">
                        {blog?.title}
                      </h4>
                    </div>
                  </Link>
                ))}
              </div>
            </div>
          </div>

          {/* Right Section - Sidebar (35% width) - Sticky */}
          <div className="lg:w-[30%]">
            <div className="lg:sticky lg:top-24 mt-32">
              {/* Categories Section */}
              <div className="bg-white rounded-lg shadow-md border border-gray-100 p-3 mb-6">
                <h3 className="text-xl font-bold text-gray-800 mb-4">
                  Categories
                </h3>
                <div className="w-16 h-1 bg-[#FF6E04] mb-6"></div>
                <div className="space-y-1">
                  {blogCategories?.map((cat) => (
                    <div
                      key={cat.id}
                      className="flex justify-between items-center p-1 hover:bg-gray-50 rounded cursor-pointer transition-colors border-l-2 border-transparent hover:border-[#FF6E04]"
                    >
                      <span className="text-gray-700 text-sm font-medium">
                        {cat.name}
                      </span>
                      <span className="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">
                        {cat.counts}
                      </span>
                    </div>
                  ))}
                </div>
              </div>

              {/* Popular Blogs Section */}
              <div className="bg-white rounded-lg shadow-md border border-gray-100 p-4 mb-6">
                <h3 className="text-xl font-bold text-gray-800 mb-4">
                  Popular Posts
                </h3>
                <div className="w-16 h-1 bg-[#FF6E04] mb-6"></div>
                <div className="space-y-4">
                  {mostViewedBlogs?.map((blog) => (
                    <Link
                      key={blog.id}
                      href={`/blogs/${blog.slug}`}
                      className="block pb-4 border-b border-gray-100 last:border-b-0 hover:translate-x-1 transition-transform"
                    >
                      <h4 className="text-gray-800 text-sm font-semibold mb-1 hover:text-[#FF6E04] transition-colors">
                        {blog.title}
                      </h4>
                    </Link>
                  ))}
                </div>
              </div>

              {/* Ad Banner Section 1 */}
              <div className="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg shadow-md border-2 border-[#FF6E04] p-8 mb-6 text-center">
                <h4 className="text-xl font-bold text-gray-800 mb-2">
                  Advertise Here
                </h4>
                <p className="text-gray-600 mb-4">300 x 250</p>
                <button className="text-[#FF6E04] border border-[#FF6E04] px-6 py-2 rounded hover:bg-[#FF6E04] hover:text-white transition-all duration-300 font-medium">
                  Learn More
                </button>
              </div>

              {/* Ad Banner Section 2 */}
              <div className="bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg shadow-md border border-gray-200 p-8 text-center">
                <h4 className="text-xl font-bold text-gray-800 mb-2">
                  Sponsored Content
                </h4>
                <p className="text-gray-600 mb-4">300 x 250</p>
                <button className="text-[#FF6E04] border border-[#FF6E04] px-6 py-2 rounded hover:bg-[#FF6E04] hover:text-white transition-all duration-300 font-medium">
                  Contact Us
                </button>
              </div>
            </div>
          </div>
        </div>

        {/* Custom Styles for Blog Content */}
        <style jsx>{`
          .blog-content h2 {
            font-size: 1.875rem;
            font-weight: 700;
            color: #1f2937;
            margin-top: 2rem;
            margin-bottom: 1rem;
          }
          .blog-content p {
            color: #4b5563;
            line-height: 1.875;
            margin-bottom: 1.5rem;
          }
          .blog-content ul {
            list-style: disc;
            margin-left: 1.5rem;
            margin-bottom: 1.5rem;
            color: #4b5563;
          }
          .blog-content ul li {
            margin-bottom: 0.5rem;
            line-height: 1.75;
          }
        `}</style>
      </div>
    </>
  );
};

export default BlogDetail;
