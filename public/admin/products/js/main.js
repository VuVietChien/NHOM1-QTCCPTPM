// Upload File
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
$("#upload").change(function () {
    const form = new FormData();
    form.append("file", $(this)[0].files[0]);
    $.ajax({
        type: "POST",
        url: "/upload/services",
        data: form,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (response) {
            if (!response.error) {
                $("#image_show").html(`
                <img width="300px" src="${response.url}" alt="" />
                `);
                $("#file").val(response.url);
            } else {
                alert("Upload file lỗi");
            }
        },
    });
});
function removeRow(e) {
    e.preventDefault();
    let id = $(this).data("id"); // will return the number 123
    let url = $(this).data("url"); // will return the number 123
    if (confirm("Bạn có muốn xoá không?")) {
        $.ajax({
            type: "DELETE",
            url: url,
            data: { id },
            dataType: "JSON",
            success: function (response) {
                if (response.error === false) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert("Xoá thất bại, vui lòng thử lại");
                }
            },
        });
    }
}
$(document).ready(function () {
    $(document).on("click", "#btnDelete", removeRow);
});
