'use strict';
Object.defineProperty(exports, "__esModule", { value: true });
const vscode = require("vscode");
const translateApi = require("google-translate-open-api").default;
var languages;
var replaceText;
var translations;
var selections;
var linesCount;
let activeEditor;
function activate(context) {
    var _a;
    const isShowWhatsNew = (_a = context.globalState.get('show-whats-new'), (_a !== null && _a !== void 0 ? _a : true));
    if (isShowWhatsNew) {
        showWhatsNew(context);
    }
    let disposable = vscode.commands.registerCommand('extension.translate', onActivate);
    context.subscriptions.push(disposable);
}
exports.activate = activate;
function showWhatsNew(context) {
    const panel = vscode.window.createWebviewPanel('whatsNew', `What's New in Google Translate`, vscode.ViewColumn.One, {});
    panel.webview.html = getWebviewContent();
    panel.onDidDispose(onWhatsNewClosed.bind(null, context));
}
function onWhatsNewClosed(context) {
    context.globalState.update('show-whats-new', false);
}
function getWebviewContent() {
    return `
		<!DOCTYPE html>
		<html lang="en">
			<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<title>What's New in Google Translate</title>
			</head>
			<body>
				<h1 align="center">
					<br>
					<img src="https://raw.githubusercontent.com/benshabatnoam/google-translate-vscode-ext/master/assets/icons/icon.ico">
					<br>
					Google Translate
				</h1>
				<h2 align="center">Translate your code using Google Translate.</a>
				</h2>
				<p align="center">
					<a href="https://travis-ci.org/benshabatnoam/google-translate-vscode-ext"><img src="https://travis-ci.org/benshabatnoam/google-translate-vscode-ext.svg?branch=master" alt="Travis CI"></a>
					<a href="https://github.com/benshabatnoam/google-translate-vscode-ext/releases"><img src="https://img.shields.io/github/release/benshabatnoam/google-translate-vscode-ext.svg" alt="version"></a>
				</p>
				<h3 align="center">
					No need to register <i>Google Cloud Translate API</i> anymore! Translate your code totally free from today.
				</h3>
			</body>
		</html>
	`;
}
function onActivate() {
    if (!vscode.window.activeTextEditor) {
        vscode.window.showErrorMessage('Must select text to translate');
        return;
    }
    activeEditor = vscode.window.activeTextEditor;
    initMembers();
    if (selections.length > 1) {
        if (selections.every(s => s.isEmpty)) {
            showEmptyError();
            return;
        }
        multiCursorTranslate();
    }
    else if (selections.length === 1) {
        let selection = selections[0];
        if (selection.isEmpty) {
            showEmptyError();
            return;
        }
        translateSelection(selections[0]);
    }
    else {
        showEmptyError();
    }
}
function initMembers() {
    languages = vscode.workspace.getConfiguration('googleTranslateExt')['languages'];
    replaceText = vscode.workspace.getConfiguration('googleTranslateExt')['replaceText'];
    selections = activeEditor.selections;
    translations = [];
    linesCount = 0;
}
function multiCursorTranslate() {
    selections.forEach(selection => {
        translateSelection(selection);
    });
}
function translateSelection(selection) {
    if (!selection.isSingleLine) {
        let firstLineNumber = selection.start.line;
        let lastLineNumber = selection.end.line;
        linesCount += lastLineNumber - firstLineNumber;
        for (let lineNumber = firstLineNumber; lineNumber <= lastLineNumber; lineNumber++) {
            let range = activeEditor.document.lineAt(lineNumber).range;
            if (lineNumber === firstLineNumber) {
                range = new vscode.Range(lineNumber, selection.start.character, lineNumber, range.end.character);
            }
            else if (lineNumber === lastLineNumber) {
                range = new vscode.Range(lineNumber, 0, lineNumber, selection.end.character);
            }
            translateSelection(range);
        }
        return;
    }
    let selectedText = activeEditor.document.getText(new vscode.Range(selection.start, selection.end));
    if (!languages) {
        vscode.window.showErrorMessage('Go to user settings and edit "googleTranslateExt.languages".');
        return;
    }
    if (typeof languages === "string") {
        translate(selectedText, selection, languages);
    }
    else {
        if (replaceText) {
            translate(selectedText, selection, languages[0]);
        }
        else {
            languages.forEach((language) => {
                translate(selectedText, selection, language);
            });
        }
    }
}
function translate(textToTranslate, selection, language) {
    translateApi(textToTranslate, { to: language })
        .then((res) => {
        onTranslateSuccess(selection, language, res.data[0]);
    })
        .catch((error) => {
        vscode.window.showInformationMessage(error.message);
    });
}
function onTranslateSuccess(selection, language, translatedText) {
    if (replaceText) {
        if (selections.length + linesCount === translations.length + 1) {
            activeEditor.edit((editBuilder) => {
                for (let i = 0; i < translations.length; i++) {
                    const element = translations[i];
                    editBuilder.replace(element.selection, element.translatedText);
                }
                editBuilder.replace(selection, translatedText);
            });
        }
        else {
            translations.push({
                'selection': selection,
                'translation': translatedText
            });
        }
    }
    else {
        vscode.window.showInformationMessage(translatedText);
    }
}
function showEmptyError() {
    vscode.window.showErrorMessage('Must select text to translate');
}
// this method is called when your extension is deactivated
function deactivate() {
}
exports.deactivate = deactivate;
//# sourceMappingURL=extension.js.map