'use strict';
Object.defineProperty(exports, "__esModule", { value: true });
const vscode = require("vscode");
const http = require("http");
let bitcoinItem;
let relativeDifference;
let currency;
let decimals;
let useRelativeToYesterday;
let historicalData;
function activate(context) {
    bitcoinItem = vscode.window.createStatusBarItem(vscode.StatusBarAlignment.Left, 1);
    bitcoinItem.text = "loading";
    bitcoinItem.show();
    refresh();
    setInterval(refresh, 60000);
    context.subscriptions.push(vscode.workspace.onDidChangeConfiguration(refresh));
}
exports.activate = activate;
function deactivate() {
}
exports.deactivate = deactivate;
function refresh() {
    const config = vscode.workspace.getConfiguration();
    const relativeConfig = config.get('bitcoinwatcher.useRelativeDifference', []);
    const currencyConfig = config.get('bitcoinwatcher.currency', "");
    useRelativeToYesterday = config.get('bitcoinwatcher.relativeToYesterday');
    decimals = config.get('bitcoinwatcher.decimals');
    currency = setDefaultCurrency(currencyConfig);
    relativeDifference = calculateRelativeDifference(relativeConfig);
    createItem();
}
function setDefaultCurrency(val) {
    return val.toUpperCase();
}
function calculateRelativeDifference(input) {
    let average = 0;
    input.forEach(element => {
        parseInt(element);
        average += element;
    });
    return average / input.length;
}
function createItem() {
    const url = "http://api.coindesk.com/v1/bpi/currentprice/" + currency + ".json";
    httpGet(url).then(response => {
        const responseObj = JSON.parse(response);
        updateStatusWithResult(currency, responseObj.bpi[currency].rate_float);
    });
}
function fetchHistoricalData(url) {
    return httpGet(url).then(response => {
        return response;
    });
}
function relativeToYesterday(input) {
    if (input) {
        const url = "http://api.coindesk.com/v1/bpi/historical/close.json?for=yesterday&currency=" + currency;
        return fetchHistoricalData(url).then(response => {
            const responseObj = JSON.parse(response);
            return responseObj.bpi[Object.keys(responseObj.bpi)[0]];
        });
    }
}
function userDefinedPrecision(rate) {
    return rate.toFixed(decimals);
}
function updateStatusWithResult(code, rate) {
    var data = userDefinedPrecision(rate);
    bitcoinItem.text = "Bitcoin: " + data.toString() + " " + code;
    if (useRelativeToYesterday) {
        relativeToYesterday(useRelativeToYesterday).then(x => {
            var val = userDefinedPrecision((rate - x));
            if (val > 0) {
                bitcoinItem.text += " (+" + val.toString() + ")";
                bitcoinItem.color = "lightgreen";
            }
            else {
                bitcoinItem.text += " (" + val.toString() + ")";
                bitcoinItem.color = "LightSalmon";
            }
        });
    }
    if (relativeDifference) {
        //bitcoinItem.tooltip = " RD: " + relativeDifference.toString()
        var percentage = userDefinedPrecision((rate - relativeDifference) / relativeDifference * 100).toString() + "%";
        if (rate > relativeDifference) {
            bitcoinItem.color = "lightgreen";
            bitcoinItem.text += "(+" + percentage + ")";
        }
        else {
            bitcoinItem.text += "(-" + percentage + ")";
            bitcoinItem.color = "LightSalmon";
        }
    }
}
function httpGet(url) {
    return new Promise((resolve, reject) => {
        http.get(url, response => {
            let responseData = '';
            response.on('data', chunk => responseData += chunk);
            response.on('end', () => {
                if (response.statusCode === 200) {
                    resolve(responseData);
                }
                else {
                    reject('fail: ' + response.statusCode);
                }
            });
        });
    });
}
//# sourceMappingURL=extension.js.map