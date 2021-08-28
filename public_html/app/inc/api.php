<script>
    const API_HOST = 'https://nviame.com';
    const API = {
        host: API_HOST,
        root: `${API_HOST}/api`,
        request: function(path, data, method, extra) {
            return new Promise(function(resolve, reject) {
                $.ajax(Object.assign({
                    type: method,
                    url: `${API.root}/${path}`,
                    data: data,
                    complete: function (jqXHR) {
                        switch(jqXHR.status) {
                            case 200:
                                var jsonResp = null;
                                try {
                                    jsonResp = JSON.parse(jqXHR.responseText);
                                }
                                catch(e) {

                                }
                                if(jsonResp) {
                                    resolve(jqXHR.responseJSON);
                                }
                                else {
                                    reject({
                                        status: jqXHR.status,
                                        description: 'No Valid JSON'
                                    });
                                }
                            break;
                            default:
                                reject({
                                    status: jqXHR.status,
                                    description: jqXHR.statusText
                                });
                        }
                    }
                }, extra));
            });
        },
        get: function(path, data, extra) {
            if(typeof extra === 'undefined') extra = {};
            if(typeof data === 'undefined') data = {};
            return API.request(path, data, 'GET', extra);
        },
        post: function(path, data, extra) {
            if(typeof extra === 'undefined') extra = {};
            if(typeof data === 'undefined') data = {};
            return API.request(path, data, 'POST', extra);
        },
        put: function(path, data, extra) {
            if(typeof extra === 'undefined') extra = {};
            if(typeof data === 'undefined') data = {};
            return API.request(path, data, 'PUT', extra);
        },
        delete: function(path, data, extra) {
            if(typeof extra === 'undefined') extra = {};
            if(typeof data === 'undefined') data = {};
            return API.request(path, data, 'DELETE', extra);
        }
    };
</script>