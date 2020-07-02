//入力欄が空の場合にエラーメッセージを表示する 
//※注意：on.clickイベントではそのままデータ送信されてしまう
function chk() {
    if ($('input[name="user_name"]').val() == "" && $('input[name="psw"]').val() == "") {
        alert("入力欄が空です");
        return false;
    } else if ($('input[name="user_name"]').val() == "") {
        alert("名前が記入されていません。");
        return false;
    } else if ($('input[name="psw"]').val() == "") {
        alert("パスワードが記入されていません。");
        return false;
    } else {

    }
}