var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var CmpAdd = /** @class */ (function (_super) {
    __extends(CmpAdd, _super);
    function CmpAdd() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    CmpAdd.prototype.perform = function (e) {
        var owner = this.applyPath(e, "target/attributes/owner/value");
        if (owner == null)
            return;
        owner += "_";
        var x = parseFloat(this.getVal(owner + "txt_x"));
        var y = parseFloat(this.getVal(owner + "txt_y"));
        var z = x + y;
        this.setVal(owner + "spn_result", z);
        $(this.elm(owner + "txt_x")).on("change", function () {
            console.log("JQUERY HERE");
        });
    };
    CmpAdd.run = function (e) {
        var cmp = new CmpAdd();
        cmp.perform(e);
    };
    return CmpAdd;
}(Cmp));
