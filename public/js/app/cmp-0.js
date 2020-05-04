var Cmp = /** @class */ (function () {
    function Cmp() {
    }
    Cmp.prototype.elm = function (elementId) {
        var element = document.getElementById(elementId);
        return element;
    };
    Cmp.prototype.getVal = function (elementId) {
        var element = this.elm(elementId);
        return element.value;
    };
    Cmp.prototype.setVal = function (elementId, value) {
        var element = this.elm(elementId);
        if (element == null)
            return;
        element.innerText = "" + value;
    };
    Cmp.prototype.applyPath = function (el, path) {
        var arr = path.split("/");
        var res = el;
        for (var i = 0; i < arr.length; i++) {
            res = res[arr[i]];
            if (res == null)
                return null;
        }
        return res;
    };
    return Cmp;
}());
