const CONFIG = {
    NODEJS: {
        port: 3355
    },
    MYSQL: {
        host: "localhost",
        user: "nviame_app",
        password: "RB1fr30a",
        database: "nviame",
        multipleStatements: true
    },
    MISC: {
        primary_color: '#4C00FF'
    },
    MP: {
        client_id: '8456003364969642',
        client_secret: 'Zb9ejdCsUZk5YjlMinWvYDnXoxomWzF5',
        access_token_test: 'TEST-8456003364969642-103113-0e105765ef24416efcabdf9a27633220-484927268',
        access_token_prod: 'APP_USR-8456003364969642-103113-8bb691be752547ebab5ca625491ab440-484927268',
        public_key_test: 'TEST-13be80f4-544a-4c42-b2e5-00859daeaa98',
        public_key_prod: 'APP_USR-2eeecf88-9656-43a6-ac40-7f01d727595d',
        sandbox: false
    },
    FCM: {
        serverKey: 'AAAA11-q2gg:APA91bGy4K9HRPaKNzkhU8d5MnY6OugfdfIKDlF6ZSLspBnRouwoor0w01TjaBtLz7XMA5pZohDiAupwJdETRs7qBaCMhlBupH3yf8r4gEqhCpE8iVJv7o7BGTUEb42vToQuiUNPEHCo'
    },
    GMAPS: {
        apiKey: 'AIzaSyBrfdSCaNPmklpwWIj5TsT5GQIEaOQD698'
    },
    ONESIGNAL: {
        appId: '111c67c1-8b1a-43cc-a914-760b403e26bf',
        apiKey: 'MzM0ZDE1ODItODVmYS00OTZiLWJkMTAtOGEzNWI1YmVhYjk4'
    }
};

const app = require('express')();
const server = require('http').createServer(app);
const options = {};
const io = require('socket.io')(server, options);

const moment = require("moment");

const axios = require('axios');

const mp = require("mercadopago");

const redis = require("redis");

const OneSignal = require('onesignal-node');

function handleNewShipment(socket, data) {
    if (typeof data === 'object') {
        console.log('new shipment: ', data);
        if(socket) {
            socket.broadcast.emit('new shipment', data);
        }
        else {
            emitToClient('*', 'new shipment', data);
        }
        const pushData = {
            title: `Nuevo envío disponible`,
            content: `${data.user.name} ha creado un nuevo envío`,
            rel: 'new-shipment',
            additionalData: Object.assign(data.shipment, {
                owner: {
                    id: data.user.id
                }
            }),
            actions: [{
                //"icon": "shipment_offer",
                "title": "OFERTAR",
                "callback": "shipment_offer",
                "foreground": true
            }]
        };
        sendPushNotification(pushData);
    }
}

function arrGroupBy(objectArray, property) {
    return objectArray.reduce((acc, obj) => {
       const key = obj[property];
       if (!acc[key]) {
          acc[key] = [];
       }
       // Add object to list for given key's value
       acc[key].push(obj);
       return acc;
    }, {});
 }

var clients = {},
    subscriptions = {
        data: [],
        add: function(s, name, data) {
            if(subscriptions.data.filter(r => r.name != name && r.socket.id != s.id).length == 0) {
                subscriptions.data.push({
                    socket: s,
                    name: name,
                    data: data
                });
            }
        },
        remove: function(s, name) {
            subscriptions.data = subscriptions.data.filter(r => r.name != name && r.socket.id != s.id);
        },
        trigger: function(name, key, value, info) {
            subscriptions.data.forEach(function(row) {
                //console.log(row.name, row.data);
                if(row.name == name && row["data"][key] == value) {
                    //console.log('------------------------------------------------------');
                    //console.log('subscription trigger', name, key, value, row["data"][key], info, row.data);
                    const json = {
                        name: row.name,
                        data: info
                    };
                    //console.log('emit [suscription]', json);
                    row.socket.emit('[suscription]', json);
                    //console.log('------------------------------------------------------');
                }
            });
        }
    };

var mysql = require('promise-mysql');

var fAdmin = require("firebase-admin");

var firebaseServiceAccount = require("./nviame-3a5fe-firebase-adminsdk-j2q73-1c68c2cc31.json");
const { type } = require('os');

fAdmin.initializeApp({
    credential: fAdmin.credential.cert(firebaseServiceAccount),
    databaseURL: "https://nviame-3a5fe.firebaseio.com"
});

const fcm = fAdmin.messaging();

mp.configure(CONFIG.MP.sandbox ? {
    sandbox: CONFIG.MP.sandbox,
    access_token: CONFIG.MP.access_token_test
} : {
    access_token: CONFIG.MP.access_token_prod
});

const osClient = new OneSignal.Client(CONFIG.ONESIGNAL.appId, CONFIG.ONESIGNAL.apiKey);

/*setTimeout(function() {
    mp.payment.update(
        {
          id: "29540327",
          status: "approved"
        },
        function() {
            
        }
    );
}, 2000);*/

function emitToClient(userId, name, data) {
    console.log('emitToClient', userId, name, data);
    if(userId === '*') {
        Object.keys(clients).forEach(id => {
            clients[id].socket.emit(name, data);
        });
    }
    else if(clients.hasOwnProperty(userId)) {
        clients[userId].socket.emit(name, data);
    }
}

function saveNotification(data) {
    console.log('~~ saveNotification > ', data);
    var ids = [];
    async function runQuery() {
        let connection;
        mysql.createConnection(CONFIG.MYSQL).then(conn => {
            connection = conn;
            ids = data.id_user ? (Array.isArray(data.id_user) ? data.id_user : [data.id_user]) : [null];
            if(ids.length == 0) {
                ids = [null];
            }
            ids = [...new Set(ids)];
            return connection.query(
                ids.map(id => `
                    INSERT INTO notifications ( 
                        id_user,
                        id_shipment, 
                        id_offer,
                        title, 
                        content, 
                        datetime, 
                        readed, 
                        \`group\`
                    ) VALUES ( 
                        ${id},
                        ${data.hasOwnProperty('id_shipment') ? data.id_shipment : null},
                        ${data.hasOwnProperty('id_offer') ? data.id_offer : null},
                        ${data.hasOwnProperty('title') ? `'${data.title}'` : null},
                        ${data.hasOwnProperty('content') ? `'${data.content}'` : null},
                        UTC_TIMESTAMP(),
                        ${data.hasOwnProperty('readed') ? data.readed : 0},
                        ${data.hasOwnProperty('group') ? `'${data.group}'` : null}
                    )`
                ).join(';')
            );
        }).then(d => {
            return connection.query(`
                SELECT * FROM notifications WHERE id = ?
            `, [
                d.insertId
            ]);
        }).then(d => {
            if(d.length > 0) {
                if(data.hasOwnProperty('id_user')) {
                    ids.forEach(function(idu) {
                        emitToClient(idu, 'notification', d[0]);
                    });
                }
                else {
                    emitToClient('*', 'notification', d[0]);
                }
            }
            connection.end();
        }).catch(err => {
            console.log('err', err);
            //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
        });
    }

    runQuery();
}

function sendPushNotification(params) {
    console.log(`\n # sendPushNotification ~ `, params);

    if(!(params.hasOwnProperty('ids') && params.ids == '*')) {
        params.ids = params.hasOwnProperty('ids') ? (typeof params.ids == 'object' ? params.ids : [params.ids]) : '*';
    }

    async function send(registrationTokens) {
        console.log('sendPushNotification ~ send ~ ', registrationTokens);
        if (registrationTokens.length == 0) return;

        var fcmTokens = registrationTokens.filter(t => t.length != 36);
        if(fcmTokens.length > 0) {
            var data = {};
            if (params.hasOwnProperty('rel')) {
                data.rel = params.rel;
            }
            let message = {
                data: data,
                notification: {
                    title: params.title,
                    body: params.content
                },
                style: "inbox",
                android: {
                    notification: {
                        //icon: 'ic_n',
                        color: CONFIG.MISC.primary_color
                    }
                },
                content_available: true,
                apns: {
                    payload: {
                        aps: {
                            badge: 42,
                        },
                    },
                },
                tokens: fcmTokens
            };
    
            if (params.hasOwnProperty('additionalData')) {
                message.additionalData = params.additionalData;
            }

            fcm.sendMulticast(message).then(response => {
                response.responses.forEach((r, i) => {
                    if(r.success) {
                        console.log('Sent to ', fcmTokens[i]);
                    }
                    else {
                        console.error('Not sent to ', fcmTokens[i], ' error > ', r.error);
                    }
                });
                //console.log(response.successCount + ' messages were sent successfully');
            });
        }

        // OneSignal
        var osTokens = registrationTokens.filter(t => t.length == 36);
        if(osTokens.length > 0) {
            osClient.createNotification({ 
                app_id: CONFIG.ONESIGNAL.appId,
                small_icon: 'ic_n',
                headings: {
                    "es": params.title,
                    "en": params.title
                },
                contents: {
                    "es": params.content,
                    "en": params.content
                },
                include_player_ids: osTokens,
                channel_for_external_user_ids: "push",
                data: params.hasOwnProperty('additionalData') ? params.additionalData : {},
                buttons: params.hasOwnProperty('actions') ? params.actions.map(r => {
                    return {
                        "id": r.callback,
                        "text": r.title
                    };
                }) : []
            }).then(response => {
                console.log(response);
            }).catch(e => {
                console.log(e);
            });
        }
    }

    async function runQuery() {
        let connection;
        var ids = [];
        var bandSend = false;
        mysql.createConnection(CONFIG.MYSQL).then(conn => {
            connection = conn;
            var query = '';
            if (params.ids === '*') {
                switch (params.rel) {
                    case 'new-shipment':
                        const additionalData = params.additionalData;
                        const locN = additionalData.start_address.locality.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                        query = `
                            SELECT
                                u.id, u.email 
                            FROM
                                users AS u INNER JOIN users_settings AS s ON u.id = s.user_id 
                            WHERE
                                s.push_new_shipments = 1 AND (u.last_location_locality = '${additionalData.start_address.locality}' OR u.locality = '${additionalData.start_address.locality}' OR u.locality = '${locN}') AND s.user_id != ${additionalData.owner.id}
                        `;
                        break;
                    default:
                        query = `
                            SELECT
                                id, email 
                            FROM
                                users
                        `;
                }
            }
            else {
                if(params.rel == 'chat-new-message') {
                    query = `
                        SELECT
                            u.id, u.email 
                        FROM
                            users AS u INNER JOIN users_settings AS s ON u.id = s.user_id 
                        WHERE
                            s.push_chats = 1 AND u.id IN (?)
                    `;
                }
                else {
                    query = `
                        SELECT
                            id, email 
                        FROM
                            users 
                        WHERE
                            id IN (?)
                    `;
                }
            }
            return query.indexOf('?') != -1 ? connection.query(query, params.ids.join(',')) : connection.query(query);
        }).then(data => {
            if(data.length > 0) {
                ids = data.map(r => r.id);
                let emails = data.map(r => r.email);
                //let query = 'SELECT reg_id FROM users_push_reg_ids WHERE email IN (' + emails.map(e => `"${e}"`).join(',') + ') AND enabled = 1';
                let query = 'SELECT upri.reg_id FROM users_push_reg_ids AS upri INNER JOIN users AS u ON upri.email = u.email LEFT JOIN users_settings AS us ON u.id = us.id WHERE upri.email IN (' + emails.map(e => `"${e}"`).join(',') + ') AND upri.enabled = 1 AND (us.`online` = 1 OR us.`online` IS NULL)';
                bandSend = true;
                return connection.query(query);
            }
            else {
                return connection.query("SELECT 1");
            }
        }).then(data => {
            if(bandSend) {
                let regIds = data.map(r => r.reg_id);
                if(regIds.length > 0) {
                    send(regIds);
                }
            }
            if(params.ids === '*' && params.rel) {
                saveNotification({
                    id_user: ids,
                    title: params.title,
                    content: params.content,
                    id_shipment: params.additionalData.id,
                    group: 'new_shipment'
                });
            }
            connection.end();
        }).catch(err => {
            console.log('err', err);
            //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
        });
    }

    runQuery();
}

io.on('connection', socket => {
    socket.on('user connect', data => {
        if (typeof data === 'object') {
            socket._user_data = data;

            if(clients.hasOwnProperty(data.user.id) && clients[data.user.id].socket.id != socket.id) {
                /*socket.emit('system message', {
                    type: 'info',
                    content: 'Hay una sesión activa en otro dispotivo y ha sido cerrada.'
                });*/
            }

            clients[data.user.id] = {
                data: data,
                socket: socket,
                socket_id: socket.id,
                logout: false
            };
            socket.broadcast.emit('user status', {
                id: data.user.id,
                status: 'online'
            });
            socket.broadcast.emit('user connected', {
                id: data.user.id
            });
            console.log('\nSocket clients: ', Object.keys(clients));
            console.log(`\nuser connect: ${data.user.id} -> ${data.user.email}`);
        }
    });
    socket.on('offer accepted', data => {
        if (typeof data === 'object') {
            console.log('offer accepted: ', data);
            socket.broadcast.emit('offer accepted', data);
            const pushData = {
                ids: data.user.id,
                title: 'Oferta aceptada',
                content: `Tu oferta por $${data.shipment.offer} ha sido aceptada.`
            };
            sendPushNotification(pushData);
            saveNotification({
                id_user: pushData.ids,
                title: pushData.title,
                content: pushData.content,
                id_shipment: data.shipment.id,
                id_offer: data.shipment.offer_id,
                group: 'offer_accepted'
            });

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `SELECT id_user, offer FROM shipments_offers WHERE id_shipment = ? AND id_user != ?`;
                    return connection.query(query, [data.shipment.id, data.user.id]);
                }).then(d => {
                    if(d.length > 0) {
                        d.forEach(r => {
                            const pushData = {
                                ids: r.id_user,
                                title: 'Oferta no aceptada',
                                content: `Tu oferta por $${r.offer} no ha sido aceptada. El envío aceptó una oferta por $${data.shipment.offer}.`
                            };
                            sendPushNotification(pushData);
                            saveNotification({
                                id_user: pushData.ids,
                                title: pushData.title,
                                content: pushData.content,
                                id_shipment: data.shipment.id,
                                id_offer: data.shipment.offer_id,
                                group: 'offer_not_accepted'
                            });
                            emitToClient(pushData.ids, 'offer not accepted', data);
                        });
                    }
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });
    socket.on('offer refused', data => {
        if (typeof data === 'object') {
            console.log('offer refused: ', data);
            socket.broadcast.emit('offer refused', data);
            const pushData = {
                ids: data.user.id,
                title: 'Oferta rechazada',
                content: `Tu oferta por $${data.shipment.offer} ha sido rechazada.`
            };
            sendPushNotification(pushData);
            saveNotification({
                id_user: pushData.ids,
                title: pushData.title,
                content: pushData.content,
                id_shipment: data.shipment.id,
                id_offer: data.shipment.offer_id,
                group: 'offer_refused'
            });
        }
    });
    socket.on('new offer', data => {
        if (typeof data === 'object') {
            console.log('new offer: ', data);
            socket.broadcast.emit('new offer', data);
            var messageContent = `${data.user.name} ha ofertado $${data.shipment.offer} por tu envío.`;
            if(data.arrival_distance) {
                messageContent = `${messageContent} Con arribo aproximado de ${data.arrival_distance.duration.text} y distancia de ${data.arrival_distance.distance.text}`;
            }
            const pushData = {
                ids: data.shipment.id_user,
                title: 'Nueva oferta',
                content: messageContent
            };
            sendPushNotification(pushData);
            saveNotification({
                id_user: pushData.ids,
                title: pushData.title,
                content: pushData.content,
                id_shipment: data.shipment.id,
                id_offer: data.shipment.offer_id,
                group: 'new_offer'
            });
        }
    });
    
    socket.on('new shipment', data => {
        handleNewShipment(socket, data);
    });

    socket.on('check payment', data => {
        if (typeof data === 'object') {
            console.log('check payment: ', data);

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `SELECT * FROM shipments_payments WHERE id_shipment = ${data.id_shipment}`;
                    return connection.query(query);
                }).then(data => {
                    socket.emit('status payment', data.length > 0 ? data[0] : null);
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('check payment extra', data => {
        if (typeof data === 'object') {
            console.log('check payment extra: ', data);

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `SELECT * FROM shipments_payments_extra WHERE id_shipment = ${data.id_shipment}`;
                    return connection.query(query);
                }).then(data => {
                    socket.emit('status payment extra', data.length > 0 ? data[0] : null);
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('shipment retired', data => {
        if (typeof data === 'object') {
            console.log('shipment retired: ', data);

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `UPDATE shipments SET id_status = 3 WHERE id = ${data.id}`;
                    return connection.query(query);
                }).then(d => {
                    socket.emit('shipment retired', {
                        id: data.id
                    });
                    socket.broadcast.emit('shipment retired', {
                        id: data.id
                    });
                    return connection.query(`
                        INSERT INTO shipments_operations_history (
                            id_shipment,
                            id_user,
                            uid,
                            datetime,
                            valor
                        ) VALUES (
                            ?,
                            ?,
                            ?,
                            ?,
                            ?
                        )
                    `, [
                        data.id,
                        socket._user_data.user.id,
                        'retired',
                        moment.utc().format('YYYY-MM-DD HH:mm:ss'),
                        null
                    ]);
                }).then(d => {
                    return connection.query(`
                        SELECT * FROM shipments_operations_history WHERE id_shipment = ?
                    `, [
                        data.id
                    ]);
                }).then(d => {
                    if(d.length > 0) {
                        var dataT = arrGroupBy(d, 'uid');
                        dataT._uid = 'retired';
                        socket.emit('shipment timeline updated', dataT);
                    }
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('shipment travel on', data => {
        if (typeof data === 'object') {
            console.log('shipment travel on: ', data);

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `UPDATE users SET traveling = 1 WHERE id = ${socket._user_data.user.id};UPDATE shipments SET id_status = 4 WHERE id = ${data.id}`;
                    return connection.query(query);
                }).then(d => {
                    socket.emit('shipment travel on', {
                        id: data.id
                    });
                    socket.broadcast.emit('shipment travel on', {
                        id: data.id
                    });
                    return connection.query(`
                        INSERT INTO shipments_operations_history (
                            id_shipment,
                            id_user,
                            uid,
                            datetime,
                            valor
                        ) VALUES (
                            ?,
                            ?,
                            ?,
                            ?,
                            ?
                        )
                    `, [
                        data.id,
                        socket._user_data.user.id,
                        'on_travel',
                        moment.utc().format('YYYY-MM-DD HH:mm:ss'),
                        null
                    ]);
                }).then(d => {
                    return connection.query(`
                        SELECT * FROM shipments_operations_history WHERE id_shipment = ?
                    `, [
                        data.id
                    ]);
                }).then(d => {
                    if(d.length > 0) {
                        var dataT = arrGroupBy(d, 'uid');
                        dataT._uid = 'on_travel';
                        socket.emit('shipment timeline updated', dataT);
                    }
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('get shipment timeline updated', data => {
        if (typeof data === 'object') {
            console.log('get shipment timeline updated: ');
            console.log(data);

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    return connection.query(`
                        SELECT * FROM shipments_operations_history WHERE id_shipment = ${data.id}
                    `);
                }).then(d => {
                    console.log(d);
                    if(d.length > 0) {
                        var dataT = arrGroupBy(d, 'uid');
                        Object.keys(dataT).forEach(k => {
                            if(Array.isArray(dataT[k])) {
                                dataT[k] = dataT[k][0];
                            }
                        });
                        dataT._uid = null;
                        console.log(dataT);
                        socket.emit('shipment timeline updated', dataT);
                    }
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('shipment delivered', data => {
        if (typeof data === 'object') {
            console.log('shipment delivered: ', data);

            var deliver_id = 0;

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `
                        SELECT
                            s.id_user,
                            u.id AS deliver_id,
                            IFNULL(u.fullname, u.email) AS deliver
                        FROM
                            shipments AS s
                        INNER JOIN 
                            shipments_offers AS o 
                        ON 
                            s.id = o.id_shipment 
                        INNER JOIN 
                            users AS u
                        ON 
                            o.id_user = u.id
                        WHERE
                            s.id = ${data.id} AND o.accepted_at IS NOT NULL
                    `;
                    return connection.query(query);
                }).then(dataQuery => {
                    deliver_id = dataQuery[0].deliver_id;
                    if(dataQuery.length > 0) {
                        const pushData = {
                            ids: dataQuery[0].id_user,
                            title: 'Paquete entregado',
                            //content: `${dataQuery[0].deliver.split('@').shift()} ha entregado tu envío.`
                            content: `Tu envío se ha entregado y confirmado.`
                        };
                        sendPushNotification(pushData);
                        saveNotification({
                            id_user: pushData.ids,
                            title: pushData.title,
                            content: pushData.content,
                            group: 'shipment_delivered'
                        });

                        const pushData2 = {
                            ids: deliver_id,
                            title: 'Paquete confirmado',
                            content: `Tu entrega ha sido confirmada.`
                        };
                        sendPushNotification(pushData2);
                        saveNotification({
                            id_user: pushData2.ids,
                            title: pushData2.title,
                            content: pushData2.content,
                            group: 'shipment_delivered'
                        });
                    }
                    const query = `UPDATE shipments SET id_status = 5, delivered_at = UTC_TIMESTAMP() WHERE id = ${data.id};UPDATE users SET traveling = 0 WHERE id = ${deliver_id};DELETE FROM shipments_users_locations WHERE id_shipment = ${data.id};`;
                    return connection.query(query);
                }).then(dataQuery => {
                    socket.emit('shipment delivered', {
                        id: data.id
                    });
                    socket.broadcast.emit('shipment delivered', {
                        id: data.id
                    });
                    return connection.query(`
                        INSERT INTO shipments_operations_history (
                            id_shipment,
                            id_user,
                            uid,
                            datetime,
                            valor
                        ) VALUES (
                            ?,
                            ?,
                            ?,
                            ?,
                            ?
                        )
                    `, [
                        data.id,
                        deliver_id,
                        'delivered',
                        moment.utc().format('YYYY-MM-DD HH:mm:ss'),
                        null
                    ]);
                }).then(d => {
                    return connection.query(`
                        SELECT * FROM shipments_operations_history WHERE id_shipment = ?
                    `, [
                        data.id
                    ]);
                }).then(d => {
                    if(d.length > 0) {
                        var dataT = arrGroupBy(d, 'uid');
                        dataT._uid = 'delivered';
                        emitToClient(deliver_id, 'shipment timeline updated', dataT);
                    }
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('shipment returned', data => {
        if (typeof data === 'object') {
            console.log('shipment returned: ', data);

            var deliver_id = 0;

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `
                        SELECT
                            s.id_user,
                            u.id AS deliver_id,
                            IFNULL(u.fullname, u.email) AS deliver
                        FROM
                            shipments AS s
                        INNER JOIN 
                            shipments_offers AS o 
                        ON 
                            s.id = o.id_shipment 
                        INNER JOIN 
                            users AS u
                        ON 
                            o.id_user = u.id
                        WHERE
                            s.id = ${data.id} AND o.accepted_at IS NOT NULL
                    `;
                    return connection.query(query);
                }).then(dataQuery => {
                    if(dataQuery.length > 0) {
                        const pushData = {
                            ids: dataQuery[0].deliver_id,
                            title: 'Paquete devuelto',
                            content: `La devolución del envío se ha confirmado.`
                        };
                        sendPushNotification(pushData);
                        saveNotification({
                            id_user: pushData.ids,
                            title: pushData.title,
                            content: pushData.content,
                            group: 'shipment_returned'
                        });
                    }
                    deliver_id = dataQuery[0].deliver_id;
                    const query = `UPDATE shipments SET id_status = 7 WHERE id = ${data.id};UPDATE users SET traveling = 0 WHERE id = ${dataQuery[0].deliver_id};DELETE FROM shipments_users_locations WHERE id_shipment = ${data.id};`;
                    return connection.query(query);
                }).then(dataQuery => {
                    socket.emit('shipment returned', {
                        id: data.id,
                        message: true
                    });
                    socket.broadcast.emit('shipment returned', {
                        id: data.id
                    });
                    return connection.query(`
                        INSERT INTO shipments_operations_history (
                            id_shipment,
                            id_user,
                            uid,
                            datetime,
                            valor
                        ) VALUES (
                            ?,
                            ?,
                            ?,
                            ?,
                            ?
                        )
                    `, [
                        data.id,
                        deliver_id,
                        'return',
                        moment.utc().format('YYYY-MM-DD HH:mm:ss'),
                        null
                    ]);
                }).then(d => {
                    return connection.query(`
                        SELECT * FROM shipments_operations_history WHERE id_shipment = ?
                    `, [
                        data.id
                    ]);
                }).then(d => {
                    if(d.length > 0) {
                        var dataT = arrGroupBy(d, 'uid');
                        dataT._uid = 'return';
                        socket.emit('shipment timeline updated', dataT);
                        emitToClient(deliver_id, 'shipment timeline updated', dataT);
                    }
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('shipment delivered notify', data => {
        if (typeof data === 'object') {
            console.log('shipment delivered notify: ', data);

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `
                        SELECT
                            s.id_user,
                            IFNULL(u.fullname, u.email) AS deliver
                        FROM
                            shipments AS s
                        INNER JOIN 
                            shipments_offers AS o 
                        ON 
                            s.id = o.id_shipment 
                        INNER JOIN 
                            users AS u
                        ON 
                            o.id_user = u.id
                        WHERE
                            s.id = ${data.id} AND o.accepted_at IS NOT NULL
                    `;
                    return connection.query(query);
                }).then(dataQuery => {
                    if(dataQuery.length > 0) {
                        const pushData = {
                            ids: dataQuery[0].id_user,
                            title: 'Notificación de paquete entregado',
                            content: `${dataQuery[0].deliver.split('@').shift()} ha notificado que ha entregado tu envío, ahora deberá notificar a la persona a cargo para que confirme la recepción del mismo, a través del enlace de confirmación que le ha proporcionado.`
                        };
                        sendPushNotification(pushData);
                        saveNotification({
                            id_user: pushData.ids,
                            title: pushData.title,
                            content: pushData.content,
                            group: 'shipment_delivered_notify'
                        });
                        socket.emit('shipment delivered notified', {
                            id: data.id
                        });
                    }
                    return connection.query(`
                        INSERT INTO shipments_operations_history (
                            id_shipment,
                            id_user,
                            uid,
                            datetime,
                            valor
                        ) VALUES (
                            ?,
                            ?,
                            ?,
                            ?,
                            ?
                        )
                    `, [
                        data.id,
                        socket._user_data.user.id,
                        'delivery_notification',
                        moment.utc().format('YYYY-MM-DD HH:mm:ss'),
                        null
                    ]);
                }).then(d => {
                    return connection.query(`
                        SELECT * FROM shipments_operations_history WHERE id_shipment = ?
                    `, [
                        data.id
                    ]);
                }).then(d => {
                    if(d.length > 0) {
                        var dataT = arrGroupBy(d, 'uid');
                        dataT._uid = 'delivery_notification';
                        socket.emit('shipment timeline updated', dataT);
                    }
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('shipment cancel status', data => {
        if (typeof data === 'object') {
            console.log('shipment cancel status: ', data);

            async function runQuery2() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `UPDATE shipments SET id_status = NULL WHERE id = ?; DELETE FROM shipments_offers WHERE id_shipment = ${data.id}`;
                    return connection.query(query, [data.id]);
                }).then(d => {
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `
                        SELECT
                            s.id_user AS id,
                            IFNULL(
                                u.fullname,
                            SUBSTRING_INDEX( u.email, '@', 1 )) AS display_name,
                            o.id AS offer_id,
                            o.offer AS offer_amount
                        FROM
                            shipments AS s
                            INNER JOIN shipments_offers AS o ON s.id = o.id_shipment
                            INNER JOIN users AS u ON o.id_user = u.id 
                        WHERE
                            s.id = ${data.id} AND o.accepted_at IS NOT NULL
                    `;
                    return connection.query(query);
                }).then(dataQuery => {
                    if(dataQuery.length > 0) {
                        const pushData = {
                            ids: dataQuery[0].id,
                            title: 'Operación cancelada',
                            content: `${socket._user_data.user.display_name} ha cancelado la operación del envío con oferta realizada de $${dataQuery[0].offer_amount}.`
                        };
                        sendPushNotification(pushData);
                        saveNotification({
                            id_user: pushData.ids,
                            title: pushData.title,
                            content: pushData.content,
                            group: 'shipment_operation_aborted'
                        });
                        socket.emit('shipment operation aborted', {
                            id: data.id
                        });
                        socket.broadcast.emit('shipment operation aborted', {
                            id: data.id
                        });
                        runQuery2();
                    }
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('shipment paid', data => {
        if (typeof data === 'object') {
            console.log('shipment paid: ', data);

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `
                        SELECT
                            u.id AS id,
                            IFNULL(
                                u.fullname,
                            SUBSTRING_INDEX( u.email, '@', 1 )) AS display_name 
                        FROM
                            shipments AS s
                            INNER JOIN shipments_offers AS o ON s.id = o.id_shipment
                            INNER JOIN users AS u ON o.id_user = u.id 
                        WHERE
                            s.id = ${data.id} AND o.accepted_at IS NOT NULL
                    `;
                    return connection.query(query);
                }).then(dataQuery => {
                    if(dataQuery.length > 0) {
                        const pushData = {
                            ids: dataQuery[0].id,
                            title: 'Pago realizado',
                            content: `${socket._user_data.user.display_name} ha realizado el pago de tu oferta.`
                        };
                        if(data.hasOwnProperty('status')) {
                            switch(data.status) {
                                case 'approved':
                                    pushData.title += ' con transacción aprobada';
                                break;
                                case 'in_process':
                                    pushData.title += ' con transacción pendiente de aprobación';
                                break;
                            }
                        }
                        sendPushNotification(pushData);
                        saveNotification({
                            id_user: pushData.ids,
                            title: pushData.title,
                            content: pushData.content,
                            group: 'shipment_paid'
                        });
                    }
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('shipment paid extra', data => {
        if (typeof data === 'object') {
            console.log('shipment paid extra: ', data);

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `
                        SELECT
                            u.id AS id,
                            IFNULL(
                                u.fullname,
                            SUBSTRING_INDEX( u.email, '@', 1 )) AS display_name 
                        FROM
                            shipments AS s
                            INNER JOIN shipments_offers AS o ON s.id = o.id_shipment
                            INNER JOIN users AS u ON o.id_user = u.id 
                        WHERE
                            s.id = ${data.id} AND o.accepted_at IS NOT NULL
                    `;
                    return connection.query(query);
                }).then(dataQuery => {
                    if(dataQuery.length > 0) {
                        const pushData = {
                            ids: dataQuery[0].id,
                            title: 'Pago extra realizado',
                            content: `${socket._user_data.user.display_name} ha realizado el pago extra del envío.`
                        };
                        if(data.hasOwnProperty('status')) {
                            switch(data.status) {
                                case 'approved':
                                    pushData.title += ' con transacción aprobada';
                                break;
                                case 'in_process':
                                    pushData.title += ' con transacción pendiente de aprobación';
                                break;
                            }
                        }
                        sendPushNotification(pushData);
                        saveNotification({
                            id_user: pushData.ids,
                            title: pushData.title,
                            content: pushData.content,
                            group: 'shipment_paid_extra'
                        });
                    }
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('shipment rate', data => {
        if (typeof data === 'object') {
            console.log('shipment rate: ', data);
            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `
                        SELECT
                            r.*,
                            IFNULL(
                                u.fullname,
                            SUBSTRING_INDEX( u.email, '@', 1 )) AS user_display_name
                        FROM
                            users_ratings AS r
                            INNER JOIN shipments AS s ON r.id_shipment = s.id
                            INNER JOIN shipments_offers AS o ON s.id = o.id_shipment
                            INNER JOIN users AS u ON IF(r.id_user = s.id_user, o.id_user, s.id_user) = u.id 
                        WHERE
                            r.id_shipment = ? 
                        ORDER BY id DESC LIMIT 1
                    `;
                    return connection.query(query, [data.id]);
                }).then(d => {
                    if(d.length > 0) {
                        const pushData = {
                            ids: d[0].id_user,
                            title: `${d[0].user_display_name} te ha calificado`,
                            content: `${d[0].comments} ― Calificación otorgada: ${d[0].rating}`
                        };
                        sendPushNotification(pushData);
                        saveNotification({
                            id_user: pushData.ids,
                            title: pushData.title,
                            content: pushData.content,
                            group: 'shipment_rate'
                        });
                        emitToClient(pushData.ids, 'shipment rate', d[0]);
                    }
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('update general user status', data => {
        if (typeof data === 'object') {
            console.log('update general user status', socket._user_data.user.id, data);
            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `UPDATE users_settings SET online = ? WHERE id = ?`;
                    return connection.query(query, [data.online, socket._user_data.user.id]);
                }).then(d => {
                    if(d.affectedRows > 0) {
                        socket.emit('general user status', {
                            status: data.online
                        });
                        socket.broadcast.emit('general user status', {
                            id: socket._user_data.user.id,
                            status: data.online
                        });
                    }
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('check user status', data => {
        if (typeof data === 'object' && data.hasOwnProperty('id')) {
            console.log('check user status', data);
            const status = typeof clients[data.id] === 'undefined' ? 'offline' : 'online';
            console.log(data.id, status);
            socket.emit('user status', {
                id: data.id,
                status: status
            });
            socket.broadcast.emit('user status', {
                id: data.id,
                status: status
            });
        }
    });

    socket.on('user tracking position', data => {
        if (typeof data === 'object') {
            /*if(clients.hasOwnProperty(data.id)) {
                socket.emit('user tracking position', clients[data.id].location);
            }
            else {*/
                async function runQuery() {
                    let connection;
                    mysql.createConnection(CONFIG.MYSQL).then(conn => {
                        connection = conn;
                        return connection.query(`
                            SELECT last_location_lat, last_location_lng FROM users WHERE id = ?
                        `, [
                            data.id
                        ]);
                    }).then(d => {
                        if(d.length > 0) {
                            socket.emit('user tracking position', {
                                latitude: d[0].last_location_lat,
                                longitude: d[0].last_location_lng
                            });
                        }
                        connection.end();
                    }).catch(err => {
                        console.log('err', err);
                        //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                    });
                }
                runQuery();
            /*}*/
        }
    });

    socket.on('user position', data => {
        if (typeof data === 'object') {
            console.log(moment().format('hh:mm:ss A'), 'user position', data);

            const position = data.position;
            const addressComponents = position.address;

            const currentUserId = socket._user_data.user.id;

            clients[currentUserId].location = {
                latitude: position.latitude,
                longitude: position.longitude
            }

            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    return connection.query(`UPDATE users SET last_location_locality = ?, last_location_region = ?, last_location_country = ? WHERE id = ?`, [addressComponents.locality, addressComponents.region, addressComponents.country, currentUserId]);
                }).then(d => {
                    socket.emit('user position address components', {
                        address_components: addressComponents
                    });
                    return connection.query(`
                        UPDATE users SET last_location_lat = ?, last_location_lng = ?, last_location_datetime = ? WHERE id = ?
                    `, [
                        position.latitude, position.longitude, moment.utc().format('YYYY-MM-DD HH:mm:ss'), currentUserId
                    ]);
                }).then(d => {

                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            
            runQuery();

            subscriptions.trigger('user tracking position', 'id', currentUserId, {
                latitude: position.latitude,
                longitude: position.longitude,
                addressComponents: addressComponents
            });

            socket.emit('user position changed', {
                user: currentUserId,
                data: data
            });
            socket.broadcast.emit('user position changed', {
                user: currentUserId,
                data: data
            });

            if(data.traveling) {
                console.log(`${currentUserId} ~ traveling mode`, data);
                async function runQuery2() {
                    let connection;
                    mysql.createConnection(CONFIG.MYSQL).then(conn => {
                        connection = conn;
                        const query = `
                            SELECT
                                s.id
                            FROM
                                shipments AS s
                            INNER JOIN 
                                shipments_offers AS o ON s.id = o.id_shipment 
                            WHERE
                                o.id_user = ? AND o.accepted_at IS NOT NULL AND s.id_status = 4
                            ORDER BY
                                s.id DESC
                        `;
                        return connection.query(query, [currentUserId]);
                    }).then(d => {
                        var querys = [];
                        d.forEach(function(row) {
                            querys.push(`
                                INSERT INTO shipments_users_locations (id_shipment, id_user, lat, lng, datetime) VALUES (${data.id}, ${currentUserId}, ${data.position.latitude}, ${data.position.longitude}, UTC_TIMESTAMP())
                            `);
                            socket.broadcast.emit('shipment user location changed', {
                                id_shipment: data.id,
                                id_user: currentUserId,
                                lat: data.position.latitude,
                                lng: data.position.longitude
                            });
                        });
                        return connection.query(querys.join(';'));
                    }).then(d => {
                        connection.end();
                    }).catch(err => {
                        //console.log('err', err);
                        //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                    });
                }
                runQuery2();
            }
        }
    });

    socket.on('unread notifications', data => {
        if (typeof data === 'object') {
            console.log('unread notifications', data);
            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `
                        SELECT
                            * 
                        FROM
                            notifications 
                        WHERE
                            id_user = ? AND readed = 0 
                        ORDER BY
                            datetime DESC
                    `;
                    return connection.query(query, [data.id]);
                }).then(data => {
                    socket.emit('unread notifications', data);
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('check count available shipments', data => {
        if(typeof data === 'undefined') {
            data = {};
        }
        console.log('check count available shipments', data ? data : {});
        if(!socket.hasOwnProperty('_user_data')) {
            return;
        }
        async function runQuery() {
            let connection;
            mysql.createConnection(CONFIG.MYSQL).then(conn => {
                connection = conn;
                const loc = data ? (data.hasOwnProperty('locality') ? data.locality : '') : '';
                return connection.query(`
                    SELECT COUNT(*) AS count FROM shipments AS s LEFT JOIN shipments_ignored AS si ON (s.id = si.id_shipment AND si.id_user = ?) WHERE s.id_user != ? AND s.start_address_locality = ? AND s.id_status IS NULL AND si.id IS NULL AND shipment_is_expired(s.id) != 1
                `, [socket._user_data.user.id, socket._user_data.user.id, loc]);
            }).then(d => {
                socket.emit('count available shipments', d[0].count);
                connection.end();
            }).catch(err => {
                console.log('err', err);
                //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
            });
        }
        runQuery();
    });

    socket.on('check count offers shipments', data => {
        console.log('check count offers shipments', data ? data : {});
        if(!socket.hasOwnProperty('_user_data')) {
            return;
        }
        async function runQuery() {
            let connection;
            mysql.createConnection(CONFIG.MYSQL).then(conn => {
                connection = conn;
                return connection.query(`
                    SELECT
                        COUNT(*) AS count
                    FROM
                        shipments AS s
                    INNER JOIN 
                        shipments_offers AS o 
                    ON 
                        s.id = o.id_shipment 
                    WHERE
                        s.id_user = ? AND o.readed = 0
                `, [socket._user_data.user.id]);
            }).then(d => {
                socket.emit('count offers shipments', d[0].count);
                connection.end();
            }).catch(err => {
                console.log('err', err);
                //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
            });
        }
        runQuery();
    });

    socket.on('shipment offers', data => {
        console.log('shipment offers', data ? data : {});
        if(!socket.hasOwnProperty('_user_data')) {
            return;
        }
        async function runQuery() {
            let connection;
            mysql.createConnection(CONFIG.MYSQL).then(conn => {
                connection = conn;
                return connection.query(`
                    SELECT
                        o.id,
                        o.offer,
                        o.registered_at,
                        o.accepted_at,
                        o.estimated_arrival_date,
                        o.approximate_arrival_value,
                        o.approximate_arrival_desc,
                        o.approximate_distance_value,
                        o.approximate_distance_desc,
                        o.transport_id,
                        o.transport_type,
                        u.id AS user_id,
                        IFNULL(u.avatar, 'default.png') AS user_avatar,
                        IFNULL(u.fullname, SUBSTRING_INDEX(u.email, '@', 1)) AS user_fullname,
                        u.verified AS user_verified,
                        u.email AS user_email,
                        u.overall_rating AS user_overall_rating,
                        u.last_location_locality AS user_locality,
                        u.last_location_country AS user_country,
                        c.name AS user_company,
                        s.id AS shipment_id,
                        s.id_status AS shipment_id_status,
                        s.id_user AS shipment_id_user
                    FROM
                        shipments_offers AS o 
                    INNER JOIN 
                        shipments AS s ON o.id_shipment = s.id
                    INNER JOIN 
                        users AS u ON u.id = o.id_user 
                    LEFT JOIN 
                        companies AS c ON u.id_company = c.id
                    WHERE
                        o.id_shipment = ?
                `, [data.id]);
            }).then(d => {
                socket.emit('shipment offers', d);
                connection.end();
            }).catch(err => {
                console.log('err', err);
                //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
            });
        }
        runQuery();
    });

    socket.on('mask notifications as read', data => {
        if (typeof data === 'object') {
            data.ids = data.ids.filter(id => id != null);
            console.log('mask notifications as read', data);
            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `UPDATE notifications SET readed = 1 WHERE id IN (${data.ids.length > 0 ? data.ids.join(',') : 0})`;
                    return connection.query(query);
                }).then(data => {
                    const query = `
                        SELECT
                            * 
                        FROM
                            notifications 
                        WHERE
                            id_user = ? AND readed = 0 
                        ORDER BY
                            datetime DESC
                    `;
                    return connection.query(query, [data.id_user]);
                }).then(data => {
                    socket.emit('unread notifications', data);
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('chat new message', data => {
        if (typeof data === 'object') {
            var queryData = {};

            async function runQuery2(idt, idr) {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `
                        UPDATE chats SET archived_transmitter = 0, archived_receiver = 0 WHERE (id_transmitter = ? OR id_receiver = ?) OR (id_transmitter = ? OR id_receiver = ?) LIMIT 1
                    `;
                    return connection.query(query, [
                        idt,
                        idr,
                        idr,
                        idt
                    ]);
                }).then(d => {
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            
            async function runQuery() {
                let connection;
                var dt = moment.utc().format('YYYY-MM-DD HH:mm:ss');
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `
                        SELECT * FROM chats WHERE id_transmitter = ? OR id_receiver = ? LIMIT 1
                    `;
                    return connection.query(query, [
                        socket._user_data.user.id,
                        socket._user_data.user.id
                    ]);
                }).then(d => {
                    queryData = [
                        socket._user_data.user.id, 
                        data.to, 
                        data.message, 
                        null, 
                        null, 
                        null,
                        null
                    ];
                    if(d.length > 0) {
                        if(d[0].id_transmitter == data.to) {
                            queryData[5] = dt;
                        }
                        else {
                            queryData[3] = dt;
                        }
                    }
                    else {
                        queryData[3] = dt;
                    }
                    const query = `
                        INSERT INTO chats (
                            id_transmitter, 
                            id_receiver, 
                            message,
                            transmitter_date_sent, 
                            transmitter_date_reading, 
                            receiver_date_sent, 
                            receiver_date_reading
                        ) VALUES (
                            ?, 
                            ?, 
                            ?, 
                            ?, 
                            ?, 
                            ?, 
                            ?
                        )
                    `;
                    return connection.query(query, queryData);
                }).then(d => {
                    if(d.insertId > 0) {
                        sendPushNotification({
                            ids: data.to,
                            title: socket._user_data.user.display_name,
                            content: data.message,
                            rel: 'chat-new-message'
                        });
                        socket.emit('chat new message sent', {
                            uid: data.uid,
                            dt: dt
                        });
                        queryData.uid = data.uid;
                        emitToClient(data.to, 'chat new message', {
                            id: d.insertId,
                            id_transmitter: queryData[0], 
                            id_receiver: queryData[1], 
                            message: queryData[2],
                            transmitter_date_sent: queryData[3], 
                            transmitter_date_reading: queryData[4], 
                            receiver_date_sent: queryData[5],
                            receiver_date_reading: queryData[6],
                            transmitter_display_name: socket._user_data.user.display_name
                        });
                    }
                    connection.end();
                    runQuery2(queryData[0], queryData[1]);
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('chat mask as read', data => {
        if (typeof data === 'object' && data.ids.length > 0) {
            console.log('chat mask as read', data);
            async function runQuery() {
                let connection;
                var dt = moment.utc().format('YYYY-MM-DD HH:mm:ss');
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `
                        SELECT * FROM chats WHERE id IN (${data.ids.join(',')}) LIMIT 1
                    `;
                    return connection.query(query);
                }).then(d => {
                    if(d.length > 0) {
                        var column = '';
                        if(d[0].id_transmitter == socket._user_data.user.id) {
                            column = 'transmitter_date_reading';
                        }
                        else {
                            column = 'receiver_date_reading';
                        }
                        return connection.query(`
                            UPDATE chats SET ${column} = ? WHERE id IN (${data.ids.join(',')})
                        `, [dt]);
                    }
                }).then(d => {
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('chat user typing', data => {
        if (typeof data === 'object') {
            console.log('chat user typing', data);
            emitToClient(data.to, 'chat user typing', {
                user: socket._user_data.user.id
            });
        }
    });

    socket.on('chat user stop typing', data => {
        if (typeof data === 'object') {
            console.log('chat user stop typing', data);
            emitToClient(data.to, 'chat user stop typing', {
                user: socket._user_data.user.id
            });
        }
    });

    /*socket.on('chat unread messages count', data => {
        if (typeof data === 'object') {
            console.log('chat unread messages count', data);
            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    const query = `
                        SELECT
                            COUNT(*) AS quantity
                        FROM ( 
                                SELECT 
                                    DISTINCT ( id_transmitter ) AS i 
                                FROM 
                                    chats 
                                WHERE 
                                    id_receiver = ? AND receiver_date_reading IS NULL ${data.hasOwnProperty('id') ? ` AND id_transmitter = ${data.id}` : ``}
                        ) AS C
                    `;
                    return connection.query(query, [
                        socket._user_data ? socket._user_data.user.id : 0
                    ]);
                }).then(d => {
                    if(d.length > 0) {
                        if(data.hasOwnProperty('id')) {
                            socket.emit('chat unread messages count', {
                                id: data.id,
                                count: d[0].quantity
                            });
                        }
                        else {
                            socket.emit('chat unread messages count', {
                                count: d[0].quantity
                            });
                        }
                    }
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });*/

    socket.on('chat unread messages count', data => {
        if (typeof data === 'object') {
            console.log('chat unread messages count', data);
            const individual = data.hasOwnProperty('id');
            async function runQuery() {
                let connection;
                mysql.createConnection(CONFIG.MYSQL).then(conn => {
                    connection = conn;
                    if(individual) {
                        return connection.query(`SELECT id, id_transmitter FROM chats WHERE (id_receiver = ? AND receiver_date_reading IS NULL) AND id_transmitter = ?`, [socket._user_data.user.id, data.id]);
                    }
                    else {
                        return connection.query(`SELECT id, id_transmitter FROM chats WHERE (id_receiver = ? AND receiver_date_reading IS NULL)`, [socket._user_data.user.id]);
                    }
                }).then(d => {
                    if(individual) {
                        socket.emit('chat unread messages count', {
                            id: data.id,
                            count: d.length,
                            data: d
                        });
                    }
                    else {
                        socket.emit('chat unread messages count', {
                            count: d.length,
                            data: d
                        });
                    }
                    connection.end();
                }).catch(err => {
                    console.log('err', err);
                    //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                });
            }
            runQuery();
        }
    });

    socket.on('mp payment methods', () => {
        console.log('mp payment methods');
        axios.get('https://api.mercadopago.com/v1/payment_methods', {
            params: {
                access_token: CONFIG.MP.sandbox ? CONFIG.MP.access_token_test : CONFIG.MP.access_token_prod
            }
        }).then(function (response) {
            //console.log(response.statusText, response.status, response.data);
            if(response.statusText == "OK") {
                const paymentMethods = response.data.filter(r => (r.status == 'active' && r.payment_type_id == 'credit_card'));
                socket.emit('mp payment methods', paymentMethods);
            }
            else {

            }
        }).catch(function (error) {
            console.log(error);
        }).then(function () {
            // always executed
        });
    });

    socket.on('mp user cards', (data) => {
        console.log('mp user cards', data);
        mp.customers.search({
            qs: {
              "email": data.email
            }
        }).then(function(res) {
            if(res.response.results.length > 0) {
                socket.emit('mp user cards', res.response.results[0].cards);
            }
            else {
                socket.emit('mp user cards', []);
            }
        }).catch(function(err) {
            console.log(err);
        });
    });

    socket.on('mp user info', (data) => {
        console.log('mp user info', data);
        mp.customers.search({
            qs: {
              "email": data.email
            }
        }).then(function(res) {
            if(res.response.results.length > 0) {
                socket.emit('mp user info', res.response.results[0]);
                /*res.response.results[0].cards.forEach((c) => {
                    axios.delete(`https://api.mercadopago.com/v1/customers/${res.response.results[0]["id"]}/cards/${c.id}`, {
                        data: {},
                        params: {
                            access_token: CONFIG.MP.sandbox ? CONFIG.MP.access_token_test : CONFIG.MP.access_token_prod
                        }
                    }).then(function (response) {
                        console.log(response.statusText, response.status, response.data);
                    }).catch(function (error) {
                        console.log(error);
                    }).then(function () {
                        // always executed
                    });
                });*/
            }
            else {
                socket.emit('mp user info', []);
            }
        }).catch(function(err) {
            console.log(err);
        });
    });

    socket.on('[suscribe]', data => {
        const currentUserId = socket._user_data.user.id;

        console.log('[suscribe]', data);
        subscriptions.add(socket, data.name, data.data);
        if(data.name == 'user tracking position') {
            if(clients.hasOwnProperty(data.data.id)) {
                subscriptions.trigger('user tracking position', 'id', currentUserId, clients[data.data.id].location);
            }
            else {
                async function runQuery() {
                    let connection;
                    mysql.createConnection(CONFIG.MYSQL).then(conn => {
                        connection = conn;
                        return connection.query(`
                            SELECT last_location_lat, last_location_lng FROM users WHERE id = ?
                        `, [
                            data.data.id
                        ]);
                    }).then(d => {
                        if(d.length > 0) {
                            subscriptions.trigger('user tracking position', 'id', currentUserId, {
                                latitude: d[0].last_location_lat,
                                longitude: d[0].last_location_lng
                            });
                        }
                        connection.end();
                    }).catch(err => {
                        console.log('err', err);
                        //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                    });
                }
                runQuery();
            }
        }
    });

    socket.on('[unsuscribe]', name => {
        console.log('[unsuscribe]', name);
        subscriptions.remove(socket, name);
    });

    socket.on('disconnect', () => {
        var disconnectedUserId = null;
        Object.keys(clients).forEach(function (userId) {
            if (clients[userId].socket_id == socket.id) {
                disconnectedUserId = userId;
            }
        });
        if (disconnectedUserId) {
            if(clients[disconnectedUserId].logout) {
                clients[disconnectedUserId].logout = false;
            }
            else {
                delete clients[disconnectedUserId];
                socket.broadcast.emit('user status', {
                    id: disconnectedUserId,
                    status: 'offline'
                });
                console.log('Socket clients: ', Object.keys(clients).length);
            }
        }
    });
});

server.listen(CONFIG.NODEJS.port, () => {
    console.log('\nListening on port: ', CONFIG.NODEJS.port);

    /*sendPushNotification({
        ids: [1, 2, 3, 4, 5],
        title: 'Feliz noche otra vez',
        content: 'Te deseamos una feliz noche.'
    });*/
    
    // Redis server
    const redisClient = redis.createClient();
    redisClient.subscribe('sbxnv');
    redisClient.on("message", function(channel, data) {
        var json = JSON.parse(data);
        console.log('redis > ', json);
        switch(json.action) {
            case 'new shipment':
                handleNewShipment(null, json.data);
            break;
            case 'save notification':
                saveNotification({
                    id_user: json.data.to,
                    title: json.data.title,
                    content: json.data.content,
                    id_shipment: json.data.id_s,
                    group: 'return_dispatch_expenses'
                });
                break;
            case 'push notification':
                sendPushNotification({
                    ids: json.data.to,
                    title: json.data.title,
                    content: json.data.content
                });
                break;
            case 'chat new message':
                var rowInfo = json.data.message;
                rowInfo.transmitter_display_name = json.data.from.display_name;
                sendPushNotification({
                    ids: json.data.to.id,
                    title: json.data.from.display_name,
                    content: '📷 Foto',
                    rel: 'chat-new-message'
                });
                emitToClient(json.data.to.id, 'chat new message', rowInfo);
            break;
            case 'shipment timeline updated':
                async function runQuery() {
                    let connection;
                    mysql.createConnection(CONFIG.MYSQL).then(conn => {
                        connection = conn;
                        return connection.query(`
                            SELECT * FROM shipments_operations_history WHERE id_shipment = ?
                        `, [
                            json.data.id_shipment
                        ]);
                    }).then(d => {
                        if(d.length > 0) {
                            var dataT = arrGroupBy(d, 'uid');
                            dataT._uid = json.data.uid;
                            emitToClient(json.data.id_user, 'shipment timeline updated', dataT);
                        }
                        connection.end();
                    }).catch(err => {
                        console.log('err', err);
                        //console.log(`${err.code} | ${err.sqlMessage} | ${err.sqlState} | ${err.errno}`);
                    });
                }
                runQuery();
            break;
            case 'user verification':
                sendPushNotification({
                    ids: json.data.id_user,
                    title: json.data.verified ? 'Perfil verificado' : 'Perfil desactivado',
                    content: json.data.verified ? 'Su perfil ha sido verificado satisfactoriamente. Ahora podrá crear envíos, hacer ofertas y mucho más.' : 'Su perfil ha sido desactivado temporalmente. Por favor, chequee todos su datos personales y las fotos de su perfil y documentación. Revisaremos su información lo antes posible.',
                    rel: 'user-verification'
                });
                emitToClient(json.data.id_user, 'user verification', {
                    verified: json.data.verified
                });
            break;
        }
    });
    redisClient.on("connect", () => {
        console.log("sbxnv redisClient connected");
    });
    redisClient.on("reconnecting", () => {
        console.log("sbxnv redisClient reconnecting");
    });
    redisClient.on("end", () => {
        console.log("sbxnv redisClient ended");
    });
    redisClient.on("error", (error) => {
        console.error("sbxnv redisClient errored", error);
    });
});