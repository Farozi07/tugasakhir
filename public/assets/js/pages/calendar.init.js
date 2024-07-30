"use strict";
!(function (l) {
    function e() {
        this.$calendar = l("#calendar");
    }
    (e.prototype.init = function () {
        var e = new Date(l.now());
        var e = [
                {
                    title: "Meeting with Mr. Shreyu",
                    start: new Date(l.now() + 158e6),
                    end: new Date(l.now() + 338e6),
                    className: "bg-danger",
                },
                {
                    title: "Interview - Backend Engineer",
                    start: e,
                    end: e,
                    className: "bg-success",
                },
                {
                    title: "Phone Screen - Frontend Engineer",
                    start: new Date(l.now() + 168e6),
                    className: "bg-info",
                },
                {
                    title: "Buy Design Assets",
                    start: new Date(l.now() + 338e6),
                    end: new Date(l.now() + 4056e5),
                    className: "bg-primary",
                },
            ],
            a = this;
        (a.$calendarObj = new FullCalendar.Calendar(a.$calendar[0], {
            themeSystem: "bootstrap",
            bootstrapFontAwesome: !1,
            buttonText: {
                today: "Today",
                month: "Month",
                prev: "Prev",
                next: "Next",
            },
            initialView: "dayGridMonth",
            handleWindowResize: !0,
            height: l(window).height() - 200,
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "",
            },
            initialEvents: e,
            editable: !0,
            droppable: !0,
            selectable: !0,
        })),
            a.$calendarObj.render();
    }),
        (l.CalendarApp = new e()),
        (l.CalendarApp.Constructor = e);
})(window.jQuery),
    window.jQuery.CalendarApp.init();
