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
var CmpFile = /** @class */ (function (_super) {
    __extends(CmpFile, _super);
    function CmpFile(ownerId) {
        var _this = _super.call(this, ownerId) || this;
        _this.file_show = null;
        _this.btn_save = null;
        _this.btn_remove = null;
        _this.btn_view = null;
        _this.file_tag = null;
        _this.file_gdp_create = null;
        _this.file_gdp_publish = null;
        _this.file_gdp_expires = null;
        _this.file_show = _this.dlr("file_show");
        _this.btn_save = _this.dlr("btn_save");
        _this.btn_remove = _this.dlr("btn_remove");
        _this.btn_view = _this.dlr("btn_view");
        _this.file_tag = _this.dlr("file_tag");
        _this.file_gdp_create = _this.dlr("file_gdp_create");
        _this.file_gdp_publish = _this.dlr("file_gdp_publish");
        _this.file_gdp_expires = _this.dlr("file_gdp_expires");
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    CmpFile.prototype.prepare = function () {
        var file_show_s_indx = parseInt(this.file_show.attr("s_indx"));
        this.file_show.prop("selectedIndex", file_show_s_indx);
        var file_tag_s_txt = this.file_tag.attr("s_txt");
        this.file_tag.val(file_tag_s_txt);
    };
    CmpFile.prototype.assignEventHandlers = function () {
        var _this = this;
        var self = this;
        this.btn_save.on("click", function () {
            var file_id = self.btn_save.attr("file_id");
            var file_show = _this.file_show.prop("selectedIndex");
            var file_gdp_publish = $("#" + _this.file_gdp_publish.attr("id") + "_txt_date").attr("gdp");
            var file_gdp_expires = $("#" + _this.file_gdp_expires.attr("id") + "_txt_date").attr("gdp");
            var file_tag = _this.file_tag
                .children("option")
                .filter(":selected")
                .text();
            $.post("./api/update-document-properties", {
                file_id: file_id,
                file_show: file_show,
                file_gdp_publish: file_gdp_publish,
                file_gdp_expires: file_gdp_expires,
                file_tag: file_tag,
            }, function (d, s) {
                // console.log({ d, s });
                try {
                    if (d["ok"] == 1) {
                        alert("SAVED");
                    }
                }
                catch (error) {
                    alert("SAVE Failed!");
                }
            });
        });
        this.btn_remove.on("click", function () {
            var file_id = self.btn_save.attr("file_id");
            alert(file_id);
        });
        this.btn_view.on("click", function () {
            var file_id = self.btn_save.attr("file_id");
            alert(file_id);
        });
    };
    CmpFile.init = function (ownerId) {
        new CmpFile(ownerId);
    };
    return CmpFile;
}(Cmp));
