function getCurrentTime() {
    return moment().format('h:mm A');
}

function getCurrentDateTime() {
    return moment().format('MM/DD/YYYY h:mm A');
}
function getDateTime() {
    return moment(new Date()).format("DD/MM/YYYY");
}
function getdate(datetime) {
    return moment(datetime, 'YYYY-MM-DD HH:mm:ss').format('DD/MM/YYYY');
    // return moment(datetime, 'YYYY-MM-DD HH:mm:ss').tz('Asia/Ho_Chi_Minh').format('DD/MM/YYYY');
}

function dateFormat(datetime) {
    return moment(datetime, 'YYYY-MM-DD HH:mm:ss').format('MM/DD/YYYY h:mm A');
    // return moment(datetime, 'YYYY-MM-DD HH:mm:ss').tz('Asia/Ho_Chi_Minh').format('MM/DD/YYYY h:mm A');
}

function timeFormat(datetime) {
    return moment(datetime, 'YYYY-MM-DD HH:mm:ss').format('h:mm A');
    // return moment(datetime, 'YYYY-MM-DD HH:mm:ss').tz('Asia/Ho_Chi_Minh').format('h:mm A');
}