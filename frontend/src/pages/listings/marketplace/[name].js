import BreadCrumbs from "@/components/BreadCrumbs";
import React, { useEffect, useState } from "react";
import Image from "next/image";
import TitleAndLogo from "@/components/SeeDetails/TitleAndLogo";
import SliderCard from "@/components/SeeDetails/SliderCard";
import QuickInformation from "@/components/SeeDetails/QuickInformation";
import GetMoreInfo from "@/components/SeeDetails/GetMoreInfo";
import UserInformation from "@/components/SeeDetails/UserInformation";
import RecentCustomerReviewCard from "@/components/BusinessListingComponents/RecentCustomerReviewCard";
import TitleAndLogoMobile from "@/components/SeeDetails/TitleAndLogoMobile";
import { get_marketplace_by_id } from "@/api/showlistings";
import { useRouter } from "next/router";

const reviews = [
  {
    title: "Brigadier Defence Academy",
    rating: 4.7,
    image: "/assets/BusinessListingPng/review.png",
    review:
      "Yes we have all necessary infrastructure, facilities, equipments provided by the college. Well furnished benches & projector facility available in classrooms. Free wifi and free Gym facilities available. All the things are well maintained and clean campus maintained. Academics: Very close teachers, super teaching quality, nice education.",
  },
  {
    title: "Captain Defence Institute",
    rating: 4.5,
    image: "/assets/BusinessListingPng/review.png",
    review:
      "The institute provides excellent guidance for NDA and other defence exams. Clean campus, helpful staff, and very experienced faculty members. The library and sports facilities are top-notch. Study material is updated regularly.",
  },
  {
    title: "Major Kalshi Classes",
    rating: 4.8,
    image: "/assets/BusinessListingPng/review.png",
    review:
      "One of the most reputed academies in the city. The teachers are extremely helpful and focus on individual performance. Hostel facilities are also good. Offers medical and physical test preparation along with academic sessions.",
  },
];

const facilitiesList = [
  "Laundry Service",
  "Internet Access",
  "Parking Available",
  "Wedding services",
  "Restaurant",
  "Parking",
];

const payment = ["cash", "others"];
// bg-[#F8F7F7]

const SeeDetails = () => {
  const router = useRouter();
  const { id } = router?.query;

  const [data, setData] = useState(null);
  // const [listingData, setListingData] = useState(null);
  const getMarketplaceListing = async (id) => {
    const res = await get_marketplace_by_id(id);
    console.log("response of marketplace", res);
    setData(res?.data);
  };
  useEffect(() => {
    getMarketplaceListing(id);
  }, [id]);
  const [enquirePop, setEnquirePop] = useState(false);
  return (
    <>
      <div className=" h-auto  flex flex-col items-center w-full max-md:relative max-md:bottom-9 justify-center bg-[#F8F7F7]   mt-2   ">
        <div className="flex flex-col md:w-[80%] max-w-[94%]  max-md:mx-auto max-md:items-center max-md:border max-md:border-gray-200 max-md:rounded-sm bg-white md:px-5 px-2 pb-7  ">
          {/* breadCrumbs section */}
          <BreadCrumbs />
          {/* image and title and button section */}
          <div className="max-md:hidden pl-2">
            <h2 className="font-semibold text-2xl line-clamp-2 capitalize mb-1">
              {data?.title}
            </h2>
            <span className="flex gap-1.5 items-center text-gray-400 font-medium  text-[15px] ">
              <svg
                width="13"
                height="18"
                viewBox="0 0 13 18"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M6.29303 0.00275534C6.7548 -0.0155547 7.20809 0.0599183 7.65512 0.154148C7.95924 0.218456 8.2531 0.333229 8.54695 0.438623C8.75818 0.514543 8.96808 0.598947 9.16681 0.702555C9.38698 0.817328 9.60044 0.948177 9.80453 1.08975C10.0403 1.25364 10.2708 1.42736 10.4878 1.61493C10.6723 1.77391 10.8455 1.94898 11.0036 2.13386C11.1943 2.35671 11.3707 2.5934 11.5409 2.83277C11.6454 2.9797 11.728 3.14181 11.8169 3.29945C11.8691 3.39189 11.9138 3.48836 11.9615 3.58303C12.1022 3.8626 12.1978 4.15868 12.2974 4.45477C12.4899 5.02551 12.5591 5.61545 12.5814 6.2103C12.5908 6.45815 12.5412 6.70913 12.5055 6.95699C12.4465 7.36695 12.3313 7.76308 12.1862 8.15071C12.0951 8.39366 12.0156 8.64151 11.9147 8.88043C11.7936 9.16759 11.6547 9.4476 11.5243 9.73118C11.4681 9.8531 11.4172 9.97725 11.3587 10.0978C11.3055 10.2068 11.2448 10.3117 11.1885 10.4189C11.1452 10.5015 11.105 10.5864 11.0612 10.669C10.8964 10.9776 10.7357 11.2889 10.5633 11.593C10.3601 11.9516 10.1471 12.3049 9.93628 12.6594C9.7764 12.9278 9.61697 13.1967 9.45084 13.4611C9.28158 13.7308 9.10339 13.9952 8.93057 14.2627C8.79882 14.4672 8.67289 14.6762 8.53802 14.879C8.3375 15.1804 8.13207 15.4783 7.92798 15.7775C7.75381 16.0325 7.58009 16.2884 7.40235 16.5412C7.27507 16.722 7.14065 16.8984 7.01114 17.078C6.88699 17.2503 6.76507 17.4245 6.64137 17.5973C6.55607 17.717 6.47032 17.8363 6.38279 17.9542C6.33724 18.0158 6.24257 18.0153 6.19746 17.9524C5.9965 17.6733 5.79821 17.3924 5.5968 17.1137C5.51106 16.9949 5.41817 16.8806 5.33242 16.7613C5.23641 16.6269 5.14575 16.4885 5.05107 16.3532C4.94925 16.2076 4.84341 16.0642 4.74248 15.9177C4.62191 15.7427 4.50445 15.5658 4.38656 15.3894C4.24454 15.1768 4.10119 14.9656 3.96141 14.7513C3.79081 14.4896 3.62379 14.2252 3.45498 13.9626C3.32993 13.7683 3.20176 13.5758 3.07985 13.3798C2.93783 13.1516 2.80118 12.9202 2.66273 12.6898C2.53546 12.4781 2.40639 12.2673 2.28269 12.0539C2.1447 11.8163 2.01027 11.5765 1.87764 11.3358C1.745 11.0951 1.61504 10.853 1.48643 10.6096C1.39488 10.4363 1.30645 10.2608 1.21937 10.0853C1.1171 9.87855 1.01707 9.67044 0.917477 9.46233C0.873265 9.36944 0.8295 9.27566 0.79154 9.18009C0.695971 8.93894 0.601741 8.69733 0.511084 8.45439C0.413728 8.19359 0.308781 7.93501 0.230628 7.6684C0.160514 7.42903 0.122108 7.17984 0.0698575 6.93511C-0.0105279 6.5573 -0.0149938 6.17502 0.0234126 5.79319C0.0631587 5.39751 0.11407 5.00139 0.226609 4.61911C0.344061 4.22031 0.48027 3.82598 0.675428 3.45754C0.88309 3.06589 1.10683 2.68227 1.40426 2.34912C1.61415 2.11332 1.8169 1.86859 2.04689 1.65423C2.25857 1.45684 2.50062 1.29205 2.7333 1.11788C2.86325 1.02052 2.99901 0.930761 3.13612 0.843677C3.22007 0.790533 3.30805 0.741855 3.3996 0.704342C3.7198 0.572599 4.04268 0.447555 4.36333 0.318045C4.75365 0.1604 5.16719 0.10413 5.57849 0.042948C5.81474 0.00811427 6.055 0.0148132 6.29303 0.00275534ZM9.43476 6.59258C9.41556 4.86875 8.01864 3.44727 6.26534 3.46156C4.51562 3.47585 3.09324 4.92726 3.15264 6.71092C3.20668 8.33649 4.56117 9.78432 6.38681 9.73207C8.06955 9.68473 9.41467 8.31148 9.43476 6.59258Z"
                  fill="#8C8C8C"
                />
              </svg>
              <p>{data?.locality}</p> / <p>{data?.city}</p>
            </span>
          </div>
          {/* main section  */}
          <div className="flex w-full justify-between max-md:flex-col max-md:flex my-3">
            {/* left section */}
            <div className="md:w-[64.5%] ">
              <SliderCard
                images={
                  Array.isArray(data?.images)
                    ? data.images
                    : data?.images
                    ? JSON.parse(data.images)
                    : []
                }
              />

              {/* for mobile */}
              <div className="md:hidden mx-auto w-full ">
                <TitleAndLogoMobile
                  enquirePop={enquirePop}
                  setEnquirePop={setEnquirePop}
                />
              </div>
              {/* about and text section */}
              <div className="mt-5 md:pl-2 px-1">
                <span className="flex gap-3 items-center whitespace-nowrap ">
                  <h2 className="font-semibold max-md:font-bold  uppercase md:text-xl">
                    description
                  </h2>
                  <span className="h-[1px] w-full bg-gray-200 "></span>
                </span>

                <p className="md:text-[13.5px] capitalize w-full text-[15px] mt-2 md:font-[500]">
                  {data?.description}
                </p>
              </div>

              {/* payment modes */}
              <div className="max-w-4xl  mt-5 pl-2">
                <span className="flex gap-3 items-center whitespace-nowrap ">
                  <h2 className="font-semibold max-md:font-bold  uppercase md:text-xl">
                    Payment Modes
                  </h2>
                  <span className="h-[1px] w-full bg-gray-200 "></span>
                </span>
                <p className="text-sm mt-2 max-md:font-semibold max-md:text-xs  mb-4">
                  {data?.business_name} provides the following Payment Methods:
                </p>
                <div className="flex flex-col  flex-wrap h-5 gap-4">
                  {payment?.map((payment, index) => (
                    <div key={index} className="flex items-center space-x-2">
                      <svg
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <circle cx="10" cy="10" r="10" fill="#FFE9D9" />
                        <path
                          d="M17.1515 5.32281C16.6874 4.89226 15.9337 4.89253 15.469 5.32281L7.8968 12.3386L4.53129 9.22053C4.06656 8.78998 3.31326 8.78998 2.84854 9.22053C2.38382 9.65109 2.38382 10.349 2.84854 10.7796L7.05526 14.677C7.28747 14.8922 7.59196 15 7.89648 15C8.201 15 8.50579 14.8924 8.738 14.677L17.1515 6.88182C17.6162 6.45156 17.6162 5.75334 17.1515 5.32281Z"
                          fill="#FF6E04"
                        />
                      </svg>

                      <span className=" text-[15px] flex flex-wrap max-w-full font-semibold">
                        {payment}
                      </span>
                    </div>
                  ))}
                </div>
              </div>
              {/* overview */}
              <div className="max-w-4xl  mt-10 pl-2">
                <h2 className="text-xl font-semibold uppercase">
                  Overview - {data?.name}
                </h2>
                <div className="text-[13px] font-[500] flex flex-col gap-5 mt-2 max-w-xl">
                  <p>
                    {`         ${data?.name} at ${data?.locality} is a Hotel in Dehradun. Their facilities
                    are :- Laundry Service, Internet Access, Parking Available,
                    Wedding services, Restaurant, Parking, their acceptable
                    payment mode is Cash & Other`}
                  </p>

                  <p>Scroll to the top for more details of {data?.name}</p>

                  <p>
                    Don&apos;t forget to tell, you found {data?.name} on{" "}
                    <strong className="text-[#FF6E04]">Address Guru</strong>
                  </p>
                </div>
              </div>
            </div>
            {/* right section */}

            <div className="md:w-[34%] max-md:hidden h-auto mb-10 flex flex-col gap-5 ">
              <QuickInformation />
              <div className="w-full h-[30rem] mb-7">
                <GetMoreInfo />
              </div>
              <UserInformation />
            </div>
          </div>

          {/* only for mobile */}
          <div className="md:hidden">
            <UserInformation />
          </div>

          {/* reviews section */}

          <div className=" h-70 w-full space-y-2  my-5">
            <div className="flex w-full items-center justify-between">
              <h1 className="text-xl max-md:text-xs font-semibold">
                Recent Customer Reviews
              </h1>
              <button className="text-[#6D6D6D] max-md:scale-75 border rounded-sm text-sm px-3 py-1 font-[500]">
                View More
              </button>
            </div>
            <div className=" py-2 md:pl-4 flex md:justify-between max-md:gap-5 md:max-w-6xl overflow-x-scroll hide-scroll w-full ">
              {reviews.map((item, index) => {
                return <RecentCustomerReviewCard key={index} data={item} />;
              })}
            </div>
          </div>
          {/* rest is footer  */}
        </div>
      </div>

      {enquirePop && (
        <div className=" inset-0 flex items-center fixed justify-center backdrop-blur-sm z-50 py-20 px-5 ">
          <GetMoreInfo setEnquirePop={setEnquirePop} />
        </div>
      )}
    </>
  );
};

export default SeeDetails;
