class CmpContentMenu extends Cmp {
    private btn_add = null;
    private div_menu_items = null;
    private btn_new_div_doc = null;
    private btn_new_plugin = null;
    private section = null;

    public constructor(ownerId, section) {
        super(ownerId);

        this.section = section;
        this.btn_add = this.dlr("btn_add");
        this.div_menu_items = this.dlr("div_menu_items");
        this.btn_new_div_doc = this.dlr("btn_new_div_doc");
        this.btn_new_plugin = this.dlr("btn_new_plugin");

        this.prepare();

        this.assignEventHandlers();
    }

    private prepare() {
        this.div_menu_items.hide();
        this.div_menu_items.removeClass("d-none");
    }

    private assignEventHandlers() {
        this.btn_add.click(() => {
            this.div_menu_items.fadeToggle();
        });

        this.btn_new_div_doc.click(() => {
            let doc_tag = this.section;
            $.post("./api/new-div-doc", { doc_tag }, (d, s) => {
                if (d["ok"] == 1) {
                    window.location.reload();
                }
            });
        });

        this.btn_new_plugin.click(() => {
            let plg_tag = this.section;
            $.post("./api/new-plugin", { plg_tag }, (d, s) => {
                if (d["ok"] == 1) {
                    window.location.reload();
                }
            });
        });
    }

    public static init(ownerId, section) {
        new CmpContentMenu(ownerId, section);
    }
}
