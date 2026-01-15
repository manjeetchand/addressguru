export const API_URL = process.env.NEXT_PUBLIC_BASE_URL;
// mine
export const GEMINI_KEY = "AIzaSyAkgxC9RyLWdb8C9kgqsUIj7dCIypA9aoY";
// sir api
// export const GEMINI_KEY = "AIzaSyDWHmk3K0KpZ0-qA7Z8Ea2FmTDorJnGJes"
// export const API_URL = "http://127.0.0.1:8000/api/"
export const APP_URL = "https://api.addressguru.sg";

export const REGISTER_STEPS = [
  {
    icon: "/assets/register/create-account.png",
    title: "Create Account",
    text: "Provide your name, mobile number, email, and set a password to get started",
  },
  {
    icon: "/assets/register/add-business.png",
    title: "Add Business",
    text: "Complete your business profile with name, address, hours & photos",
  },
  {
    icon: "/assets/register/business-category.png",
    title: "Business Category",
    text: "Enhance your free listing with accurate categories & business info to attract more customers",
  },
];

export const REGISTER_REVIEWS = [
  {
    name: "Aniket Rawat",
    text: "Got listed on Address Guru & started getting real leads within days. Super happy with the results.Address Guru really works!",
    image: "/assets/register/review1.png",
  },
  {
    name: "Richha Chouhan",
    text: "Got listed on Address Guru & started getting real leads within days.Super happy with the results.Address Guru really works!",
    image: "/assets/register/review2.png",
  },
  {
    name: " Dr. K.L Suman",
    text: "Got listed on Address Guru & started getting real leads within days. Super happy with the results.Address Guru really works!",
    image: "/assets/register/review3.png",
  },
];

export const BUSINESS_POSTING_TIPS = [
  {
    step: 1,
    fields: [
      {
        title: "Business Name",
        tip: "Enter your business or organization name as per legal documents.",
      },
      {
        title: "Business Address",
        tip: "Mention your complete business address as per official records.",
      },
      {
        title: "Ad Description",
        tip: "Briefly describe your business, services, industry, and products.",
      },
      {
        title: "Payment Mode",
        tip: "Specify the payment methods accepted by your business.",
      },
      {
        title: "Services",
        tip: "List the services your business provides.",
      },
      {
        title: "Facilities",
        tip: "Mention available facilities such as parking, Wi-Fi, AC, etc.",
      },
      {
        title: "Opening Hours",
        tip: "Specify your working days and business hours.",
      },
    ],
  },
  {
    step: 2,
    fields: [
      {
        title: "Website Link",
        tip: "Add your official business website URL.",
      },
      {
        title: "Social Media Links",
        tip: "Provide links to your social media profiles.",
      },
      {
        title: "Online Listing",
        tip: "Add Google Business or other trusted listing links if available.",
      },
    ],
  },
  {
    step: 3,
    fields: [
      {
        title: "Full Name",
        tip: "Enter the full name of the contact person.",
      },
      {
        title: "Email",
        tip: "Provide a valid email address for inquiries.",
      },
      {
        title: "Mobile Number",
        tip: "Enter your primary contact number.",
      },
      {
        title: "Alternate Number",
        tip: "Add an alternate contact number if available.",
      },
      {
        title: "Locality / Landmark",
        tip: "Mention a nearby landmark for easy location.",
      },
      {
        title: "City",
        tip: "Select or enter the city where your business is located.",
      },
    ],
  },
  {
    step: 4,
    fields: [
      {
        title: "Meta Title",
        tip: "Enter a short, keyword-friendly title for your business.",
      },
      {
        title: "Meta Description",
        tip: "Write a brief description to improve search visibility.",
      },
    ],
  },
  {
    step: 5,
    fields: [
      {
        title: "Business Images",
        tip: "Upload clear and high-quality images of your business.",
      },
      {
        title: "Logo Image",
        tip: "Upload your official business logo.",
      },
    ],
  },
  {
    step: 6,
    fields: [
      {
        title: "Review Details",
        tip: "Review all entered information carefully.",
      },
      {
        title: "Choose Plan",
        tip: "Select a suitable listing or promotion plan.",
      },
      {
        title: "Make Payment",
        tip: "Complete the payment process securely.",
      },
      {
        title: "Submit Listing",
        tip: "Submit your business listing for review and approval.",
      },
    ],
  },
];
