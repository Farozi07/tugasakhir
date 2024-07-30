"use strict";
$(document).ready(function () {
    function e() {
        $("#sparkline1").sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40], {
            type: "line",
            width: "100%",
            height: "165",
            chartRangeMax: 50,
            lineColor: "#5b69bc",
            fillColor: "rgba(91, 105, 188, 0.3)",
            highlightLineColor: "rgba(0,0,0,.1)",
            highlightSpotColor: "rgba(0,0,0,.2)",
        }),
            $("#sparkline1").sparkline([25, 23, 26, 24, 25, 32, 30, 24, 19], {
                type: "line",
                width: "100%",
                height: "165",
                chartRangeMax: 40,
                lineColor: "#ff8acc",
                fillColor: "rgba(255, 138, 204, 0.3)",
                composite: !0,
                highlightLineColor: "rgba(0,0,0,.1)",
                highlightSpotColor: "rgba(0,0,0,.2)",
            }),
            $("#sparkline2").sparkline(
                [3, 6, 7, 8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12],
                {
                    type: "bar",
                    height: "165",
                    barWidth: "10",
                    barSpacing: "3",
                    barColor: "#71b6f9",
                }
            ),
            $("#sparkline3").sparkline([20, 40, 30], {
                type: "pie",
                width: "165",
                height: "165",
                sliceColors: ["#f5f5f5", "#188ae2", "#ff8acc"],
            }),
            $("#sparkline4").sparkline([0, 23, 43, 35, 44, 45, 56, 37, 40], {
                type: "line",
                width: "100%",
                height: "165",
                chartRangeMax: 50,
                lineColor: "#10c469",
                fillColor: "transparent",
                highlightLineColor: "rgba(0,0,0,.1)",
                highlightSpotColor: "rgba(0,0,0,.2)",
            }),
            $("#sparkline4").sparkline([25, 23, 26, 24, 25, 32, 30, 24, 19], {
                type: "line",
                width: "100%",
                height: "165",
                chartRangeMax: 40,
                lineColor: "#188ae2",
                fillColor: "transparent",
                composite: !0,
                highlightLineColor: "rgba(0,0,0,1)",
                highlightSpotColor: "rgba(0,0,0,1)",
            }),
            $("#sparkline6").sparkline(
                [3, 6, 7, 8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12],
                {
                    type: "bar",
                    height: "165",
                    barWidth: "10",
                    barSpacing: "3",
                    barColor: "#10c469",
                }
            ),
            $("#sparkline6").sparkline(
                [3, 6, 7, 8, 6, 4, 7, 10, 12, 7, 4, 9, 12, 13, 11, 12],
                {
                    type: "line",
                    width: "100%",
                    height: "165",
                    lineColor: "#435966",
                    fillColor: "transparent",
                    composite: !0,
                    highlightLineColor: "rgba(0,0,0,.1)",
                    highlightSpotColor: "rgba(0,0,0,.2)",
                }
            );
    }
    function r() {
        var r,
            l = -1,
            t = -1,
            o = 0,
            a = [];
        function h() {
            var i,
                e = new Date().getTime();
            r &&
                r != e &&
                ((i = Math.round((o / (e - r)) * 1e3)),
                a.push(i),
                30 < a.length && a.splice(0, 1),
                (o = 0),
                $("#sparkline5").sparkline(a, {
                    tooltipSuffix: " pixels per second",
                    type: "line",
                    width: "100%",
                    height: "165",
                    chartRangeMax: 50,
                    lineColor: "#f9c851",
                    fillColor: "rgba(249, 200, 81, 0.3)",
                    highlightLineColor: "rgba(24,147,126,.1)",
                    highlightSpotColor: "rgba(24,147,126,.2)",
                })),
                (r = e),
                setTimeout(h, 500);
        }
        $("html").mousemove(function (i) {
            var e = i.pageX,
                i = i.pageY;
            -1 < l && (o += Math.max(Math.abs(e - l), Math.abs(i - t))),
                (l = e),
                (t = i);
        }),
            setTimeout(h, 500);
    }
    var l;
    e(),
        r(),
        $(window).resize(function (i) {
            clearTimeout(l),
                (l = setTimeout(function () {
                    e(), r();
                }, 300));
        });
});
