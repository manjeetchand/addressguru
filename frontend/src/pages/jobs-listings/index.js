import { get_all_jobs_listings } from "@/api/listings";
import BreadCrumbs from "@/components/BreadCrumbs";
import HelpFull from "@/components/Helpfull";
import Filters from "@/components/Jobs/Filters";
import JobCard from "@/components/Jobs/JobCard";
import { useAuth } from "@/context/AuthContext";
import Image from "next/image";
import React from "react";
import { APP_URL } from "@/services/constants";
import Head from "next/head";

const JobsListings = ({ allJobs }) => {
  const { city } = useAuth();
  const jobSlug = "jobs"; // or dynamic — use category if available

  const canonicalUrl = `${APP_URL}/jobs/${city
    ?.toLowerCase()
    .replace(/\s+/g, "-")}`;
  return (
    <>
      <Head>
        {/* ===== META BASIC ===== */}
        <title>{`Top Jobs in ${city} | Latest Job Openings`}</title>
        <meta
          name="description"
          content={`Find the latest jobs in ${city}. Explore verified job openings, salary, company details, and apply instantly.`}
        />
        <meta
          name="keywords"
          content={`jobs in ${city}, ${city} job openings, latest jobs, hiring in ${city}, apply for jobs ${city}`}
        />

        {/* ===== CANONICAL ===== */}
        <link rel="canonical" href={canonicalUrl} />

        {/* ===== OPEN GRAPH (FB / WHATSAPP) ===== */}
        <meta property="og:type" content="website" />
        <meta property="og:title" content={`Top Jobs in ${city} | Apply Now`} />
        <meta
          property="og:description"
          content={`Browse the latest job vacancies in ${city}. Verified companies with salary information.`}
        />
        <meta property="og:url" content={canonicalUrl} />
        <meta property="og:site_name" content="Your Website Name" />
        <meta
          property="og:image"
          content={`${APP_URL}/seo/default-job-og.jpg`}
        />

        {/* ===== TWITTER CARDS ===== */}
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content={`Top Jobs in ${city}`} />
        <meta
          name="twitter:description"
          content={`Find verified job openings in ${city}. Apply now.`}
        />
        <meta
          name="twitter:image"
          content={`${APP_URL}/seo/default-job-og.jpg`}
        />

        {/* ===== STRUCTURED DATA (JSON-LD) ===== */}
        <script
          type="application/ld+json"
          dangerouslySetInnerHTML={{
            __html: JSON.stringify({
              "@context": "https://schema.org",
              "@type": "ItemList",
              name: `Top Jobs in ${city}`,
              url: canonicalUrl,
              numberOfItems: allJobs?.length || 0,
              itemListElement:
                allJobs?.map((job, i) => ({
                  "@type": "ListItem",
                  position: i + 1,
                  name: job?.title,
                  description: job?.shortDescription,
                  url: `${APP_URL}/job/${job?.slug}`,
                })) || [],
            }),
          }}
        />
      </Head>

      <div className="flex flex-col items-center w-full h-full justify-center bg-[#F8F7F7] ">
        <div className="md:w-[80%] w-full rounded-lg pb-10 bg-white md:pl-3 max-md:px-2">
          <div className="max-md:hidden">

          <BreadCrumbs slug={"jobs"} name={"jobs"} length={allJobs?.length} />
          </div>
          <h1 className="capitalize font-semibold max-md:hidden text-2xl">
            top jobs in {city}
          </h1>

          {/* main section */}
          <div className="flex justify-between w-full md:pr-3 mt-5">
            {/* filter section */}
            <div className="w-[19%] md:sticky max-md:hidden self-start top-20 ">
              <Filters />
            </div>

            {/* main card section */}
            <div className="md:w-[55%] w-full flex flex-col gap-2">
              {allJobs?.map((item, index) => (
                <JobCard key={index} data={item} />
              ))}
              <HelpFull layout={"col"} />
            </div>

            {/* ads section */}
            <div className="flex flex-col gap-2 w-[24%] max-md:hidden sticky self-start top-20">
              <div className="w-full h-70 relative">
                <div className="absolute top-4 left-4 flex flex-col gap-1">
                  <span className="flex items-center font-[500] gap-1 text-lg">
                    Looking for{" "}
                    <h2 className="text-xl font-semibold">Candidates</h2>
                  </span>
                  <button className="text-[#FF6E04] bg-white py-1.5 w-40 text-[13px] font-bold rounded-sm">
                    POST FREE JOB
                  </button>
                </div>
                <Image
                  src="/assets/job/jobsad1.png"
                  alt="looking for jobs"
                  height={500}
                  width={500}
                  className="h-full w-full"
                />
              </div>

              <div className="w-full h-70 relative">
                <div className="absolute bottom-4 right-2 flex flex-col">
                  <span className="flex items-center relative left-4 font-[500] gap-1">
                    Looking for <h2 className="text-lg font-semibold">Jobs</h2>
                  </span>
                  <button className="text-[#FF6E04] bg-white py-1.5 px-2 text-xs font-bold rounded-sm">
                    CREATE YOUR PROFILE
                  </button>
                </div>
                <Image
                  src="/assets/job/jobsad2.png"
                  alt="looking for jobs"
                  height={500}
                  width={500}
                  className="h-full w-full"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default JobsListings;

// ✅ Server-side rendering
export async function getServerSideProps() {
  try {
    const res = await get_all_jobs_listings();
    return {
      props: {
        allJobs: res || [],
      },
    };
  } catch (error) {
    console.error("Error fetching jobs:", error);
    return {
      props: {
        allJobs: [],
      },
    };
  }
}
