
<form action="send_link-do.php" method="POST">
Phone Number : (<input type="text" name="area_code" size="3" maxlength="3">)
<input type="text" name="phone_number" size="7" maxlength="7">
<select name="carrier">
  <option value="Sprint">Sprint</option>
  <option value="Cingular">Cingular</option>
  <option value="T-Mobile">T-Mobile</option>
  <option value="Verizon">Verizon</option>
  <option value="Virgin">Virgin</option>
  <option value="Nextel">Nextel</option>
</select>

<select name="size">
  <option value="240">240</option>
  <option value="176">176</option>
  <option value="132">132</option>
  <option value="128">128</option>
</select>

<input type="submit" name="submit" value="Go">
</form> 
