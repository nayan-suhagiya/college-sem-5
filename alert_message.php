<script src="./lib/js/sweetalert2.all.js"></script>
<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo "<div></div><script>
    Swal.fire({
        icon: '" . $message['icon'] . "',
        title: '" . $message['type'] . "',
        text: '" . $message['message'] . "'
    })
</script>";
    }
}
?>
<div></div>