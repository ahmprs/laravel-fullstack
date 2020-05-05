//calendar code
//1399-02-16
//-----------------------------------------
var Calendar = /** @class */ (function () {
    function Calendar() {
        this.JAL_ORG_GDP = null;
        this.JAL_MAX_GDP = null;
        this.GREG_ORG_GDP = null;
        this.GREG_MAX_GDP = null;
        this.jal_week_days = null;
        this.jal_week_days_abbr = null;
        this.jal_months = null;
        this.greg_week_days = null;
        this.greg_week_days_abbr = null;
        this.greg_months = null;
        this.greg_months_abbr = null;
        this.greg_months_fa = null;
        this.JAL_ORG_GDP = 226894;
        this.JAL_MAX_GDP = 3652058;
        this.GREG_ORG_GDP = 0; /*  The origine of Gerigorian calendar (0001/01/01 Greg)*/
        this.GREG_MAX_GDP = 3652058; /*  Days passd from 1/1/1 AD to 9999 Dec 31 AD which is the maximum supported date in gregorian calendar (9999/12/31 Greg)*/
        this.jal_week_days = [
            "شنبه",
            "یکشنبه",
            "دوشنبه",
            "سه شنبه",
            "چهار شنبه",
            "پنج شنبه",
            "جمعه",
        ];
        this.jal_week_days_abbr = ["ش", "ی", "د", "س", "چ", "پ", "ج"];
        this.jal_months = [
            "فروردین",
            "اردیبهشت",
            "خرداد",
            "تیر",
            "مرداد",
            "شهریور",
            "مهر",
            "آبان",
            "آذر",
            "دی",
            "بهمن",
            "اسفند",
        ];
        this.greg_week_days = [
            "Saturday",
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
        ];
        this.greg_week_days_abbr = [
            "Sat",
            "Sun",
            "Mon",
            "Tue",
            "Wed",
            "Thr",
            "Fri",
        ];
        this.greg_months = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "Septamber",
            "October",
            "November",
            "December",
        ];
        this.greg_months_abbr = [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
        ];
        this.greg_months_fa = [
            "زانويه",
            "فوريه",
            "مارچ",
            "آوريل",
            "مي",
            "ژون",
            "جولاي",
            "آگوست",
            "سپتامبر",
            "اکتبر",
            "نوامبر",
            "دسامبر",
        ];
    }
    Calendar.prototype.getJalDateFromGdp = function (gdp) {
        var jal_year = 0;
        var jal_month = 0;
        var jal_day_of_month = 0;
        var jal_day_of_week = 0;
        var obj1 = this.getJalYear(gdp);
        jal_year = obj1["year"];
        var rem = obj1["rem"];
        var is_leap = this.IsJalLeapYear(jal_year);
        var obj2 = this.getJalMonth(is_leap, rem);
        jal_month = obj2["month"];
        jal_day_of_month = obj2["rem"] + 1;
        var date_str = "";
        date_str += this.padLeft(jal_year, 4, "0") + "/";
        date_str += this.padLeft(jal_month, 2, "0") + "/";
        date_str += this.padLeft(jal_day_of_month, 2, "0");
        var day_of_week_number = (Math.floor(gdp) + 2) % 7;
        var day_title = this.jal_week_days[day_of_week_number];
        var day_title_abbr = this.jal_week_days_abbr[day_of_week_number];
        var month_title = this.jal_months[jal_month - 1];
        var full_date_str = "";
        full_date_str += day_title + " ";
        full_date_str += jal_day_of_month + " ";
        full_date_str += month_title + " ";
        full_date_str += jal_year;
        return {
            DateString: date_str,
            FullDateString: full_date_str,
            Year: jal_year,
            Month: jal_month,
            DayOfMonth: jal_day_of_month,
            DayOfWeek: day_of_week_number,
            DayTitle: day_title,
            MonthTitle: month_title,
            DayTitleAbbr: day_title_abbr,
        };
    };
    Calendar.prototype.getJalDaysInMonth = function (gdp) {
        //???
        var obj1 = this.getJalYear(gdp);
        var jal_year = obj1["year"];
        var rem = obj1["rem"];
        var is_leap = this.IsJalLeapYear(jal_year);
        var month = this.getJalMonth(is_leap, rem)["month"];
        var M = [];
        if (is_leap)
            M = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 30];
        else
            M = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
        return M[month - 1];
    };
    Calendar.prototype.getGdp = function (Year, Month, DayOfMonth) {
        var c = 0;
        var y = 1;
        var d = 0;
        var M = [];
        while ((c + 1) * 100 < Year) {
            c++;
            if (c % 4 == 0)
                d += 36525;
            else
                d += 36524;
        }
        while (c * 100 + y < Year) {
            if (this.IsGregLeapYear(c * 100 + y))
                d += 366;
            else
                d += 365;
            y++;
        }
        if (this.IsGregLeapYear(Year))
            M = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        else
            M = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        for (var m = 1; m < Month; m++) {
            d += M[m - 1];
        }
        d += DayOfMonth;
        return d - 1;
    };
    Calendar.prototype.IsGregLeapYear = function (AYear) {
        if (AYear <= 0)
            return false;
        if (AYear % 4 != 0)
            return false;
        if (AYear % 100 == 0) {
            if (AYear % 400 == 0)
                return true;
            else
                return false;
        }
        return true;
    };
    Calendar.prototype.getJalYear = function (GregDaysPassed) {
        var RemainingDays = 0;
        if (GregDaysPassed < this.JAL_ORG_GDP)
            return -1;
        if (GregDaysPassed > this.JAL_MAX_GDP)
            return -1;
        var d = 0;
        var y = 0;
        var obj = this.GetJalLeapSequence(GregDaysPassed);
        var Rem = obj.rem;
        var n = obj.seq;
        if (n == 0)
            y = 0;
        else
            y = n * 33 - 8;
        var y_days = 0;
        while (true) {
            y++;
            if (this.IsJalLeapYear(y))
                y_days = 366;
            else
                y_days = 365;
            if (d + y_days > Rem)
                break;
            d += y_days;
        }
        RemainingDays = Rem - d;
        return {
            year: y,
            rem: RemainingDays,
        };
    };
    Calendar.prototype.getJalMonth = function (IsLeapYear, YearDaysPassed) {
        var RemainingDays = 0;
        if (YearDaysPassed > 366)
            return -1;
        if (YearDaysPassed < 0)
            return -1;
        var M = [];
        if (IsLeapYear)
            M = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 30];
        else
            M = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
        var d = 0;
        var m = 1;
        while (d + M[m - 1] <= YearDaysPassed) {
            d += M[m - 1];
            m++;
        }
        RemainingDays = YearDaysPassed - d;
        return {
            month: m,
            rem: RemainingDays,
        };
    };
    Calendar.prototype.GetJalLeapSequence = function (GregDaysPassed) {
        var RemainingDays = 0;
        var JalDaysPassed = GregDaysPassed - this.JAL_ORG_GDP;
        var n = Math.floor((JalDaysPassed + 2922) / 12053);
        if (n == 0) {
            RemainingDays = JalDaysPassed;
            //alert("n = " + n);
            //alert("rem = " + RemainingDays);
            return {
                seq: n,
                rem: RemainingDays,
            };
        }
        else if (n == 1) {
            RemainingDays = JalDaysPassed - 9131;
            //alert("n = " + n);
            //alert("rem = " + RemainingDays);
            return {
                seq: n,
                rem: RemainingDays,
            };
        }
        else {
            RemainingDays = JalDaysPassed - (9131 + (n - 1) * 12053);
            //alert("n = " + n);
            //alert("rem = " + RemainingDays);
            return {
                seq: n,
                rem: RemainingDays,
            };
        }
    };
    Calendar.prototype.IsJalLeapYear = function (AJalaliYear) {
        for (var i = 0; i < 7; i++)
            if ((AJalaliYear - (i * 4 - 7)) % 33 == 0)
                return true;
        if ((AJalaliYear - (7 * 4 - 6)) % 33 == 0)
            return true;
        return false;
    };
    Calendar.prototype.jalDateToGdp = function (Year, Month, DayOfMonth) {
        //    alert(Year);
        //    alert(Month);
        //    alert(DayOfMonth);
        if (this.IsValidJalDate(Year, Month, DayOfMonth) == false)
            return null;
        var n = Math.floor((Year + 7) / 33);
        var y = 0;
        var d = 0;
        var m = 1;
        var M = [];
        if (n == 0) {
            d = 0;
            y = 1;
        }
        else {
            d = 9131 + (n - 1) * 12053;
            y = n * 33 - 7;
        }
        while (y < Year) {
            if (this.IsJalLeapYear(y))
                d += 366;
            else
                d += 365;
            y++;
        }
        if (this.IsJalLeapYear(y))
            M = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 30];
        else
            M = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
        while (m < Month) {
            d += M[m - 1];
            m++;
        }
        d += DayOfMonth;
        d += this.JAL_ORG_GDP;
        return d - 1;
    };
    Calendar.prototype.jalDateStrToGdp = function (dateStr) {
        var jal_date = this.getDateParts(dateStr);
        if (jal_date == null) {
            return null;
        }
        else {
            var gdp = this.jalDateToGdp(jal_date.year, jal_date.month, jal_date.day);
            return gdp;
        }
    };
    Calendar.prototype.IsValidJalDate = function (JalYear, JalMonth, JalDayOfMonth) {
        if (JalYear < 0)
            return false;
        if (JalYear > 9999)
            return false;
        if (JalMonth < 0)
            return false;
        if (JalMonth > 12)
            return false;
        if (JalDayOfMonth < 0)
            return false;
        if (JalDayOfMonth > 31)
            return false;
        if (JalMonth > 6 && JalDayOfMonth > 30)
            return false;
        var is_leap = this.IsJalLeapYear(JalYear);
        if (is_leap && JalMonth == 12 && JalDayOfMonth > 29)
            return false;
        return true;
    };
    Calendar.prototype.getDateParts = function (dateStr) {
        var y = 0;
        var m = 0;
        var d = 0;
        try {
            var parts = dateStr.trim().split("/");
            if (parts.length != 3)
                return null;
            y = parseInt(parts[0]);
            m = parseInt(parts[1]);
            d = parseInt(parts[2]);
            return {
                year: y,
                month: m,
                day: d,
            };
        }
        catch (e) {
            return null;
        }
    };
    Calendar.prototype.padLeft = function (str, totlalLength, ch) {
        var s = str + "";
        var len = s.length;
        var n = totlalLength - len;
        var res = s;
        for (var i = 0; i < n; i++) {
            res = ch + res;
        }
        return res;
    };
    Calendar.prototype.getGregCentury = function (GregDaysPassed) {
        var RemainingDays = 0;
        var d = 0;
        var c = 0;
        var c_days = 0;
        while (true) {
            c++;
            if (c % 4 == 0)
                c_days = 36525;
            else
                c_days = 36524;
            if (d + c_days > GregDaysPassed)
                break;
            d += c_days;
        }
        RemainingDays = GregDaysPassed - d;
        return {
            Century: c,
            RemainingDays: RemainingDays,
        };
    };
    Calendar.prototype.getGregYear = function (GregDaysPassed) {
        var RemainingDays = 0;
        if (GregDaysPassed < this.GREG_ORG_GDP)
            return -1;
        if (GregDaysPassed > this.GREG_MAX_GDP)
            return -1;
        var res = this.getGregCentury(GregDaysPassed);
        var c = res.Century;
        var rem = res.RemainingDays;
        var d = 0;
        var y = 0;
        var y_days = 0;
        while (true) {
            y++;
            if (this.IsGregLeapYear(y + (c - 1) * 100))
                y_days = 366;
            else
                y_days = 365;
            if (d + y_days > rem)
                break;
            d += y_days;
        }
        RemainingDays = rem - d;
        var g = y + (c - 1) * 100;
        return {
            GregYear: g,
            RemainingDays: RemainingDays,
        };
    };
    Calendar.prototype.getGregMonth = function (IsLeapYear, YearDaysPassed) {
        var RemainingDays = 0;
        if (YearDaysPassed > 366)
            return -1;
        if (YearDaysPassed < 0)
            return -1;
        var M = [];
        if (IsLeapYear)
            M = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        else
            M = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        var d = 0;
        var m = 1;
        while (d + M[m - 1] <= YearDaysPassed) {
            d += M[m - 1];
            m++;
        }
        RemainingDays = YearDaysPassed - d;
        return {
            GregMonth: m,
            RemainingDays: RemainingDays,
        };
    };
    Calendar.prototype.getGregDateFromGdp = function (gdp) {
        var res = this.getGregYear(gdp);
        var Rem = res["RemainingDays"];
        var Y = res["GregYear"];
        var ress = this.getGregMonth(this.IsGregLeapYear(Y), Rem);
        var M = ress["GregMonth"];
        Rem = ress["RemainingDays"];
        var D = Rem + 1;
        var date_str = "";
        date_str += this.padLeft(Y, 4, "0") + "/";
        date_str += this.padLeft(M, 2, "0") + "/";
        date_str += this.padLeft(D, 2, "0");
        var day_of_week_number = (Math.floor(gdp) + 2) % 7;
        var day_title = this.greg_week_days_abbr[day_of_week_number];
        var month_title = this.greg_months_abbr[M - 1];
        var full_date_str = "";
        full_date_str += day_title + ", ";
        full_date_str += month_title + ", ";
        full_date_str += D + ", ";
        full_date_str += Y;
        return {
            DateString: date_str,
            FullDateString: full_date_str,
            Year: Y,
            Month: M,
            DayOfMonth: D,
            DayOfWeek: day_of_week_number,
            DayTitle: day_title,
            MonthTitle: month_title,
        };
    };
    return Calendar;
}());
