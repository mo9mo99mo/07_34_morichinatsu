//入力欄が空の場合にエラーメッセージを表示する 
//※注意：on.clickイベントではそのままデータ送信されてしまう
function chk() {
    if ($('input[name="img"]').val() == "" && $('input[name="date"]').val() == "" && $('input[name="title"]').val() == "" && $('input[name="honbun"]').val() == "") {
        alert("入力欄が空です");
        $("#img_error").html("画像が選択されていません。");
        $("#date_error").html("日付が選択されていません。");
        $("#ttl_error").html("タイトルがありません。");
        $("#honbun_error").html("本文がありません。");
        return false;
    } else if (
        $('input[name="img"]').val() == ""
    ) {
        if ($('input[name="date"]').val() == ""
            && $('input[name="title"]').val() == "") {
            $("#img_error").html("画像が選択されていません。");
            $("#date_error").html("日付が選択されていません。");
            $("#ttl_error").html("タイトルがありません。");
            return false;
        }
        else if (!$('input[name="date"]').val() == ""
            && $('input[name="title"]').val() == "") {
            $("#img_error").html("画像が選択されていません。");
            $("#ttl_error").html("タイトルがありません。");
            return false;
        }
        else if (
            $('input[name="date"]').val() == ""
            && !$('input[name="title"]').val() == "") {
            $("#img_error").html("画像が選択されていません。");
            $("#date_error").html("日付が選択されていません。");
            return false;
        }
        else {
            $("#img_error").html("画像が選択されていません。");
            return false;
        }

    } else if ($('input[name="date"]').val() == "") {
        if ($('input[name="img"]').val() == ""
            && $('input[name="title"]').val() == "") {
            $("#date_error").html("日付が選択されていません。");
            $("#img_error").html("画像が選択されていません。");
            $("#ttl_error").html("タイトルがありません。");
            return false;
        }
        else if (
            !$('input[name="img"]').val() == ""
            && $('input[name="title"]').val() == "") {
            $("#date_error").html("日付が選択されていません。");
            $("#ttl_error").html("タイトルがありません。");
            return false;
        }
        else if (
            $('input[name="img"]').val() == ""
            && !$('input[name="title"]').val() == "") {
            $("#date_error").html("日付が選択されていません。");
            $("#img_error").html("画像が選択されていません。");
            return false;
        } else {
            $("#date_error").html("日付が選択されていません。");
            return false;
        }
    } else if (
        $('input[name="title"]').val() == "") {
        if ($('input[name="img"]').val() == ""
            && $('input[name="date"]').val() == "") {
            $("#ttl_error").html("タイトルがありません。");
            $("#img_error").html("画像が選択されていません。");
            $("#date_error").html("日付が選択されていません。");
            return false;
        } else if (
            !$('input[name="img"]').val() == ""
            && $('input[name="date"]').val() == "") {
            $("#ttl_error").html("タイトルがありません。");
            $("#date_error").html("日付が選択されていません。");
            return false;
        } else if (
            $('input[name="img"]').val() == ""
            && !$('input[name="date"]').val() == "") {
            $("#ttl_error").html("タイトルがありません。");
            $("#img_error").html("画像が選択されていません。");
            return false;
        } else {
            $("#ttl_error").html("タイトルがありません。");
            return false;
        }

    } else {

    }
}
