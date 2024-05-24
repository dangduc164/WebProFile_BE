import moment from "moment";

export const isCheckValidate = (data, error) => {
    Object.keys(data).forEach((item) => {
        if (!data[item]) {
            error[item] = 'require';
        } else {
            error[item] = null;
        }
    });
};
export const convertDateOfBirth = (date) => {
    if (date) {
        if (String(date).length === 8) {
            const newDate = moment(date, "DDMMYYYY").format("DD-MM-YYYY");
            return newDate;
        }
    }
};
