import React, { useEffect, useRef, useState } from "react";
import InputWithTitle from "../InputWithTitle";
import axios from "axios";
import { API_URL } from "@/services/constants";

const ContactDetails = ({ contact, setContact, error, clearError, refs }) => {
  const [cities, setCities] = useState([]);
  const [isOpen, setIsOpen] = useState(false);
  const dropdownRef = useRef();

  useEffect(() => {
    const fetchCities = async () => {
      try {
        const res = await axios.get(`${API_URL}/cities`);
        setCities(res?.data || []);
      } catch (err) {
        console.error("Client-side error:", err);
      }
    };
    fetchCities();
  }, []);

  // Close dropdown if clicked outside
  useEffect(() => {
    const handleClickOutside = (e) => {
      if (dropdownRef.current && !dropdownRef.current.contains(e.target)) {
        setIsOpen(false);
      }
    };
    document.addEventListener("mousedown", handleClickOutside);
    return () => document.removeEventListener("mousedown", handleClickOutside);
  }, []);

  const handleChange = (field, value, errorKey) => {
    setContact((prev) => ({
      ...prev,
      [field]: value,
    }));

    // Clear error when user starts typing
    if (clearError && errorKey) {
      clearError(errorKey);
    }
  };

  const handleCitySelect = (cityName) => {
    handleChange("city", cityName, "contactCity");
    setIsOpen(false);
  };

  return (
    <section>
      <h3 className="text-xl font-semibold uppercase my-10 text-gray-800">
        business contact details
      </h3>
      <div className="space-y-4">
        {/* Row 1: Full Name & Email */}
        <div className="grid grid-cols-2 gap-5">
          <div ref={refs?.contactNameRef}>
            <InputWithTitle
              error={error?.contactName}
              title={"Full Name"}
              isTextarea={false}
              placeholder={"Enter Full Name"}
              value={contact.name}
              onChange={(e) =>
                handleChange("name", e.target.value, "contactName")
              }
            />
          </div>

          <div ref={refs?.contactEmailRef}>
            <InputWithTitle
              error={error?.contactEmail}
              title="Email"
              isTextarea={false}
              placeholder="Enter Email"
              value={contact.email}
              onChange={(e) =>
                handleChange("email", e.target.value, "contactEmail")
              }
            />
          </div>
        </div>

        {/* Row 2: Mobile Number & Alternate Number */}
        <div className="grid grid-cols-2 gap-5">
          <div ref={refs?.contactNumberRef}>
            <InputWithTitle
              error={error?.contactNumber}
              title="Mobile Number"
              isTextarea={false}
              placeholder="Primary Number"
              value={contact.number}
              onChange={(e) =>
                handleChange("number", e.target.value, "contactNumber")
              }
            />
          </div>

          <div ref={refs?.contactAltNumberRef}>
            <InputWithTitle
              error={error?.contactAltNumber}
              title="Alternate Number"
              isTextarea={false}
              placeholder="Optional"
              value={contact.altNumber}
              onChange={(e) =>
                handleChange("altNumber", e.target.value, "contactAltNumber")
              }
            />
          </div>
        </div>

        {/* Row 3: Locality/Landmark & City */}
        <div className="grid grid-cols-2 gap-5">
          <div ref={refs?.contactLandmarkRef}>
            <InputWithTitle
              error={error?.contactLandmark}
              title="Locality / Landmark"
              isTextarea={true}
              rows={3}
              placeholder="Near by place name"
              value={contact.landmark}
              onChange={(e) =>
                handleChange("landmark", e.target.value, "contactLandmark")
              }
            />
          </div>

          {/* City Dropdown */}
          <div ref={refs?.contactCityRef}>
            <h3 className="text-[#696969] 2xl:text-lg relative capitalize font-semibold mb-2">
              City
              <span className="text-red-600 ml-1">&#42;</span>
            </h3>
            <div className="relative w-full" ref={dropdownRef}>
              <div
                className={`flex justify-between items-center w-full px-4 py-2 bg-white border ${
                  error?.contactCity ? "border-red-500" : "border-gray-200"
                } cursor-pointer rounded-lg shadow-sm text-left hover:border-orange-600 focus:outline-none`}
                onClick={() => setIsOpen(!isOpen)}
              >
                <span
                  className={`font-semibold ${
                    contact?.city ? "text-gray-800" : "text-gray-400"
                  }`}
                >
                  {contact?.city || "Select City"}
                </span>
                <svg
                  className={`transition-transform duration-200 ${
                    isOpen ? "rotate-180" : ""
                  }`}
                  width="14"
                  height="7"
                  viewBox="0 0 14 7"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fillRule="evenodd"
                    clipRule="evenodd"
                    d="M7.98343 6.68574C7.54169 7.05908 6.8254 7.05908 6.38366 6.68574L0.727562 1.90552C0.2858 1.53215 0.2858 0.926819 0.727562 0.553454C1.16934 0.180099 1.88558 0.180099 2.32735 0.553454L7.18354 4.65768L12.0397 0.553454C12.4815 0.180099 13.1978 0.180099 13.6395 0.553454C14.0813 0.926819 14.0813 1.53215 13.6395 1.90552L7.98343 6.68574Z"
                    fill="#FF6E04"
                  />
                </svg>
              </div>

              {/* Error Message */}
              {error?.contactCity && (
                <p className="text-red-500 text-sm mt-1">{error.contactCity}</p>
              )}

              {/* Dropdown Menu */}
              {isOpen && (
                <div className="absolute z-50 mt-1 bg-white shadow-lg border rounded-lg border-orange-600 w-full max-h-[200px] overflow-y-auto">
                  {cities && cities.length > 0 ? (
                    cities.map((cityName, index) => (
                      <div
                        key={index}
                        onClick={() => handleCitySelect(cityName)}
                        className={`px-4 py-2 cursor-pointer font-medium hover:bg-orange-100 transition-colors ${
                          contact?.city === cityName
                            ? "bg-orange-50 text-orange-600 font-semibold"
                            : "text-gray-700"
                        }`}
                      >
                        {cityName}
                      </div>
                    ))
                  ) : (
                    <div className="px-4 py-2 text-gray-500 text-sm">
                      No cities available
                    </div>
                  )}
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default ContactDetails;
