$(document).ready(function () {
    $("#close").click(function () {
        $("form").each(function () {
            if (this.id == "content-form") {
                this.reset();
                $(".upload-display").empty();
            };
        });
    });
});