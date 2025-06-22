let ws = new WebSocket("ws://localhost:8080")

ws.onopen = function() {
    let sessionToken = window.document.getElementById('sessionToken')?.value || ''

    console.log("Sending auth with token:", sessionToken);

    let authData = {
        type: "auth",
        token: sessionToken
    }
    ws.send(JSON.stringify(authData))
}

ws.onmessage = function(event) {
    let data = JSON.parse(event.data)
    if (data.type === 'like') {
        updateNumberOfLikes(data)
    } else if (data.type === 'follow') {
        updateFollowSatus(data)
    }
}

function updateNumberOfLikes(data) {
    let likes = window.document.querySelector(`span#icone-reacao-num-${data.contentId}`)
    // alert(likes)
    // console.log(likes.textContent)
    likes.textContent = data.likes
}

function updateFollowSatus(data) {
    let follow = window.document.querySelector(`button#seguir-${data.profileId}`)
    let followers = window.document.querySelector(`button#button-followers`)

    if (follow.textContent == 'Seguir') {
        follow.textContent = 'A Seguir'
        followers.textContent = Number(followers.textContent) + 1
    } else {
        follow.textContent = 'Seguir'
        followers.textContent = Number(followers.textContent) - 1
    }
}

window.document.querySelectorAll("span[id^='icone-reacao-']").forEach((span) => {
    span.addEventListener('click', function () {
        let contentId = this.id.replace("icone-reacao-", "")
        let data = {
            type : 'like',
            contentId : contentId,
        }

        ws.send(JSON.stringify(data))
    })
})  

window.document.querySelectorAll("div[id^='icone-salvar-']").forEach((span) => {
    span.addEventListener('click', function () {
        let contentId = this.id.replace("icone-salvar-", "")
        let file = this.getAttribute('file')
        let tipo_conteudo = this.getAttribute('tipo_conteudo')
        let data = {
            type : 'save',
            contentId : contentId,
            file: file,
            tipo_conteudo : tipo_conteudo,
        }

        console.log(data)

        ws.send(JSON.stringify(data))
    })
})

window.document.querySelectorAll("button[id^='seguir-']").forEach((button) => {
    button.addEventListener('click', function () {
        let profileId = this.id.replace("seguir-", "")
        let data = {
            type : 'follow',
            profileId : profileId,
        }

        console.log('OK ' + data)

        ws.send(JSON.stringify(data))
    })
}) 

window.document.querySelectorAll("span[id^='icone-de-guardado-']").forEach((span) => {
    // Inicializa o estado visual no load da página
    updateSavedStyle(span);

    // Toggle no clique
    span.addEventListener('click', function () {
    this.setAttribute('saved', this.getAttribute('saved') === 'nao-guardado' ? 'guardado' : 'nao-guardado');
    updateSavedStyle(this);
    });
});

// Função utilitária para não repetir código
function updateSavedStyle(span) {
    let isSaved = span.getAttribute('saved');
    span.style.fontVariationSettings = isSaved === 'guardado' ? "'FILL' 1" : "'FILL' 0";
    span.style.color = isSaved === 'guardado' ? '#ED7D3A' : '#363537';
}

// Quando a página carrega
document.addEventListener("DOMContentLoaded", function() {

    // 1️⃣ No load: percorre todos os spans e garante que a cor está certa
    window.document.querySelectorAll("span[id^='icone-reacao-num-']").forEach((numSpan) => {
        if (numSpan.classList.contains('eu-gostei')) {
            numSpan.style.color = '#F7D500'; // cor de "gostei"
        } else {
            numSpan.style.color = '#363537'; // cor de "não gostei"
        }
    });

    // 2️⃣ No clique no like, alterna a classe e a cor
    window.document.querySelectorAll("span[id^='icone-reacao-']").forEach((span) => {
        span.addEventListener('click', function () {
            let contentId = this.id.replace("icone-reacao-", "");
            let numSpan = window.document.querySelector(`#icone-reacao-num-${contentId}`);
            if (!numSpan) return;

            // Alternar entre classes e cores
            if (numSpan.classList.contains('eu-gostei')) {
                numSpan.classList.remove('eu-gostei');
                numSpan.classList.add('nao-gostei');
                numSpan.style.color = '#363537';
            } else {
                numSpan.classList.remove('nao-gostei');
                numSpan.classList.add('eu-gostei');
                numSpan.style.color = '#F7D500';
            }
        });
    });
});