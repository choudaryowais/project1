 
<?=$this->extend('indextemplate')?>
<?=$this->section('content')?>


<body>
    <div class="background-image">
        <div class="login-container">
            <h2>Login</h2>
            <form action="get/login" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
    
</body>


<?=$this->endSection()?>
