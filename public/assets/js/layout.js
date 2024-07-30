"use strict";
function _classCallCheck(e, t) {
    if (!(e instanceof t))
        throw new TypeError("Cannot call a class as a function");
}
function _defineProperties(e, t) {
    for (var a = 0; a < t.length; a++) {
        var n = t[a];
        (n.enumerable = n.enumerable || !1),
            (n.configurable = !0),
            "value" in n && (n.writable = !0),
            Object.defineProperty(e, n.key, n);
    }
}
function _createClass(e, t, a) {
    return (
        t && _defineProperties(e.prototype, t), a && _defineProperties(e, a), e
    );
}
var LeftSidebar = (function () {
        function e() {
            _classCallCheck(this, e),
                (this.body = $("body")),
                (this.window = $(window));
        }
        return (
            _createClass(e, [
                {
                    key: "initMenu",
                    value: function () {
                        var a, n, t, i, o;
                        $("#side-menu").length &&
                            ((i = $("#side-menu li .collapse")).on({
                                "show.bs.collapse": function (e) {
                                    e = $(e.target).parents(".collapse.show");
                                    $("#side-menu .collapse.show")
                                        .not(e)
                                        .collapse("hide");
                                },
                            }),
                            $("#side-menu a").each(function () {
                                var e = window.location.href.split(/[?#]/)[0];
                                this.href == e &&
                                    ($(this).addClass("active"),
                                    $(this)
                                        .parent()
                                        .addClass("menuitem-active"),
                                    $(this)
                                        .parent()
                                        .parent()
                                        .parent()
                                        .addClass("show"),
                                    $(this)
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .addClass("menuitem-active"),
                                    "sidebar-menu" !==
                                        (e = $(this)
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()).attr("id") &&
                                        e.addClass("show"),
                                    $(this)
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .addClass("menuitem-active"),
                                    "wrapper" !==
                                        (e = $(this)
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()).attr("id") &&
                                        e.addClass("show"),
                                    (e = $(this)
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()).is("body") ||
                                        e.addClass("menuitem-active"));
                            })),
                            $("#two-col-sidenav-main").length &&
                                ((a = $("#two-col-sidenav-main .nav-link")),
                                (n = $(".twocolumn-menu-item")),
                                (t = $(
                                    ".twocolumn-menu-item .nav-second-level"
                                )),
                                (i = $("#two-col-menu li .collapse")).on({
                                    "show.bs.collapse": function () {
                                        var e = $(this)
                                            .closest(t)
                                            .closest(t)
                                            .find(i);
                                        (e.length ? e : i)
                                            .not($(this))
                                            .collapse("hide");
                                    },
                                }),
                                a.on("click", function (e) {
                                    var t = $($(this).attr("href"));
                                    return (
                                        !t.length ||
                                        (e.preventDefault(),
                                        a.removeClass("active"),
                                        $(this).addClass("active"),
                                        n.removeClass("d-block"),
                                        t.addClass("d-block"),
                                        $.LayoutThemeApp.leftSidebar.changeSize(
                                            "default"
                                        ),
                                        !1)
                                    );
                                }),
                                (o = window.location.href),
                                a.each(function () {
                                    this.href === o &&
                                        $(this).addClass("active");
                                }),
                                $("#two-col-menu a").each(function () {
                                    var e, t, a;
                                    this.href == o &&
                                        ($(this).addClass("active"),
                                        $(this)
                                            .parent()
                                            .addClass("menuitem-active"),
                                        $(this)
                                            .parent()
                                            .parent()
                                            .parent()
                                            .addClass("show"),
                                        $(this)
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .addClass("menuitem-active"),
                                        "sidebar-menu" !==
                                            (e = $(this)
                                                .parent()
                                                .parent()
                                                .parent()
                                                .parent()
                                                .parent()
                                                .parent()).attr("id") &&
                                            e.addClass("show"),
                                        $(this)
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .addClass("menuitem-active"),
                                        "wrapper" !==
                                            (e = $(this)
                                                .parent()
                                                .parent()
                                                .parent()
                                                .parent()
                                                .parent()
                                                .parent()
                                                .parent()
                                                .parent()
                                                .parent()).attr("id") &&
                                            e.addClass("show"),
                                        (e = $(this)
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()
                                            .parent()).is("body") ||
                                            e.addClass("menuitem-active"),
                                        (t = null),
                                        (a =
                                            "#" +
                                            $(this)
                                                .parents(".twocolumn-menu-item")
                                                .attr("id")),
                                        $(
                                            "#two-col-sidenav-main .nav-link"
                                        ).each(function () {
                                            $(this).attr("href") === a &&
                                                (t = $(this));
                                        }),
                                        t && t.trigger("click"));
                                }));
                    },
                },
                {
                    key: "init",
                    value: function () {
                        this.initMenu();
                    },
                },
            ]),
            e
        );
    })(),
    Topbar = (function () {
        function e() {
            _classCallCheck(this, e),
                (this.body = $("body")),
                (this.window = $(window));
        }
        return (
            _createClass(e, [
                {
                    key: "toggleRightSideBar",
                    value: function () {
                        document.body.classList.contains("right-bar-enabled")
                            ? document.body.classList.remove(
                                  "right-bar-enabled"
                              )
                            : document.body.classList.add("right-bar-enabled");
                    },
                },
                {
                    key: "initMenu",
                    value: function () {
                        var e = this;
                        null !==
                            (t = document.querySelector(".right-bar-toggle")) &&
                            void 0 !== t &&
                            t.addEventListener("click", function () {
                                e.toggleRightSideBar();
                            }),
                            $("#top-search").on("click", function (e) {
                                $("#search-dropdown").addClass("d-block");
                            }),
                            $(".topbar-dropdown").on(
                                "show.bs.dropdown",
                                function () {
                                    $("#search-dropdown").removeClass(
                                        "d-block"
                                    );
                                }
                            ),
                            $(".navbar-nav a").each(function () {
                                var e,
                                    t = window.location.href.split(/[?#]/)[0];
                                this.href == t &&
                                    ($(this).addClass("active"),
                                    $(this).parent().addClass("active"),
                                    $(this)
                                        .parent()
                                        .parent()
                                        .addClass("active"),
                                    $(this)
                                        .parent()
                                        .parent()
                                        .parent()
                                        .addClass("active"),
                                    $(this)
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .addClass("active"),
                                    $(this)
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .hasClass("mega-dropdown-menu")
                                        ? ($(this)
                                              .parent()
                                              .parent()
                                              .parent()
                                              .parent()
                                              .parent()
                                              .addClass("active"),
                                          $(this)
                                              .parent()
                                              .parent()
                                              .parent()
                                              .parent()
                                              .parent()
                                              .parent()
                                              .addClass("active"))
                                        : (e = $(this)
                                              .parent()
                                              .parent()[0]
                                              .querySelector(
                                                  ".dropdown-item"
                                              )) &&
                                          ((t =
                                              window.location.href.split(
                                                  /[?#]/
                                              )[0]),
                                          (e.href != t &&
                                              !e.classList.contains(
                                                  "dropdown-toggle"
                                              )) ||
                                              e.classList.add("active")),
                                    (e = $(this)
                                        .parent()
                                        .parent()
                                        .parent()
                                        .parent()
                                        .addClass("active")
                                        .prev()).hasClass("nav-link") &&
                                        e.addClass("active"));
                            }),
                            $(".navbar-toggle").on("click", function (e) {
                                $(this).toggleClass("open"),
                                    $("#navigation").slideToggle(400);
                            });
                        var t = document.querySelectorAll(
                                "ul.navbar-nav .dropdown .dropdown-toggle"
                            ),
                            n = !1;
                        t.forEach(function (a) {
                            a.addEventListener("click", function (e) {
                                var t;
                                a.parentElement.classList.contains(
                                    "nav-item"
                                ) ||
                                    ((n = !0),
                                    a.parentElement.parentElement.classList.add(
                                        "show"
                                    ),
                                    ((t =
                                        a.parentElement.parentElement.parentElement.querySelector(
                                            ".nav-link"
                                        )).ariaExpanded = !0),
                                    t.classList.add("show"),
                                    bootstrap.Dropdown.getInstance(a).show());
                            }),
                                a.addEventListener(
                                    "hide.bs.dropdown",
                                    function (e) {
                                        n &&
                                            (e.preventDefault(),
                                            e.stopPropagation(),
                                            (n = !1));
                                    }
                                );
                        });
                    },
                },
                {
                    key: "init",
                    value: function () {
                        this.initMenu();
                    },
                },
            ]),
            e
        );
    })(),
    RightSidebar = (function () {
        function e() {
            _classCallCheck(this, e),
                (this.body = $("body")),
                (this.window = $(window));
        }
        return (
            _createClass(e, [
                {
                    key: "init",
                    value: function () {
                        $(document).on("click", "body", function (e) {
                            1 !== $(e.target).closest("#top-search").length &&
                                $("#search-dropdown").removeClass("d-block"),
                                0 <
                                    $(e.target).closest(
                                        ".right-bar-toggle, .right-bar"
                                    ).length ||
                                    0 <
                                        $(e.target).closest(
                                            ".left-side-menu, .side-nav"
                                        ).length ||
                                    $(e.target).hasClass(
                                        "button-menu-mobile"
                                    ) ||
                                    0 <
                                        $(e.target).closest(
                                            ".button-menu-mobile"
                                        ).length ||
                                    ($("body").removeClass("right-bar-enabled"),
                                    $("body").removeClass("sidebar-enable"));
                        });
                    },
                },
            ]),
            e
        );
    })(),
    ThemeCustomizer = (function () {
        function e() {
            _classCallCheck(this, e),
                (this.body = document.body),
                (this.defaultConfig = {
                    leftbar: {
                        color: "light",
                        size: "default",
                        position: "fixed",
                    },
                    layout: { color: "light", size: "fluid", mode: "default" },
                    topbar: { color: "light" },
                    sidebar: { user: !0 },
                });
        }
        return (
            _createClass(e, [
                {
                    key: "initConfig",
                    value: function () {
                        var e,
                            t = JSON.parse(JSON.stringify(this.defaultConfig));
                        (t.leftbar.color =
                            null !==
                                (e =
                                    this.body.getAttribute(
                                        "data-leftbar-color"
                                    )) && void 0 !== e
                                ? e
                                : this.defaultConfig.leftbar.color),
                            (t.leftbar.size =
                                null !==
                                    (e =
                                        this.body.getAttribute(
                                            "data-leftbar-size"
                                        )) && void 0 !== e
                                    ? e
                                    : this.defaultConfig.leftbar.size),
                            (t.leftbar.position =
                                null !==
                                    (e = this.body.getAttribute(
                                        "data-leftbar-position"
                                    )) && void 0 !== e
                                    ? e
                                    : this.defaultConfig.leftbar.position),
                            (t.layout.color =
                                null !==
                                    (e =
                                        this.body.getAttribute(
                                            "data-layout-color"
                                        )) && void 0 !== e
                                    ? e
                                    : this.defaultConfig.layout.color),
                            (t.layout.size =
                                null !==
                                    (e =
                                        this.body.getAttribute(
                                            "data-layout-size"
                                        )) && void 0 !== e
                                    ? e
                                    : this.defaultConfig.layout.size),
                            (t.layout.mode =
                                null !==
                                    (e =
                                        this.body.getAttribute(
                                            "data-layout-mode"
                                        )) && void 0 !== e
                                    ? e
                                    : this.defaultConfig.layout.mode),
                            (t.topbar.color =
                                null !==
                                    (e =
                                        this.body.getAttribute(
                                            "data-topbar-color"
                                        )) && void 0 !== e
                                    ? e
                                    : this.defaultConfig.topbar.color),
                            (t.sidebar.user =
                                null !==
                                    (e =
                                        this.body.getAttribute(
                                            "data-sidebar-user"
                                        )) && void 0 !== e
                                    ? e
                                    : this.defaultConfig.sidebar.user),
                            (this.defaultConfig = JSON.parse(
                                JSON.stringify(t)
                            )),
                            (this.config = t),
                            this.setSwitchFromConfig();
                    },
                },
                {
                    key: "changeLeftbarColor",
                    value: function (e) {
                        (this.config.leftbar.color = e),
                            this.body.setAttribute("data-leftbar-color", e),
                            this.setSwitchFromConfig();
                    },
                },
                {
                    key: "changeLeftbarPosition",
                    value: function (e) {
                        (this.config.leftbar.position = e),
                            this.body.setAttribute("data-leftbar-position", e),
                            this.setSwitchFromConfig();
                    },
                },
                {
                    key: "changeLeftbarSize",
                    value: function (e) {
                        (this.config.leftbar.size = e),
                            this.body.setAttribute("data-leftbar-size", e),
                            this.setSwitchFromConfig();
                    },
                },
                {
                    key: "changeLayoutMode",
                    value: function (e) {
                        (this.config.layout.mode = e),
                            this.body.setAttribute("data-layout-mode", e),
                            this.setSwitchFromConfig();
                    },
                },
                {
                    key: "changeLayoutColor",
                    value: function (e) {
                        (this.config.layout.color = e),
                            this.body.setAttribute("data-layout-color", e),
                            this.setSwitchFromConfig();
                    },
                },
                {
                    key: "changeLayoutSize",
                    value: function (e) {
                        (this.config.layout.size = e),
                            this.body.setAttribute("data-layout-size", e),
                            this.setSwitchFromConfig();
                    },
                },
                {
                    key: "changeTopbarColor",
                    value: function (e) {
                        (this.config.topbar.color = e),
                            this.body.setAttribute("data-topbar-color", e),
                            this.setSwitchFromConfig();
                    },
                },
                {
                    key: "changeSidebarUser",
                    value: function (e) {
                        (this.config.sidebar.user = e)
                            ? this.body.setAttribute("data-sidebar-user", e)
                            : this.body.removeAttribute("data-sidebar-user"),
                            this.setSwitchFromConfig();
                    },
                },
                {
                    key: "resetTheme",
                    value: function () {
                        (this.config = JSON.parse(
                            JSON.stringify(this.defaultConfig)
                        )),
                            this.changeLeftbarColor(this.config.leftbar.color),
                            this.changeLeftbarPosition(
                                this.config.leftbar.position
                            ),
                            this.changeLeftbarSize(this.config.leftbar.size),
                            this.changeLayoutColor(this.config.layout.color),
                            this.changeLayoutSize(this.config.layout.size),
                            this.changeLayoutMode(this.config.layout.mode),
                            this.changeTopbarColor(this.config.topbar.color),
                            this.changeSidebarUser(this.config.sidebar.user);
                    },
                },
                {
                    key: "initSwitchListener",
                    value: function () {
                        var e,
                            a = this;
                        document
                            .querySelectorAll("input[name=leftbar-color]")
                            .forEach(function (t) {
                                t.addEventListener("change", function (e) {
                                    a.changeLeftbarColor(t.value);
                                });
                            }),
                            document
                                .querySelectorAll("input[name=leftbar-size]")
                                .forEach(function (t) {
                                    t.addEventListener("change", function (e) {
                                        a.changeLeftbarSize(t.value);
                                    });
                                }),
                            document
                                .querySelectorAll(
                                    "input[name=leftbar-position]"
                                )
                                .forEach(function (t) {
                                    t.addEventListener("change", function (e) {
                                        a.changeLeftbarPosition(t.value);
                                    });
                                }),
                            document
                                .querySelectorAll("input[name=layout-color]")
                                .forEach(function (t) {
                                    t.addEventListener("change", function (e) {
                                        a.changeLayoutColor(t.value);
                                    });
                                }),
                            document
                                .querySelectorAll("input[name=layout-size]")
                                .forEach(function (t) {
                                    t.addEventListener("change", function (e) {
                                        a.changeLayoutSize(t.value);
                                    });
                                }),
                            document
                                .querySelectorAll("input[name=layout-mode]")
                                .forEach(function (t) {
                                    t.addEventListener("change", function (e) {
                                        a.changeLayoutMode(t.value);
                                    });
                                }),
                            document
                                .querySelectorAll("input[name=topbar-color]")
                                .forEach(function (t) {
                                    t.addEventListener("change", function (e) {
                                        a.changeTopbarColor(t.value);
                                    });
                                }),
                            document
                                .querySelectorAll("input[name=sidebar-user]")
                                .forEach(function (t) {
                                    t.addEventListener("change", function (e) {
                                        a.changeSidebarUser(t.checked);
                                    });
                                }),
                            null !==
                                (e = document.querySelector("#resetBtn")) &&
                                void 0 !== e &&
                                e.addEventListener("click", function (e) {
                                    a.resetTheme();
                                }),
                            null !==
                                (e = document.querySelector(
                                    ".button-menu-mobile"
                                )) &&
                                void 0 !== e &&
                                e.addEventListener("click", function () {
                                    "default" === a.config.leftbar.size
                                        ? a.changeLeftbarSize("condensed")
                                        : a.changeLeftbarSize("default");
                                });
                    },
                },
                {
                    key: "setSwitchFromConfig",
                    value: function () {
                        document
                            .querySelectorAll(".right-bar input[type=checkbox]")
                            .forEach(function (e) {
                                e.checked = !1;
                            });
                        var e,
                            t,
                            a,
                            n,
                            i,
                            o,
                            r,
                            s,
                            l = this.config;
                        l &&
                            ((e = document.querySelector(
                                "input[type=checkbox][name=leftbar-color][value=" +
                                    l.leftbar.color +
                                    "]"
                            )),
                            (t = document.querySelector(
                                "input[type=checkbox][name=leftbar-size][value=" +
                                    l.leftbar.size +
                                    "]"
                            )),
                            (a = document.querySelector(
                                "input[type=checkbox][name=leftbar-position][value=" +
                                    l.leftbar.position +
                                    "]"
                            )),
                            (n = document.querySelector(
                                "input[type=checkbox][name=layout-color][value=" +
                                    l.layout.color +
                                    "]"
                            )),
                            (i = document.querySelector(
                                "input[type=checkbox][name=layout-size][value=" +
                                    l.layout.size +
                                    "]"
                            )),
                            (o = document.querySelector(
                                "input[type=checkbox][name=layout-mode][value=" +
                                    l.layout.type +
                                    "]"
                            )),
                            (r = document.querySelector(
                                "input[type=checkbox][name=topbar-color][value=" +
                                    l.topbar.color +
                                    "]"
                            )),
                            (s = document.querySelector(
                                "input[type=checkbox][name=sidebar-user]"
                            )),
                            e && (e.checked = !0),
                            t && (t.checked = !0),
                            a && (a.checked = !0),
                            n && (n.checked = !0),
                            i && (i.checked = !0),
                            o && (o.checked = !0),
                            r && (r.checked = !0),
                            s &&
                                "true" === l.sidebar.user.toString() &&
                                (s.checked = !0));
                    },
                },
                {
                    key: "init",
                    value: function () {
                        this.initConfig(), this.initSwitchListener();
                    },
                },
            ]),
            e
        );
    })(),
    Layout = (function () {
        function e() {
            _classCallCheck(this, e);
        }
        return (
            _createClass(e, [
                {
                    key: "init",
                    value: function () {
                        (this.themeCustomizer = new ThemeCustomizer()),
                            this.themeCustomizer.init(),
                            (this.leftSidebar = new LeftSidebar()),
                            (this.topbar = new Topbar()),
                            (this.rightSidebar = new RightSidebar(this)),
                            this.rightSidebar.init(),
                            this.topbar.init(),
                            this.leftSidebar.init();
                    },
                },
            ]),
            e
        );
    })();
window.addEventListener("DOMContentLoaded", function (e) {
    new Layout().init();
});
