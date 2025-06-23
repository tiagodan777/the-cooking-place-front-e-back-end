let ws = new WebSocket("ws://localhost:8080");

ws.onopen = function () {
    let sessionToken = document.getElementById('sessionToken')?.value || '';
    console.log("Sending auth with token:", sessionToken);

    let authData = {
        type: "auth",
        token: sessionToken
    };
    ws.send(JSON.stringify(authData));
};

ws.onmessage = function (event) {
    let data = JSON.parse(event.data);
    console.log("WebSocket message:", data);

    if (data.type === 'like') {
        updateNumberOfLikes(data);
    }
    if (data.type === 'follow') {
        updateFollowStatus(data);
    }
};

function updateNumberOfLikes(data) {
    let likes = document.querySelector(`span#icone-reacao-num-${data.contentId}`);
    if (likes) {
        likes.textContent = data.likes;
    }
}

function updateFollowStatus(data) {
    const profileId = data.profileId;
    const followButton = document.querySelector(`button#seguir-${profileId}`);
    const followersCount = document.querySelector('button#button-followers');

    if (!followersCount) return;

    // Atualiza o número de seguidores (para todos)
    if (typeof data.followers !== 'undefined') {
        followersCount.textContent = data.followers;
    }

    // Só o cliente que clicou deve mudar o botão
    if (!data.status || !followButton) return;

    if (data.status === 'followed') {
        followButton.textContent = 'A Seguir';
        followButton.classList.remove('seguir');
        followButton.classList.add('a_seguir');
    } else if (data.status === 'unfollowed') {
        followButton.textContent = 'Seguir';
        followButton.classList.remove('a_seguir');
        followButton.classList.add('seguir');
    }

    followButton.disabled = false;
}

// 👇 Atualiza likes visualmente e envia evento
document.querySelectorAll("span[id^='icone-reacao-']").forEach((span) => {
    span.addEventListener('click', function () {
        let contentId = this.id.replace("icone-reacao-", "");
        let numSpan = document.querySelector(`#icone-reacao-num-${contentId}`);

        if (numSpan) {
            // Alternar estilo
            if (numSpan.classList.contains('eu-gostei')) {
                numSpan.classList.remove('eu-gostei');
                numSpan.classList.add('nao-gostei');
                numSpan.style.color = '#363537';
            } else {
                numSpan.classList.remove('nao-gostei');
                numSpan.classList.add('eu-gostei');
                numSpan.style.color = '#F7D500';
            }
        }

        ws.send(JSON.stringify({
            type: 'like',
            contentId: contentId
        }));
    });
});

// 👇 Guardar conteúdos
document.querySelectorAll("div[id^='icone-salvar-']").forEach((span) => {
    span.addEventListener('click', function () {
        let contentId = this.id.replace("icone-salvar-", "");
        let file = this.getAttribute('file');
        let tipo_conteudo = this.getAttribute('tipo_conteudo');

        ws.send(JSON.stringify({
            type: 'save',
            contentId,
            file,
            tipo_conteudo
        }));
    });
});

// 👇 Botão seguir com proteção contra spam
document.querySelectorAll("button[id^='seguir-']").forEach((button) => {
    button.addEventListener('click', function () {
        if (button.disabled) return;

        button.disabled = true; // Evita spam até vir resposta do backend

        let profileId = this.id.replace("seguir-", "");

        ws.send(JSON.stringify({
            type: 'follow',
            profileId: profileId
        }));
    });
});

// 👇 Estilo dos guardados (inicialização e clique)
document.querySelectorAll("span[id^='icone-de-guardado-']").forEach((span) => {
    updateSavedStyle(span);

    span.addEventListener('click', function () {
        let estado = this.getAttribute('saved');
        this.setAttribute('saved', estado === 'nao-guardado' ? 'guardado' : 'nao-guardado');
        updateSavedStyle(this);
    });
});

function updateSavedStyle(span) {
    let isSaved = span.getAttribute('saved');
    span.style.fontVariationSettings = isSaved === 'guardado' ? "'FILL' 1" : "'FILL' 0";
    span.style.color = isSaved === 'guardado' ? '#ED7D3A' : '#363537';
}

// 👇 Cores dos likes ao carregar a página
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("span[id^='icone-reacao-num-']").forEach((numSpan) => {
        if (numSpan.classList.contains('eu-gostei')) {
            numSpan.style.color = '#F7D500';
        } else {
            numSpan.style.color = '#363537';
        }
    });
});