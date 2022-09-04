const forms = document.querySelectorAll('#form-js');

forms.forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const url = this.getAttribute('action');
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const articleId = this.querySelector('#article-id-js').value;
        const count = this.querySelector('#count-js');


        fetch(url, {
            method: 'POST',
            headers: {
            'Accept': 'application/json',
            'Content-type': 'application/json',
            'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
            id: articleId,
            
            })
        }).then(response => {
            response.json().then(data => {
                count.innerHTML = data.count;
                // console.log(data)
            })
        }).catch(error => {
            console.log(error)
        });

    });
});