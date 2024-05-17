import api from "../http-request";
import apiConstants from "../apiConstant";

export const uploadAvatarApi = async (data) =>
  api.post('admin/upload-avatar', data, {
    headers: {
      "Content-Type": "multipart/form-data",
    },
  });
