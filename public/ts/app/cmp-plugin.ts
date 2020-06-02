class CmpPlugin extends Cmp {
    private me = null;

    private plg_id = null;
    private rec_id = null;
    private div_app = null;
    private div_app_script = null;

    private btn_menu = null;
    private div_menu = null;
    private btn_hide_menu = null;

    private btn_save = null;
    private btn_delete = null;

    private cmb_publish = null;
    private cmb_section = null;
    private plg_gdp_publish = null;
    private plg_gdp_expires = null;
    private cmb_plugin_cls = null;

    private txt_rank = null;

    constructor(ownerId, plgId, recId) {
        super(ownerId);

        this.me = $("#" + ownerId);
        this.plg_id = plgId;
        this.rec_id = recId;
        this.div_app = this.dlr("div_app");
        this.div_app_script = this.dlr("div_app_script");
        this.btn_menu = this.dlr("btn_menu");
        this.div_menu = this.dlr("div_menu");
        this.btn_hide_menu = this.dlr("btn_hide_menu");
        this.btn_save = this.dlr("btn_save");
        this.btn_delete = this.dlr("btn_delete");

        this.cmb_publish = this.dlr("cmb_publish");
        this.cmb_section = this.dlr("cmb_section");
        this.plg_gdp_publish = this.dlr("plg_gdp_publish");
        this.plg_gdp_expires = this.dlr("plg_gdp_expires");
        this.cmb_plugin_cls = this.dlr("cmb_plugin_cls");

        this.txt_rank = this.dlr("txt_rank");

        this.prepare();
        this.assignEventHandlers();
    }

    private assignEventHandlers() {
        this.btn_menu.on("click", () => {
            this.div_menu.fadeToggle();
        });

        this.btn_hide_menu.on("click", () => {
            this.div_menu.fadeOut();
        });

        this.btn_save.on("click", (event) => {
            let plg_gdp_publish = $(
                "#" + this.plg_gdp_publish.attr("id") + "_txt_date"
            ).attr("gdp");
            let plg_gdp_expires = $(
                "#" + this.plg_gdp_expires.attr("id") + "_txt_date"
            ).attr("gdp");
            let plg_show = this.cmb_publish.prop("selectedIndex");
            let plg_rank = parseInt(this.txt_rank.val());
            let plg_tag = this.cmb_section.val();

            let op = this.cmb_plugin_cls.find("option:selected");
            let plg_id = op.attr("tag");

            $.post(
                "./api/save-plugin-meta",
                {
                    rec_id: this.rec_id,
                    plg_id,
                    plg_gdp_publish,
                    plg_gdp_expires,
                    plg_show,
                    plg_rank,
                    plg_tag,
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
            let delete_confirm = window.prompt("DELETE PLUGIN?", "NO");
            if (delete_confirm.trim().toLocaleLowerCase() != "yes") return;

            $.post(
                "./api/delete-plugin-meta",
                { rec_id: this.rec_id },
                (d, s) => {
                    if (d["ok"] == 1) {
                        this.me.fadeOut();
                    }
                }
            );
        });
    }

    private prepare() {
        this.div_menu.hide();
        this.div_menu.removeClass("d-none");

        let t = this.cmb_plugin_cls.attr("tag");
        this.cmb_plugin_cls.val(t);

        t = this.cmb_section.attr("tag");
        this.cmb_section.val(t);

        t = this.cmb_publish.attr("tag");
        this.cmb_publish.prop("selectedIndex", parseInt(t));
    }

    private present() {
        //
    }

    public static init(ownerId, plgId, recId) {
        new CmpPlugin(ownerId, plgId, recId);
    }
}
