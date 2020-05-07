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
var CmpFiles = /** @class */ (function (_super) {
    __extends(CmpFiles, _super);
    function CmpFiles(ownerId, cnt) {
        var _this = _super.call(this, ownerId) || this;
        _this.tbl_items = null;
        _this.arr_file_show = [];
        _this.arr_btn_save = [];
        _this.arr_file_tag = [];
        _this.arr_file_gdp_create = [];
        _this.arr_file_gdp_publish = [];
        _this.arr_file_gdp_expires = [];
        _this.tbl_items = _this.dlr("tbl_items");
        for (var i = 0; i < cnt; i++) {
            var btn = _this.dlr("btn_save_" + i);
            btn.attr("indx", i);
            _this.arr_btn_save.push(_this.dlr("btn_save_" + i));
            _this.arr_file_show.push(_this.dlr("file_show_" + i));
            _this.arr_file_gdp_create.push(_this.dlr("file_gdp_create_" + i));
            _this.arr_file_gdp_publish.push(_this.dlr("file_gdp_publish_" + i));
            _this.arr_file_gdp_expires.push(_this.dlr("file_gdp_expires_" + i));
            _this.arr_file_tag.push(_this.dlr("file_tag_" + i));
        }
        _this.assignEventHandlers();
        return _this;
    }
    CmpFiles.prototype.assignEventHandlers = function () {
        var self = this;
        for (var i = 0; i < this.arr_btn_save.length; i++) {
            var btn = this.arr_btn_save[i];
            btn.on("click", function () {
                var btn = $(self.applyPath(window, "event/target"));
                var indx = btn.attr("indx");
                var file_id = btn.attr("file_id");
                var file_show = self.arr_file_show[indx];
                var file_gdp_create = self.arr_file_gdp_create[indx];
                var file_gdp_publish = self.arr_file_gdp_publish[indx];
                var file_gdp_expires = self.arr_file_gdp_expires[indx];
                var file_tag = self.arr_file_tag[indx];
                console.log(file_tag, file_gdp_expires, file_gdp_publish, file_gdp_create, file_show);
                // TODO:
                // A. extract the value of
                // 1- show
                // 2- created
                // 3- published
                // 4- expires
                // 5- section
                // B. make an endpoint on server-side for update
                // C. send a post request
                // D. handle on success and failure situations
            });
        }
    };
    CmpFiles.init = function (ownerId, cnt) {
        new CmpFiles(ownerId, cnt);
    };
    return CmpFiles;
}(Cmp));
