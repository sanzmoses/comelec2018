if(isset($_FILES['file_array'])){
    $name_array = $_FILES['file_array']['name'];
    $tmp_name_array = $_FILES['file_array']['tmp_name'];
    $type_array = $_FILES['file_array']['type'];
    $size_array = $_FILES['file_array']['size'];
    $error_array = $_FILES['file_array']['error'];
    for($i = 0; $i < count($tmp_name_array); $i++){
        if(move_uploaded_file($tmp_name_array[$i], "test_uploads/".$name_array[$i])){
            echo $name_array[$i]." upload is complete<br>";
        } else {
            echo "move_uploaded_file function failed for ".$name_array[$i]."<br>";
        }
    }
}
?>

  $('#addButton').click(function () {
        var avatar = $("#avatarupload").val();
        var extension = avatar.split('.').pop().toUpperCase();
        if(avatar.length < 1) {
            avatarok = 0;
        }
        else if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG"){
            avatarok = 0;
            alert("invalid extension "+extension);
        }
        else {
            avatarok = 1;
        }
        if(avatarok == 1) {
            $('.formValidation').addClass("sending");
            $("#form").submit();
        }
        else {
            $('.formValidation').addClass("validationError");
        }
        return false;
    });