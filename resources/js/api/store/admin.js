import api from "../http-request";
import apiConstants from "../apiConstant";

//[POST] method
export const loginApi = async (data) =>
    api.post(apiConstants.AUTH.LOGIN, data, {
        headers: {
            "Content-Type": "multipart/form-data",
        },
    });
export const logoutApi = async () => api.post(apiConstants.AUTH.LOGOUT);

//[GET] methods
export const getInforApi = async (id) => api.get(`/admin/${id}/info-user`);

//[PUT] method
export const resetPassWordUser = async (email) =>
    api.put(`${apiConstants.AUTH.RESET_PASSWORD}/${email}`);
export const createOrUpdateApi = async (id, data) =>
    api.put(`/admin/${id}/createOrUpdate`, data);
