class CmpPlugin extends Cmp {
    private me = null;

    private plg_id = null;
    private div_app = null;
    private div_js_code = null;
    private div_ts_code = null;
    private div_app_script = null;

    private btn_menu = null;
    private div_menu = null;
    private btn_hide_menu = null;

    private btn_reload = null;
    private btn_save = null;
    private btn_clear = null;
    private btn_delete = null;

    private cmb_publish = null;
    private cmb_section = null;
    private plg_gdp_publish = null;
    private plg_gdp_expires = null;

    private plg_js_code = null;
    private plg_ts_code = null;

    private txt_cls = null;

    constructor(ownerId, plgId) {
        super(ownerId);

        this.me = $("#" + ownerId);

        this.plg_id = plgId;

        this.div_js_code = this.dlr("div_js_code");
        this.div_ts_code = this.dlr("div_ts_code");
        this.div_app = this.dlr("div_app");
        this.div_app_script = this.dlr("div_app_script");
        this.btn_menu = this.dlr("btn_menu");
        this.div_menu = this.dlr("div_menu");
        this.btn_hide_menu = this.dlr("btn_hide_menu");

        this.btn_reload = this.dlr("btn_reload");
        this.btn_save = this.dlr("btn_save");
        this.btn_clear = this.dlr("btn_clear");
        this.btn_delete = this.dlr("btn_delete");

        this.plg_gdp_publish = this.dlr("plg_gdp_publish");
        this.plg_gdp_expires = this.dlr("plg_gdp_expires");
        this.cmb_publish = this.dlr("cmb_publish");
        this.cmb_section = this.dlr("cmb_section");

        this.txt_cls = this.dlr("txt_cls");

        this.prepare();
        this.assignEventHandlers();
    }

    private assignEventHandlers() {
        this.btn_menu.on("click", () => {
            this.div_menu.fadeIn();
        });

        this.btn_hide_menu.on("click", () => {
            this.div_menu.fadeOut();
        });

        this.btn_save.on("click", (event) => {
            let plg_js_code = this.div_js_code.html();
            let plg_ts_code = this.div_ts_code.html();

            let plg_js_plain = this.div_js_code.text();
            let plg_cls = this.txt_cls.val();

            // plg_js_code = /*Globals.strToCode*/ plg_js_code;
            // plg_ts_code = /*Globals.strToCode*/ plg_ts_code;

            let plg_show = this.cmb_publish.prop("selectedIndex");

            let plg_gdp_publish = $(
                "#" + this.plg_gdp_publish.attr("id") + "_txt_date"
            ).attr("gdp");

            let plg_gdp_expires = $(
                "#" + this.plg_gdp_expires.attr("id") + "_txt_date"
            ).attr("gdp");

            let plg_tag = this.cmb_section.val(); /* section */

            $.post(
                "./api/save-plugin",
                {
                    plg_id: this.plg_id,
                    plg_js_code,
                    plg_ts_code,
                    plg_js_plain,
                    plg_cls,
                    plg_show,
                    plg_tag,
                    plg_gdp_publish,
                    plg_gdp_expires,
                },
                (d, s) => {
                    console.log(d);
                    this.div_menu.fadeOut();
                    this.btn_menu.fadeIn();
                }
            );
        });

        this.btn_clear.on("click", (event) => {
            this.div_js_code.html("");
            this.div_ts_code.html("");
        });

        this.btn_delete.on("click", (event) => {
            if (this.plg_id == null) return;
            let plg_id = this.plg_id;
            let delete_confirm = window.prompt("DELETE PLUGIN?", "NO");
            if (delete_confirm.trim().toLocaleLowerCase() != "yes") return;

            $.post("./api/delete-plugin", { plg_id }, (d, s) => {
                if (d["ok"] == 1) {
                    this.me.fadeOut();
                }
            });
        });

        this.btn_reload.on("click", () => {
            this.reloadPluginCode();
        });
    }

    private prepare() {
        this.div_menu.hide();
        this.div_menu.removeClass("d-none");

        let plg_show = parseInt(this.cmb_publish.attr("tag"));
        this.cmb_publish.prop("selectedIndex", plg_show);

        let doc_tag = this.cmb_section.attr("tag");
        this.cmb_section.val(doc_tag);
    }

    private reloadPluginCode() {
        $.post("./api/get-plugin", { plg_id: this.plg_id }, (d, s) => {
            try {
                if (d["ok"] == 1) {
                    this.plg_js_code =
                        /*Globals.codeToStr*/ d["result"]["plg_js_code"];
                    this.plg_ts_code =
                        /*Globals.codeToStr*/ d["result"]["plg_ts_code"];

                    this.present();
                } else {
                    console.log("Unable to get plugin");
                }
            } catch (err) {
                console.log(err);
            }
        });
    }

    private present() {
        this.div_js_code.html(this.plg_js_code);
        this.div_ts_code.html(this.plg_ts_code);
    }

    public static init(ownerId, plgId) {
        new CmpPlugin(ownerId, plgId);
    }
}
