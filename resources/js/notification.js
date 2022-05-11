import Pusher from "pusher-js";

$(document).ready(function () {

    var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
        encrypted: true,
        cluster: "ap1",
    });
    console.log(pusher)
    var channel = pusher.subscribe("my-channel-" + window.user);
    channel.bind("my-event", async function (data) {

        let notiNum = parseInt($("#notiNum").find(".badge").html());
        if (Number.isNaN(notiNum)) {
            $("#notiNum").append(
                '<span class="badge badge-danger">1</span>'
            );
        } else {
            $("#notiNum")
                .find(".badge")
                .html(notiNum + 1);
        }

        let message =
            `<li class="unchecked">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="notify-img"><img src="" alt="">
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
                <a href="#" class="link-view" data-id="${data.notification_id}">${data.message}</a>
                <hr>
                <p class="time">${data.created_at}</p>
            </div>
        </li>`;

        $('.drop-content').prepend(message);
    });

    $(document).on('click', '.link-view', function (e) {
        e.preventDefault();

        let id = $(this).attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/user/notifications/" + id,
            success: function () {
                let notiNum = parseInt($("#notiNum").find(".badge").html());
                if (notiNum != NaN) {
                    $("#notiNum")
                        .find(".badge")
                        .html(notiNum - 1);
                }

                window.location.href = '/user/articles';
            }
        });
    });

    $(document).on('click', '.allRead', function (e) {
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/user/notifications",
            success: function () {
                $("#notiNum").html('');
                $('.drop-content li').each(function () {
                    $(this).removeClass('unchecked');
                });
            }
        });
    });
});
