document.addEventListener('DOMContentLoaded', () => {
    const modeToggle = document.getElementById('modeToggle');
    const toggleLabel = document.getElementById('toggleLabel');
    const body = document.body;

    // Função para aplicar o estado do modo
    const applyMode = (isNeonMode) => {
        if (isNeonMode) {
            body.classList.add('neon');
            toggleLabel.textContent = 'ON';
        } else {
            body.classList.remove('neon');
            toggleLabel.textContent = 'OFF';
        }
    };

    // Carregar o estado salvo no localStorage (se existir)
    const savedMode = localStorage.getItem('neonMode');
    if (savedMode === 'true') {
        modeToggle.checked = true;
        applyMode(true);
    } else {
        modeToggle.checked = false;
        applyMode(false);
    }

    // Adicionar listener para a mudança do toggle
    modeToggle.addEventListener('change', () => {
        const isNeonMode = modeToggle.checked;
        applyMode(isNeonMode);
        // Salvar o estado no localStorage
        localStorage.setItem('neonMode', isNeonMode);
    });
});

const profileToggle = document.getElementById('profileToggle');
    const profileMenu = document.getElementById('profileMenu');

    profileToggle.addEventListener('click', () => {
      profileMenu.classList.toggle('active'); // Adiciona/remove a classe 'active'
    });

    // Fechar o menu se clicar fora dele
    document.addEventListener('click', (event) => {
      if (!profileToggle.contains(event.target) && !profileMenu.contains(event.target)) {
        profileMenu.classList.remove('active');
      }
    });


    // não deixar espaço em branco passar no login
    const form = document.getElementById('loginForm');

    form.addEventListener('submit', function(event) {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();

    if (!username || !password) {
      event.preventDefault(); // impede o envio do formulário
      alert('Por favor, preencha todos os campos.');
    }
  });