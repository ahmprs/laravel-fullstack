class Globals {
    public static arr = [];

    public static strToCode(txt: string): string {
        let n = txt.length;
        let h: string = "";
        for (let i = 0; i < n; i++) {
            h += txt.charCodeAt(i) + ";";
        }
        return h;
    }

    public static codeToStr(hex: string): string {
        let arr = hex.split(";");
        let n = arr.length;
        let s: string = "";
        for (let i = 0; i < n; i++) {
            s += String.fromCharCode(parseInt(arr[i]));
        }
        return s;
    }
}
