"use strict";
$(document).ready(function () {
    $("#basicwizard").bootstrapWizard(),
        $("#progressbarwizard").bootstrapWizard({
            onTabShow: function (t, r, a) {
                r = ((a + 1) / r.find("li").length) * 100;
                $("#progressbarwizard")
                    .find(".bar")
                    .css({ width: r + "%" });
            },
        }),
        $("#btnwizard").bootstrapWizard({
            nextSelector: ".button-next",
            previousSelector: ".button-previous",
            firstSelector: ".button-first",
            lastSelector: ".button-last",
        }),
        $("#rootwizard").bootstrapWizard({
            onNext: function (t, r, a) {
                t = $($(t).data("targetForm"));
                if (
                    t &&
                    (t.addClass("was-validated"), !1 === t[0].checkValidity())
                )
                    return event.preventDefault(), event.stopPropagation(), !1;
            },
        });
});
