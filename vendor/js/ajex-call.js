
function likePost(postId) {
    $.ajax({
        type: "POST",
        url: "like.php",
        data: {
            post_id: postId
        },
        success: function (response) {
            $("#likeCount_" + postId).text(response);
        }
    });
}
