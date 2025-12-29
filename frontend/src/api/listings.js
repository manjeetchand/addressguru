import axios from "axios";
import { API_URL } from "@/services/constants";



// job listings 
export const get_all_jobs_listings = async () => {
    // console.log("api response for jobs");
  try {
    const response = await axios.get(`${API_URL}/jobs`);
    // console.log("api response for jobs", response);
    return response?.data?.jobs;
  } catch (error) {
    return null;
  }
};

// job details
export const get_job_details = async (ID) => {
  try {
    const response = await axios.get(`${API_URL}/jobs/${ID}`)
    // console.log("response of solo job",response?.data)
    return response?.data?.jobs;
  } catch (error) {
     return null;
  }
}
