const advertsiments = document.getElementById('advertisments');

if(advertsiments)
{
    advertsiments.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger delete-advertisment')
        {
            if(confirm('Are you sure?'))
            {
                const id = e.target.getAttribute('data-id');

                fetch(`/advertisment/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    })
}