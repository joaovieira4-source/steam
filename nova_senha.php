<!DOCTYPE html>
<html>
<head>
  <title>Redefinir senha</title>
</head>
<body>

    <div class="toggle-container">
        <label class="switch">
        <input type="checkbox" id="modeToggle" />
        <span class="slider"></span>
        </label>
        <span id="toggleLabel">OFF</span>
    </div>

  <h2>Redefinir senha</h2>
  <form id="formSenha">
    <input type="password" id="novaSenha" placeholder="Nova senha" required />
    <input type="password" id="confirmaSenha" placeholder="Confirmar senha" required />
    <button type="submit">Atualizar senha</button>
  </form>

  <script>
    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get('token');

    document.getElementById('formSenha').addEventListener('submit', async (e) => {
      e.preventDefault();

      const novaSenha = document.getElementById('novaSenha').value;
      const confirmaSenha = document.getElementById('confirmaSenha').value;

      if (novaSenha !== confirmaSenha) {
        alert('Senhas não coincidem!');
        return;
      }

      const res = await fetch('/redefinir-senha', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ token, novaSenha })
      });

      const data = await res.json();
      alert(data.message);

      if (res.ok) {
        window.location.href = 'login'; // redireciona para login
      }
    });
  </script>
</body>
</html>
