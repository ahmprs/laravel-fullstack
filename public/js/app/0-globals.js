var Globals = /** @class */ (function () {
    function Globals() {
    }
    Globals.strToCode = function (txt) {
        var n = txt.length;
        var h = "";
        for (var i = 0; i < n; i++) {
            h += txt.charCodeAt(i) + ";";
        }
        return h;
    };
    Globals.codeToStr = function (hex) {
        var arr = hex.split(";");
        var n = arr.length;
        var s = "";
        for (var i = 0; i < n; i++) {
            s += String.fromCharCode(parseInt(arr[i]));
        }
        return s;
    };
    Globals.arr = [];
    Globals.arrPlg = [];
    return Globals;
}());
