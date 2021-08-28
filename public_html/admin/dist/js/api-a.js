/*const API_Config = {
    host: 'http://driftpadel.com.ar/sbxnv',
    path: 'api',
    socketPort: 3344
};*/
const API_Config = {
    host: 'https://nviame.com',
    path: 'api',
    socketPort: 5533
}
const API = {
    getShipmentPicture: function(pic) {
        return `${API_Config.host}/${API_Config.path}/uploads/shipments/${pic}`;
    },
    getUserPicture: function(pic) {
        return `${API_Config.host}/${API_Config.path}/uploads/users/${pic || "default.png"}`;
    },
    getCommercePicture: function(pic) {
        return `${API_Config.host}/app/uploads/${pic}`;
    },
    getConveyancePicture: function(pic) {
        return `${API_Config.host}/${API_Config.path}/uploads/conveyances/${pic}`;
    },
    getChatPicture: function(pic) {
        return `${API_Config.host}/${API_Config.path}/uploads/chats/${pic}`;
    },
    request: (path, data, cb, type) => {
        $.ajax({
            url: `${API_Config.host}/${API_Config.path}/a/${path}`,
            type: type,
            data: data
        }).done(data => {
            cb(data);
        });
    },
    get: (path, data, cb) => {
        API.request(path, data, cb, 'GET');
    },
    post: (path, data, cb) => {
        API.request(path, data, cb, 'POST');
    },
    put: (path, data, cb) => {
        API.request(path, data, cb, 'PUT');
    }
}