var Cmp = /** @class */ (function () {
    function Cmp(ownerId) {
        this.prefix = "";
        this.prefix = ownerId + "_";
        // Keep track of each object generated
        Globals.arr[ownerId] = this;
    }
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
    Cmp.prototype.dlr = function (id) {
        return $("#" + this.prefix + id);
    };
    Cmp.prototype.getCmp = function (id) {
        return Globals.arr[this.prefix + id];
    };
    return Cmp;
}());
