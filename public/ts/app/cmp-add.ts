class CmpAdd extends Cmp {
    // html elements used by GUI
    private txt_x = null;
    private txt_y = null;
    private spn_result = null;
    private btn_add = null;

    // main constructor
    constructor(ownerId: string) {
        super(ownerId);
        let self = this;

        // bind js objects to html elements
        this.txt_x = this.dlr("txt_x");
        this.txt_y = this.dlr("txt_y");
        this.spn_result = this.dlr("spn_result");
        this.btn_add = this.dlr("btn_add");

        // assign event handlers
        this.btn_add.on("click", () => {
            let x = parseFloat(self.txt_x.val());
            let y = parseFloat(self.txt_y.val());
            let z = x + y;
            self.spn_result.text(z);
        });
    }

    // entry point
    public static init(ownerId) {
        new CmpAdd(ownerId);
    }
}
