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
var CmpContentMenu = /** @class */ (function (_super) {
    __extends(CmpContentMenu, _super);
    function CmpContentMenu(ownerId, section) {
        var _this = _super.call(this, ownerId) || this;
        _this.btn_add = null;
        _this.div_menu_items = null;
        _this.btn_new_div_doc = null;
        _this.btn_new_plugin = null;
        _this.section = null;
        _this.section = section;
        _this.btn_add = _this.dlr("btn_add");
        _this.div_menu_items = _this.dlr("div_menu_items");
        _this.btn_new_div_doc = _this.dlr("btn_new_div_doc");
        _this.btn_new_plugin = _this.dlr("btn_new_plugin");
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    CmpContentMenu.prototype.prepare = function () {
        this.div_menu_items.hide();
        this.div_menu_items.removeClass("d-none");
    };
    CmpContentMenu.prototype.assignEventHandlers = function () {
        var _this = this;
        this.btn_add.click(function () {
            _this.div_menu_items.fadeToggle();
        });
        this.btn_new_div_doc.click(function () {
            var doc_tag = _this.section;
            $.post("./api/new-div-doc", { doc_tag: doc_tag }, function (d, s) {
                if (d["ok"] == 1) {
                    window.location.reload();
                }
            });
        });
        this.btn_new_plugin.click(function () {
            var plg_tag = _this.section;
            $.post("./api/new-plugin", { plg_tag: plg_tag }, function (d, s) {
                if (d["ok"] == 1) {
                    window.location.reload();
                }
            });
        });
    };
    CmpContentMenu.init = function (ownerId, section) {
        new CmpContentMenu(ownerId, section);
    };
    return CmpContentMenu;
}(Cmp));
