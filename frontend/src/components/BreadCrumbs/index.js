import { useAuth } from "@/context/AuthContext";
import { useRouter } from "next/router";
import React from "react";

const BreadCrumbs = ({ slug, name, length, type }) => {
  const { city } = useAuth();
  const router = useRouter();
  const handleSlugClick = () => {
    if (slug && type) router.back(); // go back to previous page
  };
  return (
    <div className="">
      <span className="text-xs flex items-center max-md:text-[11x] font-medium gap-[4px] ">
        {/* City */}
        <span>{city}</span>

        {/* If SLUG */}
        {slug && (
          <span
            className={`cursor-pointer font-semibold ${type && "text-orange-500"} `}
            onClick={handleSlugClick}
          >
            {">"} {slug}
          </span>
        )}

        {/* TYPE will come BEFORE name if exists */}
        {type && (
          <span className="font-medium ">
            {">"} {type}
          </span>
        )}

        {/* Name */}
        {name && (
          <strong className="flex gap-[2px]">
            {/* {">"} */}
            {length && (
              <span>
                {length}
                {"+"}
              </span>
            )}
            {name}
          </strong>
        )}
      </span>
    </div>
  );
};

export default BreadCrumbs;
