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


  // const filterItems = [
  //   // {
  //   //   label: "Categories",
  //   //   hasDropdown: true,
  //   //   dropdownOptions: ["Education", "Health", "Technology", "Science"],
  //   //   icon: (
  //   //     <svg
  //   //       width="17"
  //   //       height="17"
  //   //       viewBox="0 0 19 19"
  //   //       fill="none"
  //   //       xmlns="http://www.w3.org/2000/svg"
  //   //     >
  //   //       <path
  //   //         d="M6.86719 11.1083C7.41937 11.1083 7.8671 11.5561 7.86719 12.1083V17.9755C7.86717 18.5277 7.41941 18.9754 6.86719 18.9755H1C0.447773 18.9754 1.98582e-05 18.5277 0 17.9755V12.1083C8.85806e-05 11.5561 0.447816 11.1083 1 11.1083H6.86719ZM14.5547 11.1083C16.7271 11.1083 18.4882 12.8695 18.4883 15.0419C18.4883 17.2143 16.7271 18.9755 14.5547 18.9755C12.3824 18.9753 10.6211 17.2142 10.6211 15.0419C10.6211 12.8696 12.3824 11.1084 14.5547 11.1083ZM8.30566 0.460817C8.69899 -0.153916 9.59791 -0.153946 9.99121 0.460817L14.1465 6.95886C14.5722 7.62449 14.0938 8.49793 13.3037 8.49793H4.99316C4.20306 8.49793 3.72471 7.62449 4.15039 6.95886L8.30566 0.460817Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //     </svg>
  //   //   ),
  //   // },
  //   {
  //     label: "Sort by",
  //     hasDropdown: true,
  //     dropdownOptions: ["Newest", "Oldest"],
  //   },

  //   {
  //     label: "Facilities",
  //     isMultiple: true, // ✅ Changed from isRadio to isMultiple
  //     multiOptions: dynamicFilters?.facilitis?.map((facility) => ({
  //       id: facility.id,
  //       label: facility.name,
  //       value: facility.id,
  //     })),
  //   },
  //   {
  //     label: "Services",
  //     isMultiple: true, // ✅ Changed from isRadio to isMultiple
  //     multiOptions: dynamicFilters?.service?.map((service) => ({
  //       id: service.id,
  //       label: service.name,
  //       value: service.id,
  //     })),
  //   },
  //   {
  //     label: "Payment Mode",
  //     isMultiple: true, // ✅ Changed from isRadio to isMultiple
  //     multiOptions: dynamicFilters?.paymentMode?.map((paymentMode) => ({
  //       id: paymentMode.id,
  //       label: paymentMode.name,
  //       value: paymentMode.id,
  //     })),
  //   },

  //   // {
  //   //   label: "Gender Status",
  //   //   hasDropdown: true,
  //   //   dropdownOptions: ["Male", "Female", "Other"],
  //   // },
  //   // {
  //   //   label: "Managed by",
  //   //   hasDropdown: true,
  //   //   dropdownOptions: ["Admin", "User", "Team Lead", "Manager"],
  //   // },
  //   {
  //     label: "AG Verified",
  //     hasDropdown: false,
  //     icon: (
  //       <svg
  //         width="16"
  //         height="14"
  //         viewBox="0 0 19 14"
  //         fill="none"
  //         xmlns="http://www.w3.org/2000/svg"
  //       >
  //         <path
  //           d="M18.3796 1.15416C17.8276 0.605505 16.9313 0.605851 16.3786 1.15416L7.3727 10.0943L3.36998 6.12096C2.81727 5.57231 1.92134 5.57231 1.36863 6.12096C0.815925 6.66961 0.815925 7.55897 1.36863 8.10762L6.37182 13.0741C6.648 13.3482 7.01014 13.4857 7.37232 13.4857C7.73449 13.4857 8.09698 13.3486 8.37316 13.0741L18.3796 3.14078C18.9323 2.59251 18.9323 1.70277 18.3796 1.15416Z"
  //           fill="#FF6E04"
  //         />
  //       </svg>
  //     ),
  //   },
  //   // {
  //   //   label: "Quick Response",
  //   //   hasDropdown: false,
  //   //   icon: (
  //   //     <svg
  //   //       width="23"
  //   //       height="20"
  //   //       viewBox="0 0 27 23"
  //   //       fill="none"
  //   //       xmlns="http://www.w3.org/2000/svg"
  //   //     >
  //   //       <path
  //   //         d="M11.1494 13.2955C11.1671 11.6887 12.6157 10.5629 14.2262 10.9035C14.3472 10.9295 14.4979 10.9221 14.6086 10.8709C18.1153 9.26039 21.6182 7.64244 25.122 6.02635C25.2141 5.98355 25.3063 5.94168 25.4012 5.90353C25.6635 5.79747 25.8887 5.86074 26.0254 6.07566C26.1473 6.26732 26.1157 6.5241 25.9138 6.69437C25.6942 6.87951 25.4542 7.04047 25.2207 7.20794C22.2295 9.35994 19.2364 11.5101 16.2489 13.6658C16.1503 13.7374 16.0647 13.8621 16.0284 13.9793C15.6804 15.1126 14.6914 15.8336 13.5284 15.7862C12.3654 15.7396 11.4369 14.9395 11.2006 13.7728C11.168 13.6183 11.1652 13.4555 11.1494 13.2955ZM14.4393 13.3132C14.4346 12.8536 14.0699 12.4981 13.6084 12.5047C13.1712 12.5112 12.8232 12.8638 12.8232 13.3029C12.8223 13.7784 13.186 14.1328 13.6671 14.1245C14.095 14.117 14.4439 13.7514 14.4393 13.3132Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M24.2943 5.78068C22.9815 6.38264 21.7209 6.96041 20.4592 7.53912C20.1671 7.67309 19.8777 7.81544 19.58 7.93639C19.5056 7.96617 19.3725 7.95965 19.3186 7.91127C18.1212 6.8469 16.7619 6.08398 15.1709 5.67275C15.7329 4.01107 16.2892 2.36521 16.8586 0.682129C19.941 1.5046 22.3973 3.19698 24.2943 5.78068Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M9.30615 1.03283C11.4758 0.309916 13.6492 0.101508 15.9073 0.492273C15.3425 2.15767 14.7843 3.80633 14.2428 5.40288C13.5506 5.40288 12.8891 5.36846 12.2341 5.41218C11.5865 5.45498 10.9455 5.57686 10.2635 5.66897C9.95184 4.16174 9.63272 2.61636 9.30615 1.03283Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M6.34743 7.89629C5.55381 6.7882 4.77135 5.69592 3.98145 4.5934C5.23096 3.2127 6.69354 2.16415 8.39988 1.39844C8.59898 2.36418 8.79157 3.29178 8.9823 4.21845C9.09488 4.76553 9.21118 5.3126 9.31259 5.86153C9.32468 5.92665 9.27723 6.0504 9.22513 6.07273C8.17472 6.52397 7.2099 7.10732 6.34743 7.89629Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M1.15527 9.60264C1.6214 8.05074 2.34152 6.65702 3.33053 5.37122C3.391 5.44379 3.44125 5.49589 3.48311 5.5545C4.16695 6.51188 4.848 7.47018 5.5337 8.42569C5.60813 8.5299 5.65837 8.59968 5.54765 8.72528C4.91033 9.4454 4.39304 10.2465 3.99018 11.1201C3.97622 11.1499 3.95575 11.1778 3.9204 11.2345C3.00489 10.694 2.09125 10.1553 1.15527 9.60264Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M2.9932 14.6901C2.28145 14.5831 1.52876 14.4724 0.777938 14.3514C0.725836 14.3431 0.649543 14.264 0.645822 14.2128C0.555574 12.9977 0.642101 11.7947 0.909123 10.5731C1.21615 10.7555 1.50457 10.9276 1.79393 11.0979C2.32611 11.4114 2.86108 11.7203 3.38769 12.0431C3.45933 12.0869 3.54213 12.2143 3.52818 12.2832C3.36257 13.0749 3.18021 13.863 2.9932 14.6901Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M0.703613 15.3208C1.50096 15.439 2.19596 15.5376 2.88817 15.6492C2.94679 15.6585 3.03238 15.7432 3.0389 15.8009C3.11705 16.4466 3.18218 17.0941 3.25475 17.7789C2.71047 17.9129 2.13269 18.0543 1.48886 18.2125C1.22835 17.2504 0.974357 16.3163 0.703613 15.3208Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M3.53802 18.7046C3.74829 19.1865 3.94739 19.6341 4.13347 20.0862C4.15673 20.143 4.13626 20.2546 4.09346 20.2956C3.80411 20.5672 3.50266 20.8268 3.15377 21.1357C2.73509 20.4547 2.33037 19.7969 1.90332 19.1028C2.48761 18.9604 3.01142 18.833 3.53802 18.7046Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M3.77979 21.8708C4.04867 21.6299 4.29987 21.4047 4.55201 21.1805C4.59481 21.1423 4.64133 21.1088 4.69715 21.066C4.96045 21.4196 5.22748 21.7573 5.46938 22.1118C5.62568 22.3407 5.56428 22.6263 5.35959 22.7956C5.14746 22.9706 4.84322 22.9733 4.64505 22.7761C4.35198 22.4858 4.07379 22.1806 3.77979 21.8708Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //     </svg>
  //   //   ),
  //   // },
  //   // {
  //   //   label: "Top Rated",
  //   //   hasDropdown: false,
  //   //   icon: (
  //   //     <svg
  //   //       width="21"
  //   //       height="21"
  //   //       viewBox="0 0 21 21"
  //   //       fill="none"
  //   //       xmlns="http://www.w3.org/2000/svg"
  //   //     >
  //   //       <path
  //   //         d="M0.416992 12.7376C0.536452 12.4259 0.777494 12.272 1.08915 12.1849C1.45178 12.0835 1.80644 11.9545 2.16535 11.8403C2.58266 11.7071 2.96174 11.8796 3.08333 12.2555C3.2065 12.6362 3.00847 12.9914 2.58797 13.1331C2.21844 13.2574 1.84626 13.3747 1.47514 13.4947C0.920315 13.6736 0.668653 13.5696 0.416992 13.0572C0.416992 12.9505 0.416992 12.8438 0.416992 12.7376Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M20.8052 13.0568C20.5514 13.5696 20.3014 13.6732 19.7471 13.4942C19.376 13.3743 19.0048 13.2548 18.6342 13.1332C18.2169 12.9962 18.0157 12.6373 18.1389 12.2556C18.261 11.8792 18.639 11.7071 19.0569 11.8404C19.4221 11.9567 19.7832 12.0889 20.1522 12.1913C20.4591 12.2768 20.6852 12.4388 20.8058 12.7382C20.8052 12.8439 20.8052 12.9506 20.8052 13.0568Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M15.9871 3.30516C15.7269 3.30144 15.5278 3.18676 15.3998 2.96271C15.2714 2.7376 15.2634 2.49708 15.4099 2.28418C15.6945 1.86952 15.9871 1.45911 16.2977 1.0641C16.5191 0.782176 16.9247 0.754568 17.2103 0.968002C17.4848 1.17294 17.5756 1.56583 17.3808 1.85519C17.1004 2.2725 16.7994 2.67654 16.4957 3.07739C16.3736 3.2372 16.192 3.30728 15.9871 3.30516Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M5.28674 3.30521C5.0011 3.30521 4.8174 3.21176 4.6836 3.03019C4.40858 2.65747 4.13303 2.28423 3.86809 1.90461C3.64935 1.59136 3.71837 1.18467 4.01304 0.966457C4.31832 0.740281 4.72714 0.796029 4.965 1.11087C5.24427 1.4804 5.51451 1.85736 5.7821 2.23538C5.94085 2.45997 5.9589 2.70473 5.82829 2.94789C5.70193 3.18309 5.49805 3.30149 5.28674 3.30521Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M9.93397 18.8881C9.93397 18.656 9.92919 18.4235 9.93503 18.1915C9.94512 17.8166 10.2472 17.5225 10.613 17.5236C10.9794 17.5246 11.282 17.8177 11.2878 18.1941C11.2953 18.6587 11.2947 19.1233 11.2884 19.5873C11.2831 19.9765 10.9783 20.269 10.6008 20.2632C10.2329 20.2573 9.943 19.9643 9.93503 19.5846C9.93025 19.3526 9.93397 19.1201 9.93397 18.8881Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //       <path
  //   //         d="M2.01072 7.1024C2.12961 7.1024 2.24803 7.1024 2.36691 7.1024C4.3637 7.10517 6.36049 7.10701 8.35775 7.11345C8.45985 7.11391 8.49994 7.07709 8.52885 6.98872C8.81324 6.10965 9.09949 5.23104 9.38668 4.35289C9.70371 3.38362 10.0221 2.4148 10.3396 1.44598C10.3858 1.3056 10.4305 1.16523 10.4846 1C10.5135 1.04234 10.5322 1.06029 10.5392 1.08192C10.893 2.16028 11.2469 3.23864 11.5989 4.31746C11.8879 5.20297 12.176 6.08894 12.4614 6.9763C12.4949 7.08031 12.5471 7.11437 12.659 7.11391C14.722 7.10747 16.785 7.10563 18.848 7.10333C18.896 7.10333 18.9441 7.10793 19 7.13738C18.8802 7.22437 18.7608 7.31228 18.6401 7.39834C17.247 8.39293 15.8535 9.38661 14.46 10.3812C14.2493 10.5317 14.0409 10.685 13.8292 10.8341C13.7737 10.8732 13.7584 10.9091 13.7812 10.9777C14.2134 12.2765 14.6428 13.5762 15.0731 14.8755C15.2983 15.5557 15.5248 16.236 15.7505 16.9162C15.757 16.936 15.7566 16.9586 15.7617 17C15.7169 16.9738 15.6866 16.9595 15.6605 16.9402C13.9798 15.7302 12.2991 14.5202 10.6198 13.3074C10.5336 13.2453 10.4776 13.2333 10.3802 13.3038C9.00952 14.2965 7.63465 15.2833 6.26072 16.2724C5.95675 16.4914 5.65371 16.7123 5.35021 16.9319C5.3199 16.954 5.2868 16.9728 5.23086 16.9807C5.26722 16.8638 5.30219 16.7464 5.34042 16.6304C5.80383 15.229 6.26772 13.8271 6.7316 12.4256C6.88964 11.9488 7.04489 11.4711 7.20714 10.9956C7.23464 10.9151 7.22345 10.8741 7.15352 10.8244C6.09568 10.0719 5.04018 9.31619 3.98374 8.56139C3.3674 8.12139 2.75107 7.68185 2.13474 7.2414C2.08858 7.20826 2.04476 7.17236 2 7.13784C2.00373 7.12588 2.00746 7.11391 2.01072 7.1024Z"
  //   //         fill="#FF6E04"
  //   //       />
  //   //     </svg>
  //   //   ),
  //   // },
  // ];
