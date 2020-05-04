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
var CmpCalendar = /** @class */ (function (_super) {
    __extends(CmpCalendar, _super);
    function CmpCalendar(ownerId) {
        var _this = _super.call(this, ownerId) || this;
        _this.div_modal = null;
        _this.div_modal_title = null;
        _this.tbl_calendar = null;
        _this.btn_cancel = null;
        _this.btn_ok = null;
        _this.txt_date = null;
        _this.btn_next_month = null;
        _this.btn_prev_month = null;
        _this.arr_btn = [];
        _this.div_modal = _this.dlr("div_modal");
        _this.div_modal_title = _this.dlr("div_modal_title");
        _this.tbl_calendar = _this.dlr("tbl_calendar");
        _this.btn_cancel = _this.dlr("btn_cancel");
        _this.btn_ok = _this.dlr("btn_ok");
        _this.txt_date = _this.dlr("txt_date");
        _this.btn_next_month = _this.dlr("btn_next_month");
        _this.btn_prev_month = _this.dlr("btn_prev_month");
        var indx = 0;
        for (var i = 0; i < 7; i++) {
            for (var j = 0; j < 7; j++) {
                // debugger;
                _this.arr_btn.push(_this.dlr("btn_" + indx));
                indx++;
            }
        }
        _this.assignEventHandlers();
        return _this;
    }
    CmpCalendar.prototype.assignEventHandlers = function () {
        var self = this;
        this.btn_next_month.on("click", function () {
            alert("NEXT");
        });
        this.btn_prev_month.on("click", function () {
            alert("PREV");
        });
        this.btn_ok.on("click", function () {
            alert("OK");
        });
        this.btn_cancel.on("click", function () {
            alert("CANCEL");
        });
        for (var i = 0; i < this.arr_btn.length; i++) {
            this.arr_btn[i].on("click", function () {
                var btn = self.applyPath(window, "event/target");
                var gdp = self.applyPath(btn, "attributes/gdp/value");
                var jal = self.applyPath(btn, "attributes/jal/value");
                var greg = self.applyPath(btn, "attributes/greg/value");
                self.txt_date.val(jal + "-" + greg);
                self.txt_date.attr("gdp", gdp);
                self.txt_date.attr("jal", jal);
                self.txt_date.attr("greg", greg);
                console.log({ gdp: gdp, jal: jal, greg: greg });
            });
        }
    };
    CmpCalendar.init = function (ownerId) {
        new CmpCalendar(ownerId);
    };
    return CmpCalendar;
}(Cmp));
