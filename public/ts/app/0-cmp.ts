class Cmp {
    public prefix: string = "";
    public csrf_token = "";

    public constructor(ownerId: string, csrf_token = "") {
        this.csrf_token = csrf_token;
        this.prefix = ownerId + "_";

        // Keep track of each object generated
        Globals.arr[ownerId] = this;
    }

    protected applyPath(el, path) {
        let arr: string[] = path.split("/");
        let res = el;
        for (let i = 0; i < arr.length; i++) {
            res = res[arr[i]];
            if (res == null) return null;
        }
        return res;
    }

    protected dlr(id: string) {
        return $("#" + this.prefix + id);
    }

    protected getCmp(id: string) {
        return Globals.arr[this.prefix + id];
    }
}
