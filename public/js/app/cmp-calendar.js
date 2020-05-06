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
        _this.div_brief = null;
        _this.h4_greg_date = null;
        _this.h4_jal_date = null;
        _this.h3_month = null;
        _this.tbl_calendar = null;
        _this.btn_cancel = null;
        _this.btn_ok = null;
        _this.txt_date = null;
        _this.btn_next_month = null;
        _this.btn_prev_month = null;
        _this.arr_btn = [];
        _this.server_gdp = 0;
        _this.gdp = 0;
        _this.div_modal = _this.dlr("div_modal");
        _this.div_modal_title = _this.dlr("div_modal_title");
        _this.div_brief = _this.dlr("div_brief");
        _this.h4_greg_date = _this.dlr("h4_greg_date");
        _this.h4_jal_date = _this.dlr("h4_jal_date");
        _this.h3_month = _this.dlr("h3_month");
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
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    CmpCalendar.prototype.prepare = function () {
        var btn = null;
        var spn = null;
        var sub = null;
        var spn2 = null;
        this.server_gdp = parseInt(this.txt_date.attr("server_gdp"));
        this.gdp = parseInt(this.txt_date.attr("gdp"));
        var c = new Calendar();
        var jal = c.getJalDateFromGdp(this.gdp);
        var greg = c.getGregDateFromGdp(this.gdp);
        var d = jal["DayOfMonth"];
        //--
        this.h4_greg_date.text(greg["DateString"]);
        this.h4_greg_date.attr("gdp", this.gdp);
        this.h4_greg_date.attr("jal", jal["DateString"]);
        this.h4_greg_date.attr("greg", greg["DateString"]);
        this.h4_jal_date.text(jal["DateString"]);
        this.h4_jal_date.attr("gdp", this.gdp);
        this.h4_jal_date.attr("jal", jal["DateString"]);
        this.h4_jal_date.attr("jal", jal["DateString"]);
        this.h3_month.text(jal["MonthTitle"] + " " + jal["Year"]);
        //--
        var g = this.gdp - d + 1;
        var jal_base = c.getJalDateFromGdp(g);
        var w = jal_base["DayOfWeek"];
        var m = jal_base["Month"];
        for (var i = 0; i < this.arr_btn.length; i++) {
            // assign a name for current button
            btn = this.arr_btn[i];
            spn = $(btn.children()[0]);
            sub = $(btn.children()[1]);
            spn2 = $(btn.children()[2]);
            spn2.hide();
            // apply the first day of week
            if (i < w) {
                btn.hide();
                spn.text("");
                sub.text("");
                btn.attr("gdp", 0);
                spn.attr("gdp", 0);
                sub.attr("gdp", 0);
                spn2.attr("gdp", 0);
                continue;
            }
            btn.fadeIn();
            jal = c.getJalDateFromGdp(g);
            greg = c.getGregDateFromGdp(g);
            // if we get at the end of month
            if (m != jal["Month"]) {
                for (var j = i; j < this.arr_btn.length; j++) {
                    btn = this.arr_btn[j];
                    spn = $(btn.children()[0]);
                    sub = $(btn.children()[1]);
                    spn2 = $(btn.children()[2]);
                    btn.hide();
                    spn.text("");
                    sub.text("");
                    btn.attr("gdp", 0);
                    spn.attr("gdp", 0);
                    sub.attr("gdp", 0);
                    spn2.attr("gdp", 0);
                }
                break;
            }
            // set day of month and gdp
            spn.text(jal["DayOfMonth"]);
            sub.text(greg["DayOfMonth"]);
            if (jal["DayOfWeek"] >= 5) {
                btn.removeClass("btn-primary");
                btn.addClass("btn-success");
            }
            else {
                btn.removeClass("btn-success");
                btn.addClass("btn-primary");
            }
            if (greg["DayOfMonth"] == 1) {
                spn2.text(greg["MonthTitle"]);
                spn2.fadeIn();
                sub.hide();
            }
            else {
                spn2.text("");
                sub.show();
            }
            btn.attr("gdp", g);
            spn.attr("gdp", g);
            sub.attr("gdp", g);
            spn2.attr("gdp", g);
            g++;
        }
    };
    CmpCalendar.prototype.assignEventHandlers = function () {
        var self = this;
        this.btn_next_month.on("click", function () {
            var c = new Calendar();
            var jal = c.getJalDateFromGdp(self.gdp);
            var y = jal["Year"];
            var m = jal["Month"];
            if (m < 12)
                m++;
            else {
                m = 1;
                y++;
            }
            self.gdp = c.jalDateToGdp(y, m, 1);
            self.txt_date.attr("gdp", self.gdp);
            self.prepare();
        });
        this.btn_prev_month.on("click", function () {
            var c = new Calendar();
            var jal = c.getJalDateFromGdp(self.gdp);
            var y = jal["Year"];
            var m = jal["Month"];
            if (m > 1)
                m--;
            else {
                m = 12;
                y--;
            }
            self.gdp = c.jalDateToGdp(y, m, 1);
            self.txt_date.attr("gdp", self.gdp);
            self.prepare();
        });
        this.btn_ok.on("click", function () {
            self.txt_date.val(self.h4_greg_date.text());
            self.txt_date.attr("gdp", self.h4_greg_date.attr("gdp"));
            self.txt_date.attr("jal", self.h4_greg_date.attr("jal"));
            self.txt_date.attr("greg", self.h4_greg_date.attr("greg"));
            // OR
            // self.txt_date.val(self.h4_jal_date.text());
            // self.txt_date.attr("gdp", self.h4_jal_date.attr("gdp"));
            // self.txt_date.attr("jal", self.h4_jal_date.attr("jal"));
            // self.txt_date.attr("greg", self.h4_jal_date.attr("greg"));
        });
        this.btn_cancel.on("click", function () {
            alert("CANCEL");
        });
        for (var i = 0; i < this.arr_btn.length; i++) {
            this.arr_btn[i].on("click", function () {
                var btn = $(self.applyPath(window, "event/target"));
                var gdp = btn.attr("gdp");
                var c = new Calendar();
                var jal = c.getJalDateFromGdp(gdp);
                var greg = c.getGregDateFromGdp(gdp);
                self.h4_greg_date.text(greg["DateString"]);
                self.h4_greg_date.attr("gdp", gdp);
                self.h4_greg_date.attr("jal", jal["DateString"]);
                self.h4_greg_date.attr("greg", greg["DateString"]);
                self.h4_jal_date.text(jal["DateString"]);
                self.h4_jal_date.attr("gdp", gdp);
                self.h4_jal_date.attr("jal", jal["DateString"]);
                self.h4_jal_date.attr("jal", jal["DateString"]);
            });
        }
    };
    CmpCalendar.init = function (ownerId) {
        new CmpCalendar(ownerId);
    };
    return CmpCalendar;
}(Cmp));
