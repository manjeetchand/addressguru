import { get_marketplace_subcategories } from "@/api/Categories";
import { add_marketplace_listing } from "@/api/forms";
import { get_plans } from "@/api/plans";
import DropDown from "@/components/Forms/DropDown";
import InputWithTitle from "@/components/Forms/InputWithTitle";
import Navbar from "@/components/Forms/Navbar";
import Steps from "@/components/Forms/Steps";
import SearchEngine from "@/components/Forms/FormSections/SearchEngine";
import PricingTable from "@/components/Plans/PricingTable";
import Footer from "@/layout/footer";
import Image from "next/image";
import { useRouter } from "next/router";
import React, { useEffect, useRef, useState } from "react";
import { FaUpload } from "react-icons/fa";
import { MdCancel } from "react-icons/md";
import {
  saveToSession,
  getFromSession,
  clearSession,
} from "@/utils/sessionStorage";

const MarketPlaceListing = () => {
  const router = useRouter();
  const categoryId = router?.query?.item;
  const [isDragOver, setIsDragOver] = useState(false);
  const [subSubCategories, setSubSubCategories] = useState([]);
  const [plans, setPlans] = useState(null);
  const [selectedPlanId, setSelectedPlanId] = useState(null);
  const [listingId, setListingId] = useState(null);
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [errors, setErrors] = useState({});
  const [lastSaved, setLastSaved] = useState(null);

  // Refs for error scrolling
  const conditionRef = useRef(null);
  const titleRef = useRef(null);
  const descriptionRef = useRef(null);
  const priceRef = useRef(null);
  const imagesRef = useRef(null);
  const contactNameRef = useRef(null);
  const emailRef = useRef(null);
  const cityRef = useRef(null);
  const mobileRef = useRef(null);
  const localityRef = useRef(null);
  const seoTitleRef = useRef(null);
  const seoDescriptionRef = useRef(null);
  const planRef = useRef(null);

  const getSubCategories = async (categoryId) => {
    const res = await get_marketplace_subcategories(categoryId);
    setSubSubCategories(res);
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
    getSubCategories(categoryId);
    getPlansData();
  }, [categoryId]);

  // Section 1: Ad Information
  const [adInfo, setAdInfo] = useState({
    condition: "",
    subcategoryId: "",
    title: "",
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

  // Section 4: SEO Details
  const [seo, setSeo] = useState({
    title: "",
    description: "",
  });

  const multipleInputRef = useRef(null);

  // Steps state - Updated to 5 steps
  const [steps, setSteps] = useState([
    {
      step: 1,
      title: "Add Information",
      description: "Update your Ad details and info",
      active: true,
      completed: false,
    },
    {
      step: 2,
      title: "Add Photos",
      description: "Add your product images",
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
      title: "Search Engine Friendly",
      description: "Update SEO friendly keywords & description",
      active: false,
      completed: false,
    },
    {
      step: 5,
      title: "Payment",
      description: "Proceed for payment",
      active: false,
      completed: false,
    },
  ]);

  // Load data from session storage on mount
  useEffect(() => {
    const savedData = getFromSession();

    if (savedData.adInfo) {
      setAdInfo(savedData.adInfo);
    }
    if (savedData.contactDetails) {
      setContactDetails(savedData.contactDetails);
    }
    if (savedData.seo) {
      setSeo(savedData.seo);
    }
    if (savedData.selectedPlanId) {
      setSelectedPlanId(savedData.selectedPlanId);
    }
    if (savedData.listingId) {
      setListingId(savedData.listingId);
    }
    if (savedData.currentStep && savedData.currentStep > 1) {
      setActiveStep(savedData.currentStep);
    }
    if (savedData.steps) {
      setSteps(savedData.steps);
    }
  }, []);

  // Save adInfo to session storage whenever it changes
  useEffect(() => {
    if (adInfo.title || adInfo.description || adInfo.condition) {
      saveToSession("adInfo", adInfo);
      setLastSaved(new Date().toLocaleTimeString());
    }
  }, [adInfo]);

  // Save contact details to session storage
  useEffect(() => {
    if (
      contactDetails.contactName ||
      contactDetails.email ||
      contactDetails.mobileNumber
    ) {
      saveToSession("contactDetails", contactDetails);
      setLastSaved(new Date().toLocaleTimeString());
    }
  }, [contactDetails]);

  // Save SEO details to session storage
  useEffect(() => {
    if (seo.title || seo.description) {
      saveToSession("seo", seo);
      setLastSaved(new Date().toLocaleTimeString());
    }
  }, [seo]);

  // Save selected plan
  useEffect(() => {
    if (selectedPlanId) {
      saveToSession("selectedPlanId", selectedPlanId);
    }
  }, [selectedPlanId]);

  // Save listing ID
  useEffect(() => {
    if (listingId) {
      saveToSession("listingId", listingId);
    }
  }, [listingId]);

  // Save steps state
  useEffect(() => {
    saveToSession("steps", steps);
  }, [steps]);

  // Clear session when user leaves the page
  useEffect(() => {
    const handleBeforeUnload = () => {
      clearSession();
    };

    const handleRouteChange = () => {
      clearSession();
    };

    window.addEventListener("beforeunload", handleBeforeUnload);
    router.events.on("routeChangeStart", handleRouteChange);

    return () => {
      window.removeEventListener("beforeunload", handleBeforeUnload);
      router.events.off("routeChangeStart", handleRouteChange);
    };
  }, [router]);

  const currentStep = steps.find((step) => step.active)?.step || 1;

  const setActiveStep = (stepNumber) => {
    setSteps((prevSteps) =>
      prevSteps.map((step) => ({
        ...step,
        active: step.step === stepNumber,
        completed: step.step < stepNumber ? true : step.completed,
      }))
    );
    saveToSession("currentStep", stepNumber);
  };

  // Dropdown options
  const conditionOptions = [
    { value: "used", label: "Used" },
    { value: "new", label: "New" },
  ];

  const priceOptions = [
    { value: "amount", label: "Amount" },
    { value: "free", label: "Free" },
    { value: "swap_trade", label: "Swap/Trade" },
    { value: "contact_or_sale", label: "Contact For Sale" },
  ];

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
  const handleAdInfoChange = (field, value) => {
    setAdInfo((prev) => ({
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
      condition: conditionRef,
      title: titleRef,
      description: descriptionRef,
      amount: priceRef,
      images: imagesRef,
      contactName: contactNameRef,
      email: emailRef,
      city: cityRef,
      mobileNumber: mobileRef,
      locality: localityRef,
      seoTitle: seoTitleRef,
      seoDescription: seoDescriptionRef,
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

  // Map API error keys to frontend error keys
  const mapApiErrorsToState = (apiErrors, stepNumber) => {
    const errorMapping = {
      1: {
        condition: "condition",
        title: "title",
        description: "description",
        price_type: "priceType",
        amount: "amount",
        sub_category_id: "subcategoryId",
      },
      2: {
        images: "images",
      },
      3: {
        name: "contactName",
        email: "email",
        city: "city",
        mobile_number: "mobileNumber",
        locality: "locality",
      },
      4: {
        seo_title: "seoTitle",
        seo_description: "seoDescription",
      },
      5: {
        plan_id: "plan",
      },
    };

    const mappedErrors = {};
    const currentStepMapping = errorMapping[stepNumber] || {};

    Object.keys(apiErrors).forEach((apiKey) => {
      const frontendKey = currentStepMapping[apiKey] || apiKey;
      const errorMessage = Array.isArray(apiErrors[apiKey])
        ? apiErrors[apiKey][0]
        : apiErrors[apiKey];
      mappedErrors[frontendKey] = errorMessage;
    });

    return mappedErrors;
  };

  // Validation function
  const validateStep = (step) => {
    let newErrors = {};

    if (step === 1) {
      if (!adInfo.condition) {
        newErrors.condition = "Please select condition";
      }
      if (!adInfo.title.trim()) {
        newErrors.title = "Title is required";
      }
      if (!adInfo.description.trim()) {
        newErrors.description = "Description is required";
      }
      if (adInfo.priceType === "amount" && !adInfo.amount.trim()) {
        newErrors.amount = "Amount is required";
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
      if (!seo.title.trim()) {
        newErrors.seoTitle = "SEO title is required";
      } else if (seo.title.length < 10) {
        newErrors.seoTitle = "Title must be at least 10 characters";
      }
      if (!seo.description.trim()) {
        newErrors.seoDescription = "SEO description is required";
      } else if (seo.description.length < 30) {
        newErrors.seoDescription = "Description must be at least 30 characters";
      }
    }

    if (step === 5) {
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
    setIsSubmitting(true);
    setErrors({});

    const formData = new FormData();
    formData.append("category_id", categoryId);
    formData.append("step", stepNumber);

    if (listingId) {
      formData.append("listing_id", listingId);
    }

    switch (stepNumber) {
      case 1:
        formData.append("condition", adInfo.condition);
        formData.append("title", adInfo.title);
        formData.append("description", adInfo.description);
        formData.append("price_type", adInfo.priceType);
        if (adInfo.priceType === "amount") {
          formData.append("amount", adInfo.amount);
        }
        if (adInfo.subcategoryId) {
          formData.append("sub_category_id", adInfo.subcategoryId);
        }
        break;

      case 2:
        formData.append("listing_id", listingId);
        media.images.forEach((img) => {
          formData.append("images[]", img.file);
        });
        break;

      case 3:
        formData.append("listing_id", listingId);
        formData.append("name", contactDetails.contactName);
        formData.append("email", contactDetails.email);
        formData.append("city", contactDetails.city);
        formData.append("mobile_number", contactDetails.mobileNumber);
        formData.append("locality", contactDetails.locality);
        break;

      case 4:
        formData.append("listing_id", listingId);
        formData.append("seo_title", seo.title);
        formData.append("seo_description", seo.description);
        break;

      case 5:
        formData.append("listing_id", listingId);
        formData.append("plan_id", selectedPlanId);
        break;

      default:
        break;
    }

    try {
      const response = await add_marketplace_listing(formData);
      console.log(`Step ${stepNumber} submitted:`, response);

      // Check for API errors in response
      if (response?.errors && Object.keys(response.errors).length > 0) {
        const mappedErrors = mapApiErrorsToState(response.errors, stepNumber);
        setErrors(mappedErrors);

        const firstErrorKey = Object.keys(mappedErrors)[0];
        setTimeout(() => scrollToError(firstErrorKey), 100);

        setIsSubmitting(false);
        return false;
      }

      // Capture listing ID from step 1 response
      if (stepNumber === 1 && response?.data?.id) {
        setListingId(response.data.id);
      }

      // Handle final step completion
      if (stepNumber === 5) {
        clearSession();
        console.log("response from step 5:", response);
        if (response?.success) {
          router.push({
            pathname: `/marketplace/${response?.data?.slug}`,
            query: { preview: true },
          });
        }
      } else {
        // Only move to next step if no errors
        setActiveStep(stepNumber + 1);
      }

      setIsSubmitting(false);
      console.log("main response", response);
      return true;
    } catch (error) {
      console.error(`Error submitting step ${stepNumber}:`, error);

      // Handle error responses with mapped errors
      if (error?.response?.data?.errors) {
        const mappedErrors = mapApiErrorsToState(
          error.response.data.errors,
          stepNumber
        );
        setErrors(mappedErrors);
        const firstErrorKey = Object.keys(mappedErrors)[0];
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
            {/* name and category selection */}
            <div className="flex w-full items-center gap-2">
              <div
                ref={conditionRef}
                className={subSubCategories.length > 0 ? "w-1/2" : "w-full"}
              >
                <h4 className="font-semibold text-gray-500 mb-1">
                  Condition *
                </h4>

                <DropDown
                  placeholder="Select condition"
                  options={conditionOptions}
                  onChange={(selected) =>
                    handleAdInfoChange("condition", selected.value)
                  }
                />

                {errors.condition && (
                  <p className="text-red-500 text-sm mt-1">
                    {errors.condition}
                  </p>
                )}
              </div>

              {subSubCategories.length > 0 && (
                <div className="w-1/2">
                  <h4 className="font-semibold text-gray-500 mb-1">
                    Sub Category
                  </h4>

                  <DropDown
                    placeholder="Select Sub Category"
                    options={subSubCategories.map((item) => ({
                      value: item.id,
                      label: item.name,
                    }))}
                    onChange={(selected) =>
                      handleAdInfoChange("subcategoryId", selected.value)
                    }
                  />
                </div>
              )}
            </div>
            <div ref={titleRef}>
              <InputWithTitle
                title={"Add Title "}
                value={adInfo.title}
                onChange={(e) => handleAdInfoChange("title", e.target.value)}
              />
              {errors.title && (
                <p className="text-red-500 text-sm mt-1">{errors.title}</p>
              )}
            </div>
            <div ref={descriptionRef}>
              <InputWithTitle
                title={"Ad Description"}
                isTextarea={true}
                rows={5}
                value={adInfo.description}
                onChange={(e) =>
                  handleAdInfoChange("description", e.target.value)
                }
              />
              {errors.description && (
                <p className="text-red-500 text-sm mt-1">
                  {errors.description}
                </p>
              )}
            </div>
            <div className="md:flex gap-3 w-full items-center">
              <div className="w-full">
                <h4 className="font-semibold text-gray-500 mb-1">Price Type</h4>
                <DropDown
                  placeholder="Select price type"
                  options={priceOptions}
                  onChange={(selected) =>
                    handleAdInfoChange("priceType", selected.value)
                  }
                />
              </div>
              {adInfo.priceType === "amount" && (
                <div className="w-full" ref={priceRef}>
                  <InputWithTitle
                    title="Amount"
                    value={adInfo.amount}
                    onChange={(e) =>
                      handleAdInfoChange("amount", e.target.value)
                    }
                  />
                  {errors.amount && (
                    <p className="text-red-500 text-sm mt-1">{errors.amount}</p>
                  )}
                </div>
              )}
            </div>
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
                  title={"Contact Name "}
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
                  title={"Email "}
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
                  title={"City "}
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
                  title={"Mobile Number "}
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
                title={"Locality "}
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
          <SearchEngine
            seo={seo}
            business={{
              name: adInfo.title,
              description: adInfo.description,
              address: contactDetails.city + ", " + contactDetails.locality,
            }}
            setSeo={setSeo}
            error={errors}
            clearError={clearError}
            refs={{ seoTitleRef, seoDescriptionRef }}
          />
        );

      case 5:
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
            {/* Auto-save indicator */}
            {lastSaved && (
              <div className="text-xs text-gray-500 flex items-center justify-end gap-1 px-4 py-1">
                <svg
                  className="w-3 h-3 text-green-500"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    fillRule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clipRule="evenodd"
                  />
                </svg>
                Auto-saved at {lastSaved}
              </div>
            )}
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
                  <strong>Condition: </strong>Select whether your item is new or
                  used.
                  <br />
                  <strong>Title: </strong>Create a clear, descriptive title for
                  your ad.
                  <br />
                  <strong>Description: </strong>Provide detailed information
                  about your item.
                  <br />
                  <strong>Price: </strong>Set a fair price or choose alternative
                  options.
                  <br />
                  <strong>Images: </strong>Upload clear photos showing your item
                  from multiple angles.
                  <br />
                  <strong>Contact: </strong>Provide accurate contact information
                  for buyers to reach you.
                  <br />
                  <strong>SEO: </strong>Optimize your listing with relevant
                  keywords for better visibility.
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
              onClick={async () => {
                if (validateStep(currentStep)) {
                  await handleStepSubmit(currentStep);
                }
              }}
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
                  {currentStep === 5 ? "Complete Payment" : "Next Step"}
                  {currentStep < 5 && (
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

export default MarketPlaceListing;
