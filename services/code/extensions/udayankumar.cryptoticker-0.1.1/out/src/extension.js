"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const vscode = require("vscode");
const https = require("https");
const currencyMap = {
    'AED': 'د.إ',
    'AFN': '؋',
    'ALL': 'L',
    'ANG': 'ƒ',
    'AOA': 'Kz',
    'ARS': '$',
    'AUD': '$',
    'AWG': 'ƒ',
    'AZN': '₼',
    'BAM': 'KM',
    'BBD': '$',
    'BDT': '৳',
    'BGN': 'лв',
    'BHD': '.د.ب',
    'BIF': 'FBu',
    'BMD': '$',
    'BND': '$',
    'BOB': 'Bs.',
    'BRL': 'R$',
    'BSD': '$',
    'BTC': '฿',
    'BTN': 'Nu.',
    'BWP': 'P',
    'BYR': 'p.',
    'BZD': 'BZ$',
    'CAD': '$',
    'CDF': 'FC',
    'CHF': 'Fr.',
    'CLP': '$',
    'CNY': '¥',
    'COP': '$',
    'CRC': '₡',
    'CUC': '$',
    'CUP': '₱',
    'CVE': '$',
    'CZK': 'Kč',
    'DJF': 'Fdj',
    'DKK': 'kr',
    'DOP': 'RD$',
    'DZD': 'دج',
    'EEK': 'kr',
    'EGP': '£',
    'ERN': 'Nfk',
    'ETB': 'Br',
    'ETH': 'Ξ',
    'EUR': '€',
    'FJD': '$',
    'FKP': '£',
    'GBP': '£',
    'GEL': '₾',
    'GGP': '£',
    'GHC': '₵',
    'GHS': 'GH₵',
    'GIP': '£',
    'GMD': 'D',
    'GNF': 'FG',
    'GTQ': 'Q',
    'GYD': '$',
    'HKD': '$',
    'HNL': 'L',
    'HRK': 'kn',
    'HTG': 'G',
    'HUF': 'Ft',
    'IDR': 'Rp',
    'ILS': '₪',
    'IMP': '£',
    'INR': '₹',
    'IQD': 'ع.د',
    'IRR': '﷼',
    'ISK': 'kr',
    'JEP': '£',
    'JMD': 'J$',
    'JPY': '¥',
    'KES': 'KSh',
    'KGS': 'лв',
    'KHR': '៛',
    'KMF': 'CF',
    'KPW': '₩',
    'KRW': '₩',
    'KYD': '$',
    'KZT': '₸',
    'LAK': '₭',
    'LBP': '£',
    'LKR': '₨',
    'LRD': '$',
    'LSL': 'M',
    'LTC': 'Ł',
    'LTL': 'Lt',
    'LVL': 'Ls',
    'MAD': 'MAD',
    'MDL': 'lei',
    'MGA': 'Ar',
    'MKD': 'ден',
    'MMK': 'K',
    'MNT': '₮',
    'MOP': 'MOP$',
    'MUR': '₨',
    'MVR': 'Rf',
    'MWK': 'MK',
    'MXN': '$',
    'MYR': 'RM',
    'MZN': 'MT',
    'NAD': '$',
    'NGN': '₦',
    'NIO': 'C$',
    'NOK': 'kr',
    'NPR': '₨',
    'NZD': '$',
    'OMR': '﷼',
    'PAB': 'B/.',
    'PEN': 'S/.',
    'PGK': 'K',
    'PHP': '₱',
    'PKR': '₨',
    'PLN': 'zł',
    'PYG': 'Gs',
    'QAR': '﷼',
    'RMB': '￥',
    'RON': 'lei',
    'RSD': 'Дин.',
    'RUB': '₽',
    'RWF': 'R₣',
    'SAR': '﷼',
    'SBD': '$',
    'SCR': '₨',
    'SDG': 'ج.س.',
    'SEK': 'kr',
    'SGD': '$',
    'SHP': '£',
    'SLL': 'Le',
    'SOS': 'S',
    'SRD': '$',
    'SSP': '£',
    'STD': 'Db',
    'SVC': '$',
    'SYP': '£',
    'SZL': 'E',
    'THB': '฿',
    'TJS': 'SM',
    'TMT': 'T',
    'TND': 'د.ت',
    'TOP': 'T$',
    'TRL': '₤',
    'TRY': '₺',
    'TTD': 'TT$',
    'TVD': '$',
    'TWD': 'NT$',
    'TZS': 'TSh',
    'UAH': '₴',
    'UGX': 'USh',
    'USD': '$',
    'UYU': '$U',
    'UZS': 'лв',
    'VEF': 'Bs',
    'VND': '₫',
    'VUV': 'VT',
    'WST': 'WS$',
    'XAF': 'FCFA',
    'XBT': 'Ƀ',
    'XCD': '$',
    'XOF': 'CFA',
    'XPF': '₣',
    'YER': '﷼',
    'ZAR': 'R',
    'ZWD': 'Z$',
    'USDT': '₮'
};
let items;
function activate(context) {
    items = new Map();
    refresh();
    setInterval(refresh, 60 * 1e3);
    context.subscriptions.push(vscode.workspace.onDidChangeConfiguration(refresh));
}
exports.activate = activate;
// this method is called when your extension is deactivated
function deactivate() {
}
exports.deactivate = deactivate;
function refresh() {
    const config = vscode.workspace.getConfiguration();
    const configuredSymbols = config.get('cryptoticker.cryptoSymbols', ['BTC', 'ETH'])
        .map(symbol => symbol.toUpperCase());
    //pick only the top currency    
    const stringCurrency = config.get('cryptoticker.cryptoCurrency', 'USD');
    const configExchange = config.get('cryptoticker.cryptoExchange', 'CCCAGG');
    const symbolCurrency = currencyMap[stringCurrency];
    if (!symbolCurrency) {
        console.log('Currency not found');
    }
    if (!arrayEq(configuredSymbols, Array.from(items.keys()))) {
        cleanup();
        fillEmpty(configuredSymbols, stringCurrency, symbolCurrency);
    }
    refreshSymbols(configuredSymbols, stringCurrency, symbolCurrency, configExchange);
}
function fillEmpty(symbols, stringCurrency, symbolCurrency) {
    symbols
        .forEach((symbol, i) => {
        // Enforce ordering with priority
        const priority = symbols.length - i;
        const item = vscode.window.createStatusBarItem(vscode.StatusBarAlignment.Left, priority);
        item.text = `${symbol}: ${symbolCurrency}…`;
        item.show();
        items.set(symbol, item);
    });
}
function cleanup() {
    items.forEach(item => {
        item.hide();
        item.dispose();
    });
    items = new Map();
}
function refreshSymbols(symbols, stringCurrency, symbolCurrency, configExchange) {
    symbols.forEach(function (element) {
        const url = `https://min-api.cryptocompare.com/data/price?fsym=${element}&tsyms=${stringCurrency}&e=${configExchange}`;
        httpGet(url).then(response => {
            // Remove prepended newline+comment
            //response = response.substr(3)
            const responseObj = JSON.parse(response);
            responseObj[stringCurrency];
            updateItemWithSymbolResult(element, responseObj, stringCurrency, symbolCurrency);
        }).catch(e => console.error(e));
    });
}
function updateItemWithSymbolResult(element, symbolResult, stringCurrency, symbolCurrency) {
    const symbol = element;
    const item = items.get(symbol);
    const price = symbolResult[stringCurrency];
    item.text = `${symbol.toUpperCase()} ${symbolCurrency}${price}`;
}
function httpGet(url) {
    return new Promise((resolve, reject) => {
        https.get(url, response => {
            let responseData = '';
            response.on('data', chunk => responseData += chunk);
            response.on('end', () => {
                // Sometimes the 'error' event is not fired. Double check here.
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
function arrayEq(arr1, arr2) {
    if (arr1.length !== arr2.length)
        return false;
    return !arr1.some((item, i) => item !== arr2[i]);
}
//# sourceMappingURL=extension.js.map