class CmpSetting extends Cmp {
    private stgType: string = null;

    private btn_save = null;
    private cmb_option = null;
    private txt_text = null;
    private txt_number = null;
    private cmp_cal = null;

    private stg_id = 0;

    constructor(ownerId: string, stgType: string, stgId: number) {
        super(ownerId);
        this.stg_id = stgId;
        this.stgType = stgType;
        this.btn_save = this.dlr("btn_save");

        if (this.stgType == "option") this.cmb_option = this.dlr("cmb_option");
        if (this.stgType == "text") this.txt_text = this.dlr("txt_text");
        if (this.stgType == "number") this.txt_number = this.dlr("txt_number");
        if (this.stgType == "gdp") this.cmp_cal = this.getCmp("cmp_cal"); // Globals.arr[ownerId + "_cmp_cal"];

        this.prepare();
        this.assignEventHandlers();
    }

    private hasChanges() {
        this.btn_save.fadeIn();
    }

    private getStgVal() {
        switch (this.stgType) {
            case "option":
                return this.cmb_option.val();
            case "text":
                return this.txt_text.val();
            case "number":
                return this.txt_number.val();
            case "gdp":
                return (<CmpCalendar>this.cmp_cal).getGdp();

            default:
                return "";
        }
    }

    private assignEventHandlers() {
        if (this.cmb_option != null) {
            this.cmb_option.on("change", () => {
                this.hasChanges();
            });
        }

        if (this.txt_text != null) {
            this.txt_text.keypress(() => {
                this.hasChanges();
            });
        }

        if (this.txt_number != null) {
            this.txt_number.keypress(() => {
                this.hasChanges();
            });
            this.txt_number.on("input", () => {
                this.hasChanges();
            });
        }

        this.btn_save.on("click", () => {
            // send a post request to update the value
            let stg_id = this.stg_id;
            let stg_val = this.getStgVal();

            $.post("./api/update-settings", { stg_id, stg_val }, (d, s) => {
                try {
                    if (d["ok"] == 1) {
                        this.btn_save.fadeOut();
                    }
                } catch (err) {
                    console.log(err);
                }
            });

            // this.btn_save.fadeOut();
        });

        if (this.cmp_cal != null) {
            this.cmp_cal["onDateChange"] = () => {
                this.hasChanges();
            };
        }
    }

    private prepare() {
        this.btn_save.hide();
        this.btn_save.removeClass("d-none");

        if (this.stgType == "option") {
            let stg_val = this.cmb_option.attr("stg_val");
            this.cmb_option.val(stg_val).prop("selected", true);
        }
    }

    public static init(ownerId, stgType, stgId) {
        new CmpSetting(ownerId, stgType, stgId);
    }
}
