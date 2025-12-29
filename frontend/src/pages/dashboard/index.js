"use client";
import CountCard from "@/components/Dashboard/CountCard";
import DashboardNavbar from "@/components/Dashboard/DashboardNavbar";
import DashboardOverview from "@/components/Dashboard/DashboardOverview";
import PostAdsPop from "@/components/Dashboard/Popups/PostAdsPop";
import RecentLeads from "@/components/Dashboard/RecentLeads";
import React, { useEffect, useState } from "react";
import Image from "next/image";
import Header from "@/components/HeadersMobile/Dashboard";
import MyListings from "@/components/Dashboard/MyListings";
import DashboardSidebar from "@/components/Dashboard/DashboardSidebar";
import { get_user_listings } from "@/api/showlistings";
import { get_dashboard_data } from "@/api/dashboard";
import { useAuth } from "@/context/AuthContext";
import { useRouter } from "next/router";
import MyJobListings from "@/components/Dashboard/MyJobListings";

const Dashboard = () => {
  const router = useRouter();
  const [data, setData] = useState(null);
  const [activeTab, setActiveTab] = useState("dashboard");
  const getDashboardData = async () => {
    const res = await get_dashboard_data();
    if (res?.success) {
      setData(res?.data);
    }
  };
  useEffect(() => {
    getDashboardData();
  }, []);
  const countData = [
    {
      image: "/count-listing",
      title: "YOUR LISTING",
      count: data?.listings,
    },
    {
      image: "/count-products",
      title: "PRODUCTS",
      count: data?.products,
    },
    {
      image: "/count-jobs",
      title: "JOBS",
      count: data?.jobs,
    },
    {
      image: "/count-properties",
      title: "PROPERTIES",
      count: data?.properties,
    },
    {
      image: "/count-reviews",
      title: "REVIEWS",
      count: data?.reviews,
    },
  ];
  const [myListings, setMyListings] = useState(null);
  const [myJobs, setMyJobs] = useState(null);

  const getUserListings = async (type) => {
    const res = await get_user_listings(type);
    console.log(`response from user ${type}`, res);
    if (res?.data?.success && type === "listing") {
      setMyListings(res?.data?.data);
    }
    if (res?.data?.success && type === "jobs") {
      setMyJobs(res?.data?.data);
    }
  };
  useEffect(() => {
    getUserListings("listing");
    getUserListings("jobs");
  }, []);
  const [postAdd, setPostAdd] = useState(false);
  const { user } = useAuth();

  const renderSection = () => {
    switch (activeTab) {
      case "dashboard":
        return (
          <>
            {/* for main dashboard data  */}
            <div className=" md:w-[82.5%] mr-2">
              <section className="bg-[#D1E9FD] w-[98%] md:w-full  mx-auto  min-h-40 rounded-xl flex justify-between md:pl-10 px-2">
                <div className="py-5">
                  <h6 className="md:text-2xl text-sm font-extrabold">
                    Grow Faster. Sell Smarter.
                  </h6>
                  <div className="max-md:flex gap-2 max-md:mt-2 items-center">
                    <p className="font-semibold max-md:font-bold max-md:text-[10px] whitespace-nowrap">
                      Select a Plan Now
                    </p>
                    <button className="bg-orange-500 text-[10px] whitespace-nowrap md:text-[15px] font-bold text-white px-3 md:px-7 md:mt-3 rounded-md py-1 ">
                      GET 50% OFF
                    </button>
                  </div>
                  <p className="text-orange-500 text-xs font-semibold mt-1.5">
                    Limited Period Offer!
                  </p>
                </div>

                <div className=" max-h-45 md:p-3 w-[40%]  max-md:min-w-[40%] relative ">
                  <Image
                    src="/assets/dashboard/slider-img/illustrator1.png"
                    alt="illustrator"
                    height={500}
                    width={500}
                    className="object-contain  max-md:hidded  h-full w-full"
                  />
                </div>
              </section>

              <div className="flex gap-2 max-md:flex-wrap my-5">
                {countData.map((item, index) => (
                  <CountCard key={index} data={item} />
                ))}
              </div>
              <div className="w-full bg-white  z-30">
                <DashboardOverview data={data} />
              </div>
              <section className="my-5 space-y-5">
                {/* <RecentLeads /> */}
                <MyListings data={myListings} />
              </section>
            </div>
          </>
        );
      case "my-listings":
        return (
          <>
            <div className="md-max-w-[80%] ">
              <section className="my-5 space-y-5">
                {/* <RecentLeads /> */}
                <MyListings data={myListings} />
              </section>
            </div>
          </>
        );
      case "my-jobs":
        return (
          <>
            <div className="md-max-w-[80%] ">
              <section className="my-5 space-y-5 w-full">
                {/* <RecentLeads /> */}
                <MyJobListings data={myJobs} />
              </section>
            </div>
          </>
        );
      case "leads":
        return <LeadsSection />;
      default:
        return <OverviewSection />;
    }
  };
  //  bg-[#FF6E04]
  return (
    <>
      <div className="w-full h-screen overflow-y-scroll hide-scroll  relative flex justify-between overflow-x-hidden">
        <div className=" w-[17%] h-full fixed top-0 left-0 z-10">
          <DashboardSidebar activeTab={activeTab} setActiveTab={setActiveTab} />
        </div>
        {/* header section  */}
        <DashboardNavbar user={user} setPostAdd={setPostAdd} />
        <div className="md:hidden w-full">
          <Header />
        </div>
        <section className="h-full md:w-[82.5%] w-[99%] mx-auto [20000px]:w-full hide-scroll absolute flex top-21 right-0">
          {renderSection()}
          {/* for ads section */}
          <div className="flex flex-col fixed right-0 h-full max-md:hidden  pb-2 w-[12.5%] mr-2 gap-2">
            <div className="bg-red-100 w-full max-h-[43%] rounded-sm text-center">
              <Image
                src="/assets/dashboard/add.png"
                alt="ads"
                height={500}
                width={500}
                className="h-full"
              />
            </div>
            <div className="bg-red-100 w-full max-h-[43%] rounded-sm text-center">
              <Image
                src="/assets/dashboard/add.png"
                alt="ads"
                height={500}
                width={500}
                className="h-full"
              />
            </div>
          </div>
        </section>
      </div>

      {postAdd && <PostAdsPop postAdd={postAdd} setPostAdd={setPostAdd} />}
    </>
  );
};

export default Dashboard;
