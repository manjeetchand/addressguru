import { add_properties_listing, get_service_facility } from "@/api/forms";
import { get_plans } from "@/api/plans";
import CheckBox from "@/components/Forms/CheckBox";
import DropDown from "@/components/Forms/DropDown";
import InputWithTitle from "@/components/Forms/InputWithTitle";
import Navbar from "@/components/Forms/Navbar";
import Steps from "@/components/Forms/Steps";
import PricingTable from "@/components/Plans/PricingTable";
import Footer from "@/layout/footer";
import Image from "next/image";
import { useRouter } from "next/router";
import React, { useEffect, useRef, useState } from "react";
import { FaUpload } from "react-icons/fa";
import { MdCancel } from "react-icons/md";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";

const PropertiesListing = () => {
  const router = useRouter();
  const categoryId = router?.query?.id;
  const type = router?.query?.type;

  const [isDragOver, setIsDragOver] = useState(false);
  const [selectedFacilities, setSelectedFacilities] = useState([]);
  const [selectedServices, setSelectedServices] = useState([]);
  const [service, setService] = useState([]);
  const [facility, setFacility] = useState([]);
  const [plans, setPlans] = useState(null);
  const [selectedPlanId, setSelectedPlanId] = useState(null);
  const [listingId, setListingId] = useState(null);
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [errors, setErrors] = useState({});
  const [startDate, setStartDate] = useState(new Date());

  // Refs for error scrolling
  const rentByRef = useRef(null);
  const availableRef = useRef(null);
  const sizeRef = useRef(null);
  const caeRef = useRef(null);
  const descriptionRef = useRef(null);
  const priceRef = useRef(null);
  const facilitiesRef = useRef(null);
  const imagesRef = useRef(null);
  const contactNameRef = useRef(null);
  const emailRef = useRef(null);
  const cityRef = useRef(null);
  const mobileRef = useRef(null);
  const localityRef = useRef(null);
  const planRef = useRef(null);

  // Section 1: Property Information
  const [propertyInfo, setPropertyInfo] = useState({
    rentBy: "",
    size: "",
    caeNumber: "",
    description: "",
    priceType: "amount",
    amount: "",
  });

  // Section 2: Media (Images)
  const [media, setMedia] = useState({
    images: [],
  });

  // Section 3: Contact Details
  const [contactDetails, setContactDetails] = useState({
    contactName: "",
    email: "",
    city: "",
    mobileNumber: "",
    locality: "",
  });

  const multipleInputRef = useRef(null);

  // Steps state
  const [steps, setSteps] = useState([
    {
      step: 1,
      title: "Property Information",
      description: "Update your property details and info",
      active: true,
      completed: false,
    },
    {
      step: 2,
      title: "Add Photos",
      description: "Add your property images",
      active: false,
      completed: false,
    },
    {
      step: 3,
      title: "Contact Details",
      description: "Add your contact details for buyers to connect",
      active: false,
      completed: false,
    },
    {
      step: 4,
      title: "Payment",
      description: "Proceed for payment",
      active: false,
      completed: false,
    },
  ]);

  const currentStep = steps.find((step) => step.active)?.step || 1;
  const setActiveStep = (stepNumber) => {
    setSteps((prevSteps) =>
      prevSteps.map((step) => ({
        ...step,
        active: step.step === stepNumber,
        completed: step.step < stepNumber ? true : step.completed,
      }))
    );
  };
  // Dropdown options
  const rentByOptions = [
    { value: "owner", label: "Owner" },
    { value: "broker", label: "Broker" },
    { value: "agency", label: "Agency" },
  ];
  const priceOptions = [
    { value: "amount", label: "Amount" },
    { value: "free", label: "Free" },
    { value: "swap/trade", label: "Swap/Trade" },
    { value: "contact for price", label: "Contact For Price" },
  ];
  // Fetch service and facility
  const getServiceAndFacility = async (categoryId) => {
    const res = await get_service_facility(categoryId);
    if (res?.success === true) {
      const facilities = res?.data?.facilitis || [];
      const services = res?.data?.service || [];
      setFacility(facilities.length > 0 ? facilities : []);
      setService(services.length > 0 ? services : []);
    }
  };
  const getPlansData = async () => {
    try {
      const res = await get_plans();
      setPlans(res?.data);
    } catch (error) {
      console.log("error in fetching plans", error);
    }
  };
  useEffect(() => {
    if (categoryId) {
      getServiceAndFacility(categoryId);
    }
    getPlansData();
  }, [categoryId]);
  // Handle multiple images upload
  const handleMultipleUpload = (files) => {
    const imageFiles = Array.from(files).filter((file) =>
      file.type.startsWith("image/")
    );
    if (media.images.length + imageFiles.length > 10) {
      alert("Maximum 10 images allowed");
      return;
    }
    imageFiles.forEach((file) => {
      const reader = new FileReader();
      reader.onload = (e) => {
        setMedia((prev) => ({
          ...prev,
          images: [
            ...prev.images,
            {
              id: Date.now() + Math.random(),
              file: file,
              preview: e.target.result,
              name: file.name,
            },
          ],
        }));
      };
      reader.readAsDataURL(file);
    });
  };
  // Drag & Drop handlers
  const handleDragOver = (e) => {
    e.preventDefault();
    setIsDragOver(true);
  };
  const handleDragLeave = (e) => {
    e.preventDefault();
    setIsDragOver(false);
  };
  const handleDrop = (e) => {
    e.preventDefault();
    setIsDragOver(false);
    handleMultipleUpload(e.dataTransfer.files);
  };
  // Remove single image
  const removeImage = (id) => {
    setMedia((prev) => ({
      ...prev,
      images: prev.images.filter((img) => img.id !== id),
    }));
  };
  // Handler functions
  const handlePropertyInfoChange = (field, value) => {
    setPropertyInfo((prev) => ({
      ...prev,
      [field]: value,
    }));
    clearError(field);
  };
  const handleContactDetailsChange = (field, value) => {
    setContactDetails((prev) => ({
      ...prev,
      [field]: value,
    }));
    clearError(field);
  };
  // Clear specific error
  const clearError = (errorKey) => {
    if (errors[errorKey]) {
      setErrors((prev) => {
        const newErrors = { ...prev };
        delete newErrors[errorKey];
        return newErrors;
      });
    }
  };
  // Scroll to first error field
  const scrollToError = (errorKey) => {
    const errorRefMap = {
      rentBy: rentByRef,
      available: availableRef,
      size: sizeRef,
      caeNumber: caeRef,
      description: descriptionRef,
      amount: priceRef,
      facilities: facilitiesRef,
      images: imagesRef,
      contactName: contactNameRef,
      email: emailRef,
      city: cityRef,
      mobileNumber: mobileRef,
      locality: localityRef,
      plan: planRef,
    };
    const ref = errorRefMap[errorKey];
    if (ref?.current) {
      ref.current.scrollIntoView({
        behavior: "smooth",
        block: "center",
      });
      if (ref.current.querySelector("input, textarea")) {
        setTimeout(() => {
          ref.current.querySelector("input, textarea")?.focus();
        }, 500);
      }
    }
  };
  // Validation function
  const validateStep = (step) => {
    let newErrors = {};
    if (step === 1) {
      if (!propertyInfo.rentBy) {
        newErrors.rentBy = "Please select who is listing the property";
      }
      if (!startDate) {
        newErrors.available = "Available date is required";
      }
      if (!propertyInfo.size.trim()) {
        newErrors.size = "Size is required";
      }
      if (!propertyInfo.description.trim()) {
        newErrors.description = "Description is required";
      }
      if (propertyInfo.priceType === "amount" && !propertyInfo.amount.trim()) {
        newErrors.amount = "Amount is required";
      }
      if (facility.length > 0 && selectedFacilities.length === 0) {
        newErrors.facilities = "Please select at least one facility";
      }
    }

    if (step === 2) {
      if (media.images.length === 0) {
        newErrors.images = "Please upload at least one image";
      }
    }

    if (step === 3) {
      if (!contactDetails.contactName.trim()) {
        newErrors.contactName = "Contact name is required";
      }
      if (!contactDetails.email.trim()) {
        newErrors.email = "Email is required";
      } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(contactDetails.email)) {
        newErrors.email = "Enter a valid email";
      }
      if (!contactDetails.city.trim()) {
        newErrors.city = "City is required";
      }
      if (!contactDetails.mobileNumber.trim()) {
        newErrors.mobileNumber = "Mobile number is required";
      } else if (!/^[6-9]\d{9}$/.test(contactDetails.mobileNumber)) {
        newErrors.mobileNumber = "Enter a valid mobile number";
      }
      if (!contactDetails.locality.trim()) {
        newErrors.locality = "Locality is required";
      }
    }

    if (step === 4) {
      if (!selectedPlanId) {
        newErrors.plan = "Please select a plan";
      }
    }

    setErrors(newErrors);

    if (Object.keys(newErrors).length > 0) {
      const firstErrorKey = Object.keys(newErrors)[0];
      setTimeout(() => scrollToError(firstErrorKey), 100);
    }

    return Object.keys(newErrors).length === 0;
  };
  // Submit handler for each step
  const handleStepSubmit = async (stepNumber) => {
    if (!validateStep(stepNumber)) {
      return;
    }
    setIsSubmitting(true);
    const formData = new FormData();
    formData.append("category_id", categoryId);
    formData.append("type", type);
    formData.append("step", stepNumber);

    if (listingId) {
      formData.append("listing_id", listingId);
    }
    switch (stepNumber) {
      case 1:
        formData.append("rent_by", propertyInfo.rentBy);
        formData.append(
          "available_date",
          startDate.toISOString().split("T")[0]
        );
        formData.append("size", propertyInfo.size);
        if (propertyInfo.caeNumber) {
          formData.append("cae_number", propertyInfo.caeNumber);
        }
        formData.append("description", propertyInfo.description);
        formData.append("price_type", propertyInfo.priceType);
        if (propertyInfo.priceType === "amount") {
          formData.append("amount", propertyInfo.amount);
        }
        selectedFacilities.forEach((id) => formData.append("facilities[]", id));
        selectedServices.forEach((id) => formData.append("services[]", id));
        break;
      case 2:
        media.images.forEach((img) => {
          formData.append("images[]", img.file);
        });
        break;
      case 3:
        formData.append("name", contactDetails.contactName);
        formData.append("email", contactDetails.email);
        formData.append("city", contactDetails.city);
        formData.append("phone", contactDetails.mobileNumber);
        formData.append("locality", contactDetails.locality);
        break;
      case 4:
        formData.append("plan_id", selectedPlanId);
        break;
      default:
        break;
    }
    try {
      const response = await add_properties_listing(formData);
      console.log(`Step ${stepNumber} submitted:`, response);

      if (response?.errors && Object.keys(response.errors).length > 0) {
        setErrors(response.errors);
        const firstErrorKey = Object.keys(response.errors)[0];
        setTimeout(() => scrollToError(firstErrorKey), 100);
        setIsSubmitting(false);
        return false;
      }

      if (stepNumber === 1 && response?.data?.id) {
        setListingId(response.data.id);
      }

      if (stepNumber === 4) {
        if (response?.success) {
          router.push({
            pathname: `/property/${response?.data?.slug}`,
            query: { preview: true },
          });
        }
      } else {
        setActiveStep(stepNumber + 1);
      }

      setIsSubmitting(false);
      return true;
    } catch (error) {
      console.error(`Error submitting step ${stepNumber}:`, error);
      if (error?.response?.data?.errors) {
        setErrors(error.response.data.errors);
        const firstErrorKey = Object.keys(error.response.data.errors)[0];
        setTimeout(() => scrollToError(firstErrorKey), 100);
      } else {
        alert(`Error submitting step ${stepNumber}. Please try again.`);
      }
      setIsSubmitting(false);
      return false;
    }
  };

  // Render step content
  const renderStepContent = () => {
    switch (currentStep) {
      case 1:
        return (
          <section className="space-y-4">
            <div className="flex justify-between gap-5  w-full items-center ">
              <div className="w-1/2 " ref={rentByRef}>
                <h4 className="font-semibold text-gray-500 capitalize mb-1">
                  {type} BY *
                </h4>
                <DropDown
                  placeholder={`Select ${type} by`}
                  options={rentByOptions}
                  onChange={(selected) =>
                    handlePropertyInfoChange("rentBy", selected.value)
                  }
                />
                {errors.rentBy && (
                  <p className="text-red-500 text-sm mt-1">{errors.rentBy}</p>
                )}
              </div>
              <div className="min-w-1/2 " ref={availableRef}>
                <p className="text-md font-semibold text-gray-500 capitalize mb-2">
                  Available 
                </p>
                <span className="border p-2.5  border-gray-200 rounded-md">
                  <DatePicker
                    selected={startDate}
                    onChange={(date) => {
                      setStartDate(date);
                      clearError("available");
                    }}
                    className="outline-none"
                    minDate={new Date()}
                  />
                </span>
                {errors.available && (
                  <p className="text-red-500 text-sm mt-1">
                    {errors.available}
                  </p>
                )}
              </div>
            </div>

            <div ref={sizeRef}>
              <InputWithTitle
                title={"Size (sqft) *"}
                value={propertyInfo.size}
                onChange={(e) =>
                  handlePropertyInfoChange("size", e.target.value)
                }
              />
              {errors.size && (
                <p className="text-red-500 text-sm mt-1">{errors.size}</p>
              )}
            </div>

            <div ref={caeRef}>
              <InputWithTitle
                title={"CAE number"}
                value={propertyInfo.caeNumber}
                onChange={(e) =>
                  handlePropertyInfoChange("caeNumber", e.target.value)
                }
              />
            </div>

            <div ref={descriptionRef}>
              <InputWithTitle
                title={"Property Description *"}
                isTextarea={true}
                rows={5}
                value={propertyInfo.description}
                onChange={(e) =>
                  handlePropertyInfoChange("description", e.target.value)
                }
              />
              {errors.description && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.description}
                </p>
              )}
            </div>

            <div className="md:flex gap-3 w-full">
              <div className="w-full">
                <h4 className="font-semibold text-gray-500 mb-1">
                  Price Type *
                </h4>
                <DropDown
                  placeholder="Select price type"
                  options={priceOptions}
                  onChange={(selected) =>
                    handlePropertyInfoChange("priceType", selected.value)
                  }
                />
              </div>

              {propertyInfo.priceType === "amount" && (
                <div className="w-full" ref={priceRef}>
                  <InputWithTitle
                    title="Amount *"
                    value={propertyInfo.amount}
                    onChange={(e) =>
                      handlePropertyInfoChange("amount", e.target.value)
                    }
                  />
                  {errors.amount && (
                    <p className="text-red-500 text-sm mt-1">{errors.amount}</p>
                  )}
                </div>
              )}
            </div>

            {facility.length > 0 && (
              <div ref={facilitiesRef}>
                <CheckBox
                  heading="Select Facilities *"
                  options={facility}
                  onChange={(ids) => {
                    setSelectedFacilities(ids);
                    clearError("facilities");
                  }}
                />
                {errors.facilities && (
                  <p className="text-red-500 text-sm mt-1">
                    {errors.facilities}
                  </p>
                )}
              </div>
            )}

            {service.length > 0 && (
              <div>
                <CheckBox
                  heading="Select Services"
                  options={service}
                  onChange={(ids) => setSelectedServices(ids)}
                />
              </div>
            )}
          </section>
        );

      case 2:
        return (
          <section ref={imagesRef}>
            <h3 className="text-xl font-semibold mb-6 uppercase text-gray-800">
              Upload Images *
            </h3>
            <div
              className={`bg-white rounded-lg border-2 border-dashed p-8 ${
                isDragOver ? "border-blue-400 bg-blue-50" : "border-gray-300"
              }`}
              onDragOver={handleDragOver}
              onDragLeave={handleDragLeave}
              onDrop={handleDrop}
            >
              <div className="text-center">
                <div className="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                  <FaUpload className="w-8 h-8 text-gray-400" />
                </div>
                <p className="text-gray-600 mb-2">
                  Drag and drop images here, or click to select
                </p>
                <p className="text-sm text-gray-500 mb-4">
                  Maximum 10 images ({media.images.length}/10 uploaded)
                </p>
                <input
                  ref={multipleInputRef}
                  type="file"
                  accept="image/*"
                  multiple
                  onChange={(e) => handleMultipleUpload(e.target.files)}
                  className="hidden"
                  id="multiple-upload"
                />
                <label
                  htmlFor="multiple-upload"
                  className="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 cursor-pointer transition-colors"
                >
                  <FaUpload className="w-4 h-4 mr-2" /> Choose Images
                </label>
              </div>
            </div>

            {errors.images && (
              <p className="text-red-500 text-sm mt-2">{errors.images}</p>
            )}

            {media.images.length > 0 && (
              <div className="mt-6">
                <h4 className="text-lg font-medium text-gray-800 mb-4">
                  Uploaded Images
                </h4>
                <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                  {media.images.map((img) => (
                    <div key={img.id} className="relative group">
                      <div className="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                        <Image
                          height={500}
                          width={500}
                          src={img.preview}
                          alt={img.name}
                          className="w-full h-full object-cover"
                        />
                      </div>
                      <button
                        onClick={() => removeImage(img.id)}
                        className="absolute -top-2 -right-2 w-7 h-7 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100"
                      >
                        <MdCancel className="w-7 h-7 text-white rounded-full bg-red-500" />
                      </button>
                      <p
                        className="mt-1 text-xs text-gray-600 truncate"
                        title={img.name}
                      >
                        {img.name}
                      </p>
                    </div>
                  ))}
                </div>
              </div>
            )}
          </section>
        );

      case 3:
        return (
          <section className="space-y-5">
            <div className="flex gap-5">
              <div className="w-full" ref={contactNameRef}>
                <InputWithTitle
                  title={"Contact Name *"}
                  value={contactDetails.contactName}
                  onChange={(e) =>
                    handleContactDetailsChange("contactName", e.target.value)
                  }
                />
                {errors.contactName && (
                  <p className="text-red-500 text-sm mt-1">
                    {errors.contactName}
                  </p>
                )}
              </div>
              <div className="w-full" ref={emailRef}>
                <InputWithTitle
                  title={"Email *"}
                  value={contactDetails.email}
                  onChange={(e) =>
                    handleContactDetailsChange("email", e.target.value)
                  }
                />
                {errors.email && (
                  <p className="text-red-500 text-sm mt-1">{errors.email}</p>
                )}
              </div>
            </div>
            <div className="flex gap-5">
              <div className="w-full" ref={cityRef}>
                <InputWithTitle
                  title={"City *"}
                  value={contactDetails.city}
                  onChange={(e) =>
                    handleContactDetailsChange("city", e.target.value)
                  }
                />
                {errors.city && (
                  <p className="text-red-500 text-sm mt-1">{errors.city}</p>
                )}
              </div>
              <div className="w-full" ref={mobileRef}>
                <InputWithTitle
                  title={"Mobile Number *"}
                  value={contactDetails.mobileNumber}
                  onChange={(e) =>
                    handleContactDetailsChange("mobileNumber", e.target.value)
                  }
                />
                {errors.mobileNumber && (
                  <p className="text-red-500 text-sm mt-1">
                    {errors.mobileNumber}
                  </p>
                )}
              </div>
            </div>
            <div ref={localityRef}>
              <InputWithTitle
                title={"Locality *"}
                value={contactDetails.locality}
                onChange={(e) =>
                  handleContactDetailsChange("locality", e.target.value)
                }
              />
              {errors.locality && (
                <p className="text-red-500 text-sm mt-1">{errors.locality}</p>
              )}
            </div>
          </section>
        );

      case 4:
        return (
          <section className="mx-auto w-full" ref={planRef}>
            <div className="p-8 text-center">
              <h2 className="text-2xl font-bold mb-4">Payment Section</h2>
              <PricingTable
                plans={plans}
                selectedPlanId={selectedPlanId}
                setSelectedPlanId={setSelectedPlanId}
                onSelect={() => clearError("plan")}
              />
              {errors.plan && (
                <p className="text-red-500 mt-2">{errors.plan}</p>
              )}
            </div>
          </section>
        );

      default:
        return null;
    }
  };

  return (
    <>
      <div className="h-screen w-full">
        <div className="bg-white md:w-[80%] max-md:w-full h-auto mx-auto flex flex-col items-center relative max-w-[2000px]">
          <div className="fixed top-0 md:w-[80%] max-w-[1400px] w-full bg-white z-40">
            <Navbar />
          </div>

          <section className="mt-26 md:scale-85 max-md:scale-90 2xl:scale-95 flex max-md:mb-5 justify-center">
            <Steps steps={steps} setActiveStep={setActiveStep} />
          </section>

          <div className="flex max-md:flex-col gap-2 2xl:w-[95%] md:mt-14 mb-24">
            <section className="2xl:w-[95%] w-full h-full max-md:px-5 md:pl-10 rounded-xl">
              {renderStepContent()}
            </section>

            <div className="md:w-[420px] mx-2 h-fit shadow-md mt-7 bg-[#FFF8F3] p-3 rounded-xl text-sm">
              <div className="w-full">
                <h6 className="font-extrabold text-base my-2">Posting Tips</h6>
                <p>
                  <strong>Property Type: </strong>Specify whether you&apos;re
                  the owner, broker, or agency.
                  <br />
                  <strong>Availability: </strong>Mention when the property will
                  be available.
                  <br />
                  <strong>Size: </strong>Provide accurate property size in
                  square feet.
                  <br />
                  <strong>Description: </strong>Describe key features,
                  amenities, and location benefits.
                  <br />
                  <strong>Price: </strong>Set a competitive price or choose
                  alternative pricing options.
                  <br />
                  <strong>Images: </strong>Upload high-quality images showing
                  property interior and exterior.
                  <br />
                  <strong>Facilities: </strong>Select available facilities to
                  attract potential buyers/renters.
                </p>
              </div>
            </div>
          </div>

          <div className="flex justify-between w-[95%] 2xl:w-[95%] mb-8">
            {currentStep > 1 && (
              <button
                onClick={() => setActiveStep(currentStep - 1)}
                disabled={isSubmitting}
                className="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition-colors duration-200 flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <svg
                  className="w-4 h-4"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M15 19l-7-7 7-7"
                  />
                </svg>
                Previous
              </button>
            )}

            {currentStep === 1 && <div></div>}

            <button
              onClick={() => handleStepSubmit(currentStep)}
              disabled={isSubmitting}
              className="px-6 py-3 bg-[#FF6E04] hover:bg-[#E55A03] text-white font-semibold rounded-lg transition-colors duration-200 flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {isSubmitting ? (
                <>
                  <svg
                    className="animate-spin h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                  >
                    <circle
                      className="opacity-25"
                      cx="12"
                      cy="12"
                      r="10"
                      stroke="currentColor"
                      strokeWidth="4"
                    ></circle>
                    <path
                      className="opacity-75"
                      fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                    ></path>
                  </svg>
                  Submitting...
                </>
              ) : (
                <>
                  {currentStep === 4 ? "Complete Payment" : "Next Step"}
                  {currentStep < 4 && (
                    <svg
                      className="w-4 h-4"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth={2}
                        d="M9 5l7 7-7 7"
                      />
                    </svg>
                  )}
                </>
              )}
            </button>
          </div>
        </div>
        <section>
          <Footer />
        </section>
      </div>
    </>
  );
};

export default PropertiesListing;
