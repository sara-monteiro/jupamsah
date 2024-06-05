document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede que o formulário seja enviado diretamente

    var email = document.getElementById('email').value;
    var senha = document.getElementById('senha').value;

    // Enviar dados para o servidor para verificação
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'verificar_login.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status == 200) {
            document.getElementById('mensagem').innerHTML = xhr.responseText;
        }
    };
    xhr.send('email=' + email + '&senha=' + senha);
});