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
var PlgSlideMaster = /** @class */ (function (_super) {
    __extends(PlgSlideMaster, _super);
    function PlgSlideMaster(ownerId, csrf_token) {
        if (csrf_token === void 0) { csrf_token = ""; }
        var _this = _super.call(this, ownerId, csrf_token) || this;
        _this.arr_div = null;
        _this.arr_spn = [];
        _this.div_0 = null;
        _this.div_1 = null;
        _this.div_2 = null;
        _this.div_3 = null;
        _this.div_4 = null;
        _this.div_5 = null;
        _this.div_foot = null;
        _this.div_progress = null;
        /* private btn_previous = null; */
        /* private btn_pause_play = null; */
        /* private btn_next = null; */
        _this.paused = false;
        _this.slide_index = 0;
        _this.img_previous = null;
        _this.img_next = null;
        _this.img_pause_play = null;
        _this.div_0 = _this.make("div");
        _this.div_1 = _this.make("div");
        _this.div_2 = _this.make("div");
        _this.div_3 = _this.make("div");
        _this.div_4 = _this.make("div");
        _this.div_5 = _this.make("div");
        _this.div_foot = _this.make("div");
        /* this.btn_previous = this.make("button", this.div_foot);*/
        /* this.btn_pause_play = this.make("button", this.div_foot);*/
        _this.div_progress = _this.make("div", _this.div_foot);
        /* this.btn_next = this.make("button", this.div_foot);*/
        _this.arr_div = [
            _this.div_0,
            _this.div_1,
            _this.div_2,
            _this.div_3,
            _this.div_4,
            _this.div_5,
        ];
        var n = _this.arr_div.length;
        for (var i = 0; i < n; i++) {
            var sp = _this.make("span", _this.div_progress);
            sp.text("•");
            sp.css("font-size", "2em");
            sp.css("font-family", "monospace");
            _this.arr_spn.push(sp);
        }
        _this.fetch();
        _this.prepare();
        _this.assignEventHandlers();
        _this.present();
        setInterval(function () {
            if (_this.paused)
                return;
            _this.slide_index = (_this.slide_index + 1) % _this.arr_div.length;
            _this.present();
        }, 15000);
        return _this;
    }
    PlgSlideMaster.prototype.fetch = function () {
        var _this = this;
        $.post("./slider-welcome", { _token: this.csrf_token }, function (d, s) {
            _this.div_0.html(d);
        });
        $.post("./slider-intro", { _token: this.csrf_token }, function (d, s) {
            _this.div_1.html(d);
        });
        $.post("./slider-tech", { _token: this.csrf_token }, function (d, s) {
            _this.div_2.html(d);
        });
        $.post("./slider-web-app", { _token: this.csrf_token }, function (d, s) {
            _this.div_3.html(d);
        });
        $.post("./slider-smartphone-app", { _token: this.csrf_token }, function (d, s) {
            _this.div_4.html(d);
        });
        $.post("./slider-desktop-app", { _token: this.csrf_token }, function (d, s) {
            _this.div_5.html(d);
        });
    };
    PlgSlideMaster.prototype.prepare = function () {
        for (var i = 0; i < this.arr_div.length; i++) {
            var d = this.arr_div[i];
            d.hide();
        }
        this.me.css("background-color", "#123");
        this.me.css("border-radius", "5px");
        this.div_progress.addClass("d-inline");
        this.div_progress.addClass("float-right");
        this.div_progress.addClass("p-1");
        this.arr_div.forEach(function (element) {
            element.addClass("dark");
            element.addClass("round");
            element.addClass("p-2");
            element.addClass("center");
        });
        this.div_foot.addClass("round");
        this.div_foot.addClass("dark");
        /* this.btn_previous.addClass("btn");*/
        /* this.btn_previous.addClass("circle");*/
        this.img_previous = this.make("img", this.div_foot);
        this.img_previous.attr("src", "./img/previous.png");
        this.img_previous.attr("alt", "PREVIOUS");
        this.img_previous.css("width", "40px");
        /* this.btn_pause_play.addClass("btn");*/
        /* this.btn_pause_play.addClass("circle");*/
        this.img_pause_play = this.make("img", this.div_foot);
        this.img_pause_play.attr("src", "./img/pause.png");
        this.img_pause_play.attr("alt", "PAUSE");
        this.img_pause_play.css("width", "40px");
        /* this.btn_next.addClass("btn");*/
        /* this.btn_next.addClass("circle");*/
        this.img_next = this.make("img", this.div_foot);
        this.img_next.attr("src", "./img/next.png");
        this.img_next.attr("alt", "NEXT");
        this.img_next.css("width", "40px");
    };
    PlgSlideMaster.prototype.present = function () {
        if (this.slide_index < 0)
            return;
        if (this.slide_index >= this.arr_div.length)
            return;
        for (var i = 0; i < this.arr_div.length; i++) {
            var d = this.arr_div[i];
            if (i == this.slide_index) {
                d.fadeIn();
                /* d.addClass("anm_taxi_left"); */
                this.arr_spn[i].css("color", "red");
            }
            else {
                d.hide();
                this.arr_spn[i].css("color", "gray");
            }
        }
    };
    PlgSlideMaster.prototype.assignEventHandlers = function () {
        var _this = this;
        this.img_next.click(function () {
            _this.slide_index = (_this.slide_index + 1) % _this.arr_div.length;
            _this.present();
        });
        this.img_previous.click(function () {
            _this.slide_index--;
            if (_this.slide_index == -1)
                _this.slide_index = _this.arr_div.length - 1;
            _this.present();
        });
        this.img_pause_play.click(function () {
            _this.paused = !_this.paused;
            if (_this.paused) {
                _this.img_pause_play.attr("src", "./img/play.png");
            }
            else {
                _this.img_pause_play.attr("src", "./img/pause.png");
            }
            _this.img_pause_play.css("width", "40px");
        });
        this.img_next.mouseover(function () {
            _this.img_next.animate({ width: "45px" });
        });
        this.img_next.mouseleave(function () {
            _this.img_next.animate({ width: "40px" });
        });
        this.img_previous.mouseover(function () {
            _this.img_previous.animate({ width: "45px" });
        });
        this.img_previous.mouseleave(function () {
            _this.img_previous.animate({ width: "40px" });
        });
        this.img_pause_play.mouseover(function () {
            _this.img_pause_play.animate({ width: "45px" });
        });
        this.img_pause_play.mouseleave(function () {
            _this.img_pause_play.animate({ width: "40px" });
        });
    };
    PlgSlideMaster.init = function (ownerId, csrf_token) {
        if (csrf_token === void 0) { csrf_token = ""; }
        new PlgSlideMaster(ownerId, csrf_token);
    };
    return PlgSlideMaster;
}(Plg));
