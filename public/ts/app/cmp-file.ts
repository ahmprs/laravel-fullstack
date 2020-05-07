class CmpFile extends Cmp {
    private file_show = null;
    private btn_save = null;
    private btn_remove = null;
    private btn_view = null;
    private file_tag = null;
    private file_gdp_create = null;
    private file_gdp_publish = null;
    private file_gdp_expires = null;

    constructor(ownerId) {
        super(ownerId);

        this.file_show = this.dlr("file_show");
        this.btn_save = this.dlr("btn_save");
        this.btn_remove = this.dlr("btn_remove");
        this.btn_view = this.dlr("btn_view");
        this.file_tag = this.dlr("file_tag");
        this.file_gdp_create = this.dlr("file_gdp_create");
        this.file_gdp_publish = this.dlr("file_gdp_publish");
        this.file_gdp_expires = this.dlr("file_gdp_expires");

        this.prepare();
        this.assignEventHandlers();
    }

    private prepare() {
        let file_show_s_indx = parseInt(this.file_show.attr("s_indx"));
        this.file_show.prop("selectedIndex", file_show_s_indx);
        let file_tag_s_txt = this.file_tag.attr("s_txt");
        this.file_tag.val(file_tag_s_txt);
    }

    private assignEventHandlers() {
        let self = this;
        this.btn_save.on("click", () => {
            let file_id = self.btn_save.attr("file_id");
            let file_show = this.file_show.prop("selectedIndex");

            let file_gdp_publish = $(
                "#" + this.file_gdp_publish.attr("id") + "_txt_date"
            ).attr("gdp");

            let file_gdp_expires = $(
                "#" + this.file_gdp_expires.attr("id") + "_txt_date"
            ).attr("gdp");

            let file_tag = this.file_tag
                .children("option")
                .filter(":selected")
                .text();

            $.post(
                "./api/update-document-properties",
                {
                    file_id: file_id,
                    file_show: file_show,
                    file_gdp_publish: file_gdp_publish,
                    file_gdp_expires: file_gdp_expires,
                    file_tag: file_tag,
                },
                (d, s) => {
                    // console.log({ d, s });
                    try {
                        if (d["ok"] == 1) {
                            alert("SAVED");
                        }
                    } catch (error) {
                        alert("SAVE Failed!");
                    }
                }
            );
        });

        this.btn_remove.on("click", () => {
            let file_id = self.btn_save.attr("file_id");
            alert(file_id);
        });

        this.btn_view.on("click", () => {
            let file_id = self.btn_save.attr("file_id");
            alert(file_id);
        });
    }

    public static init(ownerId: string) {
        new CmpFile(ownerId);
    }
}
