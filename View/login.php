<div id="errors"></div>
<form method="post" id="login-form">
    <div class="mb-3">

        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <button type="button" class="btn btn-primary" name="login_button" id="login-btn">Login</button>
</form>
<script src="./Assets/JavaScript/Services/login.js" type="module"></script>
<script type="module">
    import { login } from "./Assets/JavaScript/Services/login.js";

    document.addEventListener('DOMContentLoaded', () => {
        const loginBtn = document.querySelector('#login-btn')
        loginBtn.addEventListener('click', async (e) => {
            e.preventDefault();

            const formLogin = document.querySelector('#login-form');
            if (!formLogin.checkValidity()) {
                formLogin.reportValidity();
                return;
            }

            const loginResult = await login(formLogin.elements['username'].value, formLogin.elements['password'].value);

            if (loginResult.hasOwnProperty('authentication')) {
                document.location.href = 'index.php';
            } else if (loginResult.hasOwnProperty('errors')) {
                const errorsElement = document.querySelector('#errors');
                errorsElement.innerHTML = '';
                loginResult.errors.forEach(error => {
                    const errorDiv = document.createElement('div');
                    errorDiv.classList.add('alert', 'alert-danger');
                    errorDiv.setAttribute('role', 'alert');
                    errorDiv.textContent = error;
                    errorDiv.style.opacity = 1;
                    errorDiv.style.transition = 'opacity 1s';
                    errorsElement.appendChild(errorDiv);

                    setTimeout(() => {
                        errorDiv.style.opacity = 0;
                    }, 1000,);

                    setTimeout(() => {
                        errorsElement.innerHTML = '';
                    }, 5000);
                });


                console.log(loginResult.errors);

            }
        });
    });
</script>
