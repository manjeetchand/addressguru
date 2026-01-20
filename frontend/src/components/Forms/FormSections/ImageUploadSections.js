import React, { useRef, useState } from "react";
import { MdCancel } from "react-icons/md";
import { FaImage, FaUpload } from "react-icons/fa";
import Image from "next/image";
import { APP_URL } from "@/services/constants";

const ImageUploadSections = ({
  media,
  setMedia,
  error,
  clearError,
  refs,
  isEditMode = false, // Default value to prevent undefined errors
}) => {
  const [isDragOver, setIsDragOver] = useState(false);
  const [uploadError, setUploadError] = useState({
    logo: "",
    images: "",
  });

  const logoInputRef = useRef(null);
  const multipleInputRef = useRef(null);

  const MAX_FILE_SIZE = 2 * 1024 * 1024; // 2MB in bytes

  // Validate file size
  const validateFileSize = (file) => {
    return file.size <= MAX_FILE_SIZE;
  };

  // Handle logo upload
  const handleLogoUpload = (event) => {
    const file = event.target.files[0];

    if (!file) return;

    if (!file.type.startsWith("image/")) {
      setUploadError((prev) => ({
        ...prev,
        logo: "Please upload a valid image file",
      }));
      return;
    }

    if (!validateFileSize(file)) {
      setUploadError((prev) => ({
        ...prev,
        logo: "File size must be 2MB or less. Consider converting to WebP format for smaller file sizes.",
      }));
      if (logoInputRef.current) logoInputRef.current.value = "";
      return;
    }

    setUploadError((prev) => ({ ...prev, logo: "" }));
    if (clearError) clearError("logo");

    const reader = new FileReader();
    reader.onload = (e) => {
      setMedia((prev) => ({
        ...prev,
        logo: {
          file: file,
          preview: e.target.result,
          name: file.name,
          isExisting: false,
        },
      }));
    };
    reader.readAsDataURL(file);
  };

  // Handle multiple images upload
  const handleMultipleUpload = (files) => {
    const imageFiles = Array.from(files).filter((file) =>
      file.type.startsWith("image/")
    );

    if (imageFiles.length === 0) {
      setUploadError((prev) => ({
        ...prev,
        images: "Please upload valid image files",
      }));
      return;
    }

    if (media.images.length + imageFiles.length > 10) {
      setUploadError((prev) => ({
        ...prev,
        images: "Maximum 10 images allowed",
      }));
      return;
    }

    const oversizedFiles = imageFiles.filter((file) => !validateFileSize(file));

    if (oversizedFiles.length > 0) {
      setUploadError((prev) => ({
        ...prev,
        images: `${oversizedFiles.length} file(s) exceed 2MB limit. Please reduce file size or convert to WebP format.`,
      }));
      return;
    }

    setUploadError((prev) => ({ ...prev, images: "" }));
    if (clearError) clearError("images");

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
              isExisting: false,
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
    setUploadError((prev) => ({ ...prev, images: "" }));
    if (clearError) clearError("images");
  };

  // Remove logo
  const removeLogo = () => {
    setMedia((prev) => ({ ...prev, logo: null }));
    if (logoInputRef.current) logoInputRef.current.value = "";
    setUploadError((prev) => ({ ...prev, logo: "" }));
    if (clearError) clearError("logo");
  };

  return (
    <div className="max-w-4xl mx-auto p-6 space-y-12">
      {/* Logo Upload */}
      <section ref={refs?.logoRef}>
        <div className="flex items-start gap-2 mb-4">
          <h3 className="text-xl font-semibold uppercase text-gray-800">
            Upload Logo
          </h3>
          <span className="text-red-600">&#42;</span>

          {(error?.logo || uploadError.logo) && (
            <div className="flex-1">
              <p className="text-red-600 text-sm font-medium">
                {uploadError.logo || error?.logo}
              </p>
            </div>
          )}
        </div>
        <div className="bg-white rounded-lg border-2 border-dashed p-8">
          {!media?.logo ? (
            <div className="text-center">
              <div className="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <FaImage className="w-8 h-8 text-gray-400" />
              </div>
              <p className="text-gray-600 mb-2">Upload your logo image</p>
              <p className="text-xs text-gray-500 mb-4">
                Maximum file size: 2MB (WebP format recommended)
              </p>
              <input
                ref={logoInputRef}
                type="file"
                accept="image/*"
                onChange={handleLogoUpload}
                className="hidden"
                id="logo-upload"
              />
              <label
                htmlFor="logo-upload"
                className="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 cursor-pointer transition-colors"
              >
                <FaUpload className="w-4 h-4 mr-2" /> Choose Logo
              </label>
            </div>
          ) : (
            <div className="flex items-center space-x-6">
              <div className="relative">
                <Image
                  src={
                    media.logo?.isExisting
                      ? `${APP_URL}/${media.logo.preview}`
                      : media.logo?.preview || ""
                  }
                  alt="Logo preview"
                  height={500}
                  width={500}
                  className="w-20 h-20 object-contain border rounded-lg bg-gray-50"
                />
                <button
                  onClick={removeLogo}
                  className="absolute -top-2 -right-2 w-7 h-7 rounded-full flex items-center justify-center"
                >
                  <MdCancel className="w-7 h-7 text-white rounded-full bg-red-500" />
                </button>
              </div>
              <div>
                <p className="font-medium text-gray-800">
                  {media.logo?.name ||
                    (media.logo?.isExisting ? "Existing Logo" : "Logo")}
                </p>
                <p className="text-sm text-gray-500">
                  Logo uploaded successfully
                </p>
                <button
                  onClick={() => logoInputRef.current?.click()}
                  className="mt-2 text-blue-600 hover:text-blue-700 text-sm font-medium"
                >
                  Change logo
                </button>
              </div>
            </div>
          )}
        </div>
      </section>

      {/* Multiple Images Upload */}
      <section ref={refs?.imagesRef}>
        <div className="flex items-start gap-2 mb-4">
          <h3 className="text-xl font-semibold uppercase text-gray-800">
            Upload Images
          </h3>
          <span className="text-red-600">&#42;</span>

          {(error?.images || uploadError.images) && (
            <div className="flex-1">
              <p className="text-red-600 text-sm font-medium">
                {uploadError.images || error?.images}
              </p>
            </div>
          )}
        </div>
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
            <p className="text-sm text-gray-500 mb-1">
              Maximum 10 images ({media?.images?.length || 0}/10 uploaded)
            </p>
            <p className="text-xs text-gray-500 mb-4">
              Each file must be 2MB or less (WebP format recommended)
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

        {media?.images && media.images.length > 0 && (
          <div className="mt-6">
            <h4 className="text-lg font-medium text-gray-800 mb-4">
              Uploaded Images
            </h4>
            <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
              {media.images.map((img) => (
                <div key={img.id} className="relative group">
                  <div className="aspect-square bg-gray-100 rounded-lg overflow-hidden">
                    <img
                      src={
                        img?.isExisting
                          ? `${APP_URL}/${img.preview}`
                          : img?.preview || ""
                      }
                      alt={img?.name || "Image"}
                      className="w-full h-full object-cover"
                    />
                  </div>
                  <button
                    onClick={() => removeImage(img.id)}
                    className="absolute -top-2 -right-2 w-7 h-7 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity"
                  >
                    <MdCancel className="w-7 h-7 text-white rounded-full bg-red-500" />
                  </button>
                  <p
                    className="mt-1 text-xs text-gray-600 truncate"
                    title={
                      img?.name ||
                      (img?.isExisting ? "Existing Image" : "Image")
                    }
                  >
                    {img?.name ||
                      (img?.isExisting ? "Existing Image" : "Image")}
                  </p>
                </div>
              ))}
            </div>
          </div>
        )}
      </section>
    </div>
  );
};

export default ImageUploadSections;
