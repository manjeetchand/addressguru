import React from "react";
import InputWithTitle from "../InputWithTitle";

const SocialDetails = ({ social, setSocial, error, clearError, refs }) => {
  const handleChange = (field, value, errorKey) => {
    setSocial((prev) => ({
      ...prev,
      [field]: value,
    }));

    // Clear error when user starts typing
    if (clearError && errorKey) {
      clearError(errorKey);
    }
  };

  return (
    <section className="mt-14">
      <span className="flex items-center ">
        <h3 className="text-xl font-semibold uppercase text-gray-800">
          social details
        </h3>
      </span>
      <div className="mt-6 space-y-4">
        {/* Website Link - wrapped with ref */}
        <div ref={refs?.websiteLinkRef}>
          <InputWithTitle
            header={""}
            title={"Website Link"}
            isTextarea={false}
            error={error?.websiteLink}
            placeholder={"https://yourwebsite.com"}
            value={social.websiteLink}
            onChange={(e) =>
              handleChange("websiteLink", e.target.value, "websiteLink")
            }
            //                                                              ^^^^^^^^^^^^^ ADD errorKey
          />
        </div>

        {/* Video Link - wrapped with ref */}
        <div ref={refs?.videoLinkRef}>
          <InputWithTitle
            header={"facebook, youtube, instagram, tiktok"}
            title={"Social Link"}
            isTextarea={false}
            placeholder={"https://youtube.com/watch?v=..."}
            error={error?.videoLink}
            value={social.videoLink}
            onChange={(e) =>
              handleChange("videoLink", e.target.value, "videoLink")
            }
            //                                                            ^^^^^^^^^^ ADD errorKey
          />
        </div>
      </div>
    </section>
  );
};

export default SocialDetails;
