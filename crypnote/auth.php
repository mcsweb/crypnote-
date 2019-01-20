<div style="position:absolute;top:35vh;left:40vw;">
    <center>
        <div style="color:red;"><?echo $_SESSION['$auth'];?></div>
    <form action="login.php" method="POST">
    	<i class="fas fa-user"></i> <input type="text" placeholder="user" name="login"><br><br>
    	<i class="fas fa-key"></i> <input type="password" id="password" placeholder="123456" name="pass" oninput="var input = document.getElementById('password').value;heshmd5=md5(input);document.getElementById('md5pass').value = heshmd5;"><br><br>
    	<input type="hidden" id="md5pass" name="md5pass">
    	<button type="submit">Войти</button>
    </form>
    </center>
</div>