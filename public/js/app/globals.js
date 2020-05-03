"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
var Globals = /** @class */ (function () {
    function Globals() {
    }
    Globals.getVal = function (elementId) {
        var element = document.getElementById(elementId);
        return element.value;
    };
    Globals.setVal = function (elementId, value) {
        var element = document.getElementById(elementId);
        element.innerText = "" + value;
    };
    return Globals;
}());
exports.Globals = Globals;
