import axios from "axios";
import { API_URL } from "@/services/constants";

// get multiple listings based on category and city with pagination
export const get_listing_by_slug = async (SLUG, city, page = 1, filter) => {
  try {
    const response = await axios.get(`${API_URL}/listing/${SLUG}/${city}`, {
      params: {
        page,
        sort_by: filter?.sort_by || null,
        ag_verified: filter?.ag_verified || null,
        facility: filter?.facilities_id || null,
        service: filter?.service_id || null,
        payment_mode: filter?.payment_mode_id || null,
      },
    });
    return response?.data;
  } catch (error) {
    console.log(error);
    return error?.response?.data;
  }
};

// market place single listing by id
export const get_marketplace_by_id = async (ID) => {
  try {
    const response = await axios.get(`${API_URL}/marketplace/listings/${ID}`);
    return response?.data;
  } catch (error) {
    return null;
  }
};
//get listings by userID
export const get_user_listings = async (type) => {
  const token = localStorage.getItem("authToken");
  try {
    const response = await axios.get(`${API_URL}/user/listing/${type}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    console.log("i am user listings ", response);
    return response;
  } catch (error) {
    console.error("Error fetching user listings:", error);
    return error;
  }
};
// get single listing  for landing page
export const get_listing_data = async (SLUG) => {
  try {
    const response = await axios.get(`${API_URL}/listing/${SLUG}`);
    console.log("response of single listing", response?.data);
    return response?.data?.data;
  } catch (error) {
    return null;
  }
};

export const get_listing_data_single = async (SLUG) => {
  const token = localStorage.getItem("authToken");
  try {
    const response = await axios.get(
      `${API_URL}/user/listing/listing/${SLUG}`,
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    );
    console.log("response of single listing", response?.data);
    return response?.data;
  } catch (error) {
    return null;
  }
};

export const get_marketplace_listing = async () => {
  try {
    const response = await axios.get(`${API_URL}/marketplace`);
    return response?.data?.data;
  } catch (error) {
    console.log("this is get marketplace error", error);
  }
};
export const get_marketplace_listing_by_category = async (ID) => {
  try {
    const response = await axios.get(`${API_URL}/marketplace/${ID}`);
    return response?.data;
  } catch (error) {
    console.log("this is get marketplace category error", error);
  }
};
//recent listings for main page
export const get_recent_listings = async (type) => {
  try {
    const res = await axios.get(`${API_URL}/recent/${type}`);
    // console.log("recent listing ", res?.data);
    return res?.data?.result;
  } catch (error) {
    console.log(error);
  }
};
