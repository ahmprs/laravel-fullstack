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
var CmpThumbNail = /** @class */ (function (_super) {
    __extends(CmpThumbNail, _super);
    function CmpThumbNail(ownerId) {
        var _this = _super.call(this, ownerId) || this;
        _this.div_thumbnail = null;
        _this.h3_title = null;
        _this.img_pic = null;
        _this.slide_index = 0;
        _this.arr_splash = [];
        _this.div_splash = null;
        _this.paused = true;
        _this.div_thumbnail = _this.dlr("div_thumbnail");
        _this.h3_title = _this.dlr("h3_title");
        _this.img_pic = _this.dlr("img_pic");
        _this.div_splash = _this.dlr("div_splash");
        _this.arr_splash = _this.div_splash.children();
        _this.prepare();
        _this.assignEventHandlers();
        _this.present();
        return _this;
    }
    CmpThumbNail.prototype.prepare = function () {
        for (var i = 0; i < this.arr_splash.length; i++) {
            this.div_thumbnail.append(this.arr_splash[i]);
            $(this.arr_splash[i]).hide();
            $(this.arr_splash[i]).removeClass("d-none");
        }
    };
    CmpThumbNail.prototype.present = function () {
        var _this = this;
        setInterval(function () {
            if (!_this.paused) {
                var n = _this.arr_splash.length;
                var spn = $(_this.arr_splash[_this.slide_index]);
                for (var i = 0; i < n; i++) {
                    var s = $(_this.arr_splash[i]);
                    if (i == _this.slide_index) {
                        s.fadeIn();
                    }
                    else {
                        s.hide();
                    }
                }
                _this.slide_index++;
                if (_this.slide_index >= n)
                    _this.slide_index = 0;
                console.log(spn.text());
            }
        }, 2000);
    };
    CmpThumbNail.prototype.assignEventHandlers = function () {
        var _this = this;
        this.img_pic.mouseover(function () {
            _this.img_pic.animate({ zoom: "1.2" });
            _this.paused = false;
        });
        this.img_pic.mouseleave(function () {
            _this.img_pic.animate({ zoom: "1.0" });
            _this.paused = true;
        });
    };
    CmpThumbNail.init = function (ownerId) {
        new CmpThumbNail(ownerId);
    };
    return CmpThumbNail;
}(Cmp));
