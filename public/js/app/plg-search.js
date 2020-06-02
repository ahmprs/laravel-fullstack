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
var PlgSearch = /** @class */ (function (_super) {
    __extends(PlgSearch, _super);
    function PlgSearch(ownerId, csrf_token) {
        if (csrf_token === void 0) { csrf_token = ""; }
        var _this = _super.call(this, ownerId, csrf_token) || this;
        _this.txt_search = null;
        _this.btn_search = null;
        _this.div_search_results = null;
        _this.btn_close = null;
        _this.btn_close = _this.make("button");
        _this.txt_search = _this.make("input");
        _this.btn_search = _this.make("button");
        _this.make("br");
        _this.div_search_results = _this.make("div");
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    PlgSearch.prototype.prepare = function () {
        this.btn_close.text("x");
        this.btn_close.addClass("btn");
        this.btn_close.addClass("btn-danger");
        this.btn_close.addClass("float-right");
        this.txt_search.attr("placeholder", "SEARCH ...");
        this.txt_search.addClass("form-control");
        this.txt_search.addClass("col-md-6");
        this.txt_search.addClass("mb-1");
        this.btn_search.text("SEARCH");
        this.btn_search.addClass("btn");
        this.btn_search.addClass("btn-secondary");
    };
    PlgSearch.prototype.assignEventHandlers = function () {
        var _this = this;
        this.btn_search.click(function () {
            _this.div_search_results.html("");
            _this.make("hr", _this.div_search_results);
            _this.addSearchResultEntry(_this.txt_search.val());
        });
        this.btn_close.click(function () {
            $(_this.me.parent()).fadeOut();
        });
    };
    PlgSearch.prototype.addSearchResultEntry = function (entry) {
        var ent = $("<p></p>");
        ent.text(entry);
        ent.css("color", "#345");
        ent.addClass("check");
        this.div_search_results.append(ent);
    };
    PlgSearch.init = function (ownerId, csrf_token) {
        if (csrf_token === void 0) { csrf_token = ""; }
        new PlgSearch(ownerId, csrf_token);
    };
    return PlgSearch;
}(Plg));
