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
var PlgAdd = /** @class */ (function (_super) {
    __extends(PlgAdd, _super);
    function PlgAdd(ownerId, csrf_token) {
        if (csrf_token === void 0) { csrf_token = ""; }
        var _this = _super.call(this, ownerId, csrf_token) || this;
        _this.h1_title = null;
        _this.h2_title = null;
        _this.txt_a = null;
        _this.txt_b = null;
        _this.btn_add = null;
        _this.spn_result = null;
        _this.h1_title = _this.make("h1");
        _this.h2_title = _this.make("h2");
        _this.txt_a = _this.make("input");
        _this.txt_b = _this.make("input");
        _this.btn_add = _this.make("button");
        _this.make("br");
        _this.spn_result = _this.make("span");
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    PlgAdd.prototype.prepare = function () {
        this.h1_title.text("SAMPLE PLUGIN");
        this.h2_title.text("Add Numbers");
        this.h2_title.css("font-style", "italic");
        this.txt_a.addClass("col-md-4");
        this.txt_a.addClass("form-control");
        this.txt_a.attr("type", "number");
        this.txt_a.val(0);
        this.txt_a.attr("placeholder", "A = ?");
        this.txt_b.addClass("col-md-4");
        this.txt_b.addClass("form-control");
        this.txt_b.attr("type", "number");
        this.txt_b.val(0);
        this.txt_b.attr("placeholder", "A = ?");
        this.btn_add.addClass("btn");
        this.btn_add.addClass("btn-secondary");
        this.btn_add.text("ADD");
        this.spn_result.text("RESULT");
    };
    PlgAdd.prototype.assignEventHandlers = function () {
        var _this = this;
        this.btn_add.on("click", function () {
            var a = parseInt(_this.txt_a.val());
            var b = parseInt(_this.txt_b.val());
            var c = a + b;
            _this.spn_result.text(c);
        });
    };
    PlgAdd.init = function (ownerId, csrf_token) {
        if (csrf_token === void 0) { csrf_token = ""; }
        new PlgAdd(ownerId, csrf_token);
    };
    return PlgAdd;
}(Plg));
