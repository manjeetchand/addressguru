// import React, { useState } from "react";
// import ProgressBar from "./ProgressBar";

// const Filters = () => {
//   const [workMode, setWorkMode] = useState("Work from Home");
//   const [salary, setSalary] = useState(5);
//   const [experience, setExperience] = useState(3);
//   const [state, setState] = useState("Uttarakhand");

//   return (
//     <div className="border border-[#F5F5F5] rounded-xl ">
//       {/* filter heading */}
//       <span className="bg-[#F5F5F5] flex gap-2 rounded-t-lg px-3 py-2 items-center">
//         <svg
//           width="16"
//           height="14"
//           viewBox="0 0 16 14"
//           fill="none"
//           xmlns="http://www.w3.org/2000/svg"
//         >
//           <path
//             d="M13.4668 12.622C13.1323 12.622 12.7979 12.6263 12.4638 12.6194C12.3516 12.6173 12.2977 12.6501 12.251 12.7584C11.8872 13.6 11.0172 14.0928 10.1035 13.9854C9.21963 13.8814 8.48292 13.1891 8.31849 12.3078C8.12471 11.2677 8.74576 10.2557 9.76989 9.94321C10.7578 9.64197 11.8367 10.1396 12.2493 11.0964C12.2989 11.2116 12.3555 11.2418 12.4737 11.2405C13.153 11.2349 13.8328 11.2345 14.5121 11.2397C14.8651 11.2423 15.1353 11.4874 15.1892 11.837C15.238 12.1525 15.0498 12.471 14.7387 12.5737C14.6338 12.6082 14.5168 12.6181 14.4055 12.6203C14.0922 12.6259 13.7793 12.622 13.4668 12.622Z"
//             fill="#5B5B5B"
//           />
//           <path
//             d="M1.70395 7.78055C1.37509 7.78055 1.04579 7.78357 0.716929 7.77969C0.301318 7.77451 -0.00553482 7.47499 7.57042e-05 7.08528C0.00525465 6.69945 0.306497 6.40813 0.714771 6.40554C1.38372 6.40166 2.05267 6.40166 2.72118 6.40684C2.839 6.4077 2.8977 6.37749 2.94776 6.26183C3.33575 5.36587 4.30465 4.86567 5.25498 5.06031C6.21309 5.25625 6.91052 6.10646 6.91527 7.08312C6.91958 8.06108 6.23985 8.90395 5.27268 9.11931C4.33399 9.32863 3.35129 8.83274 2.95596 7.93937C2.90115 7.81551 2.83943 7.77365 2.70737 7.77753C2.37333 7.78703 2.03842 7.78098 1.70395 7.78055Z"
//             fill="#5B5B5B"
//           />
//           <path
//             d="M11.0558 2.2462C11.0661 1.09518 11.9897 0.178933 13.1312 0.188428C14.2874 0.197922 15.2123 1.13229 15.1972 2.27641C15.1821 3.41837 14.2456 4.34022 13.1088 4.33159C11.9694 4.32296 11.0454 3.38427 11.0558 2.2462Z"
//             fill="#5B5B5B"
//           />
//           <path
//             d="M4.83226 2.94769C3.46286 2.94769 2.09303 2.94898 0.723626 2.94682C0.242847 2.94639 -0.0808376 2.55107 0.0205835 2.09834C0.0822993 1.8217 0.311899 1.61497 0.608826 1.57311C0.667089 1.56491 0.727079 1.56404 0.786205 1.56404C3.48746 1.56361 6.18871 1.56361 8.88997 1.56404C9.26458 1.56404 9.52482 1.72804 9.63013 2.02583C9.78938 2.47813 9.4631 2.94164 8.97369 2.94639C8.36991 2.952 7.76613 2.94812 7.16192 2.94812C6.38508 2.94769 5.60867 2.94769 4.83226 2.94769Z"
//             fill="#5B5B5B"
//           />
//           <path
//             d="M3.45544 12.622C2.55474 12.622 1.65403 12.6233 0.752894 12.6216C0.351957 12.6207 0.0740202 12.3989 0.0118728 12.0385C-0.0567483 11.641 0.238883 11.2664 0.644136 11.2401C0.724841 11.2349 0.805978 11.2379 0.886684 11.2379C2.64494 11.2379 4.40362 11.2375 6.16188 11.2384C6.53131 11.2384 6.81011 11.4421 6.8852 11.7627C6.99223 12.2189 6.66639 12.6181 6.17396 12.6211C5.44027 12.6259 4.70702 12.6224 3.97334 12.6224C3.80071 12.622 3.62807 12.622 3.45544 12.622Z"
//             fill="#5B5B5B"
//           />
//           <path
//             d="M11.7595 6.40487C12.671 6.40487 13.5825 6.40098 14.494 6.40659C14.9649 6.40961 15.2786 6.81012 15.175 7.25724C15.109 7.54122 14.8583 7.75571 14.5657 7.77686C14.5225 7.77988 14.4793 7.78074 14.4362 7.78074C12.6399 7.78074 10.8441 7.78117 9.04792 7.78074C8.64439 7.78074 8.37249 7.57488 8.30517 7.22444C8.22489 6.80839 8.52053 6.4217 8.94434 6.40918C9.34873 6.39753 9.75311 6.40487 10.1579 6.40487C10.6918 6.40444 11.2257 6.40487 11.7595 6.40487Z"
//             fill="#5B5B5B"
//           />
//         </svg>
//         <h2 className="text-sm font-semibold text-[#5B5B5B] ">Filters</h2>
//       </span>

//       <div className="px-3 py-2 space-y-4 ">
//         {/* WORK MODE */}
//         <div>
//           <span className="flex  gap-2 ">
//             <h3 className="text-[13px] font-semibold mb-2">WORK MODE</h3>
//             <svg
//               className="relative top-[9px]"
//               width="58"
//               height="1"
//               viewBox="0 0 58 1"
//               fill="none"
//               xmlns="http://www.w3.org/2000/svg"
//             >
//               <line y1="0.5" x2="58" y2="0.5" stroke="black" />
//             </svg>
//           </span>
//           {["Work from Home", "Work from Office", "Hybrid", "Remote"].map(
//             (mode) => (
//               <label
//                 key={mode}
//                 className="block text-xs mb-1 cursor-pointer pl-3"
//               >
//                 <span className="flex gap-2 items-center ">
//                   <span className="h-3 w-3 rounded-full border"></span>
//                   <p className="">{mode}</p>
//                 </span>
//               </label>
//             )
//           )}
//           <div className="mt-4 flex gap-2">
//             <button className="text-[10px] font-semibold cursor-pointer bg-black text-white px-2 py-1 rounded">
//               APPLIED
//             </button>
//             <button className="text-xs border px-2 cursor-pointer py-1 text-[10px] font-semibold rounded">
//               CLEAR
//             </button>
//           </div>
//         </div>
//         {/* SALARY RANGE and experience section */}
//         <div>
//           <h3>Salary Range</h3>
//           <input type="radio" />
//           <label className="text-sm" htmlFor="salary">under, 3000000</label>
//         </div>

//         {/* STATE */}
//         <div>
//           <h3 className="text-sm font-semibold mt-7 mb-2">STATE</h3>
//           <label className="block text-xs ml-3">
//             <input
//               type="checkbox"
//               checked={state === "Uttarakhand"}
//               onChange={() => setState("Uttarakhand")}
//               className="mr-2"
//             />
//             Uttarakhand (1100)
//           </label>
//           <div className="mt-2  ml-3 flex gap-2">
//             <button className="text-[10px] font-semibold bg-orange-500 cursor-pointer text-white px-2 py-1 rounded">
//               APPLY
//             </button>
//             <button className="text-[10px] font-semibold text-gray-800 border cursor-pointer border-gray-400 px-2 py-1 rounded">CLEAR</button>
//           </div>
//         </div>
//       </div>
//     </div>
//   );
// };

// export default Filters;

import React, { useState } from "react";
import { ChevronDown, ChevronUp, X } from "lucide-react";

const JobFilters = () => {
  const [expandedSections, setExpandedSections] = useState({
    workMode: true,
    experience: true,
    salary: true,
    location: true,
    industry: true,
    jobType: true,
  });

  const [filters, setFilters] = useState({
    workMode: [],
    experience: [],
    salary: [],
    location: [],
    industry: [],
    jobType: [],
  });

  const toggleSection = (section) => {
    setExpandedSections((prev) => ({
      ...prev,
      [section]: !prev[section],
    }));
  };

  const handleFilterChange = (category, value) => {
    setFilters((prev) => {
      const currentFilters = prev[category];
      if (currentFilters.includes(value)) {
        return {
          ...prev,
          [category]: currentFilters.filter((item) => item !== value),
        };
      } else {
        return {
          ...prev,
          [category]: [...currentFilters, value],
        };
      }
    });
  };

  const clearAllFilters = () => {
    setFilters({
      workMode: [],
      experience: [],
      salary: [],
      location: [],
      industry: [],
      jobType: [],
    });
  };

  const getTotalActiveFilters = () => {
    return Object.values(filters).flat().length;
  };

  const FilterSection = ({ title, items, category, showCount = false }) => {
    const [searchTerm, setSearchTerm] = useState("");
    const [showAll, setShowAll] = useState(false);

    const filteredItems = items.filter((item) =>
      item.label.toLowerCase().includes(searchTerm.toLowerCase())
    );

    const displayItems = showAll ? filteredItems : filteredItems.slice(0, 5);

    return (
      <div className="border-b border-gray-200 py-2">
        <button
          onClick={() => toggleSection(category)}
          className="flex items-center justify-between w-full  text-left"
        >
          <h3 className="font-semibold text-gray-900 text-sm">{title}</h3>
          {expandedSections[category] ? (
            <ChevronUp className="w-4 h-4 text-gray-600" />
          ) : (
            <ChevronDown className="w-4 h-4 text-gray-600" />
          )}
        </button>

        {expandedSections[category] && (
          <div className="mt-1 space-y-[1px]">
            {items.length > 5 && (
              <input
                type="text"
                placeholder="Search..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="w-full px-3 py-1 text-xs border border-gray-300 rounded focus:outline-none focus:border-blue-500"
              />
            )}

            <div className=" max-h-60  overflow-y-auto">
              {displayItems.map((item) => (
                <label
                  key={item.value}
                  className="flex items-center cursor-pointer  hover:bg-gray-50 p-1 rounded"
                >
                  <input
                    type="checkbox"
                    checked={filters[category].includes(item.value)}
                    onChange={() => handleFilterChange(category, item.value)}
                    className="w-3 h-3 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                  />
                  <span className="ml-2 text-[11px] text-gray-700 flex-1">
                    {item.label}
                  </span>
                  {showCount && (
                    <span className="text-[11px] text-gray-500">
                      ({item.count})
                    </span>
                  )}
                </label>
              ))}
            </div>

            {filteredItems.length > 5 && (
              <button
                onClick={() => setShowAll(!showAll)}
                className="text-orange-600 text-xs font-semibold hover:text-orange-700 mt-2"
              >
                {showAll ? "Show Less" : `Show All (${filteredItems.length})`}
              </button>
            )}
          </div>
        )}
      </div>
    );
  };

  const workModeOptions = [
    { label: "Work from Home", value: "wfh" },
    { label: "Work from Office", value: "wfo" },
    { label: "Hybrid", value: "hybrid" },
  ];

  const experienceOptions = [
    { label: "Fresher (0-1 years)", value: "0-1" },
    { label: "1-3 years", value: "1-3" },
    { label: "3-5 years", value: "3-5" },
    { label: "5-7 years", value: "5-7" },
    { label: "7-10 years", value: "7-10" },
    { label: "10+ years", value: "10+" },
  ];

  const salaryOptions = [
    { label: "S$0 - S$3,000", value: "0-3000" },
    { label: "S$3,000 - S$5,000", value: "3000-5000" },
    { label: "S$5,000 - S$8,000", value: "5000-8000" },
    { label: "S$8,000 - S$12,000", value: "8000-12000" },
    { label: "S$12,000 - S$20,000", value: "12000-20000" },
    { label: "S$20,000+", value: "20000+" },
  ];

  const locationOptions = [
    { label: "Central Region", value: "central", count: 2450 },
    { label: "Orchard", value: "orchard", count: 1230 },
    { label: "Marina Bay", value: "marina", count: 890 },
    { label: "Raffles Place", value: "raffles", count: 1560 },
    { label: "Tanjong Pagar", value: "tanjong", count: 780 },
    { label: "Jurong", value: "jurong", count: 650 },
    { label: "Woodlands", value: "woodlands", count: 420 },
    { label: "Changi", value: "changi", count: 340 },
  ];

  const industryOptions = [
    { label: "IT Services & Consulting", value: "it", count: 3200 },
    { label: "Banking & Financial Services", value: "finance", count: 2800 },
    { label: "E-commerce", value: "ecommerce", count: 1500 },
    { label: "Healthcare", value: "healthcare", count: 980 },
    { label: "Manufacturing", value: "manufacturing", count: 1200 },
    { label: "Retail", value: "retail", count: 750 },
    { label: "Education", value: "education", count: 620 },
    { label: "Hospitality", value: "hospitality", count: 450 },
  ];

  const jobTypeOptions = [
    { label: "Permanent", value: "permanent" },
    { label: "Contract", value: "contract" },
    { label: "Part-time", value: "parttime" },
    { label: "Internship", value: "internship" },
  ];

  return (
    <div className="bg-white rounded-lg border border-gray-200 shadow-sm">
      {/* Header */}
      <div className="p-4 border-b border-gray-200 bg-gray-50">
        <div className="flex items-center justify-between">
          <h2 className="font-semibold text-gray-800">All Filters</h2>
          {getTotalActiveFilters() > 0 && (
            <button
              onClick={clearAllFilters}
              className="text-blue-600 text-xs font-semibold hover:text-blue-700 flex items-center gap-1"
            >
              <X className="w-3 h-3" />
              Clear All ({getTotalActiveFilters()})
            </button>
          )}
        </div>
      </div>

      {/* Active Filters */}
      {getTotalActiveFilters() > 0 && (
        <div className="p-4 border-b border-gray-200 bg-blue-50">
          <div className="flex flex-wrap gap-2">
            {Object.entries(filters).map(([category, values]) =>
              values.map((value) => (
                <span
                  key={`${category}-${value}`}
                  className="inline-flex items-center gap-1 bg-white border border-blue-300 text-blue-700 px-3 py-1 rounded-full text-xs"
                >
                  {value}
                  <button
                    onClick={() => handleFilterChange(category, value)}
                    className="hover:text-blue-900"
                  >
                    <X className="w-3 h-3" />
                  </button>
                </span>
              ))
            )}
          </div>
        </div>
      )}

      {/* Filter Sections */}
      <div className="p-4">
        <FilterSection
          title="Work Mode"
          items={workModeOptions}
          category="workMode"
        />
        <FilterSection
          title="Experience"
          items={experienceOptions}
          category="experience"
        />
        <FilterSection
          title="Salary (per month)"
          items={salaryOptions}
          category="salary"
        />
        <FilterSection
          title="Location"
          items={locationOptions}
          category="location"
          showCount={true}
        />
        <FilterSection
          title="Industry"
          items={industryOptions}
          category="industry"
          showCount={true}
        />
        <FilterSection
          title="Job Type"
          items={jobTypeOptions}
          category="jobType"
        />
      </div>

      {/* Footer Actions */}
      <div className="p-4 border-t border-gray-200 bg-gray-50">
        <button className="w-full text-orange-600 text-sm border border-orange-600 py-2.5 rounded font-semibold hover:bg-blue-700 transition-colors">
          Apply Filters
        </button>
      </div>
    </div>
  );
};

export default JobFilters;
