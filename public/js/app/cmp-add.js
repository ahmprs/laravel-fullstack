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
    // main constructor
    function CmpAdd(ownerId) {
        var _this = _super.call(this, ownerId) || this;
        // html elements used by GUI
        _this.txt_x = null;
        _this.txt_y = null;
        _this.spn_result = null;
        _this.btn_add = null;
        var self = _this;
        // bind js objects to html elements
        _this.txt_x = _this.dlr("txt_x");
        _this.txt_y = _this.dlr("txt_y");
        _this.spn_result = _this.dlr("spn_result");
        _this.btn_add = _this.dlr("btn_add");
        // assign event handlers
        _this.btn_add.on("click", function () {
            var x = parseFloat(self.txt_x.val());
            var y = parseFloat(self.txt_y.val());
            var z = x + y;
            self.spn_result.text(z);
        });
        return _this;
    }
    // entry point
    CmpAdd.init = function (ownerId) {
        new CmpAdd(ownerId);
    };
    return CmpAdd;
}(Cmp));
