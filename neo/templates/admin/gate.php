<form name="myform">
    <textarea name="limitxedtextarea" onKeyDown="limitText(this.form.limitedtextarea,this.form.countdown,100);" onKeyUp="limitText(this.form.limitedtextarea,this.form.countdown,100);">
</textarea><br>
    <font size="1">(Maximum characters: 100)<br>
        You have <input readonly type="text" name="countdown" size="3" value="100"> characters left.</font>
</form>