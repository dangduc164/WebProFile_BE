export const ROUTER_PATH = {
    ADMIN: '/admin',
    LOGIN: '/admin/login',
}

export const ROUTE_NAME = {
    ADMIN: {
        LOGIN: 'AdminLogin',
        EDIT_PROFILE: 'AdminEditProfile',
    }
}

export const TYPE_USER = {
    USER: "user",
    ADMIN: "admin",
};

export const STATUS_CODE = {
    BadRequest: 400,
    Unauthorized: 401,
    Forbidden: 403,
    TooManyRequests: 429,
    ValidationFailed: 422,
    InternalServerError: 500,
};
