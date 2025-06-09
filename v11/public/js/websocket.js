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
    } else {
        console.log('Oi tola')
    }
    // console.log(`Ganda parva: ${data}`)
}

function updateNumberOfLikes(data) {
    let likes = window.document.querySelector(`span#icone-reacao-num-${data.contentId}`)
    // alert(likes)
    // console.log(likes.textContent)
    likes.textContent = data.likes
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
            tipo_conteudo : tipo_conteudo
        }

        console.log(data)

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