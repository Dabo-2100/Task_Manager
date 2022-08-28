$(document).ready(function () {
    $.ajax({
        "url": "php/backend/index.php",
        "method": "GET",
        "data": {
            Action_name: "get_user_date_of_brith",
            user_id: 2
        },
        success: function (response) {
            if (response != '[]') {
                tasks = response.trim();

            }
            else {
            }
        }
    });


    i = 1;
    $("#mytasks_action").click();
    setInterval(function () {
        if (i == 1) {
            $("#new_task_img_div").css("background-image", "url('css/photos/2.jpg')");
            i = 2;
        }
        else if (i == 2) {
            $("#new_task_img_div").css("background-image", "url('css/photos/3.jpg')");
            i = 3;
        }
        else {
            $("#new_task_img_div").css("background-image", "url('css/photos/1.jpg')");
            i = 1;
        }
    }, 3000);
});

$("#newtask_action").on("click", function () {
    $("#action_area").html(
        "<div id='new_task_form'>"
        + "<h1>Create New Task</h1>"
        + "<input type='text' placeholder='Task_Name'>"
        + "<input type='text' placeholder='Task_Details'>"
        + "<button id='save_newtask'>Save Task</button>"
        + "</div>"
        + "<div id='new_task_img_div'>"
        + "</div>"
    );
    $("#new_task_form").fadeIn(500);
    $("#new_task_img_div").fadeIn(500);

});

$("#mytasks_action").on("click", function () {
    tasks = [];
    $.ajax({
        "url": "php/backend/index.php",
        "method": "GET",
        "data": {
            Action_name: "get_user_tasks",
            user_id: 1
        },
        success: function (response) {
            if (response != '[]') {
                tasks = response.trim();
                show_my_tasks(tasks);
            }
            else {
                //Dabo_alert("Error","لا يوجد جوابات جديدة ",1800);
            }
        }
    });
});

$("body").on("click", "#action_area .mytask", function () {
    if ($("input", this).prop("checked") === true) {
        $("input", this).prop("checked", false);
        $("p", this).css("text-decoration-line", "none");
    }
    else {
        $("input", this).prop("checked", true);
        $("p", this).css("text-decoration-line", "line-through");
    }

});

$("body").on("mouseenter", "#action_area .mytask", function () {
    task_details = "task details will appears here";
    $("p", this).css("width", "63%");
    $("img", this).fadeIn(300);
    $("h1", this).remove();
    $(this).append(
        "<h1>" + task_details + "</h1>"
    );
});
$("body").on("mouseleave", "#action_area .mytask", function () {
    $("p", this).css("width", "70%");
    $("img", this).css("display", "none");
    $("h1", this).remove();
});

$("#action_area").on("click", ".mytask img", function (e) {
    e.stopPropagation();
    $(this).parent().remove();
})

function show_my_tasks(tasks) {
    $("#action_area").html("");
    $("#action_area").append(
        "<div class='mytask'>"
        + "<img src='css/photos/remove_icon.png'>"
        + "<p>" + tasks + "</p>"
        + "<input type='checkbox'>"
        + "</div>"
    );
    $(".mytask").fadeIn(700);
}

