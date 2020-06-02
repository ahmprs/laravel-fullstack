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
var CmpPlugin = /** @class */ (function (_super) {
    __extends(CmpPlugin, _super);
    function CmpPlugin(ownerId, plgId, recId) {
        var _this = _super.call(this, ownerId) || this;
        _this.me = null;
        _this.plg_id = null;
        _this.rec_id = null;
        _this.div_app = null;
        _this.div_app_script = null;
        _this.btn_menu = null;
        _this.div_menu = null;
        _this.btn_hide_menu = null;
        _this.btn_save = null;
        _this.btn_delete = null;
        _this.cmb_publish = null;
        _this.cmb_section = null;
        _this.plg_gdp_publish = null;
        _this.plg_gdp_expires = null;
        _this.cmb_plugin_cls = null;
        _this.txt_rank = null;
        _this.me = $("#" + ownerId);
        _this.plg_id = plgId;
        _this.rec_id = recId;
        _this.div_app = _this.dlr("div_app");
        _this.div_app_script = _this.dlr("div_app_script");
        _this.btn_menu = _this.dlr("btn_menu");
        _this.div_menu = _this.dlr("div_menu");
        _this.btn_hide_menu = _this.dlr("btn_hide_menu");
        _this.btn_save = _this.dlr("btn_save");
        _this.btn_delete = _this.dlr("btn_delete");
        _this.cmb_publish = _this.dlr("cmb_publish");
        _this.cmb_section = _this.dlr("cmb_section");
        _this.plg_gdp_publish = _this.dlr("plg_gdp_publish");
        _this.plg_gdp_expires = _this.dlr("plg_gdp_expires");
        _this.cmb_plugin_cls = _this.dlr("cmb_plugin_cls");
        _this.txt_rank = _this.dlr("txt_rank");
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    CmpPlugin.prototype.assignEventHandlers = function () {
        var _this = this;
        this.btn_menu.on("click", function () {
            _this.div_menu.fadeToggle();
        });
        this.btn_hide_menu.on("click", function () {
            _this.div_menu.fadeOut();
        });
        this.btn_save.on("click", function (event) {
            var plg_gdp_publish = $("#" + _this.plg_gdp_publish.attr("id") + "_txt_date").attr("gdp");
            var plg_gdp_expires = $("#" + _this.plg_gdp_expires.attr("id") + "_txt_date").attr("gdp");
            var plg_show = _this.cmb_publish.prop("selectedIndex");
            var plg_rank = parseInt(_this.txt_rank.val());
            var plg_tag = _this.cmb_section.val();
            var op = _this.cmb_plugin_cls.find("option:selected");
            var plg_id = op.attr("tag");
            $.post("./api/save-plugin-meta", {
                rec_id: _this.rec_id,
                plg_id: plg_id,
                plg_gdp_publish: plg_gdp_publish,
                plg_gdp_expires: plg_gdp_expires,
                plg_show: plg_show,
                plg_rank: plg_rank,
                plg_tag: plg_tag,
            }, function (d, s) {
                console.log(d);
                if (d["ok"] == 1) {
                    _this.div_menu.fadeOut();
                    _this.btn_menu.fadeIn();
                }
            });
        });
        this.btn_delete.on("click", function (event) {
            var delete_confirm = window.prompt("DELETE PLUGIN?", "NO");
            if (delete_confirm.trim().toLocaleLowerCase() != "yes")
                return;
            $.post("./api/delete-plugin-meta", { rec_id: _this.rec_id }, function (d, s) {
                if (d["ok"] == 1) {
                    _this.me.fadeOut();
                }
            });
        });
    };
    CmpPlugin.prototype.prepare = function () {
        this.div_menu.hide();
        this.div_menu.removeClass("d-none");
        var t = this.cmb_plugin_cls.attr("tag");
        this.cmb_plugin_cls.val(t);
        t = this.cmb_section.attr("tag");
        this.cmb_section.val(t);
        t = this.cmb_publish.attr("tag");
        this.cmb_publish.prop("selectedIndex", parseInt(t));
    };
    CmpPlugin.prototype.present = function () {
        //
    };
    CmpPlugin.init = function (ownerId, plgId, recId) {
        new CmpPlugin(ownerId, plgId, recId);
    };
    return CmpPlugin;
}(Cmp));
