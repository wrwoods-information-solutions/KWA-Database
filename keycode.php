
<!DOCTYPE html>
<html>
<body>

<p>Press the Escape/Esc key on the keyboard (usually in the top left corner) in the input field, to alert some text.</p>

<input type="text" size="50" onkeydown="keyCode(event)"> 

<script>
function keyCode(event) {
    var x = event.keyCode;
    if (x == 27) {
        alert ("You pressed the Escape key!");
    }
}
</script>

</body>
</html>
