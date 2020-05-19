class CmpPluginCode extends Cmp {
    private me = null;
    private plg_id = null;
    private div_app = null;
    private btn_menu = null;
    private div_menu = null;
    private btn_hide_menu = null;
    private btn_save = null;
    private btn_delete = null;
    private txt_plugin_cls = null;

    private div_ts_code = null;
    private div_js_code = null;
    private div_app_script = null;

    constructor(ownerId, plgId) {
        super(ownerId);

        this.me = $("#" + ownerId);
        this.plg_id = plgId;
        this.div_app = this.dlr("div_app");
        this.btn_menu = this.dlr("btn_menu");
        this.div_menu = this.dlr("div_menu");
        this.btn_hide_menu = this.dlr("btn_hide_menu");
        this.btn_save = this.dlr("btn_save");
        this.btn_delete = this.dlr("btn_delete");
        this.txt_plugin_cls = this.dlr("txt_plugin_cls");

        this.div_ts_code = this.dlr("div_ts_code");
        this.div_js_code = this.dlr("div_js_code");
        this.div_app_script = this.dlr("div_app_script");

        this.prepare();
        this.assignEventHandlers();
    }

    private prepare() {
        this.div_menu.hide();
        this.div_menu.removeClass("d-none");
    }

    private assignEventHandlers() {
        this.btn_menu.on("click", () => {
            this.div_menu.fadeToggle();
        });

        this.btn_hide_menu.on("click", () => {
            this.div_menu.fadeOut();
        });

        this.btn_save.on("click", (event) => {
            let plg_cls = this.txt_plugin_cls.val();
            let plg_js_code = this.div_js_code.html();
            let plg_ts_code = this.div_js_code.html();
            let plg_js_plain = this.div_js_code.text();

            $.post(
                "./api/save-plugin-code",
                {
                    plg_id: this.plg_id,
                    plg_js_code,
                    plg_ts_code,
                    plg_js_plain,
                    plg_cls,
                },
                (d, s) => {
                    console.log(d);
                    if (d["ok"] == 1) {
                        this.div_menu.fadeOut();
                        this.btn_menu.fadeIn();
                    }
                }
            );
        });

        this.btn_delete.on("click", (event) => {
            if (this.plg_id == null) return;
            let plg_id = this.plg_id;
            let delete_confirm = window.prompt("DELETE PLUGIN?", "NO");
            if (delete_confirm.trim().toLocaleLowerCase() != "yes") return;

            $.post("./api/delete-plugin-code", { plg_id }, (d, s) => {
                if (d["ok"] == 1) {
                    this.me.fadeOut();
                }
            });
        });
    }

    public static init(ownerId, plgId) {
        new CmpPluginCode(ownerId, plgId);
    }
}
