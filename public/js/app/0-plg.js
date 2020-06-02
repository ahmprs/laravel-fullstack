var Plg = /** @class */ (function () {
    function Plg(ownerId, csrf_token) {
        if (csrf_token === void 0) { csrf_token = ""; }
        this.prefix = "";
        this.me = null;
        this.csrf_token = "";
        this.csrf_token = csrf_token;
        this.prefix = ownerId + "_";
        this.me = $("#" + ownerId);
        // Keep track of each object generated
        Globals.arrPlg[ownerId] = this;
    }
    Plg.prototype.applyPath = function (el, path) {
        var arr = path.split("/");
        var res = el;
        for (var i = 0; i < arr.length; i++) {
            res = res[arr[i]];
            if (res == null)
                return null;
        }
        return res;
    };
    Plg.prototype.dlr = function (id) {
        return $("#" + this.prefix + id);
    };
    Plg.prototype.getPlg = function (id) {
        return Globals.arr[this.prefix + id];
    };
    Plg.prototype.make = function (elementTagName, parentElement) {
        if (parentElement === void 0) { parentElement = null; }
        var element = $(document.createElement(elementTagName));
        if (parentElement == null) {
            element.appendTo(this.me);
        }
        else {
            element.appendTo(parentElement);
        }
        return element;
    };
    Plg.prototype.put = function (elementTagName, parentElement) {
        if (parentElement === void 0) { parentElement = null; }
        var element = $(document.createElement(elementTagName));
        if (parentElement == null) {
            element.appendTo(this.me);
        }
        else {
            element.appendTo(parentElement);
        }
        return this;
    };
    return Plg;
}());
