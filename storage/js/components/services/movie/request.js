import axios from "axios";

export const Movies = type => {
  return axios.create({
    baseURL: `${process.env.MIX_BASE_URL}/movies/get?&${type}`
  });
};
