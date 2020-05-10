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
var CmpTabPages = /** @class */ (function (_super) {
    __extends(CmpTabPages, _super);
    function CmpTabPages(ownerId) {
        var _this = _super.call(this, ownerId) || this;
        _this.arr_pages = [];
        _this.arr_buttons = [];
        _this.div_buttons = null;
        _this.div_page_holder = null;
        _this.active_page_index = -1;
        _this.div_buttons = _this.dlr("div_buttons");
        var arr = _this.div_buttons.children();
        for (var i = 0; i < arr.length; i++) {
            _this.arr_buttons.push($(arr[i]));
        }
        _this.div_page_holder = _this.dlr("div_page_holder");
        var brr = _this.div_page_holder.children();
        for (var i = 0; i < brr.length; i++) {
            _this.arr_pages.push($(brr[i]));
        }
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    CmpTabPages.prototype.assignEventHandlers = function () {
        var _this = this;
        for (var i = 0; i < this.arr_buttons.length; i++) {
            var btn = this.arr_buttons[i];
            btn.on("click", function (event) {
                var btn = $(event.target);
                var pin = btn.attr("pin");
                _this.active_page_index = parseInt(pin);
                _this.present();
            });
        }
    };
    CmpTabPages.prototype.prepare = function () {
        for (var i = 0; i < this.arr_pages.length; i++) {
            var p = this.arr_pages[i];
            p.hide();
            p.removeClass("d-none");
        }
        this.active_page_index = 0;
        this.present();
    };
    CmpTabPages.prototype.present = function () {
        var pin = this.active_page_index;
        if (pin == -1)
            return;
        for (var i = 0; i < this.arr_pages.length; i++) {
            var p = this.arr_pages[i];
            if (p.attr("pin") != pin)
                p.hide();
            else
                p.fadeIn();
        }
        for (var i = 0; i < this.arr_buttons.length; i++) {
            var b = this.arr_buttons[i];
            if (b.attr("pin") != pin)
                b.removeClass("bg-white");
            else
                b.addClass("bg-white");
        }
    };
    CmpTabPages.init = function (ownerId) {
        new CmpTabPages(ownerId);
    };
    return CmpTabPages;
}(Cmp));
