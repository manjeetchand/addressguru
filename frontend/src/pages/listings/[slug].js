// import BreadCrumbs from "@/components/BreadCrumbs";
// import DiscoverCard from "@/components/BusinessListingComponents/DiscoverCard";
// import Filters from "@/components/MarketplaceAndToLet/Filter";
// import RecentListingCard from "@/components/RecentListingCard";
// import React, { useEffect, useState } from "react";
// import { useRouter } from "next/router";
// import HelpFull from "@/components/Helpfull";
// import { get_marketplace_listing } from "@/api/showlistings";
// import { get_marketplace_category, get_sub_category } from "@/api/Categories";

// const Marketplace = () => {
//   const router = useRouter();
//   const slug = router?.query?.slug;
//   const [marketplaceCategory, setMarketplaceCategory] = useState(null);
//   const [marketplaceData, setMarketplaceData] = useState(null);

//   useEffect(() => {
//     getListings();
//     getSubCategories();
//   }, []);

//   const getListings = async () => {
//     const res = await get_marketplace_listing();
//     setMarketplaceData(res);
//     console.log("market-place listings", res);
//   };

//   const getSubCategories = async () => {
//     const res = await get_sub_category("marketplace");
//     // console.log("marketplace categories", res);
//     if (res?.success === true) {
//       setMarketplaceCategory(res?.result);
//     }
//   };

//   return (
//     <div className="flex flex-col items-center w-full  justify-center   bg-[#F8F7F7] ">
//       <div className=" md:w-[80%]  max-md:w-[96%] bg-white max-md:border border-gray-200 max-md:rounded-lg pb-10 md:pl-3 ">
//         <BreadCrumbs />
//         <h1 className="capitalize font-semibold max-md:hidden text-2xl">
//           {" "}
//           top {slug} in Singapore
//         </h1>
//         <div className="flex md:gap-1 mt-2 relative min-h-screen ">
//           {/* filter section */}
//           <div className=" mt-2 h-auto sticky max-md:hidden self-start top-20 w-[20%]">
//             <Filters category={marketplaceCategory} />
//           </div>
//           <div className=" h-auto md:w-[80%] max-md:w-full  flex  justify-start  ">
//             {/* main flex section */}
//             <div className=" flex  md:gap-3 2xl:gap-4 gap-2 flex-wrap max-md:justify-center md:p-2 ">
//               {marketplaceData?.map((item,index) => (
//                 <RecentListingCard
//                  key={index}
//                   data={item}
//                   img={slug === "to-let" ? 1 : 1}
//                   width={"23.7%"}
//                 />
//               ))}

//               {/* {slug === "to-let" && (
//                 <div className="md:h-[275px] md:w-[23.7%] w-[240px] max-md:w-auto p-2 max-md:min-w-[175px] max-[350px]:w-[90%] max-md:h-[247px] rounded-lg 2xl:h-[350px] bg-[#DAECFD] flex items-center justify-center">
//                   <div className=" mx-auto  ">
//                     <p className="text-md max-md:text-sm font-[500]">
//                       Looking For <strong>Buyer</strong>
//                     </p>
//                     <button className="bg-[#FF6E04] rounded-sm text-white font-semibold text-sm max-md:text-xs px-2 py-1">
//                       Post Your Ads Today
//                     </button>
//                   </div>
//                 </div>
//               )} */}

//               {/* div of best deals */}
//               {slug === "marketplace" && (
//                 <div className="md:h-[275px] md:w-[23.7%] min-w-[180px] p-2 rounded-lg 2xl:h-[350px] bg-[#DAECFD] flex items-center justify-center">
//                   <div>
//                     <p className="text-md font-[500]">
//                       Looking For <strong>Buyer</strong>
//                     </p>
//                     <button className="bg-[#FF6E04] rounded-sm text-white font-semibold text-sm px-2 py-1">
//                       Post Your Ads Today
//                     </button>
//                   </div>
//                 </div>
//               )}

//               {/* <DiscoverCard helpful={false} layout={"row"} /> */}

//               <div className="w-[97%]">
//                 <HelpFull layout={"row"} />

//                 {/* <DiscoverCard helpful={true} layout={"row"} /> */}
//               </div>
//             </div>
//           </div>
//         </div>
//       </div>
//     </div>
//   );
// };

// export default Marketplace;

import React from "react";

const Marketplace = () => {
  return (
    <div className=" max-w-[2000px] flex items-center justify-center">
      <div className="text-center w-[80%] mx-auto bg-white h-[60vh] p-10">
        <h1 className="text-6xl md:text-8xl font-bold text-orange-500 mb-6">
          AddressGuru
        </h1>
        <p className="text-2xl md:text-3xl text-gray-600">Coming Soon</p>
      </div>
    </div>
  );
};

export default Marketplace;
